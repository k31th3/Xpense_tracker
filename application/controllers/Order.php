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

		public function get_order_on_cart()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$data['result'] = $this->product->get_product_where_in($this->input->post('unique_id'));
				
				$this->load->view('product/form/product_on_cart', $data);
			}
		}
	}
