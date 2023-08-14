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

    public function get_product_type_by_id($product_type_id)
    {
        $this->db->select('*')
                 ->where('product_type_id', $this->db->escape_str($product_type_id));

        $row = $this->db->get('tbl_product_type')
                        ->row(); 
        return $row;
    }

    public function get_product_by_id($product_id)
    {
        $this->db->select('*')
                 ->where('product_id', $this->db->escape_str($product_id));

        $row = $this->db->get('tbl_product')
                        ->row(); 
        return $row;
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
            $url = base_url('product/fetch_edit_product_form');
            $icon = '<i class=ri-edit-2-fill></i>';

            $count = 1;
            foreach($result as $row)
            {
                // $count++
                $percentage = $row->commission / 100;
                $p_details = stripslashes($row->details);
                
                $data[] = array(
                    'product_id' => $row->product_id,
                    'action' => form_button([
                        'product-id' => $row->product_id,
                        'class' => 'btn border-0 text-primary p-0',
                        'content' => $icon,
                        'onclick' => "fetch_form('{$url}', '{$icon} Product', '', '{$row->product_id}')"
                    ]),
                    'product_details' => $p_details,
                    'product_type' => $row->product_type,
                    'amount' => '₱ '.number_format($row->amount, 2),
                    'commission' => '₱ '.number_format($percentage, 2),
                    'date_created' => date('M d, Y', strtotime($row->date_created)) 
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

    public function update_user_product_list($data, $product_id)
    {
        $list = array(
            "product_details" => $data->description,
            "product_type" => $this->db->escape_str($data->product_type),
            "amount" => $this->db->escape_str($data->amount),
            "commission" => $this->db->escape_str($data->commission)
        );

        $this->db->set($list)
                 ->where('product_id', $this->db->escape_str($product_id))
                 ->update('tbl_product');
    }

    public function get_product_where_in($data)
    {
        $this->db->select('*')
                 ->where_in('product_id', $this->db->escape_str($data))
                 ->order_by('date_created', 'asc');

        $result = $this->db->get('tbl_product')
                           ->result();

        return $result;
    }
}
