<?php
    defined('BASEPATH') or exit('No direct script access allowed');

class Page_model extends CI_Model
{
    public function get_all_page()
    {
        $this->db->select('*')
                 ->where('page_status', 1)
                 ->order_by('order_by', 'asc');

        $result = $this->db->get('tbl_page')
                           ->result();

        return $result;
    }
}
