<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Poin extends CI_Controller {

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

		$this->load->model('PoinModel');
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

          $otorisasi    = $auth->row();
          $id_poin      = $this->input->get('id_poin');
    			$departure	  = $this->input->get('departure');
          $arrival	    = $this->input->get('arrival');

          $show  = $this->PoinModel->show($id_poin, $departure, $arrival);
          $poin  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_poin']          = $key->id_poin;
            $json['departure']        = $key->departure;
            $json['departure_name']   = $key->departure_name;
            $json['arrival']          = $key->arrival;
            $json['arrival_name']     = $key->arrival_name;
            $json['claim_poin']       = $key->claim_poin;
            $json['redeem_poin']      = $key->redeem_poin;

            $poin[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $poin));
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
            $id_poin      = $this->KodeModel->buatKode('master_poin', 'POIN', 'id_poin', 4);
            $departure    = $this->input->post('departure');
            $arrival      = $this->input->post('arrival');
            $claim_poin   = $this->input->post('claim_poin');
            $redeem_poin  = $this->input->post('redeem_poin');

            if($departure == null || $arrival == null || $claim_poin == null || $redeem_poin == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $data = array(
                'id_poin'       => $id_poin,
                'departure'     => $departure,
                'arrival'       => $arrival,
                'claim_poin'    => $claim_poin,
                'redeem_poin'   => $redeem_poin
              );

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_poin,
                'refrensi'    => 'Poin',
                'kategori'    => 'Add',
                'keterangan'  => 'Menambahkan data poin baru'
              );

              $add = $this->PoinModel->add($data, $log);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data poin'));
              } else {
                $this->pusher->trigger('lion_membership', 'poin', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data poin'));
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
            $id_poin      = $this->input->get('id_poin');
            $departure    = $this->input->post('departure');
            $arrival      = $this->input->post('arrival');
            $claim_poin   = $this->input->post('claim_poin');
            $redeem_poin  = $this->input->post('redeem_poin');

            if($id_poin == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Poin yang dipilih'));
            } else {
              if($departure == null || $arrival == null || $claim_poin == null || $redeem_poin == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                $data = array(
                  'departure'     => $departure,
                  'arrival'       => $arrival,
                  'claim_poin'    => $claim_poin,
                  'redeem_poin'   => $redeem_poin
                );

                $log = array(
                  'user'        => $otorisasi->id_karyawan,
                  'id_ref'      => $id_poin,
                  'refrensi'    => 'Poin',
                  'kategori'    => 'Edit',
                  'keterangan'  => 'Menambahkan data poin baru'
                );

                $edit = $this->PoinModel->edit($id_poin, $data, $log);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit poin'));
                } else {
                  $this->pusher->trigger('lion_membership', 'poin', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit poin'));
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
            $id_poin = $this->input->get('id_poin');

            if($id_poin == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Poin tidak ditemukan'));
            } else {

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_poin,
                'refrensi'    => 'Poin',
                'kategori'    => 'Delete',
                'keterangan'  => 'Menghapus data poin'
              );

              $delete = $this->PoinModel->delete($id_poin, $log);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus poin'));
              } else {
                $this->pusher->trigger('lion_membership', 'poin', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus poin'));
              }
            }
          }
        }
      }
    }
  }

}

?>
