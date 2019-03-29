<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Auth extends CI_Controller {

  function __construct()
  {
    parent::__construct();

		$this->load->model('AuthModel');
  }

  function login_user()
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {

      $nip      = $this->input->post('nip');
      $password = $this->input->post('password');

      if($nip == null || $password == null) {
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIP dan Password belum lengkap' ));
      } else {
        $user   = $this->AuthModel->loginUser($nip);

        if($user->num_rows() == 0){
          json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIP tidak ditemukan' ));
        } else {
          foreach($user->result() as $key){
            $db_password    = $key->password;
            $status         = $key->status;
            $level          = strtolower($key->level);

            if($level == 'customer service'){
              $level = 'customer_service';
            }

            $session = array(
              'nip'            => $key->nip,
              'nama_user'      => $key->nama_user,
              'tgl_registrasi' => $key->tgl_registrasi,
              'foto'           => $key->foto,
              'level'          => $level,
              'token'          => $key->token
            );

            $data = array(
              'user'        => $key->nip,
              'keterangan'  => 'User login',
              'kategori'    => 'Login'
            );
          }

          if(hash_equals($password, $db_password)){
            if($status != 'Aktif'){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'User sudah tidak aktif' ));
            } else {

              $log = $this->LogModel->add($data);

              $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
              );
              $pusher = new Pusher\Pusher(
                '9e635b2377fe901b86c3',
                '5a3cbd48fcd0cc669b54',
                '744014',
                $options
              );

              $pusher->trigger('lion_membership', 'log', $data);

              if(!$log){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal melakukan login' ));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan login', 'data' => $session ));
              }
            }
          } else {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Password salah' ));
          }
        }
      }
    }
  }

  function logout_user($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $log = array(
            'user'        => $otorisasi->nip,
            'keterangan'  => 'User logout',
            'kategori'    => 'Logout'
          );

          $add_log = $this->LogModel->add($log);

          $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            '9e635b2377fe901b86c3',
            '5a3cbd48fcd0cc669b54',
            '744014',
            $options
          );

          $pusher->trigger('lion_membership', 'log', $log);

          if(!$add_log){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal Logout'));
          } else {
            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil logout'));
          }
        }
      }
    }
  }

  function password_user($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $db_password  = $otorisasi->password;
          $old_password = $this->input->post('password_lama');
          $new_password = $this->input->post('password_baru');

          if($old_password == null || $new_password == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
          } else {
            if($old_password != $db_password){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Password lama salah'));
            } else {

              $data = array(
                'password' => $new_password
              );

              $log = array(
                'user'        => $otorisasi->nip,
                'keterangan'  => 'Mengganti password lama menjadi password baru',
                'kategori'    => 'Ganti Password'
              );

              $pass = $this->AuthModel->gantiPass($otorisasi->nip, $data, $log);

              $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
              );
              $pusher = new Pusher\Pusher(
                '9e635b2377fe901b86c3',
                '5a3cbd48fcd0cc669b54',
                '744014',
                $options
              );

              $pusher->trigger('lion_membership', 'log', $log);

              if(!$pass){
                json_output(500, array('status' => 500, 'description' => 'Gagal', 'message' => 'Gagal mengganti password'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Gagal', 'message' => 'Berhasil mengganti password'));
              }
            }
          }
        }
      }
    }
  }

}

 ?>
