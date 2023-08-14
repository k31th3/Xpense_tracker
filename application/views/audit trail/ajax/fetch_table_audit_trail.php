
<div class="bootstrap-table">
	<table class="table table-hover nowrap" id="fetch_table_audit_trail" width="100%"></table>	
</div>

<script>
	truncatedLength = 85; // set this to whatever you prefer
	origDataMap = new Map(); // the original (full) data for long text
	
	$('table[id="fetch_table_audit_trail"]').dataTable({
		order: [],
		scrollX: true,
		data: <?=json_encode($result)?>,
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
		columns:
		[
			{ title: '<i class="ri-hashtag"></i> Audit no.', data: 'audit_no', orderable: false },
			{ title: '<i class="ri-pages-line"></i> Type', data: 'audit_type', orderable: false },
			{ title: '<i class="ri-article-line"></i> Details', data: 'audit_details', orderable: false },
			{ title: '<i class="ri-article-line"></i> Details', data: 'audit_details', orderable: false },
			{ title: '<i class="ri-calendar-todo-fill"></i> Date', data: 'date_created' }
		]  
	});
</script>
	
