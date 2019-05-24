<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model {

    function show($where = array(), $like = array())
    {
      $this->db->select('*')->from('member a')->join('customer b', 'b.no_aplikasi = a.no_aplikasi');

      if(count($where) != 0){
        $this->db->where($where);
      }

      if(count($like) != 0){
        $this->db->where($like);
      }

      $this->db->order_by('a.no_member', 'desc');
      return $this->db->get();
    }


}

?>
