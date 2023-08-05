<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (isset($this->session->user_id)) 
        {
            redirect(base_url('dashboard'), 'refresh');
        } 

		$this->load->view('login/index');
	}

	public function fetch_auth_login()
	{
		$this->is_app->ajax_method_required();
		$this->load->view('login/ajax/fetch_auth_login');
	}

	public function sign_out()
	{
		if (!isset($this->session->user_id)) 
        {
            redirect(base_url(''), 'refresh');
        }

		$list = [
			'user_id' => $this->session->user_id,
    		'audit_type' => 'Log-out',
      		'audit_details' => 'Successfully log-out',
      		'audit_list' => 1,
      		'color' => 'text-success',
      		'bg_color' => ' bg-success'
	    ];
		
		$this->audit_trail->add_audit_trail($list);

		$this->session->sess_destroy();
		redirect(base_url(''), 'refresh');
	}
}
