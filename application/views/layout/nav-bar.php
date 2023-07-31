<nav class="navbar navbar-expand-xl bg-body-tertiary sticky-top">
	<div class="container-fluid">
	    
	    <?php 
	    	$url = str_replace(" ", "_", strtolower($title));
	    	echo anchor("{$url}/index", $title, 'class="fw-bold text-decoration-none c-mantle"');
	    
	    	$attr = array(
	    		'class' => 'navbar-toggler',
	    		'data-bs-toggle' => 'offcanvas',
	    		'data-bs-target' => '#side-bar',
	    		'aria-controls' => 'side-bar',
	    		'content' => "<span class='navbar-toggler-icon'></span>"
	    	);

	    	echo form_button($attr);

	    ?>

	</div>
</nav>