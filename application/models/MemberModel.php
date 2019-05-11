<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model {

    function show($no_member = null, $no_aplikasi = null)
    {
      $this->db->select('*')->from('member a')->join('customer b', 'b.no_aplikasi = a.no_aplikasi');

      if($no_member != null){
        $this->db->where('a.no_member', $no_member);
      }

      if($no_aplikasi != null){
        $this->db->where('a.no_aplikasi', $no_aplikasi);
      }

      $this->db->order_by('a.no_member', 'desc');
      return $this->db->get();
    }


}

?>
