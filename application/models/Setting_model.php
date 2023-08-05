<?php
    defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    public function get_logo_data()
    {   
        $this->db->select('*')
                 ->where('setting_id', 1);   

        $row = $this->db->get('tbl_setting')
                        ->row();

        return $row;
    }

    
}
