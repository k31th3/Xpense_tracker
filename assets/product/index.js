
fetch_form_product = function(location, title)
{
	$.ajax({
		url: location,
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
