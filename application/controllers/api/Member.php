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
          $where        = array();
          $like         = array();

          $this->input->get('no_aplikasi') != null ? $where['no_aplikasi'] = $this->input->get('no_aplikasi') : null;
          $this->input->get('no_member') != null ? $where['no_member'] = $this->input->get('no_member') : null;

          $where = array(
            'no_aplikasi' => $this->input->get('no_aplikasi'),
            'no_member'   => $this->input->get('no_member')
          );

          $show         = $this->MemberModel->show($where);
          $member       = array();

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

            $json['log']                  = array();

            $where_lg = array('a.no_member' => $key->no_member);
            $log      = $this->LogPoinModel->show($where_lg);

            if($log->num_rows() !== 0){
              foreach($log->result() as $key2){
                $json_l = array();
                
                $json_l['id_user_poin']    = $key2->id_user_poin;
                $json_l['kode_booking']    = $key2->kode_booking;
                $json_l['type']            = $key2->type;
                $json_l['tgl_log']         = $key2->tgl_log;
                $json_l['departure']       = $key2->departure;
                $json_l['nama_departure']  = $key2->nama_departure;
                $json_l['arrival']         = $key2->arrival;
                $json_l['nama_arrival']    = $key2->nama_arrival;
                $json_l['claim_poin']      = $key2->claim_poin;
                $json_l['redeem_poin']     = $key2->redeem_poin;

                $json['log'][]              = $json_l;
              }
            }

            $member[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $member));

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


          $where = array(
            'MONTH(berlaku_dari)'   => $this->input->get('bulan'),
            'YEAR(berlaku_dari)'    => $this->input->get('tahun')
          );

          $show         = $this->MemberModel->show($where);
          $member       = array();

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

            $member[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $member));

        }
      }
    }
  }

  function nonaktif($token = null){
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
            $no_member = $this->input->get('no_member');

            if($no_member == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Member tidak ditemukan'));
            } else {
              $param  = array('a.no_member' => $no_member);
              $member = $this->MemberModel->show($param);

              if($member->num_rows() != 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Member tidak valid'));
              } else {
                $where  = array('no_member' => $no_member);
                $data   = array('status_member' => 'Nonaktif');

                $log = array(
                  'user'        => $otorisasi->id_karyawan,
                  'id_ref'      => $no_member,
                  'refrensi'    => 'Member',
                  'kategori'    => 'Nonaktif',
                  'keterangan'  => 'Menonaktifkan Member'
                );

                $update = $this->MemberModel->edit($where, $data, $log);

                if(!$update){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengupdate data member'));
                } else {
                  $this->pusher->trigger('lion_membership', 'member', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengupdate data member'));
                }
              }
            }
          }
        }
      }
    }
  }

  function aktif($token = null){
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
            $no_member = $this->input->get('no_member');

            if($no_member == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Member tidak ditemukan'));
            } else {
              $param  = array('a.no_member' => $no_member);
              $member = $this->MemberModel->show($param);

              if($member->num_rows() != 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Member tidak valid'));
              } else {
                $where  = array('no_member' => $no_member);
                $data   = array('status_member' => 'Aktif');

                $log = array(
                  'user'        => $otorisasi->id_karyawan,
                  'id_ref'      => $no_member,
                  'refrensi'    => 'Member',
                  'kategori'    => 'Aktif',
                  'keterangan'  => 'Menonaktifkan Member'
                );

                $update = $this->MemberModel->edit($where, $data, $log);

                if(!$update){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengupdate data member'));
                } else {
                  $this->pusher->trigger('lion_membership', 'member', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengupdate data member'));
                }
              }
            }
          }
        }
      }
    }
  }

  function upgrade($token = null){
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
            $no_member = $this->input->get('no_member');

            if($no_member == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Member tidak ditemukan'));
            } else {
              $param  = array('a.no_member' => $no_member);
              $member = $this->MemberModel->show($param);

              if($member->num_rows() != 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Member tidak valid'));
              } else {
                $where  = array('no_member' => $no_member);
                $data   = array('tipe' => 'Gold');

                $log = array(
                  'user'        => $otorisasi->id_karyawan,
                  'id_ref'      => $no_member,
                  'refrensi'    => 'Member',
                  'kategori'    => 'Upgrade',
                  'keterangan'  => 'Mengupdate Member'
                );

                $update = $this->MemberModel->edit($where, $data, $log);

                if(!$update){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengupdate data member'));
                } else {
                  $this->pusher->trigger('lion_membership', 'member', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengupdate data member'));
                }
              }
            }
          }
        }
      }
    }
  }

  function downgrade($token = null){
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
            $no_member = $this->input->get('no_member');

            if($no_member == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Member tidak ditemukan'));
            } else {
              $param  = array('a.no_member' => $no_member);
              $member = $this->MemberModel->show($param);

              if($member->num_rows() != 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'No Member tidak valid'));
              } else {
                $where  = array('no_member' => $no_member);
                $data   = array('tipe' => 'Blue');

                $log = array(
                  'user'        => $otorisasi->id_karyawan,
                  'id_ref'      => $no_member,
                  'refrensi'    => 'Member',
                  'kategori'    => 'Downgrade',
                  'keterangan'  => 'Mengupdate Member'
                );

                $update = $this->MemberModel->edit($where, $data, $log);

                if(!$update){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengupdate data member'));
                } else {
                  $this->pusher->trigger('lion_membership', 'member', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengupdate data member'));
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
