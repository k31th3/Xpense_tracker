<?php
    defined('BASEPATH') or exit('No direct script access allowed');

class Form_model extends CI_Model
{
    public function check_fields_list($fields)
    {
        $config = array_map(function($item)
        {
            $str_replace = str_replace("_", " ", $item);
            $row = [
                'field' => $item,
                'rules' => "trim|required",
                'errors' => array(
                    'required' => "The {$str_replace} field is required"
                )
            ];

            return $row;
        }, array_keys($fields));

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() === FALSE)
        {
            $row = array_map(function($name)
            {
                return form_error($name);
            }, array_keys($fields));

            $status = false;
        }
        else
        {
            $row = array_map(function($name)
            {
                return $this->input->post($name);
            }, array_keys($fields));
            $status = true;
        }

        $data = array_combine(array_keys($fields), $row);
        $data["status"] = $status;

        return (object)$data;
    }
}
