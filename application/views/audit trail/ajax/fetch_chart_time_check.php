

<canvas id='chart-time-check'></canvas>

<script>
	data = {
	  	labels: null,
	  	datasets: 
	  	[
		  	{
		    	label: 'Log-in',
		    	data: <?=json_encode(array_values($log_in))?>,
		    	borderColor: 'rgb(54, 162, 235)',
		    	backgroundColor: 'rgb(54, 162, 235)' 
		  	},
		  	{
		  		label: 'Log-out',
		    	data: <?=json_encode(array_values($log_out))?>,
		    	borderColor: 'rgb(255, 99, 132)',
		    	backgroundColor: 'rgb(255, 99, 132)'
		  	},
		  	{
		  		label: 'Failed log-in',
		    	data: <?=json_encode(array_values($failed_log_in))?>,
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
        			enabled: true // <-- this option disables tooltips
      			}
            }
	    }
	};
	
	new Chart($('canvas[id="chart-time-check"]')[0].getContext("2d"), config);

</script>
