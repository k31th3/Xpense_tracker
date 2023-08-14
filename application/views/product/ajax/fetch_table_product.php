
<div class="bootstrap-table">
	
	<table class="table table-hover" id="fetch_table_product" width="100%"></table>	

	<div class="position-relative" id="container_cart" style="display: none">
		<div class="position-fixed top-50 end-0" style="margin-right: 50px">
		<?php
			$attr = array(
				'class' => 'btn btn-choco text-light rounded-3 animate__animated animate__swing',
				'content' => "<i class='ri-shopping-cart-fill'></i>",
				'onclick' => "add_cart()"
			);

			echo form_button($attr);
		?>
		</div>
	</div>
</div>

<script>

truncatedLength = 40; // set this to whatever you prefer
origDataMap = new Map(); // the original (full) data for long text

$(document).ready(function() {
	tbl_product =	$('table[id="fetch_table_product"]').DataTable({
			order: [],
			scrollX: true,
			columnDefs: [
					{
	          targets: 0,
	         	checkboxes: 
	         	{
	            selectRow: true
	        	}
	        },
	      	{ 
	        	targets: [3],
	        	visible: false 
	      	}, 
	      	{ 
				  	targets: [2], 
				  	render: function(data, type, row, meta) 
	          { 
	              // please set var truncatedLength and origDataMap before use this function
	              return truncate_row_dataTable(data, type, row, meta);
	          }
			    }
		    ],
	    select: {
	        style: 'multi'
	    },
			data: <?=json_encode($result)?>,
			columns:
			[
				{ title: '#', data: 'product_id', orderable: false },
				{ title: 'Action <i class="ri-pencil-ruler-2-fill"></i>', data: 'action', orderable: false },
				{ title: 'Detail <i class="ri-article-fill"></i>', data: 'product_details', orderable: false },
				{ title: 'Detail <i class="ri-article-fill"></i>', data: 'product_details' },
				{ title: 'Product type <i class="ri-shopping-bag-3-fill"></i>', data: 'product_type' },
				{ title: 'Amount <i class="ri-product-hunt-fill"></i>', data: 'amount' },
				{ title: 'Commission <i class="ri-water-percent-fill"></i>', data: 'commission', orderable: false },
				{ title: 'Date <i class="ri-calendar-todo-fill"></i>', data: 'date_created' }
			]  
		});

		
	$('#fetch_table_product thead, #fetch_table_product tbody')
		.on('change', 'tr input[type="checkbox"]', function ()
		{
   			var rowIds = new Array,
   			container_cart = $('#container_cart');

			$.each(tbl_product.column(0).checkboxes.selected(), function(item, row)
			{
			 	rowIds.push(row);
			});

			if (rowIds.length > 0) 
			{
				container_cart.fadeIn(500);
			}
			else
			{
				container_cart.fadeOut(500);
			}
    	});

	add_cart = function()
	{
		var rowIds = new Array;

		$.each(tbl_product.column(0).checkboxes.selected(), function(item, row)
		{
		 	rowIds.push(row);
		});

		$('div[id="modal"]').find('.modal-dialog').addClass('modal-xl');
		
		fetch_form('<?=base_url("order/get_order_on_cart")?>', 
				"<i class='ri-shopping-cart-fill'></i> On-cart", null, rowIds);
	}
});
</script>
	
