<div class="container mt-5 mb-5">
	<div class="col-4 offset-4">
		<?php echo form_open(base_url().'profile/secret_questions'); ?>
		<h2 class="text-center mb-5">Secret Questions</h2>

		<div class="mb-5">
			<label for="question1" class="form-label">Question-One</label>


            <select class="form-select" name="question1">
              <option selected="">Select a question</option>
              <option value="What is your favourite book?">What is your favourite book?</option>
              <option value="Who is your best friend in primary school?">Who is your best friend in primary school?</option>
              <option value="What is your favourite food?">What is your favourite food?</option>
              <option value="What is your favourite movie?">What is your favourite movie?</option>
              <option value="what is your lucky number?">what is your lucky number?</option>
            </select>
			<input type="text" name="answer1" class="form-control mt-2" id="answer-1" placeholder="Answer:">

		</div>

		
		<div class="mb-5">
			<label for="question1" class="form-label">Question-Two</label>


            <select class="form-select" name="question2">
              <option selected="">Select a question</option>
              <option value="what is your first pet's name?">what is your first pet's name?</option>
              <option value="who is your favourite singer?">who is your favourite singer?</option>
              <option value="what is your favourite city?">what is your favourite city?</option>
              <option value="who is your best friend in high school?">who is your best friend in high school?</option>
              <option value="what is your favourite sport?">what is your favourite sport?</option>
            </select>
			<input type="text" name="answer2" class="form-control mt-2" id="answer-2" placeholder="Answer:">

		</div>

		<style>
			.errors{
				color:red;
			}
		</style>
		<p style="color:red"><?php //echo validation_list_errors() ?></p>
		<p style="color:red"><?php //echo $err ?></p>

		<div class="form-group mt-3 d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
			
			<button type="submit" class="btn btn-primary btn-block ">Submit</button>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>