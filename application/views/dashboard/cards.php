
<?php 
	$list = array(
		[
			'content' => 'Sales',
			'id' => 'sales-chart',
			'total' => '₱ 5023' 
		],
		[
			'content' => 'Earn money',
			'id' => 'earn-money-chart',
			'total' => '₱ 5023'	
		],
		[
			'content' => 'Order',
			'id' => 'order-chart',
			'total' => '₱ 5023'
		]
	);

	$card = null;
	foreach($list as $row)
	{
		$h6 = heading($row['content'], 6, 'class="me-auto c-mantle"');
		$anchor = anchor(null, 'view history', 'class="text-muted small text-decoration-none"');
		$h5 = heading($row['total'], 5, 'class="me-auto fw-bolder"');

		$card .= "<div class='col-12 col-lg-4'>
					<div class='card'>
						<div class='card-header d-inline-flex'>
							{$h6}
							{$anchor}
						</div>
						<div class='card-body vstack pt-0 position-relative'>
							{$h5}
							<div class='col-2 position-absolute top-50 start-50 translate-middle' id='{$row['id']}'></div>	
							<canvas id='{$row['id']}' class='card-chart'></canvas>
						</div>
					</div>
				</div>";
	}

	echo $card;
?>

<script>
	const sales_chart = $('canvas[id="sales-chart"]'),
		  l_sales_chart = $('div[id="sales-chart"]'),	
		  
		  earn_money_chart = $('canvas[id="earn-money-chart"]'),
		  l_earn_money_chart = $('div[id="earn-money-chart"]'),

		  order_chart = $('canvas[id="order-chart"]'),
		  l_order_chart = $('div[id="order-chart"]');
    
	l_sales_chart.html(single_loading_animation());
	l_sales_chart.fadeOut(4500);

	sales_chart.fadeIn(4500, function(){
		line_chart_cards(
			{
				'id': $(this)[0].getContext("2d"),
				'label': ["02:00","04:00","06:00","08:00","10:00","12:00","14:00","16:00","18:00","20:00","22:00","00:00"],
				'data': [0, 45.0,32.4,22.2,39.4,34.2,22.0,23.2,24.1,20.0,18.4,19.1,17.4],
				'border-color': 'rgba(255, 99, 132, 1)',
				'bg-color' : [
	    				'rgba(214, 31, 31, 0.3)',
	    				'rgba(214, 31, 31, 0.2)',
	    				'rgba(214, 31, 31, 0)'
	    			]
			}
		);
	});

	l_earn_money_chart.html(single_loading_animation());
	l_earn_money_chart.fadeOut(4500);
	
	earn_money_chart.fadeIn(4500, function(){
		line_chart_cards(
			{
				'id': $(this)[0].getContext("2d"),
				'label': ["02:00","04:00","06:00","08:00","10:00","12:00","14:00","16:00","18:00","20:00","22:00","00:00"],
				'data': [0, 45.0,32.4,22.2,39.4,34.2,22.0,23.2,24.1,20.0,18.4,19.1,17.4],
				'border-color': 'rgba(25, 118, 201, 1)',
				'bg-color' : [
	    				'rgba(25, 118, 210, 0.3)',
	    				'rgba(25, 118, 210, 0.2)',
	    				'rgba(25, 118, 210, 0)'
	    			]
			}
		);
	});

	l_order_chart.html(single_loading_animation());
	l_order_chart.fadeOut(4500);
	
	order_chart.fadeIn(4500, function(){
		line_chart_cards(
			{
				'id': $(this)[0].getContext("2d"),
				'label': ["02:00","04:00","06:00","08:00","10:00","12:00","14:00","16:00","18:00","20:00","22:00","00:00"],
				'data': [0, 45.0,32.4,22.2,39.4,34.2,22.0,23.2,24.1,20.0,18.4,19.1,17.4],
				'border-color': 'rgba(0, 121, 107, 1)',
				'bg-color' : [
	    				'rgba(0, 121, 107, 0.3)',
	    				'rgba(0, 121, 107, 0.2)',
	    				'rgba(0, 121, 107, 0)'
	    			]
			}
		);
	});	
</script>