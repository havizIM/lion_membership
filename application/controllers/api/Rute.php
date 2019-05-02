<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Rute extends CI_Controller {

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

		$this->load->model('RuteModel');
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

          $otorisasi  = $auth->row();
          $id_rute    = $this->input->get('id_rute');
          $nama_rute	= $this->input->get('nama_rute');

          $show  = $this->RuteModel->show($id_rute, $nama_rute);
          $rute  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_rute']        = $key->id_rute;
            $json['nama_rute']      = $key->nama_rute;

            $rute[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $rute));

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

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_rute    = $this->input->post('id_rute');
            $nama_rute  = $this->input->post('nama_rute');

            if($id_rute == null || $nama_rute == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $data = array(
                'id_rute'   => $id_rute,
                'nama_rute' => $nama_rute
              );

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_rute,
                'refrensi'    => 'Rute',
                'kategori'    => 'Add',
                'keterangan'  => 'Menambahkan data rute baru'
              );

              $add = $this->RuteModel->add($data, $log);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data rute'));
              } else {
                $this->pusher->trigger('lion_membership', 'rute', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data rute'));
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

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_rute    = $this->input->get('id_rute');
            $nama_rute  = $this->input->post('nama_rute');

            if($id_rute == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Rute yang dipilih'));
            } else {
              if($nama_rute == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                $data = array(
                  'nama_rute' => $nama_rute
                );

                $log = array(
                  'user'        => $otorisasi->id_karyawan,
                  'id_ref'      => $id_rute,
                  'refrensi'    => 'Rute',
                  'kategori'    => 'Edit',
                  'keterangan'  => 'Mengedit data rute'
                );

                $edit = $this->RuteModel->edit($id_rute, $data, $log);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit rute'));
                } else {
                  $this->pusher->trigger('lion_membership', 'rute', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit rute'));
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

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_rute = $this->input->get('id_rute');

            if($id_rute == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Rute tidak ditemukan'));
            } else {

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_rute,
                'refrensi'    => 'Rute',
                'kategori'    => 'Delete',
                'keterangan'  => 'Menghapus data rute'
              );

              $delete = $this->RuteModel->delete($id_rute, $log);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus rute'));
              } else {
                $this->pusher->trigger('lion_membership', 'rute', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus rute'));
              }
            }
          }
        }
      }
    }
  }

}

?>
