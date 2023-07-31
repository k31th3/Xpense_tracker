

line_chart_cards = function(row)
{
	// id, labels, data
	let ctx = row['id'];
    var data = {
         	labels : row['label'],
            datasets: [
                {
                    backgroundColor: (context) => {
                    	const bgColor = row['bg-color'];
                    	if (!context.chart.chartArea) {
                    		return;
                    	}
                    	const { ctx, data, chartArea: {top, bottom} } = context.chart;
                    	
                    	/*** Gradient ***/
						const gradientBg = ctx.createLinearGradient(0, top, 0, bottom);
							  gradientBg.addColorStop(0, bgColor[0]);
							  gradientBg.addColorStop(0.2, bgColor[1]);
							  gradientBg.addColorStop(0.5, bgColor[1]);
							  gradientBg.addColorStop(0.7, bgColor[2]);

						return gradientBg;
                    	
                    }, // Put the gradient here as a fill color
                    borderColor: row['border-color'],
                    borderWidth: 1,
                    fill: true,
                    tension: 0.7,
                    data : row['data']
                }
            ]
        };
	
	let chart = new Chart(ctx, {
	  	type: "line",
	  	data: data,
	  	options: {
	  		responsive: true,
	  		plugins:{
	  			legend: {
		  			display: false
		  		}
	  		},
	  		scales: {
	            x: {
	            	border: {
	                    display: false
	                },
	               	grid: {
	                  	display: false
	               	},
	               	ticks: {
 						display: false
	            	}
	            },
	            y: {
	            	border: {
	                    display: false
	                },
	            	beginAtZero: true,
	            	ticks: {
 						display: false
	            	},
	               	grid: {
	                  	display: false
	               	}
	            }
       		}
	  	}
	});
} 