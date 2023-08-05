<?php
    defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function get_product_type_option()
    {
        $this->db->select('*')
                 ->where('product_type_status', 1)
                 ->order_by('product_type_name', 'asc');

        $result = $this->db->get('tbl_product_type')
                           ->result(); 

        foreach($result as $row)
        {
            $data[""] = "Choose an option";
            $data[$row->product_type_id] = $row->product_type_name;
        }

        return $data;
    }
}
