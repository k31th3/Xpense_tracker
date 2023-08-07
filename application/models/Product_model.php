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

    public function get_product_list()
    {
        $this->db->select('
                        tbl_p.product_id,
                        tbl_p.product_details as details,
                        tbl_pt.product_type_name as product_type,
                        tbl_p.amount,
                        tbl_p.commission,
                        tbl_p.date_created
                    ')
                 ->join('tbl_product_type tbl_pt', 'tbl_pt.product_type_id = tbl_p.product_type', 'LEFT')
                 ->where([
                    'tbl_p.user_id' => $this->session->user_id,
                    'tbl_p.product_status' => 1
                 ])
                 ->order_by('tbl_p.date_created', 'desc');

        $result = $this->db->get('tbl_product as tbl_p')
                           ->result(); 

        $data = [];

        if (!empty($result)) 
        {
            foreach($result as $row)
            {
                $percentage = $row->commission / 100;
                $data[] = array(
                    'product_id' => $row->product_id,
                    'product_details' => $row->details,
                    'product_type' => $row->product_type,
                    'amount' => '₱ '.number_format($row->amount, 2),
                    'commission' => '₱ '.number_format($percentage, 2),
                    'date_created' => date('F d, Y', strtotime($row->date_created)) 
                );
            }
        }
        
        return $data;   
    }

    public function add_user_product_list($data)
    {
        $list = array(
            "user_id" => $this->session->user_id,
            "product_details" => $this->db->escape_str($data->description),
            "product_type" => $this->db->escape_str($data->product_type),
            "amount" => $this->db->escape_str($data->amount),
            "commission" => $this->db->escape_str($data->commission)
        );

        $this->db->insert("tbl_product", $list);
    }
}
