
<div class="bootstrap-table">
	<table class="table table-hover" id="product_on_cart" width="100%"></table>
</div>

<div class="hstack gap-2">
	<p></p>

	<div class="form-floating ms-auto position-relative">
	<?php 
		$attr = array(
			'class' => 'form-control bg-transparent ps-4',
			'id' => 'order-code',
			'name' => 'order_code'
		);

		echo form_input($attr).form_label('Order code:');
	?>
	<span class="text-danger position-absolute" id="order-code-msg"></span>
	</div>

	<div class="form-floating">
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
		'content' => "Continue",
		'onclick' => "fetch_cart_ajax()"
	);
	echo form_button($attr);
?>	
</div>

	<?=script_tag('assets/product/index.js')?>
<script>

	$('input[id="order-code"]').mask('Z#', {
            translation: {
              'Z': {
                pattern: /[1-9]/
              }
            }
          });

	truncatedLength = 40; // set this to whatever you prefer
	origDataMap = new Map(); // the original (full) data for long text

	tbl_product_on_cart = $('table[id="product_on_cart"]').DataTable({
		order: [],
		scrollX: true,
		ordering: false,
		data: <?=json_encode($result)?>,
		columnDefs: 
		[
			{ 
	        	targets: [ 1, 3 ],
	        	visible: false 
	      	}, 
	      	{ 
				targets: [2], 
				render: function(data, type, row, meta) 
	          	{ 
	              	return truncate_row_dataTable(data, type, row, meta);
	          	}
			},
			{ 
				targets: [0],
				render: function(data, type, row, meta) 
	          	{ 
	              	return row.count;
	          	}
			}
		],
		columns:
		[
			{ title: '#', data: 'product_id' },
			{ title: 'Description', data: 'description' },
			{ title: 'Description', data: 'description' },
			{ title: 'Percentage', data: 'percentage' },
			{ title: 'Quantity', data: 'quantity', width: '1px' },
			{ title: 'Order amount', data: 'order_amount' },
			{ title: 'Delivery amount', data: 'delivery_amount' },
			{ title: 'Remove', data: 'remove', 'className': 'text-center' }
		] 
	});

 	fetch_cart_ajax = function()
 	{
 		order_code = $('input[name="order_code"]');
		$.ajax({
			url: '<?=base_url("product/fetch_order_on_cart")?>',
			method: 'POST',
			data: { order_code: order_code.val() },
			dataType: 'json',
			success: function(data)
			{

				span = $('span[id="order-code-msg"]');
				span.html(null);
				order_code.removeClass('border-danger');
				if (data.status == false) 
				{
					span.addClass('fw-medium animate__animated animate__shakeX').html(data.order_code);
					order_code.addClass('border-danger');
				}
			}
		});
 	}

	
</script>

<?=script_tag("assets/product/product_on_cart.js")?>

<script>
	addition_quantity_product_on_cart = function(e)
	{
		const count = $(e).closest('tr').index(),
		      total_item = $('input[id="total-item"]');

		$.ajax({
			url: '<?=$base_url?>/product/fetch_raise_product_on_cart',
			method: 'POST',
			data: { product_id: tbl_product_on_cart.column(0).data()[count] },
			dataType: 'json',
			success: function(data)
			{
				span = $(e).closest("tr").find("td").eq(2).find("span");
				order_amount = $(e).closest("tr");
				delivery_amount = $(e).closest("tr");

				span.html(data.quantity);
				order_amount.find("td").eq(3).html(data.order_amount);
				delivery_amount.find("td").eq(4).html(data.delivery_amount);

				$('input[id="total-item"]').val(data.total_item);
				$('input[id="order-amount"]').val(data.total_order);
				$('input[id="delivery-amount"]').val(data.total_delivery);


			}
		});
	}

	decrement_quantity_product_on_cart = function(e)
	{
		const count = $(e).closest('tr').index(),
		      total_item = $('input[id="total-item"]');

		$.ajax({
			url: '<?=$base_url?>/product/fetch_decrement_product_on_cart',
			method: 'POST',
			data: { product_id: tbl_product_on_cart.column(0).data()[count] },
			dataType: 'json',
			success: function(data)
			{
				span = $(e).closest("tr").find("td").eq(2).find("span");
				order_amount = $(e).closest("tr");
				delivery_amount = $(e).closest("tr");

				span.html(data.quantity);
				order_amount.find("td").eq(3).html(data.order_amount);
				delivery_amount.find("td").eq(4).html(data.delivery_amount);

				$('input[id="total-item"]').val(data.total_item);
				$('input[id="order-amount"]').val(data.total_order);
				$('input[id="delivery-amount"]').val(data.total_delivery);
			}
		});			
	}
</script>