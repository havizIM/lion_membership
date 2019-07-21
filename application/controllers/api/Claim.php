<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Claim extends CI_Controller {

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

    $this->load->model('ClaimModel');
    $this->load->model('ClaimDetailModel');
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
          $where        = array(
              'a.id_claim' => $this->input->get('id_claim')
          );

          $show         = $this->ClaimModel->show($where);
          $claim        = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_claim']           = $key->id_claim;
            $json['kode_booking']       = $key->kode_booking;
            $json['member']             = array(
                'no_member' => $key->no_member,
                'gender'    => $key->gender,
                'nama'      => $key->nama
            );
            $json['tgl_claim']          = $key->tgl_claim;
            $json['status_claim']       = $key->status_claim;
            $json['keterangan']         = $key->keterangan;
            $json['detail']             = $this->ClaimDetailModel->show($where)->result();

            $claim[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $claim));

        }
      }
    }
  }

  function valid($token = null){
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
            $id_claim = $this->input->get('id_claim');

            if($id_claim == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Claim tidak ditemukan'));
            } else {

              $where = array(
                  'id_claim' => $id_claim
              );

              $where_claim = array(
                  'a.id_claim' => $id_claim
              );

              $data = array(
                  'status_claim' => 'Valid'
              );

              $claim    = $this->ClaimDetailModel->get($where_claim)->result();

              foreach($claim as $key => $val){
                  if($val->status_claim === 'Valid'){
                    $log_poin = array();
                  } else {
                    $log_poin[] = array(
                        'kode_booking' => $val->kode_booking,
                        'id_poin'=> $val->id_poin,
                        'no_member' => $val->no_member,
                        'type' => 'claim'
                    );
                  }
              }

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_claim,
                'refrensi'    => 'Claim',
                'kategori'    => 'Valid',
                'keterangan'  => 'Memvalidasi data poin'
              );

              $update = $this->ClaimModel->edit($where, $data, $log_poin, $log);

              if(!$update){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal memvalidasi claim'));
              } else {
                $this->pusher->trigger('lion_membership', 'claim', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil memvalidasi claim'));
              }
            }
        }
      }
    }
  }

  function tidak_valid($token = null){
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
            $id_claim = $this->input->get('id_claim');

            if($id_claim == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Claim tidak ditemukan'));
            } else {

              $where = array(
                  'id_claim' => $id_claim
              );

              $data = array(
                  'status_claim' => 'Tidak Valid'
              );

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_claim,
                'refrensi'    => 'Claim',
                'kategori'    => 'Tidak Valid',
                'keterangan'  => 'Menolak data claim'
              );

              $update = $this->ClaimModel->edit($where, $data, FALSE, $log);

              if(!$update){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal memvalidasi claim'));
              } else {
                $this->pusher->trigger('lion_membership', 'claim', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil memvalidasi claim'));
              }
            }
        }
      }
    }
  }

}

?>
