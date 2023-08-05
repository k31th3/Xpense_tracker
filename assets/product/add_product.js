	
	$('input[id="amount"]').mask('000000000');
	
	$('input[id="percentage"]').mask('000');
	
	$('select[id="product-type"] option[value=""]').attr({
		'disabled':'disabled',
		'hidden':'hidden'
	});

	