<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$page?></title>

	<?=link_tag('assets/website-logo.svg', 'icon', 'image/x-icon')?>
	<?=link_tag('assets/bootstrap/index.css')?>
	<?=link_tag('assets/bootstrap/form.css')?>
	<?=link_tag('assets/bootstrap/button.css')?>
	<?=script_tag('assets/bootstrap/popper.min.js')?>
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
		<div id="body-container">
		<?=script_tag('assets/toast/index.js')?>

		<div class="row">
			<div class="offcanvas-xl offcanvas-start col-xl-2 col-lg-3" tabindex="-1"
					aria-labelledby="offcanvas_label" id="side-bar" data-bs-backdrop="static">
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
			  	<div class="offcanvas-body d-block overflow-y-auto mx-2">
			    	<?php $this->load->view('layout/side-bar') ?>
			  	</div>
			</div>
			<main class="col-12 col-xl-10">
				<?php 
					$data["title"] = $page;
					$this->load->view('layout/nav-bar', $data) 
				?>

				<div id="main-bar" class="vstack gap-4 pt-4 px-3 pb-5">


				

	

	