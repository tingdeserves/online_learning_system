<div class="container mt-5 mb-5">
	<div class="col-4 offset-4">
		<?php echo form_open(base_url().'register'); ?>
		<h2 class="text-center mb-5">Register</h2>

		<div class="mb-3">
			<label for="exampleInputUsername" class="form-label">Username</label>
			<input type="username" name="username" class="form-control" id="exampleInputUsername" aria-describedby="usernameHelp">
		</div>

		<div class="mb-3">
			<label for="exampleInputEmail1" class="form-label">Email address</label>
			<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>

		<div class="mb-3">
			<label for="exampleInputPhone" class="form-label">Phone number</label>
			<input type="phone" name="phone" class="form-control" id="exampleInputPhone" aria-describedby="phoneHelp">
		</div>

		<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Password</label>
			<input type="password" name="password"class="form-control" id="exampleInputPassword1">
		</div>

		<!--radio  -->
		<fieldset class="mb-3">
			<div class="mb-3">
				<label for="exampleSelect" class="form-label">Select your role</label>
				<div class="form-check ">
					<input type="radio" name="role" class="form-check-input" id="exampleRadio1" value="learner">
					<label class="form-check-label" for="exampleRadio1">Learner</label>
				</div>

				<div class="mb-3 form-check">
					<input type="radio" name="role" class="form-check-input" id="exampleRadio2" value="educator">
					<label class="form-check-label" for="exampleRadio2">Educator</label>
				</div>
			</div>
		</fieldset>

		<style>
			.errors{
				color:red;
			}
		</style>
		<p style="color:red"><?php echo validation_list_errors() ?></p>
		<p style="color:red"><?php echo $err ?></p>

		<div class="form-group mt-3 d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
			
			<button type="submit" class="btn btn-primary btn-block ">Submit</button>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>