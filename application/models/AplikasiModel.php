<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AplikasiModel extends CI_Model {

    function show($no_aplikasi = null, $nama = null)
    {
      $this->db->select('*')->from('customer');

      if($no_aplikasi != null){
        $this->db->where('no_aplikasi', $no_aplikasi);
      }

      if($nama != null){
        $this->db->like('nama', $nama);
      }

      $this->db->order_by('tgl_pengajuan', 'desc');
      return $this->db->get();
    }

    function terima($param, $data, $data_member, $log)
    {
      $this->db->trans_start();
      $this->db->where($param)->update('customer', $data);
      $this->db->insert('member', $data_member);
      $this->db->insert('log', $log);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function tolak($param, $data, $log)
    {
      $this->db->trans_start();
      $this->db->where($param)->update('customer', $data);
      $this->db->insert('log', $log);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

}

?>
