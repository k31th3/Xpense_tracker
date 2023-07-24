
span_msg = function(resp)
{
	$.each(resp, function(i, item)
	{
		$(`span[id="${i}-msg"]`).addClass('text-danger fw-medium animate__animated animate__fadeInUp').html(item);
	});		
}
