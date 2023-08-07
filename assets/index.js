
span_msg = function(resp)
{
	$.each(resp, function(i, item)
	{
		$(`span[id="${i}-msg"]`).addClass('text-danger fw-medium animate__animated animate__fadeInUp').html(item);
	});		
}

loading_animation = function()
{
	parent = $("<div>", {
		'class': 'col-1 position-absolute top-50 start-50 translate-middle'
	});
	
	img = $('<img>', {
					'src': '../assets/loading/two-circle-spinner.svg',
					'class': 'img-fluid'
				});

	return parent.html(img);
}

single_loading_animation = function()
{
	img = $('<img>', {
					'src': '../assets/loading/two-circle-spinner.svg',
					'class': 'img-fluid'
				});

	return img;
}

fetch_table = function(target, location, loading, start_date, end_date)
{
	icon = $('i[id="rotate"]');
	$.ajax({
		url: location,
		method: 'POST',
		data: { start: start_date, end: end_date},
		dataType: 'html',
		beforeSend: function()
		{
			target.html(loading);
			icon.attr("refresh", "false");

		},
		success: function(response)
		{
			setTimeout(function()
			{
				target.html(response);
			}, 1000);
		},
		complete: function()
		{
			setTimeout(function()
			{
				icon.removeClass("down");
				icon.attr("refresh", "true");
			}, 1500);
		}
	});
}

fetch_form = function(location, title, loading, unique_id)
{
	$.ajax({
		url: location,
		method: 'POST',
		data: { unique_id: unique_id },
		dataType: 'html',
		success: function(response)
		{
			bs_modal(
				{	
					'title': title,
					'body': response
				}
			);		
		},
		complete: function()
		{
			$('div[id="modal"]').modal('show');
		}
	});
}

fetch_chart = function(target, data)
{
	$.ajax({
		url: data['location'],
		method: 'POST',
		data: { start: data['start_date'], end: data['end_date']},
		dataType: 'html',
		beforeSend: function()
		{
			target.html(data['loading']);
		},
		success: function(response)
		{
			setTimeout(function()
			{
				target.html(response);
			}, 1500);
		}
	});	
}

run_moment_date = function()
{
	$(function() 
	{
	    var start = moment().subtract(29, 'days'),
	    	end = moment();
	    
	    function cb(start, end) 
	    {
	        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	        re_fetch_table(start.format('MMMM D, YYYY'), end.format('MMMM D, YYYY'));
	    }

	    $('#reportrange').daterangepicker({
	        startDate: start,
	        endDate: end,
	        ranges: {
	           'Today': [moment(), moment()],
	           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	           'This Month': [moment().startOf('month'), moment().endOf('month')],
	           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        }
	   	}, cb);

	    cb(start, end);
	});	
}