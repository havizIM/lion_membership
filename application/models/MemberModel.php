<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model {

    function show($where)
    {
      $this->db->select('*')->from('member a')->join('customer b', 'b.no_aplikasi = a.no_aplikasi');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('a.no_member', 'desc');
      return $this->db->get();
    }

    function edit($param, $data, $log)
    {
      $this->db->trans_start();
      $this->db->where($param)->update('member', $data);
      
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
