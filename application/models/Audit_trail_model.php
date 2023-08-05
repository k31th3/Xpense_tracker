<?php
    defined('BASEPATH') or exit('No direct script access allowed');

class Audit_trail_model extends CI_Model
{
    public function add_audit_trail($data)
    {
        $list = array(
            'user_id' => $data['user_id'],
            'audit_type' => $data["audit_type"],
            'audit_details' => $data["audit_details"],
            'color' => $data["color"],
            'bg_color' => $data["bg_color"],
        );

        $this->db->insert('tbl_audit', $list);
    }

    public function get_all_audit_trail($data)
    {
        $this->db->select('*')
                 ->where('user_id', $this->session->user_id);

        if (!empty($data['start']) && !empty($data['end'])) 
        {
            $start = date('Y-m-d', strtotime($data['start']));
            $end = date('Y-m-d', strtotime($data['end']." +1 days"));

            $this->db->where('date_created BETWEEN "'.$start.'" AND "'.$end.'"');
        }

        $this->db->order_by('date_created', 'desc');
        $result = $this->db->get('tbl_audit')
                           ->result();

        return $result;
    }

    public function count_chart_accessibility($data)
    {
        $this->db->select('
                    audit_type,    
                    count(audit_type) as count
                ')
                 ->where([
                    'user_id' => $this->session->user_id,
                    'audit_list' => 1
                 ]);

        if (!empty($data['start']) && !empty($data['end'])) 
        {
            $start = date('Y-m-d', strtotime($data['start']));
            $end = date('Y-m-d', strtotime($data['end']." +1 days"));

            $this->db->where('date_created BETWEEN "'.$start.'" AND "'.$end.'"');
        }

        $this->db->order_by('date_created', 'desc')
                 ->group_by('audit_type');

        $result = $this->db->get('tbl_audit')
                           ->result();

        return $result;
    }

    public function chart_time_check($data)
    {
        $this->db->select('
                    audit_type,
                    date_created,
                    count(audit_type) as count
                ')
                 ->where([
                    'user_id' => $this->session->user_id,
                    'audit_list' => 1
                 ]);

        if (!empty($data['start']) && !empty($data['end'])) 
        {
            $start = date('Y-m-d', strtotime($data['start']));
            $end = date('Y-m-d', strtotime($data['end']." +1 days"));

            $this->db->where('date_created BETWEEN "'.$start.'" AND "'.$end.'"');
        }

        $this->db->order_by('date_created', 'desc')
                 ->group_by("date_created");

        $result = $this->db->get('tbl_audit')
                           ->result();

        return $result;
    }    
}
