
<table class="table " id="product_on_cart" width="100%">
	<thead class="fw-bold small">
		<tr>
			<td>Description</td>
			<td>Percentage</td>
			<td>Quantity</td>
			<td>Order amount</td>
			<td>Delivery amount</td>
			<td class='text-center'>Remove</td>
		</tr>
	</thead>
	<tbody>
	<?php 
		$list = null;

		$attr = array(
			'class' => 'btn btn-sm btn-danger fw-bold',
			'content' => "<i class='ri-close-line'></i>",
			'onclick' => "remove_product_on_cart(this)"
		);

		$remove = form_button($attr);

		$attr = array(
			'class' => 'btn btn-sm fw-bold',
			'content' => "<i class='ri-add-line'></i>",
			'onclick' => "addition_quantity_product_on_cart(this)"
		);

		$addition = form_button($attr);

		$attr = array(
			'class' => 'btn btn-sm fw-bold',
			'content' => "<i class='ri-subtract-line'></i>",
			'onclick' => "subraction_quantity_product_on_cart(this)"
		);

		$subraction = form_button($attr);

		foreach($result as $row)
		{
			$p_details = stripslashes($row->product_details);
			$commission = ($row->commission / 100);	
			$total_commission = ($commission * $row->amount);
			$order_amount = number_format(($total_commission + $row->amount), 2);

			$list .= "<tr product_id='{$row->product_id}' delivery-amount='{$row->amount}' order-amount='{$order_amount}'>
						<td> <p style='display: -webkit-box;
    							max-width: 400px;
    							-webkit-line-clamp: 2;
    							-webkit-box-orient: vertical;
  								overflow: hidden;'> {$p_details} 
  							</p>
  						</td>
						<td>{$commission}</td>
						<td>{$addition}<span>1</span>{$subraction}</td>
						<td>{$order_amount}</td>
						<td>{$row->amount}</td>
						<td class='text-center'>{$remove}</td>
					  </tr>";

			$product_id[] = $row->product_id; 
		}

		echo $list;
	?>
	</tbody>
</table>

<div class="hstack gap-2">
	<p></p>
	<div class="form-floating ms-auto">
	<?php 
		$attr = array(
			'class' => 'form-control bg-transparent ps-4',
			'id' => 'total-item',
			'disabled' => 'disabled'
		);

		echo form_input($attr).form_label('Total item:');
	?>	
	</div>
	<div class="form-floating">
	<?php 
		$attr = array(
			'class' => 'form-control bg-transparent ps-4 fw-bold',
			'id' => 'order-amount',
			'disabled' => 'disabled'
		);

		echo form_input($attr).form_label('Order amount:');
	?>	
	</div>
	<div class="form-floating">
	<?php 
		$attr = array(
			'class' => 'form-control bg-transparent ps-4 fw-bold',
			'id' => 'delivery-amount',
			'disabled' => 'disabled'
		);

		echo form_input($attr).form_label('Delivery amount:');
	?>	
	</div>
</div>

<div class="text-end my-3">
<?php 
	$attr = array(
		'class' => 'btn btn-success btn-choco',
		'id' => 'btn-continue',
		'content' => "<i class='ri-shopping-cart-fill'></i> Continue"
	);
	echo form_button($attr);
?>	
</div>
	
<script>
	total_payment_on_cart = function()
	{
		var order_amount = 0,
			delivery_amount = 0,
			item = 0,
			product_id = new Array;

		$('table[id="product_on_cart"] tbody tr').each(function() 
		{
			order_amount += parseFloat($(this).find("td").eq(3).html());
	    	delivery_amount += parseFloat($(this).find("td").eq(4).html());
	    	item += parseFloat($(this).find("td").eq(2).find('span').html()); 

	    	product_id.push(
		    	{
		    		'product_id': $(this).attr('product_id'),
		    		'item': parseFloat($(this).find("td").eq(2).find('span').html())
		    	}
	    	);	   
		});

		order = order_amount.toFixed(2);
		delivery = delivery_amount.toFixed(2);

		$('input[id="total-item"]').val(item);
		$('input[id="order-amount"]').val(`₱ ${order}`);
		$('input[id="delivery-amount"]').val(`₱ ${delivery}`);

		if (product_id.length <= 0) 
		{
			$('button[id="btn-continue"]').fadeOut('slow', function()
			{
				$(this).remove();	
			});
		}

		console.log(product_id);
	}

	total_payment_on_cart();

	addition_quantity_product_on_cart = function(e)
	{
		span = $(e).closest("tr").find("td").eq(2).find("span");
		order_amount = $(e).closest("tr");
		delivery_amount = $(e).closest("tr");
		
		quantity = parseFloat(span.html()) + 1;

		if (quantity <= 0) 
		{
			quantity = 0;
		}

		order = parseFloat($(e).closest("tr").find("td").eq(3).html()) + parseFloat(delivery_amount.attr('order-amount'));
		delivery = parseFloat($(e).closest("tr").find("td").eq(4).html()) + parseFloat(delivery_amount.attr('delivery-amount'));

		order_amount.find("td").eq(3).html(order.toFixed(2));
		delivery_amount.find("td").eq(4).html(delivery.toFixed(2));

		span.html(quantity);
		total_payment_on_cart();
	}

	subraction_quantity_product_on_cart = function(e)
	{
		span = $(e).closest("tr").find("td").eq(2).find("span");
		order_amount = $(e).closest("tr");
		delivery_amount = $(e).closest("tr");

		quantity = parseFloat(span.html()) - 1;

		if (quantity <= 0) 
		{
			quantity = 0;
		}

		order = parseFloat($(e).closest("tr").find("td").eq(3).html()) - parseFloat(delivery_amount.attr('order-amount'));
		delivery = parseFloat($(e).closest("tr").find("td").eq(4).html()) - parseFloat(delivery_amount.attr('delivery-amount'));		
		
		if (order <= 0) 
		{
			order = 0;
			delivery = 0;
		}

		order_amount.find("td").eq(3).html(order.toFixed(2));
		delivery_amount.find("td").eq(4).html(delivery.toFixed(2));

		span.html(quantity);	
		total_payment_on_cart();
	}

	remove_product_on_cart = function(e)
	{
		$(e).closest("tr").fadeOut('slow', function()
		{
			$(this).remove();
			total_payment_on_cart();		
		});

		total_payment_on_cart();
	}	
</script>