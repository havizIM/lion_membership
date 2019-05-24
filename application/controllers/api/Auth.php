<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Auth extends CI_Controller {

  function __construct()
  {
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

		$this->load->model('AuthModel');
  }

  function login_user()
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {

      $id_karyawan  = $this->input->post('id_karyawan');
      $password     = $this->input->post('password');

      if($id_karyawan == null || $password == null) {
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID dan Password belum lengkap' ));
      } else {
        $user   = $this->AuthModel->loginUser($id_karyawan);

        if($user->num_rows() == 0){
          json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID tidak ditemukan' ));
        } else {
          foreach($user->result() as $key){
            $db_password    = $key->password;
            $status         = $key->status;
            $level          = strtolower($key->level);

            if($level == 'customer service'){
              $level = 'customer_service';
            }

            $session = array(
              'id_karyawan'    => $key->id_karyawan,
              'nama_user'      => $key->nama_user,
              'tgl_registrasi' => $key->tgl_registrasi,
              'foto'           => $key->foto,
              'level'          => $level,
              'token'          => $key->token
            );

            $log = array(
              'user'        => $key->id_karyawan,
              'id_ref'      => '-',
              'refrensi'    => 'Auth',
              'kategori'    => 'Login',
              'keterangan'  => 'User login'
            );
          }

          if(hash_equals($password, $db_password)){
            if($status != 'Aktif'){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'User sudah tidak aktif' ));
            } else {

              $add = $this->LogModel->add($log);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal melakukan login' ));
              } else {
                $this->pusher->trigger('lion_membership', 'log', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan login', 'data' => $session ));
              }
            }
          } else {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Password salah' ));
          }
        }
      }
    }
  }

  function logout_user($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $log = array(
            'user'        => $otorisasi->id_karyawan,
            'id_ref'      => '-',
            'refrensi'    => 'Auth',
            'kategori'    => 'Logout',
            'keterangan'  => 'User logout'
          );

          $add = $this->LogModel->add($log);

          if(!$add){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal Logout'));
          } else {
            $this->pusher->trigger('lion_membership', 'log', $log);
            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil logout'));
          }
        }
      }
    }
  }

  function password_user($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $db_password  = $otorisasi->password;
          $old_password = $this->input->post('password_lama');
          $new_password = $this->input->post('password_baru');

          if($old_password == null || $new_password == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
          } else {
            if($old_password != $db_password){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Password lama salah'));
            } else {

              $data = array(
                'password' => $new_password
              );

              $log = array(
                'user'        => $otorisasi->id_karyawan,
                'id_ref'      => '-',
                'refrensi'    => 'Auth',
                'kategori'    => 'Ganti Password',
                'keterangan'  => 'Mengganti password lama menjadi password baru'
              );

              $pass = $this->AuthModel->gantiPass($otorisasi->id_karyawan, $data, $log);

              if(!$pass){
                json_output(500, array('status' => 500, 'description' => 'Gagal', 'message' => 'Gagal mengganti password'));
              } else {
                $this->pusher->trigger('lion_membership', 'log', $log);
                json_output(200, array('status' => 200, 'description' => 'Gagal', 'message' => 'Berhasil mengganti password'));
              }
            }
          }
        }
      }
    }
  }

  function send_verify()
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      $email     = $this->input->post('email');

      if($email == null){
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Field email pribadi harus diisi terlebih dahulu' ));
      } else {
        $param     = array('email' => $email);
        $cek_email = $this->AuthModel->cekAuthCustomer($param)->num_rows();

        if($cek_email == 1){
          json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Email sudah digunakan.'));
        } else {
          $verify_code = substr(str_shuffle("01234567890"), 0, 6);

          $this->load->library('email');

          $data_email = array(
            'verify_code'   => $verify_code
          );

          $template = $this->load->view('email/verify_code', $data_email, true);

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
          $this->email->from('adm.lionmember@gmail.com', 'Admin LPS');
          $this->email->to($email);
          $this->email->subject('Kode Verifikasi pendaftaran akun LPS');
          $this->email->message($template);

          $send = $this->email->send();

          if (!$send) {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengirim email verifikasi.' ));
          } else {
            $this->session->set_userdata($email, $verify_code);
            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengirim email verifikasi.' ));
          }
        }
      }
    }
  }

  function register_customer()
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {

      $no_aplikasi          = $this->KodeModel->buatKode('customer', '', 'no_aplikasi', 11);
      $gender               = $this->input->post('gender');
      $nama                 = $this->input->post('nama');
      $alamat               = $this->input->post('alamat');
      $kota                 = $this->input->post('kota');
      $kode_pos             = $this->input->post('kode_pos');
      $no_handphone         = $this->input->post('no_handphone');
      $kebangsaan           = $this->input->post('kebangsaan');
      $no_identitas         = $this->input->post('no_identitas');
      $email                = $this->input->post('email');
      $nama_perusahaan      = $this->input->post('nama_perusahaan');
      $alamat_perusahaan    = $this->input->post('alamat_perusahaan');
      $kota_perusahaan      = $this->input->post('kota_perusahaan');
      $kode_pos_perusahaan  = $this->input->post('kode_pos_perusahaan');
      $jabatan              = $this->input->post('jabatan');
      $no_tlp               = $this->input->post('no_tlp');
      $no_fax               = $this->input->post('no_fax');
      $email_perusahaan     = $this->input->post('email_perusahaan');
      $bidang_usaha         = $this->input->post('bidang_usaha');
      $alamat_surat         = $this->input->post('alamat_surat');
      $kode_verifikasi      = $this->input->post('kode_verifikasi');
      $status               = 'Proses';

      if($gender == null || $nama == null || $alamat == null || $kota == null || $kode_pos == null || $no_handphone == null || $kebangsaan == null || $no_identitas == null || $email == null){
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data pribadi harus diisi dengan lengkap.'));
      } elseif($nama_perusahaan == null || $alamat_perusahaan == null || $kota_perusahaan == null || $kode_pos_perusahaan == null || $jabatan == null || $no_tlp == null || $no_fax == null || $email_perusahaan == null || $bidang_usaha == null){
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data pekerjaan harus diisi dengan lengkap.'));
      } elseif($alamat_surat == null) {
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data pengiriman harus diisi dengan lengkap.'));
      } elseif($kode_verifikasi == null){
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Kode Verifikasi harus diisi.'));
      } else {

        if(!$this->session->has_userdata($email)){
          json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Silahkan tekan tombol Kirim Kode untuk dapat menerima Kode Verifikasi dari email' ));
        } else {
          if($kode_verifikasi != $this->session->userdata($email)){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Kode Verifikasi tidak dikenali' ));
          } else {
            $lampiran_daftar = $this->upload_file('lampiran_daftar', $no_aplikasi);

            if($lampiran_daftar == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Lampiran gagal diupload' ));
            } else {
              $data = array(
                'no_aplikasi'         => $no_aplikasi,
                'gender'              => $gender,
                'nama'                => $nama,
                'alamat'              => $alamat,
                'kota'                => $kota,
                'kode_pos'            => $kode_pos,
                'no_handphone'        => $no_handphone,
                'kebangsaan'          => $kebangsaan,
                'no_identitas'        => $no_identitas,
                'email'               => $email,
                'nama_perusahaan'     => $nama_perusahaan,
                'alamat_perusahaan'   => $alamat_perusahaan,
                'kota_perusahaan'     => $kota_perusahaan,
                'kode_pos_perusahaan' => $kode_pos_perusahaan,
                'jabatan'             => $jabatan,
                'no_tlp'              => $no_tlp,
                'no_fax'              => $no_fax,
                'email_perusahaan'    => $email_perusahaan,
                'bidang_usaha'        => $bidang_usaha,
                'alamat_surat'        => $alamat_surat,
                'status'              => $status,
                'lampiran_daftar'     => $lampiran_daftar
              );

              $log = array('message' => 'Customer signup new account');

              $register = $this->AuthModel->registerCustomer($data);

              if(!$register){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal melakukan registrasi'));
              } else {
                $this->session->unset_userdata($email);
                $this->pusher->trigger('lion_membership', 'aplikasi', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan registrasi.'));
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
      $files = glob('doc/'.$name.'/'.$id.'.*');
      foreach ($files as $key) {
        unlink($key);
      }

      $config['upload_path']   = './doc/'.$name.'/';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['overwrite']     = TRUE;
			$config['max_size']      = '3048';
			$config['remove_space']  = TRUE;
			$config['file_name']     = $id;

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if(!$this->upload->do_upload($name)){
        return null;
      } else {
        $file = $this->upload->data();
        return $file['file_name'];
      }
    } else {
      return null;
    }
  }

}

 ?>
