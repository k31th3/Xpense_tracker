
<?=link_tag("assets/audit trail/index.css")?>
<?=link_tag("assets/dataTable/index.css")?>
<?=link_tag("assets/date-range-picker/index.css")?>

<div class="row">

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

			<div class="card-body min-vh-100" id="table-audit-trail"></div>

		</div>
	</div>
</div>

<?=script_tag("assets/dataTable/index.js")?>
<?=script_tag("assets/dataTable/c-index.js")?>
<?=script_tag("assets/audit trail/index.js")?>
<?=script_tag("assets/date-range-picker/moment.min.js")?>
<?=script_tag("assets/date-range-picker/index.js")?>

<script>
	loading = `<div class='col-1 position-absolute top-50 start-50 translate-middle'> 
					<?php $this->load->view("components/loading") ?> 
				</div>`;

	table_audit_trail('<?=base_url("audit_trail/fetch_table_audit_trail")?>', loading);


	re_fetch_table = function(start, end)
	{
		icon = $('i[id="rotate"]'); 
		icon.addClass("down").attr("refresh", "true");
		
		if (icon.attr("refresh") != false) 
		{
			table_audit_trail('<?=base_url("audit_trail/fetch_table_audit_trail")?>', loading, start, end);	
		}
	}

	$(function() 
	{
	    var start = moment().subtract(29, 'days');
	    var end = moment();
	    
	    function cb(start, end) 
	    {
	        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	        re_fetch_table(start.format('MMMM D, YYYY'), end.format('MMMM D, YYYY'));
	    }

	    $('#reportrange').daterangepicker({
	        startDate: start,
	        endDate: end,
	        ranges: {
	           'Today': [moment(), moment()],
	           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	           'This Month': [moment().startOf('month'), moment().endOf('month')],
	           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        }
	   	}, cb);

	    cb(start, end);
	});
</script>