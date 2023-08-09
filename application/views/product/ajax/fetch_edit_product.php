<?php 

	$fields = array(
			"product_type" => null,
			"description" => null,
			"amount" => null,
			"commission" => null
		);

	$field = $this->form->check_fields_list($fields);

	$data = (array)$field;
	$data["status"] = null;
	
	if ($field->status) 
	{
		$list = array(
			[
				'field' => 'amount',
				'rules' => 'regex_match[/^[0-9]*\.?[0-9]+$/]|max_length[10]'
			],
			[
				'field' => 'commission',
				'rules' => 'regex_match[/^[0-9]+$/]|less_than[100]'
			]
		);

		$this->form_validation->set_rules($list);

		if ($this->form_validation->run() === FALSE) 
		{
			$data = array(
				"description" => form_error("description"),
				"amount" => form_error("amount"),
				"commission" => form_error("commission"),
				"status" => false 
			);
		}
		else
		{
			$data['status'] = true;

			if ($this->input->post('product_status') == true)
			{
				$this->product->update_user_product_list($field, $this->input->post('product_id'));
				
				$r_pt = $this->product->get_product_type_by_id($field->product_type);

				$list = [
	        		'user_id' => $this->session->user_id,
	        		'audit_type' => 'Update product',
	          		'audit_details' => json_encode(array(
	          			'title' => 'Successfully update product',
	          			'Date & Time' => date('F d, Y h:ma'),
	          			'item_name' => $field->description,
	          			'item_type' => $r_pt->product_type_name,
	          			'amount' => $field->amount,
	          			'commission' => $field->commission
	          		), JSON_PRETTY_PRINT),
	          		'color' => 'text-primary',
      				'bg_color' => ' bg-primary'
	        	];

	        	$this->audit_trail->add_audit_trail($list);

	        	$data = array(
	        		'status' => true,
	        		"message" => "Successfully update product",
					"type" => "success"
	        	);
			}
		}
	}

	die(json_encode($data));