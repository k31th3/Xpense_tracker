
<?php 
	$file = array(
		'audit trail/index.css',
		'dataTable/index.css',
		'date-range-picker/index.css',
		'chart/index.js',
		'dataTable/index.js',
		'dataTable/c-index.js',
		'date-range-picker/moment.min.js',
		'date-range-picker/index.js',
		'index.js'
	);

	$this->is_app->load_assets($file);
?>



<div class="row gy-4">
	
	<div class="col-12">
		
		<div class="card">
			<div class="card-body col-11 m-auto" style="min-height: 50vh">
				<div class="row">
					<div class="col-12 col-lg-4">
						<div id="fetch_chart_accessibility"></div>
					</div>
					<div class="col-12 col-lg-8">
						<div id="fetch_chart_time_check"></div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="col-12">
		<div class="card">
			
			<div class="card-header hstack gap-3 py-3">
				<small class="c-mantle fw-bold">Search filter:</small>
				<div id="reportrange" class="rounded small py-2 px-3 me-auto bg-white" type="button" style="border: 2px solid var(--thick-rgba);">
				    <i class="ri-calendar-todo-line c-mantle"></i>
				    <span class="c-mantle"></span> 
				    <i class="ri-arrow-drop-down-line c-mantle fw-bold"></i>
				</div>

				<i class="ri-restart-line rotate c-mantle fw-bold" data-bs-toggle="tooltip"  data-bs-title="Refresh audit table" data-bs-placement="top" data-bs-custom-class="tooltip" id="rotate" type="button" onclick="re_fetch_table()"></i>

			</div>

			<div class="card-body min-vh-100" id="fetch-audit-trail"></div>

		</div>
	</div>
</div>


<script>
	re_fetch_table = function(start, end)
	{
		icon = $('i[id="rotate"]'); 
		icon.addClass("down").attr("refresh", "true");
		
		if (icon.attr("refresh") != false) 
		{
			fetch_table($('div[id="fetch-audit-trail"]'), '<?=base_url("audit_trail/fetch_table_audit_trail")?>', loading_animation(), start, end);	

			fetch_chart($('div[id="fetch_chart_accessibility"]'), {
				'location': '<?=base_url("audit_trail/fetch_chart_accessibility")?>',
				'start_date': start,
				'end_date': end,
				'loading': loading_animation() 
			});

			fetch_chart($('div[id="fetch_chart_time_check"]'), {
				'location': '<?=base_url("audit_trail/fetch_chart_time_check")?>',
				'start_date': start,
				'end_date': end,
				'loading': loading_animation() 
			});
		}
	}

	run_moment_date();
</script>