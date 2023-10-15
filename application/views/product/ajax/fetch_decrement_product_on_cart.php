<?php 

	$fields = array("product_id" => null);

	$field = $this->form->check_fields_list($fields);

	if ($field->status) 
	{
		$product_id = $this->is_app->decrypt($field->product_id);
		$total_order = 0;
		$total_delivery = 0;
		$total_item = 0;

        if(is_array($this->session->product_on_cart) && count($this->session->product_on_cart) > 0) 
        {
            foreach ($this->session->product_on_cart as $row) 
            {
                $r = (object)$row;
                $commission = $r->commission;
                $total_commission = ($commission * $r->amount);
                $data[] = $row;

                if ($r->quantity >= 1) 
                {
                    if ($product_id == $r->product_id) 
                    {
                        $data[] = [
                            'product_id' => $product_id,
                            'quantity' => 0,
                            'commission' => $r->commission,
                            'amount' => $r->amount,
                            'order_amount' => number_format(0, 2),
                            'delivery_amount' => number_format(0, 2) 
                        ];

                        $quantity = ($r->quantity - 1);                         
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
            }

            $item['total_item'] = $total_item;
            $item['total_order'] = number_format($total_order, 2);
            $item['total_delivery'] = number_format($total_delivery, 2);

            $this->session->set_userdata('product_on_cart', $data);

            die(json_encode($item));           
        }


        
	}

