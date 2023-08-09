
<style type="text/css">
	.more-button {
  background: none!important;
  border: none;
  padding: 0!important;
  /*optional*/
  font-family: arial, sans-serif;
  /*input has OS specific font-family*/
  color: #069;
  text-decoration: underline;
  cursor: pointer;
}

</style>
<div class="bootstrap-table">
	<table class="table table-hover" id="fetch_table_product" width="100%"></table>	
</div>

<script>

truncatedLength = 40; // set this to whatever you prefer
origDataMap = new Map(); // the original (full) data for long text

$(document).ready(function() {
	$('table[id="fetch_table_product"]').DataTable({
		order: [],
		scrollX: true,
		columnDefs: [
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
});
</script>
	
