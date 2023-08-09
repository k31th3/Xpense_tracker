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
				'field' => 'description',
				'rules' => 'is_unique[tbl_product.product_details]'
			],
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
			$this->product->add_user_product_list($field);

			$list = [
	        		'user_id' => $this->session->user_id,
	        		'audit_type' => 'Add product',
	          		'audit_details' => 'Successfully add product',
	          		'color' => 'text-success',
      				'bg_color' => ' bg-success'
	        	];

	        $this->audit_trail->add_audit_trail($list);
	        	
			$data = array(
				"status" => true,
				"message" => "Successfully add product",
				"type" => "success"
			);
		}
	}

	die(json_encode($data));