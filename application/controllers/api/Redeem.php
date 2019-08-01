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
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi    = $auth->row();
          $where        = array(
              'a.id_redeem' => $this->input->get('id_redeem')
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
            $json['detail']             = $this->RedeemDetailModel->show($where)->result();

            $redeem[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $redeem));

        }
      }
    }
  }

  function laporan($token = null){
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
              'MONTH(a.tgl_redeem)' => $this->input->get('bulan'),
              'YEAR(a.tgl_redeem)'  => $this->input->get('tahun'),
              'status_redeem'       => 'Approve',

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
            $json['alamat_kirim']       = $key->alamat_kirim;
            $json['keterangan']         = $key->keterangan;

            $where2 = array('a.id_redeem' => $key->id_redeem);
            $json['detail']             = $this->RedeemDetailModel->show($where2)->result();

            $redeem[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $redeem));

        }
      }
    }
  }

  function approve($token = null){
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
            $id_redeem = $this->input->get('id_redeem');

            if($id_redeem == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Redeem tidak ditemukan'));
            } else {

              $where = array(
                  'id_redeem' => $id_redeem
              );

              $where_claim = array(
                  'a.id_redeem' => $id_redeem
              );

              $data = array(
                  'status_redeem' => 'Approve'
              );

              $claim    = $this->RedeemDetailModel->get($where_claim)->result();

              foreach($claim as $key => $val){
                  if($val->status_redeem === 'Approve'){
                    $log_poin = array();
                  } else {
                    $log_poin[] = array(
                        'kode_booking' => $val->no_flight,
                        'id_poin'=> $val->id_poin,
                        'no_member' => $val->no_member,
                        'type' => 'redeem'
                    );
                  }
              }

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_redeem,
                'refrensi'    => 'Redeem',
                'kategori'    => 'Approval',
                'keterangan'  => 'Memvalidasi data poin'
              );

              $update = $this->RedeemModel->edit($where, $data, $log_poin, $log);

              if(!$update){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal memvalidasi redeem'));
              } else {
                $this->pusher->trigger('lion_membership', 'redeem', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil memvalidasi redeem'));
              }
            }
        }
      }
    }
  }

  function tolak($token = null){
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
            $id_redeem = $this->input->get('id_redeem');

            if($id_redeem == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Claim tidak ditemukan'));
            } else {

              $where = array(
                  'id_redeem' => $id_redeem
              );

              $data = array(
                  'keterangan'   => $this->input->post('keterangan'),
                  'status_redeem' => 'Tolak'
              );

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => $id_redeem,
                'refrensi'    => 'Redeem',
                'kategori'    => 'Tolak',
                'keterangan'  => 'Menolak data redeem'
              );

              $update = $this->RedeemModel->edit($where, $data, FALSE, $log);

              if(!$update){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal memvalidasi redeem'));
              } else {
                $this->pusher->trigger('lion_membership', 'redeem', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil memvalidasi redeem'));
              }
            }
        }
      }
    }
  }

}

?>
