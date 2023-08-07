
<?php 
	$file = array(
		'product/index.css',
		'dataTable/index.css',
		'date-range-picker/index.css',
		'dataTable/index.js',
		'dataTable/c-index.js',
		'date-range-picker/moment.min.js',
		'date-range-picker/index.js',
		'product/index.js',
		'index.js'
	);

	$this->is_app->load_assets($file);
?>

<div class="row gy-4">
	
	<div class="col-12">
		<?php 
			$url = base_url("product/fetch_add_product_form");
			$title = '<i class=ri-add-circle-fill></i>';
			$attr = [
				'class' => 'btn btn-sm btn-success',
				'content' => "<i class='ri-add-fill'></i>",
				'onclick' => "fetch_form_product('{$url}', '{$title} Product')"
			];
			
			echo form_button($attr);
		?>
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
			<div class="card-body min-vh-100" id="fetch_table_product"></div>
		</div>
	</div>

</div>

<script>
	loading = `<div class='col-1 position-absolute top-50 start-50 translate-middle'> 
					<?php $this->load->view("components/loading") ?> 
				</div>`;

	fetch_table($('div[id="fetch_table_product"]'), `<?=base_url("product/fetch_table_product")?>`, loading);

	re_fetch_table = function(start, end)
	{
		icon = $('i[id="rotate"]'); 
		icon.addClass("down").attr("refresh", "true");
		
		if (icon.attr("refresh") != false) 
		{
			fetch_table($('div[id="fetch_table_product"]'), `<?=base_url("product/fetch_table_product")?>`, loading, start, end);
		}
	}

	$(function() 
	{
	    var start = moment().subtract(29, 'days'),
	    	end = moment();
	    
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
