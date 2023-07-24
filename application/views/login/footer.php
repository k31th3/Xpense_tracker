	
	</body>
</html>

<?=script_tag('assets/toast/index.js')?>
<?=script_tag('assets/index.js')?>

<script>
	login = function(e) 
	{
		form = $('form[id="login-form"]');
		btn = form.find('button[type="submit"]');

		$.ajax(
			{
				url: form.attr('action'),
				data: form.serialize(),
				method: form.attr('method'),
				dataType: 'json',
				beforeSend: function()
				{
					btn.html(`<?php 
								$data["construct"] = array('size' => 'spinner-border-sm');
									$this->load->view('components/spinner', $data ) ?>`
							)
						.attr('disabled', true);
				},
				success:function(resp)
				{
					span = form.find('span');
					span.html(null);
					if (resp.status == null) 
					{
						span_msg(resp);		
					}
					else if(resp.status == false) 
					{
						new Toast({
						    message: resp.message,
						    type: 'danger'
						});		
					}
					else
					{
						setTimeout(function()
						{
							window.location.href = resp.location;
						}, 1400);
					}
				},
				complete:function()
				{
					setTimeout(function(){
					    btn.html('Submit')
					   	   .removeAttr('disabled');
					}, 1500);
				}
			}
		);

		e.preventDefault();
	}
</script>