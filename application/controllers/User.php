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

		$fields = array(
			"username" => null,
			"password" => null
		);

		$field = $this->form->check_fields_list($fields);

		$data = (array)$field;
		$data["status"] = null;
		
		if ($field->status) 
		{
			$row = $this->user->login_auth($field->username);

			$data = [
				"status" => false,
				"message" => "username or password incorrect"
			];

			if (!empty($row)) 
			{
				// password_hash('Keith3soriano17', PASSWORD_BCRYPT)
				if (password_verify($field->password, $row->password)) 
				{
		          	$data = [
		          		"status" => true,
		          		"location" => base_url('dashboard/')
		          	];

		          	$temp = array(
		          		'user_id' => $row->user_id,
		          		'name' => ucwords($row->name),
		          		'role_id' => $row->role_id, 
		          		'position_id' => $row->position_id
		          	);

		          	$this->session->sess_expiration = 300; // Expire in 5 minutes
		          	$this->session->set_userdata($temp);  
		        } 
			}
		}

		die(json_encode($data));
	}

	public function log_out()
	{
		$this->session->sess_destroy();
		redirect(base_url(''), 'refresh');
	}
}
