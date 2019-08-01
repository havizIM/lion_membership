<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Redeem extends CI_Controller {

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

    $this->load->model('RedeemModel');
    $this->load->model('RedeemDetailModel');
  }

  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthMember($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi    = $auth->row();
          $where        = array(
              'a.id_redeem' => $this->input->get('id_redeem'),
              'a.no_member' => $otorisasi->no_member
          );

          $show         = $this->RedeemModel->show($where);
          $redeem        = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_redeem']          = $key->id_redeem;
            $json['member']             = array(
                'no_member' => $key->no_member,
                'gender'    => $key->gender,
                'nama'      => $key->nama
            );
            $json['tgl_redeem']         = $key->tgl_redeem;
            $json['status_redeem']      = $key->status_redeem;
            $json['keterangan']         = $key->keterangan;

            $where2           = array('a.id_redeem' => $key->id_redeem);
            $json['detail']   = $this->RedeemDetailModel->show($where2)->result();

            $redeem[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $redeem));

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
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthMember($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

            $otorisasi = $auth->row();

            $id_redeem      = $this->KodeModel->buatKode('redeem', 'RD-', 'id_redeem', 8);
            $no_member      = $otorisasi->no_member;
            $status_redeem  = 'Proses';

            $id_poin          = $this->input->post('id_poin');
            $no_flight        = $this->input->post('no_flight');
            $gender_pessenger = $this->input->post('gender_pessenger');
            $nama_pessenger   = $this->input->post('nama_pessenger');

            if($id_poin == null || $no_flight === null || $gender_pessenger === null || $nama_pessenger === null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $redeem = array(
                'id_redeem'        => $id_redeem,
                'no_member'        => $no_member,
                'status_redeem'    => $status_redeem
              );

              $detail = array(
                  'id_redeem'         => $id_redeem,
                  'id_poin'           => $id_poin,
                  'no_flight'         => $no_flight,
                  'gender_pessenger'  => $gender_pessenger,
                  'nama_pessenger'    => $nama_pessenger
              );

              $add = $this->RedeemModel->add($redeem, $detail);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data redeem'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data redeem'));
              }
            }
        }
      }
    }
  }

}

?>
