

<?=form_open(null, ['class' => 'vstack gap-3 px-3 mb-5', 'autocomplete' => 'off'])?>
	
	<div class="form-floating">
		<?php 
			$specify = 'product-type';
			echo form_dropdown($specify, $options, '', "class='form-control' id='{$specify}'").
				 form_label(ucfirst(str_replace("-", " ",$specify))." <i class='ri-shopping-bag-3-fill'></i>");
 		?>
		<span id="product-type-msg"></span>
	</div>

	<div class="form-floating">
		<?php 
			$specify = 'description';
			$attr = array(
				'class' => 'form-control h-100',
				'name' => $specify,
				'id' => $specify,
				'rows' => '3'
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
					'id' => $specify
				);

				echo form_input($attr).form_label(ucwords($specify)." ₱");
			?>	
			<span id="amount-msg"></span>	
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="form-floating">
			<?php 
				$specify = 'percentage';
				$attr = array(
					'class' => 'form-control',
					'name' => $specify,
					'id' => $specify
				);

				echo form_input($attr).form_label(ucwords($specify)." <i class='ri-water-percent-fill'></i>");
			?>	
			<span id="percentage-msg"></span>
			</div>
		</div>
	</div>

	<div class="text-end">
		<?php 
			$attr = array(
				'type' => 'submit',
				'class' => 'btn btn-success btn-choco',
				'content' => 'Submit'
			);

			echo form_button($attr);
		?>
	</div>

<?=form_close()?>

<?=script_tag("assets/jquery.mask.js")?>
<?=script_tag("assets/product/add_product.js")?>