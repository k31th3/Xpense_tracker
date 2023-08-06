
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