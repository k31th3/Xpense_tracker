<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Order extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->is_app->required_user_active();

			$this->load->model('Product_model', 'product');
		}

		public function index()
		{
			$data['page'] = 'Order';

			$this->parser->parse('layout/header', $data);
			$this->load->view('order/index')
					   ->view('layout/footer');
		}
		
	}
