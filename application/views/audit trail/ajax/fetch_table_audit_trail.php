
<?php 
	$data = [];
	
	if (!empty($result)) 
	{
		foreach($result as $row)
		{
			$data[] = array(
				'audit_no' => $row->audit_id,
				'audit_type' => "<div class='badge {$row->bg_color}'>{$row->audit_type}</div>",
				'audit_details' => $row->audit_details,
				'date_created' => date('F d, Y h:ma', strtotime($row->date_created))
			); 
		}
	}
?>

<div class="bootstrap-table">
	<table class="table table-hover nowrap" id="fetch_table_audit_trail" width="100%"></table>	
</div>

<script>
	$('table[id="fetch_table_audit_trail"]').dataTable({
		order: [],
		scrollX: true,
		data: <?=json_encode($data)?>,
		columns:
		[
			{ title: '<i class="ri-hashtag"></i> Audit no.', data: 'audit_no', orderable: false },
			{ title: '<i class="ri-pages-line"></i> Type', data: 'audit_type', orderable: false },
			{ title: '<i class="ri-article-line"></i> Details', data: 'audit_details', orderable: false },
			{ title: '<i class="ri-calendar-todo-fill"></i> Date', data: 'date_created' }
		]  
	});
</script>
	
