

<style>
	table.dataTable.nowrap td 
	{
    	white-space: revert; 
	}
	div.bootstrap-table table tr td 
	{
		line-height: 20px;
		white-space: revert; 
	}
</style>

<div class="bootstrap-table">
	<table class="table table-hover" id="fetch_table_product" width="100%"></table>	
</div>


<script>
	$('table[id="fetch_table_product"]').dataTable({
		order: [],
		scrollX: true,
		data: <?=json_encode($result)?>,
		columns:
		[
			{ title: '#', data: 'product_id', orderable: false },
			{ title: 'Action <i class="ri-pencil-ruler-2-fill"></i>', data: 'action', orderable: false },
			{ title: 'Detail <i class="ri-article-fill"></i>', data: 'product_details', orderable: false },
			{ title: 'Product type <i class="ri-shopping-bag-3-fill"></i>', data: 'product_type' },
			{ title: 'Amount <i class="ri-product-hunt-fill"></i>', data: 'amount' },
			{ title: 'Commission <i class="ri-water-percent-fill"></i>', data: 'commission', orderable: false },
			{ title: 'Date <i class="ri-calendar-todo-fill"></i>', data: 'date_created' }
		]  
	});
</script>
	
