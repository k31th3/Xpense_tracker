

<?=link_tag('assets/jquery-confirm/index.css')?>

<?=form_open('product/fetch_ajax_edit_product_form', ['class' => 'vstack gap-3 px-3 mb-5', 'autocomplete' => 'off', 'id' => 'fetch_form_edit_process', 'product-id' => $row->product_id])?>
	
	<div class="form-floating">
		<?php 
			$specify = 'product_type';
			echo form_dropdown($specify, $options, $row->product_type, "class='form-control' id='{$specify}'").
				 form_label(ucfirst(str_replace("_", " ",$specify))." <i class='ri-shopping-bag-3-fill'></i>");
 		?>
		<span id="product_type-msg"></span>
	</div>

	<div class="form-floating">
		<?php 
			$specify = 'description';
			$attr = array(
				'class' => 'form-control h-100',
				'name' => $specify,
				'id' => $specify,
				'rows' => '3',
				'value' => $row->product_details
			);

			echo form_textarea($attr).form_label(ucwords($specify)." <i class='ri-article-fill'></i>");
		?>
		<span id="description-msg"></span>
	</div>

	<div class="row gy-3">
		<div class="col-12 col-lg-6">
			<div class="form-floating">
			<?php 
				$specify = 'amount';
				$attr = array(
					'class' => 'form-control',
					'name' => $specify,
					'id' => $specify,
					'value' => $row->amount
				);

				echo form_input($attr).form_label(ucwords($specify)." <i class='ri-product-hunt-fill'></i>");
			?>	
			<span id="amount-msg"></span>	
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="form-floating">
			<?php 
				$specify = 'commission';
				$attr = array(
					'class' => 'form-control',
					'name' => $specify,
					'id' => $specify,
					'value' => $row->commission
				);

				echo form_input($attr).form_label(ucwords($specify)." <i class='ri-water-percent-fill'></i>");
			?>	
			<span id="commission-msg"></span>
			</div>
		</div>
	</div>

	<?php 
		$attr = array(
			'type' => 'submit',
			'class' => 'btn btn-success btn-choco w-100',
			'content' => 'Submit',
			'onclick' => 'fetch_form_add_process(event)'
		);

		echo form_button($attr);
	?>

<?=form_close()?>

<?=script_tag("assets/product/index.js")?>
<?=script_tag('assets/toast/index.js')?>
<?=script_tag('assets/jquery-confirm/index.js')?>

<script>
	fetch_form_add_process = function(e) 
	{
		form = $('form[id="fetch_form_edit_process"]');
		btn = form.find('button[type="submit"]');

		$.ajax(
			{
				url: form.attr('action'),
				data: form.serialize(),
				method: form.attr('method'),
				dataType: 'json',
				beforeSend: function()
				{
					btn.html(`<?php $data["construct"] = array('size' => 'spinner-border-sm');
					$loading = $this->load->view('components/spinner', $data) ?>`)
						.attr('disabled', true);
				},
				success:function(resp)
				{
					span = form.find('span');
					span.html(null);
					if (resp.status == null) 
					{
						span_msg(resp);		
					}
					else if(resp.status == false) 
					{
						span_msg(resp);		
					}
					else
					{
						$.confirm({
							title: 'Confirmation!',
						    content: 'Do you want update a product?',
						    buttons: {
						        confirm: function () 
						        {
						           	$.ajax(
										{
											url: form.attr('action'),
											data: form.serialize()+"&product_id="+form.attr('product-id')+"&product_status=true",
											method: form.attr('method'),
											dataType: 'json',
											success: function(resp)
											{
												$('div[id="modal"]').modal('hide');
												new Toast({
												    message: resp.message,
												    type: resp.type
												});
												
												fetch_table($('div[id="fetch_table_product"]'), `<?=base_url("product/fetch_table_product")?>`, loading_animation());
											}
										}
									)
						        },
						        cancel: function () 
						        {
						            $.alert('Canceled!');
						        }
						    }
						});
					}
				},
				complete:function()
				{
					setTimeout(function(){
					    btn.html('Submit')
					   	   .removeAttr('disabled');
					}, 1500);
				}
			}
		);

		e.preventDefault();
	}
</script>