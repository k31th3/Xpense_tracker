
<?php 
	$label = ['Log-in', 'Log-out', 'Failed log-in', 'No Data'];
	$item = [ 0, 0, 0, 1 ];

	$status = 'false';

	if (!empty($result)) 
	{
		$status = 'true';
		$label = null;
		$item = null;

		foreach($result as $row)
		{
			$label[] = $row->audit_type;
			$item[] = $row->count; 
		}
	}	
?>

<canvas id='chart-accessibility'></canvas>

<script>

	data = {
	  	labels: <?=json_encode($label)?>,
	  	datasets: [{
	    label: 'Total',
	    data: <?=json_encode($item)?>,
	    backgroundColor: [
	      'rgb(255, 99, 132)',
	      'rgb(54, 162, 235)',
	      'rgb(255, 205, 86)',
	      'rgb(211, 211, 211)'
	    ],
	    hoverOffset: 4
	  }]
	};

	config = {
	  	type: 'doughnut',
	  	data: data,
	  	options: {
	  		responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: 
                {
        			enabled: <?=$status?> // <-- this option disables tooltips
      			}
            }
	    }
	};
	
	new Chart($('canvas[id="chart-accessibility"]')[0].getContext("2d"), config);

</script>
