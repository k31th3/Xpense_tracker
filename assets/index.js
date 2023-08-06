
span_msg = function(resp)
{
	$.each(resp, function(i, item)
	{
		$(`span[id="${i}-msg"]`).addClass('text-danger fw-medium animate__animated animate__fadeInUp').html(item);
	});		
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