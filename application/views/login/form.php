
<div class="card rounded-0">
	<div class="card-header vstack border-0">
		<span class="small text-brown fw-bolder">Xpense tracker</span>
		<div class="fw-bold h2">
			SIGN IN
			<i class="ri-donut-chart-fill text-brown"></i>	
		</div>
	</div>
	<div class="card-body text-center">
		<i class="ri-account-circle-line fs-1 text-brown"></i>

		<?=form_open('user/fetch_auth_login', ['class' => 'vstack gap-3 mt-3', 'id' => 'login-form'])?>

			<?php 
				$data = array(
					'class' => 'form-control rounded-0',
					'placeholder' => ''
				);
			?>

			<div class="form-floating">
				<?php
					$ie = 'username';

					$username = array_merge(
						['id' => $ie, 'name' => $ie], $data
					);

					echo form_input($username).form_label('Username', $ie);
				?>
				<span id="username-msg"></span>
			</div>

			<div class="form-floating">
				<?php 
					$ie = 'password';
					
					$password = array_merge(
						[ 'type' => $ie, 'id' => $ie, 'name' => $ie ], $data
					);
					
					echo form_input($password).form_label('Password', $ie);
				?>
				<span id="password-msg"></span>
			</div>

			<?php 					 
				$attr = array(
					'type' => 'submit',
					'content' => 'Submit',
					'class' => 'btn btn-success mt-4 btn-choco',
					'onclick' => "login(event)"
				);

				echo form_button($attr);
			?>

		<?=form_close()?>
	
	</div>
	<div class="card-footer p-0 border-0">
	<?php 
		$attr = array(
			'src' => 'assets/login/footer.svg',
			'class' => 'img-fluid'
		);	
		echo img($attr);
	?>
	</div>
</div>

<script>
	login = function(e, loading) 
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
					btn.html(`<?php $data["construct"] = array('size' => 'spinner-border-sm');
				$loading = $this->load->view('components/spinner', $data) ?>`)
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

