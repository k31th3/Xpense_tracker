<?php 

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