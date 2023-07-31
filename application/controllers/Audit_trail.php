<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Audit_trail extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->is_app->required_user_active();
		}

		public function index()
		{
			$data['page'] = 'Audit trail';

			$this->load->view('layout/header', $data);
			$this->load->view('audit trail/index')
					   ->view('layout/footer');
		}

		public function fetch_table_audit_trail()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if ($row->status)
			{
				$data = array(
					'row' => $row,
					'result' => $this->audit_trail->get_all_audit_trail([
						'start' => $this->input->post('start'),
						'end' => $this->input->post('end')
					])
				);
				
				$this->load->view('audit trail/ajax/fetch_table_audit_trail', $data);
			}	
		}
	}
