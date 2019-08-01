<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RedeemModel extends CI_Model {

    function show($where)
    {
      $this->db->select('a.*, b.no_aplikasi, b.no_member, c.gender, c.nama')
               ->from('redeem a')
               ->join('member b', 'b.no_member = a.no_member')
               ->join('customer c', 'c.no_aplikasi = b.no_aplikasi');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('a.tgl_redeem', 'desc');
      return $this->db->get();
    }

    function add($data, $detail, $log)
    {
      $this->db->trans_start();
      $this->db->insert('claim', $data);

      if(!empty($detail)){
        $this->db->insert_batch('claim_detail', $detail);
      }

      if(!empty($log)){
        $this->db->insert('log', $log);
      }

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function edit($where, $data, $log_poin, $log)
    {
      $this->db->trans_start();
      $this->db->where($where)->update('redeem', $data);
      
       if(!empty($log_poin)){
        $this->db->insert_batch('log_poin', $log_poin);
      }
      
      if(!empty($log)){
        $this->db->insert('log', $log);
      }
      
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
