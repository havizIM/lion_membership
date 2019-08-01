<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Aplikasi extends CI_Controller {

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

		$this->load->model('AplikasiModel');
    $this->load->model('MemberModel');
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
          $no_aplikasi  = $this->input->get('no_aplikasi');
          $nama	        = $this->input->get('nama');

          $show      = $this->AplikasiModel->show($no_aplikasi, $nama);
          $aplikasi  = array();

          foreach($show->result() as $key){
            $json = array();

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

            $aplikasi[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $aplikasi));

        }
      }
    }
  }

  function terima_aplikasi($token = null){
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
            $no_aplikasi = $this->input->get('no_aplikasi');

            if($no_aplikasi == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Aplikasi tidak ditemukan'));
            } else {
              $aplikasi = $this->AplikasiModel->show($no_aplikasi, null);

              if($aplikasi->num_rows() != 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Aplikasi tidak valid'));
              } else {
                $member = $this->MemberModel->show(null, $no_aplikasi);

                if($member->num_rows() >= 1){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Aplikasi ini sudah menjadi member'));
                } else {
                  $customer = $aplikasi->row();

                  $no_member      = $this->input->post('no_member');
                  $password       = substr(str_shuffle("01234567890abcdefghijklmnopqestuvwxyz"), 0, 5);
                  $berlaku_dari   = date('Y-m-d');
                  $berlaku_sampai = date('Y-m-d', mktime(0, 0, 0, date("m", strtotime($berlaku_dari)), date("d", strtotime($berlaku_dari)), date("Y", strtotime($berlaku_dari)) + 2));
                  $token          = sha1($no_member);
                  $tipe           = 'Blue';
                  $status_member  = 'Aktif';

                  $this->load->library('email');

                  $data_email = array(
                    'nama_customer' => $customer->nama,
                    'no_member'     => $no_member,
                    'password'      => $password,
                    'no_aplikasi'   => $customer->no_aplikasi,
                    'sender'        => $otorisasi->nama_user
                  );

                  $template = $this->load->view('email/email_penerimaan', $data_email, true);

                  $config = array(
                    'charset'   => 'utf-8',
                    'wordwrap'  => TRUE,
                    'mailtype'  => 'html',
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_user' => 'viz.ndinq@gmail.com',
                    'smtp_pass' => 'haviz06142',
                    'smtp_port' => 465,
                    'crlf'      => "\r\n",
                    'newline'   => "\r\n"
                  );

                  $this->email->initialize($config);
                  $this->email->from('adm.lionmember@gmail.com', $otorisasi->nama_user);
                  $this->email->to($customer->email);
                  $this->email->subject('Pengajuan Aplikasi Lion Passport Card');
                  $this->email->message($template);

                  $send = $this->email->send();
                  if (!$send) {
                      json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengirim email aktivasi'));
                  } else {
                    $param       = array('no_aplikasi' => $no_aplikasi);
                    $data        = array('status' => 'Terima');

                    $data_member = array(
                      'no_member'       => $no_member,
                      'no_aplikasi'     => $no_aplikasi,
                      'password'        => $password,
                      'berlaku_dari'    => $berlaku_dari,
                      'berlaku_sampai'  => $berlaku_sampai,
                      'token'           => $token,
                      'status_member'   => $status_member
                    );

                    $log         = array(
                      'user'        => $otorisasi->id_karyawan,
                      'id_ref'      => $no_aplikasi,
                      'refrensi'    => 'Aplikasi',
                      'kategori'    => 'Terima',
                      'keterangan'  => 'Terima aplikasi pengajuan LPC'
                    );

                    $update = $this->AplikasiModel->terima($param, $data, $data_member, $log);

                    if(!$update){
                      json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengupdate data aplikasi'));
                    } else {
                      $this->pusher->trigger('lion_membership', 'aplikasi', $log);
                      json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengupdate data aplikasi'));
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }

  function tolak_aplikasi($token = null){
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
            $no_aplikasi = $this->input->get('no_aplikasi');

            if($no_aplikasi == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Aplikasi tidak ditemukan'));
            } else {
              $aplikasi = $this->AplikasiModel->show($no_aplikasi, null);

              if($aplikasi->num_rows() != 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Aplikasi tidak valid'));
              } else {
                $member = $this->MemberModel->show(null, $no_aplikasi);

                if($member->num_rows() > 1){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Aplikasi ini sudah menjadi member'));
                } else {
                  $customer = $aplikasi->row();

                  $this->load->library('email');

                  $data_email = array(
                    'nama_customer' => $customer->nama,
                    'no_aplikasi'   => $customer->no_aplikasi,
                    'sender'        => $otorisasi->nama_user
                  );

                  $template = $this->load->view('email/email_penolakan', $data_email, true);

                  $config = array(
                    'charset'   => 'utf-8',
                    'wordwrap'  => TRUE,
                    'mailtype'  => 'html',
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_user' => 'viz.ndinq@gmail.com',
                    'smtp_pass' => 'haviz06142',
                    'smtp_port' => 465,
                    'crlf'      => "\r\n",
                    'newline'   => "\r\n"
                  );

                  $this->email->initialize($config);
                  $this->email->from('adm.lionmember@gmail.com', $otorisasi->nama_user);
                  $this->email->to($customer->email);
                  $this->email->subject('Pengajuan Aplikasi Lion Passport Card');
                  $this->email->message($template);

                  $send = $this->email->send();
                  if (!$send) {
                      json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengirim email aktivasi'));
                  } else {
                    $param = array('no_aplikasi' => $no_aplikasi);
                    $data = array('status' => 'Tolak');

                    $log = array(
                      'user'        => $otorisasi->id_karyawan,
                      'id_ref'      => $no_aplikasi,
                      'refrensi'    => 'Aplikasi',
                      'kategori'    => 'Tolak',
                      'keterangan'  => 'Menolak aplikasi pengajuan LPC'
                    );

                    $update = $this->AplikasiModel->tolak($param, $data, $log);

                    if(!$update){
                      json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengupdate data aplikasi'));
                    } else {
                      $this->pusher->trigger('lion_membership', 'aplikasi', $log);
                      json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengupdate data aplikasi'));
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }

}

?>
