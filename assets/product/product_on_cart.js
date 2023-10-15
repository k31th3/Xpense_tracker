total_payment_on_cart = function()
{
	var order_amount = 0,
		delivery_amount = 0,
		item = 0,
		product_id = new Array;

	$('table[id="product_on_cart"] tbody tr').each(function() 
	{
		order_amount += parseFloat($(this).find("td").eq(3).html());
    	delivery_amount += parseFloat($(this).find("td").eq(4).html());
    	item += parseFloat($(this).find("td").eq(2).find('span').html());

    	product_id.push($(this).attr('product_id')); 	   
	});

	order = order_amount.toFixed(2);
	delivery = delivery_amount.toFixed(2);

	$('input[id="total-item"]').val(item);
	$('input[id="order-amount"]').val(`₱ ${order}`);
	$('input[id="delivery-amount"]').val(`₱ ${delivery}`);

	if (product_id.length <= 0) 
	{
		$('button[id="btn-continue"]').fadeOut('slow', function()
		{
			$(this).remove();	
		});
	}
}

total_payment_on_cart();

check_btn_on_cart = function()
{
	var product_id = new Array;
		
	$('table[id="product_on_cart"] tbody tr').each(function() 
	{
    	product_id.push(
	    	{
	    		'product_id': $(this).attr('product_id'),
	    		'item': parseFloat($(this).find("td").eq(2).find('span').html())
	    	}
    	);	   
	});

	// console.log(product_id);
}

subraction_quantity_product_on_cart = function(e)
{
	span = $(e).closest("tr").find("td").eq(2).find("span");
	order_amount = $(e).closest("tr");
	delivery_amount = $(e).closest("tr");

	quantity = parseFloat(span.html()) - 1;

	if (quantity <= 0) 
	{
		quantity = 0;
	}

	order = parseFloat($(e).closest("tr").find("td").eq(3).html()) - parseFloat(delivery_amount.attr('order-amount'));
	delivery = parseFloat($(e).closest("tr").find("td").eq(4).html()) - parseFloat(delivery_amount.attr('delivery-amount'));		
	
	if (order <= 0) 
	{
		order = 0;
		delivery = 0;
	}

	order_amount.find("td").eq(3).html(order.toFixed(2));
	delivery_amount.find("td").eq(4).html(delivery.toFixed(2));

	span.html(quantity);	
	total_payment_on_cart();
}

remove_product_on_cart = function(e)
{
	$(e).closest("tr").fadeOut('slow', function()
	{
		$(this).remove();
		total_payment_on_cart();		
	});

	total_payment_on_cart();
}	