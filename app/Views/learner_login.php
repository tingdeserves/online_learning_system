<div class="container mt-5 mb-5">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'learner_login/check_login'); ?>
				<h2 class="text-center">Learner Login</h2>       
					<div class="form-group mt-3">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>
					<div class="form-group mt-3">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password">
					</div>
					<div class="form-group mt-3">
					<?php echo $error; ?>
					</div>
					<div class="form-group mt-3">
						<button type="submit" class="btn btn-primary btn-block">Log in</button>
					</div>
					<div class="clearfix mt-3">
						<label class="float-left form-check-label"><input type="checkbox" name = "remember"> Remember me</label>
						<a href="<?php echo base_url()."learner_login/password_reset"?>" class="float-right">Forgot Password?</a>
					</div>    
			<?php echo form_close(); ?>
	</div>
</div>