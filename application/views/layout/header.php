<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{page}</title>

	<?=link_tag('assets/website-logo.svg', 'icon', 'image/x-icon')?>
	<?=link_tag('assets/bootstrap/index.css')?>
	<?=link_tag('assets/bootstrap/form.css')?>
	<?=link_tag('assets/bootstrap/button.css')?>
	<?=script_tag('assets/bootstrap/index.js')?>
	<?=script_tag('assets/jquery.js')?>

	<!-- icon -->
	<?=link_tag('assets/remixicon/index.css')?>

	<!-- toast -->
	<?=link_tag('assets/toast/index.css')?>

	<!-- animate -->
	<?=link_tag('assets/animate.min.css')?>

	<?=link_tag('assets/layout/index.css')?>
</head>

	<body class="overflow-hidden">
		<?=script_tag('assets/toast/index.js')?>

	<main class="container-fluid" id="body-container">
		<div class="row">
			
			<div class="col-12 col-xxl-2 col-xl-3">
				<div class="offcanvas-xl offcanvas-start " tabindex="-1" id="side-bar" aria-labelledby="offcanvas_label" data-bs-backdrop="static">
				  	<div class="offcanvas-header">

				  	<!-- title of canvas -->
				    <?=heading("Title of canvas", 5, 'id="offcanvas_label"')?>

				    <!-- offcanvas close button -->
				    <?php 
				    	$attr = array(
				    		'class' => 'btn-close',
				    		'data-bs-dismiss' => 'offcanvas',
				    		'data-bs-target' => '#side-bar',
				    		'aria-label' => 'Close'
				    	);
				    	echo form_button($attr);
				    ?>

				  	</div>

				  	<div class="offcanvas-body d-block overflow-y-auto">

				  		<?php $this->load->view('layout/side-bar') ?>
				  
				  	</div>
				</div>
			</div>

			<div class="col" id="main-bar">

				<div class="vstack gap-4 my-4">