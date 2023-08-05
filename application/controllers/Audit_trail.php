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

		public function fetch_chart_accessibility()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if ($row->status)
			{
				$data = array(
					'row' => $row,
					'result' => $this->audit_trail->count_chart_accessibility([
						'start' => $this->input->post('start'),
						'end' => $this->input->post('end')
					])
				);
				
				$this->load->view('audit trail/ajax/fetch_chart_accessibility', $data);
			}
		}

		public function fetch_chart_time_check()
		{
			$this->is_app->ajax_method_required();

			$row = $this->is_app->user_session_required();
			
			if ($row->status)
			{
				$data = array(
					'row' => $row,
					'result' => $this->audit_trail->chart_time_check([
						'start' => $this->input->post('start'),
						'end' => $this->input->post('end')
					])
				);
				
				$this->load->view('audit trail/ajax/fetch_chart_time_check', $data);
			}	
		}

		public function sa()
		{
			$result = $this->audit_trail->chart_time_check(null);

			foreach($result as $row)
			{
				$date = date('Y-m-d', strtotime($row->date_created));
				$r_count[] = date('Y-m-d', strtotime($row->date_created)); 	

				$data[$row->audit_type][$date] = array(
					"x" => $date,
					"y" => round(count($r_count) /2)
				);
			}

			header('Content-type: text/json');

			echo json_encode($data, JSON_PRETTY_PRINT);
		}
	}
