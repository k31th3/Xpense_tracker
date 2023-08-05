
table_audit_trail = function(location, loading, start_date, end_date)
{
	table = $('div[id="table-audit-trail"]');
	icon = $('i[id="rotate"]');

	$.ajax({
		url: location,
		method: 'POST',
		data: { start: start_date, end: end_date},
		dataType: 'html',
		beforeSend: function()
		{
			table.html(loading);
			icon.attr("refresh", "false");
		},
		success: function(response)
		{
			setTimeout(function()
			{
				table.html(response);
			}, 3500);
		},
		complete: function()
		{
			setTimeout(function()
			{
				icon.removeClass("down");
				icon.attr("refresh", "true");
			}, 4000);
		}	
	});	
}

chart_audit_trail = function(data)
{
	$.ajax({
		url: data['location'],
		method: 'POST',
		data: { start: data['start_date'], end: data['end_date']},
		dataType: 'html',
		beforeSend: function()
		{
			$(data['id']).html(data['loading']);
		},
		success: function(response)
		{
			setTimeout(function()
			{
				$(data['id']).html(response);
			}, 3500);
		}
	});	
}