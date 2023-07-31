
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

