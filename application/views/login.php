	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card login-form col-sm-4 col-sm-offset-4">
				<div class="card-header">
					<h3>Sign In</h3>
					
				</div>
				<div class="card-body">
				<div style="color:crimson"><?php echo $this->session->flashdata('message_name'); ?></div>
					<form name="login" method="POST" action="<?php echo base_url(); ?>log_check">
						<div class=" form-group">
							
							<input type="text" name="userName" class="form-control" placeholder="username">
							
						</div>
						<div class=" form-group">
							
							<input type="password" name="password" class="form-control" placeholder="password">
						</div>
						
						<div class="form-group">
							<input type="submit" value="Login" class="btn float-right login_btn">
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						Don't have an account?<a href="<?php echo base_url()?>register">Sign Up</a>
					</div>
				</div>
			</div>
		</div>
	</div>
