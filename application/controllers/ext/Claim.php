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
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthMember($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi    = $auth->row();
          $where        = array(
              'a.id_claim'  => $this->input->get('id_claim'),
              'a.no_member' => $otorisasi->no_member
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

            $where2           = array('a.id_claim' => $key->id_claim);
            $json['detail']   = $this->ClaimDetailModel->show($where2)->result();

            $claim[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $claim));

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

            $post               = $this->input->post();
            $id_claim           = $this->KodeModel->buatKode('claim', 'CL-', 'id_claim', 8);
            $kode_booking       = $post['kode_booking'];

            if($kode_booking == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              if(!isset($post['id_poin']) && count($post['id_poin']) < 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Pilih barang yang akan dipilih'));
              } else {

                $no           = 0;
                $detail       = array();

                $config['upload_path']   = './doc/lampiran_claim/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                foreach($post['id_poin'] as $key => $val){
                  $_FILES['file']['name'] = $_FILES['lampiran_claim']['name'][$key];
                  $_FILES['file']['type'] = $_FILES['lampiran_claim']['type'][$key];
                  $_FILES['file']['tmp_name'] = $_FILES['lampiran_claim']['tmp_name'][$key];
                  $_FILES['file']['error'] = $_FILES['lampiran_claim']['error'][$key];
                  $_FILES['file']['size'] = $_FILES['lampiran_claim']['size'][$key];

                  if(!$this->upload->do_upload('file')){
                    return null;
                  } else {
                    $file     = $this->upload->data();
                    $detail[] = array(
                      'id_claim'          => $id_claim,
                      'id_poin'           => $post['id_poin'][$key],
                      'lampiran_claim'    => $file['file_name']
                    );
                  }
                }

                $claim = array(
                  'id_claim'        => $id_claim,
                  'kode_booking'    => $kode_booking,
                  'no_member'       => $otorisasi->no_member,
                  'status_claim'    => 'Proses',
                  'no_member'       => $otorisasi->no_member
                );

                $add = $this->ClaimModel->add($claim, $detail);

                if(!$add){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data claim'));
                } else {
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data claim'));
                }
              }
            }
        }
      }
    }
  }

  function upload_file($name, $id)
  {
    if(isset($_FILES[$name]) && $_FILES[$name]['name'] != ""){
      // $files = glob('doc/'.$name.'/'.$id.'.*');
      // foreach ($files as $key) {
      //   unlink($key);
      // }

      $config['upload_path']   = './doc/'.$name.'/';
      $config['allowed_types'] = 'jpg|jpeg|png';
			// $config['remove_space']  = TRUE;
      // $config['overwrite']     = TRUE;
			// $config['max_size']      = '3048';
			// $config['file_name']     = $id;

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      for($count = 0; $count<count($_FILES[$name]['name']); $count++){
        $_FILES['file']['name'] = $_FILES[$name]['name'][$count];
        $_FILES['file']['type'] = $_FILES[$name]['type'][$count];
        $_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'][$count];
        $_FILES['file']['error'] = $_FILES[$name]['error'][$count];
        $_FILES['file']['size'] = $_FILES[$name]['size'][$count];

        if(!$this->upload->do_upload($name)){
          return null;
        } else {
          $file = $this->upload->data();
        }
      }
    } else {
      return null;
    }
  }

}

?>
