
<?php 

	$item = [ 0, 0, 0, 0 ];
	$status = 'false';

	if (!empty($result)) 
	{
		$status = 'true';
		$label = null;
		$item = null;

		foreach($result as $row)
		{
			$date = date('Y-m-d', strtotime($row->date_created));
			$r_count[] = date('Y-m-d', strtotime($row->date_created)); 	

			$data[$row->audit_type][$date] = array(
				"x" => $date,
				"y" => round(count($r_count) / 2)
			);	 
		}
	}	
?>

<canvas id='chart-time-check'></canvas>

<script>
	data = {
	  	labels: <?=json_encode($label)?>,
	  	datasets: 
	  	[
		  	{
		  		label: 'Log-out',
		    	data: <?=json_encode(array_values($data['Log-out']))?>,
		    	borderColor: 'rgb(255, 99, 132)',
		    	backgroundColor: 'rgb(255, 99, 132)'
		  	},
		  	{
		    	label: 'Log-in',
		    	data: <?=json_encode(array_values($data["Log-in"]))?>,
		    	borderColor: 'rgb(54, 162, 235)',
		    	backgroundColor: 'rgb(54, 162, 235)' 
		  	},
		  	{
		  		label: 'Failed log-in',
		    	data: <?=json_encode(array_values($data['Failed log-in']))?>,
		    	borderColor: 'rgb(255, 205, 86)',
		    	backgroundColor: 'rgb(255, 205, 86)'
		  	}
	  	]
	};

	config = {
	  	type: 'line',
	  	data: data,
	  	options: {
	  		responsive: true,
            plugins: {
            	scales: {
			        y: {
			            max: 5,
			            min: 0,
			            ticks: {
			                stepSize: 0.5
			            }
			        }
			    },
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
	
	new Chart($('canvas[id="chart-time-check"]')[0].getContext("2d"), config);

</script>
