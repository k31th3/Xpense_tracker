<?php 
	
	$list["order_code"] = null;

	$field = $this->form->check_fields_list($list);

	$data = (array)$field;
	$data["status"] = false;

	if ($field->status) 
	{	
		$list = array(
			[
				'field' => 'order_code',
				'rules' => 'numeric|is_unique[tbl_order.order_code]'
			]
		);

		$this->form_validation->set_rules($list);

		if ($this->form_validation->run() === FALSE) 
		{
			$data["order_code"] = str_replace('_', ' ', form_error("order_code"));
		}
		else
		{
			$data["status"] = 'success';
		}
	}


	die(json_encode($data));