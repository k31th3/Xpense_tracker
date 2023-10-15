<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Product extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();

			$this->is_app->required_user_active();
			$this->load->model('Order_model', 'order')
					   ->model('Product_model', 'product');

			$this->base_url = base_url();
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

		public function get_order_on_cart()
		{
			$this->is_app->ajax_method_required();
			
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$data = array(
					'base_url' => $this->base_url,
					'result' => $this->product->get_product_where_in($this->input->post('unique_id'))
				);
				$this->load->view('product/form/product_on_cart', $data);
			}
		}

		public function fetch_order_on_cart()
		{
			$this->is_app->ajax_method_required();	
			$this->load->view('product/ajax/fetch_order_on_cart');
		}

		public function fetch_raise_product_on_cart()
		{
			$this->is_app->ajax_method_required();
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$fields = array("product_id" => null);

				$field = $this->form->check_fields_list($fields);

				if ($field->status) 
				{
					$product_id = $this->is_app->decrypt($field->product_id);
					$total_order = 0;
					$total_delivery = 0;
					$total_item = 0;

			        foreach ($this->session->product_on_cart as $row) 
			        {
			            $r = (object)$row;
			            $commission = $r->commission;
			           	$total_commission = ($commission * $r->amount);

			            if ($product_id == $r->product_id) 
			            {
							$quantity = ($r->quantity + 1);							
							$order_amount = ($total_commission + $r->amount) * $quantity;
			                $delivery_amount = ($r->amount * $quantity);	

			                $data[] = [
			                    'product_id' => $product_id,
			                    'quantity' => $quantity,
			                    'commission' => $commission,
			                    'amount' => $r->amount,
			                    'order_amount' => number_format($order_amount, 2),
			                    'delivery_amount' => number_format($delivery_amount, 2) 
			                ];    

			                $item = [
			                    'product_id' => $product_id,
			                    'quantity' => $quantity,
			                    'commission' => $commission,
			                    'order_amount' => number_format($order_amount, 2),
			                    'delivery_amount' => number_format($delivery_amount, 2)
			                ];

			                $total_item += $quantity;
			                $total_order += $order_amount; 
			                $total_delivery += $delivery_amount;
			            }
			            else
			            {
			                $data[] = $row;
			                $total_item += $r->quantity;
			                $total_order += ($total_commission + $r->amount) * $r->quantity;
			                $total_delivery += ($r->amount * $r->quantity);
			            }
			        }

			        $item['total_item'] = $total_item;
			        $item['total_order'] = number_format($total_order, 2);
			        $item['total_delivery'] = number_format($total_delivery, 2);

			        $this->session->set_userdata('product_on_cart', $data);
			        die(json_encode($item));
				}
				
			}
		}

		public function fetch_decrement_product_on_cart()
		{
			$this->is_app->ajax_method_required();
			$row = $this->is_app->user_session_required();

			if($row->status) 
			{
				$this->load->view('product/ajax/fetch_decrement_product_on_cart');
			}
		}
	}
