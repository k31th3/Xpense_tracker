<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Product extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->is_app->required_user_active();

			$this->load->model('Product_model', 'product');
		}

		public function index()
		{
			$data['page'] = 'Product';

			$this->parser->parse('layout/header', $data);
			
			$this->load->view('components/modal')
					   ->view('product/index')
					   ->view('layout/footer');
		}

		public function fetch_add_product()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if ($row->status) 
			{
				$data['options'] = $this->product->get_product_type_option();
				
				$this->load->view('product/form/add_product', $data);
			}
		}
	}
