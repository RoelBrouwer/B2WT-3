	<div class="wrapper">
	<div class="container">
		<h2>Upload profielfoto</h1>
		
		<div class="row">
			<div class="span8">
				<?php if ($error): ?>
					<div class="alert">
					<a class="close" data-dismiss="alert">&times;</a>
					<strong>Warning!</strong> <?php echo $error; ?>
				</div>
				<?php endif ?>
				
				<?php if (isset($var)) { $v = $var; } else { $v = ''; }
				echo form_open_multipart('profile/do_upload/'.$v);?>
					<?php 
					$data_form = array(
						'name' => 'userfile'
					 ); 

					echo form_upload($data_form);
					echo form_submit('', 'Upload');
					?>
				<?php echo form_close(); ?>
			</div>
			
		</div>
	</div>
	</div>