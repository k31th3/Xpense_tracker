<?php
    defined('BASEPATH') or exit('No direct script access allowed');

class Audit_trail_model extends CI_Model
{
    public function add_audit_trail($data)
    {
        $list = array(
            'user_id' => $data['user_id'],
            'audit_type' => $data['audit_type'],
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
        $data = [];
    
        if (!empty($result)) 
        {
            foreach($result as $row)
            {
                $r_details = json_decode($row->audit_details, true);
                $o_details = (object)$r_details;

                $details = $row->audit_details;
                if (is_array($r_details) == 1) 
                {   
                    $title = array_keys($r_details);
                    $item = array_values($r_details);

                    $list = array_map(function($value, $key) 
                                {
                                    return "{$key}: {$value}";
                                }, $item, $title);

                    $details = "<ul class='list-unstyled'>
                                    <li>".implode("</li><li>", $list)."</li>
                                </ul>";
                }

                $data[] = array(
                    'audit_no' => $row->audit_id,
                    'audit_type' => "<div class='badge {$row->bg_color}'>{$row->audit_type}</div>",
                    'audit_details' => $details,
                    'date_created' => date('F d, Y h:ma', strtotime($row->date_created))
                ); 
            }
        }

        return $data;
    }

    public function count_chart_accessibility($data)
    {
        $this->db->select('
                    audit_type,    
                    count(audit_type) as count
                ')
                 ->where('user_id', $this->session->user_id)
                 ->where_in("audit_type", ["Log-in", "Log-out", "Failed log-in"]);

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

    public function chart_time_check($data, $in)
    {
        $this->db->select('
                    audit_type,
                    date_created,
                    count(audit_type) as count
                ')
                 ->where('user_id', $this->session->user_id)
                 ->where_in("audit_type", $in);

        if (!empty($data['start']) && !empty($data['end'])) 
        {
            $start = date('Y-m-d', strtotime($data['start']));
            $end = date('Y-m-d', strtotime($data['end']." +1 days"));

            $this->db->where('date_created BETWEEN "'.$start.'" AND "'.$end.'"');
        }

        $this->db->order_by('date_created', 'desc')
                 ->group_by('DATE(date_created)');

        $result = $this->db->get('tbl_audit')
                           ->result();

        $list[$data['start']] = array(
            "x" => $data['start'],
            "y" => 0 
        );
        
        if (!empty($result)) 
        {
            foreach($result as $row)
            {
                $date = date('M d, Y', strtotime($row->date_created));

                $list[$date] = array(
                    "x" => $date,
                    "y" => $row->count
                );   
            }
        }

        return $list;
    }    
}
