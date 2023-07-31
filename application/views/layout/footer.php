			</div>
		</main>
	</body>
</html>

<script>
	$(window).on("load", () => 
	{
		$('body').append(`
		<div class="walking-man vstack gap-2">
			<?php 
				$attr = array(
					'src' => 'assets/loading/walking_man.gif',
					'class' => 'img-fluid'
				);
				echo img($attr);
			?>
			<span>Please wait...</span>
		</div>`);

	 	$(".walking-man").fadeOut(2000, function()
 		{
 			$(this).remove();
 		});
	 	
	 	$("#body-container").fadeIn(5000);   
	});

	$(function () {
        $("[data-bs-toggle='tooltip']").tooltip();
    });
</script>