
<div class="bootstrap-table">
	
	<table class="table table-hover" id="fetch_table_product" width="100%"></table>	

	<div class="position-relative" id="container_cart" style="display: none">
		<div class="position-fixed top-50 end-0" style="margin-right: 50px">
		<?php
			$attr = array(
				'class' => 'btn btn-choco text-light rounded-3 animate__animated animate__swing position-relative',
				'content' => "<i class='ri-shopping-cart-fill'></i>
					<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-2 border-light' id='c-badge'>100<span>
				",
				'onclick' => "show_on_cart()"
			);

			echo form_button($attr);
		?>
		</div>
	</div>
</div>

<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="offcanvas" aria-labelledby="staticBackdropLabel">
	<div class="offcanvas-header">
	    <h5 class="offcanvas-title"><i class='ri-shopping-cart-fill me-2 c-mantle'></i>Cart</h5>
	    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body" id="offcanvas-body">
	    
	</div>
</div>

<script>

truncatedLength = 40; // set this to whatever you prefer
origDataMap = new Map(); // the original (full) data for long text

$(document).ready(function() {
	tbl_product =	$('table[id="fetch_table_product"]').DataTable({
			order: [],
			scrollX: true,
			columnDefs: [{
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
			}],
		    select: {
		        style: 'multi'
		    },
			data: <?=json_encode($result)?>,
			columns:
			[
				{ title: '#', data: 'product_id', orderable: false },
				{ title: 'Action <i class="ri-pencil-ruler-2-fill c-mantle"></i>', data: 'action', orderable: false },
				{ title: 'Detail <i class="ri-article-fill c-mantle"></i>', data: 'product_details', orderable: false },
				{ title: 'Detail <i class="ri-article-fill c-mantle"></i>', data: 'product_details' },
				{ title: 'Product type <i class="ri-shopping-bag-3-fill c-mantle"></i>', data: 'product_type' },
				{ title: 'Amount <i class="ri-product-hunt-fill c-mantle"></i>', data: 'amount' },
				{ title: 'Commission <i class="ri-water-percent-fill c-mantle"></i>', data: 'commission', orderable: false },
				{ title: 'Date <i class="ri-calendar-todo-fill c-mantle"></i>', data: 'date_created' }
			]  
		});

		
	$('#fetch_table_product thead, #fetch_table_product tbody')
		.on('change', 'tr input[type="checkbox"]', function ()
		{
   			var rowIds = new Array,
   				container_cart = $('#container_cart'),
   				badge = $('#c-badge');

			$.each(tbl_product.column(0).checkboxes.selected(), function(item, row)
			{
			 	rowIds.push(row);
			});

			if (rowIds.length > 0) 
			{
				container_cart.fadeIn(500);
				count = (rowIds.length <= 99)?rowIds.length: '99+';
				badge.html(count);
			}
			else
			{
				container_cart.fadeOut(500, function(){
					badge.html(null);	
				});
			}
    	});

	show_on_cart = function()
	{
		var rowIds = new Array;

		$.each(tbl_product.column(0).checkboxes.selected(), function(item, row)
		{
		 	rowIds.push(row);
		});
		
		$.ajax({
			url: '<?=base_url("product/get_order_on_cart")?>',
			method: 'POST',
			data: { unique_id: rowIds },
			dataType: 'html',
			success: function(response)
			{
				$('div[id="offcanvas-body"]').html(response);
				$('#offcanvas').offcanvas('show');
			}
		});
	}
});
</script>
	
