<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->is_app->required_user_active();
		}

		public function index()
		{
			$data['page'] = 'Dashboard';

			$this->parser->parse('layout/header', $data);
			$this->load->view('dashboard/index')
					   ->view('layout/footer');
		}
	}
