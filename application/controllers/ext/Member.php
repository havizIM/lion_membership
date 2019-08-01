<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Member extends CI_Controller {

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

    $this->load->model('MemberModel');
    $this->load->model('LogPoinModel');
  }

  function log_poin($token = null){
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

            $otorisasi = $auth->row();

            $where    = array('a.no_member' => $otorisasi->no_member);
            $show     = $this->LogPoinModel->show($where);
            $log      = array();

            foreach($show->result() as $key){
                $json = array();
                
                $json['id_user_poin']    = $key->id_user_poin;
                $json['kode_booking']    = $key->kode_booking;
                $json['type']            = $key->type;
                $json['tgl_log']         = $key->tgl_log;
                $json['departure']       = $key->departure;
                $json['nama_departure']  = $key->nama_departure;
                $json['arrival']         = $key->arrival;
                $json['nama_arrival']    = $key->nama_arrival;
                $json['claim_poin']      = $key->claim_poin;
                $json['redeem_poin']     = $key->redeem_poin;

                $log[]                   = $json;
            }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $log));

        }
      }
    }
  }

  function get_my_poin($token = null){
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

            $otorisasi = $auth->row();

            $where    = array('a.no_member' => $otorisasi->no_member);
            $show     = $this->LogPoinModel->show($where);
            

            $total_claim  = 0;
            $total_redeem = 0;

            foreach($show->result() as $key){
              if($key->type == 'claim'){
                $total_claim  += $key->claim_poin;
              }
              if($key->type == 'redeem'){
                $total_redeem += $key->redeem_poin;
              }
            }

            $my_poin      = array(
              'total_claim'   => $total_claim,
              'total_redeem'  => $total_redeem,
              'total_poin'    => $total_claim - $total_redeem
            );

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $my_poin));

        }
      }
    }
  }

  function profile($token = null){
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

          $where = array(
            'no_member'   => $otorisasi->no_member
          );

          $show         = $this->MemberModel->show($where);
          $profile      = array();

          foreach($show->result() as $key){
            $json = array();

            $json['no_member']          = $key->no_member;
            $json['no_aplikasi']        = $key->no_aplikasi;
            $json['berlaku_dari']       = $key->berlaku_dari;
            $json['berlaku_sampai']     = $key->berlaku_sampai;
            $json['tipe']               = $key->tipe;
            $json['status_member']      = $key->status_member;

            $json['no_aplikasi']          = $key->no_aplikasi;
            $json['gender']               = $key->gender;
            $json['nama']                 = $key->nama;
            $json['alamat']               = $key->alamat;
            $json['kota']                 = $key->kota;
            $json['kode_pos']             = $key->kode_pos;
            $json['no_handphone']         = $key->no_handphone;
            $json['kebangsaan']           = $key->kebangsaan;
            $json['no_identitas']         = $key->no_identitas;
            $json['email']                = $key->email;
            $json['nama_perusahaan']      = $key->nama_perusahaan;
            $json['alamat_perusahaan']    = $key->alamat_perusahaan;
            $json['kota_perusahaan']      = $key->kota_perusahaan;
            $json['kode_pos_perusahaan']  = $key->kode_pos_perusahaan;
            $json['jabatan']              = $key->jabatan;
            $json['no_tlp']               = $key->no_tlp;
            $json['no_fax']               = $key->no_fax;
            $json['email_perusahaan']     = $key->email_perusahaan;
            $json['bidang_usaha']         = $key->bidang_usaha;
            $json['alamat_surat']         = $key->alamat_surat;
            $json['status']               = $key->status;
            $json['tgl_pengajuan']        = $key->tgl_pengajuan;
            $json['lampiran_daftar']      = $key->lampiran_daftar;

            $profile[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $profile));

        }
      }
    }
  }

}

?>
