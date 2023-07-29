<?php
    defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends CI_Model
{
    public function insert_user($data)
    {   
        $list = array(
            'first_name' => $this->db->escape_str($data['first_name']),
            'middle_name' => $this->db->escape_str($data['middle_name']),
            'last_name' => $this->db->escape_str($data['last_name']),
            'role_id' => $this->db->escape_str($data['role_id']),
            'position_id' => $this->db->escape_str($data['position_id']),
            'username' => $this->db->escape_str($data['username']),
            'password' => $this->db->escape_str($data['password']),
            'date_created' => date('Y-m-d h:ia')
        );

        $this->db->insert('tbl_user_info', $list);
    }

    public function login_auth($username)
    {
        $this->db->select("
                    user_id,
                    concat(lower(last_name),', ', lower(first_name),' ', lower(middle_name))as name,
                    role_id,
                    position_id,
                    username,
                    password
                ")
                 ->where(
                    [
                        'username' => $this->db->escape_str($username),
                        'user_status' => 1
                    ]
                );

        $row = $this->db->get('tbl_user_info')
                        ->row();

        return $row; 
    }
}
