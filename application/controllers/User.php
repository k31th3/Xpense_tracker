<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
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
		$this->session->sess_destroy();
		redirect(base_url(''), 'refresh');
	}

	public function as()
	{
		$row = $this->page->get_all_page();

		echo json_encode($row);
	}
}
