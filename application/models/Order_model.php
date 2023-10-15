<?php
    defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function check_order_code_exist($product_id)
    {
        $this->db->select('*')
                 ->where('user_id', $this->session->user_id)
                 ->where_in('product_id', $product_id);

        $count = $this->db->get('tbl_order')
                          ->num_rows();

        return $count;
    }
}
