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

		public function fetch_add_product_form()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$data['options'] = $this->product->get_product_type_option();
				
				$this->load->view('product/form/add_product', $data);
			}
		}

		public function fetch_edit_product_form()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$data = array(
					'options' => $this->product->get_product_type_option(),
					'row' => $this->product->get_product_by_id($this->input->post('unique_id'))
				);
				
				$this->load->view('product/form/edit_product', $data);
			}
		}

		public function fetch_ajax_add_product_form()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$this->load->view('product/ajax/fetch_add_product');	
			}
		}

		public function fetch_ajax_edit_product_form()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$this->load->view('product/ajax/fetch_edit_product');	
			}
		}

		public function fetch_table_product()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$data['result'] = $this->product->get_product_list();
				$this->load->view('product/ajax/fetch_table_product', $data);	
			}				
		}
	}
