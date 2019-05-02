<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class User extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );
    $this->pusher = new Pusher\Pusher(
      '9e635b2377fe901b86c3',
      '5a3cbd48fcd0cc669b54',
      '744014',
      $this->options
    );

		$this->load->model('UserModel');
  }

  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Helpdesk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_karyawan  = $this->input->get('id_karyawan');
      			$nama_user	  = $this->input->get('nama_user');

            $show  = $this->UserModel->show($id_karyawan, $nama_user);
            $user  = array();

            foreach($show->result() as $key){
              $json = array();

              $json['id_karyawan']    = $key->id_karyawan;
              $json['nama_user']      = $key->nama_user;
              $json['password']       = $key->password;
              $json['level']          = $key->level;
              $json['tgl_registrasi'] = $key->tgl_registrasi;
              $json['foto']           = $key->foto;
              $json['status']         = $key->status;

              $user[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $user));
          }
        }
      }
    }
  }

  function add($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Helpdesk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_karyawan  = $this->input->post('id_karyawan');
            $nama_user    = $this->input->post('nama_user');
            $level        = $this->input->post('level');

            if($id_karyawan == null || $nama_user == null || $level == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $data = array(
                'id_karyawan' => $id_karyawan,
                'nama_user'   => $nama_user,
                'password'    => substr(str_shuffle("01234567890abcdefghijklmnopqestuvwxyz"), 0, 5),
                'level'       => $level,
                'foto'        => 'user.jpg',
                'status'      => 'Aktif',
                'token'       => sha1($id_karyawan)
              );

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_karyawan,
                'refrensi'    => 'User',
                'kategori'    => 'Add',
                'keterangan'  => 'Menambahkan data user baru'
              );

              $add = $this->UserModel->add($data, $log);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data user'));
              } else {
                $this->pusher->trigger('lion_membership', 'user', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data user'));
              }
            }
          }
        }
      }
    }
  }

  function edit($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          if($otorisasi->level != 'Helpdesk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_karyawan      = $this->input->get('id_karyawan');
            $nama_user        = $this->input->post('nama_user');
            $level            = $this->input->post('level');
            $status           = $this->input->post('status');

            if($id_karyawan == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada id_karyawan yang dipilih'));
            } else {
              if($nama_user == null || $level == null || $status == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                $data = array(
                  'nama_user' => $nama_user,
                  'level'     => $level,
                  'status'    => $status
                );

                $log = array(
                  'user'        => $otorisasi->id_karyawan,
                  'id_ref'      => $id_karyawan,
                  'refrensi'    => 'User',
                  'kategori'    => 'Edit',
                  'keterangan'  => 'Mengedit data user'
                );

                $edit = $this->UserModel->edit($id_karyawan, $data, $log);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit user'));
                } else {
                  $this->pusher->trigger('lion_membership', 'user', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit user'));
                }
              }
            }
          }
        }
      }
    }
  }

  function delete($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Helpdesk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_karyawan = $this->input->get('id_karyawan');

            if($id_karyawan == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'id_karyawan tidak ditemukan'));
            } else {

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_karyawan,
                'refrensi'    => 'User',
                'kategori'    => 'Delete',
                'keterangan'  => 'Menghapus data user'
              );

              $delete = $this->UserModel->delete($id_karyawan, $log);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus user'));
              } else {
                $this->pusher->trigger('lion_membership', 'user', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus user'));
              }
            }
          }
        }
      }
    }
  }

  function statistic($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Helpdesk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {

            $statistic  = $this->UserModel->statistic()->result();
            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $statistic));

          }
        }
      }
    }
  }

}

?>
