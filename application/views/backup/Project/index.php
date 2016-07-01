<html >
	<head>
					<title>User Details</title>
					<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
					<script src="<?php echo base_url();?>assets/js/Validate.js"></script>
					<script src="<?php echo base_url();?>assets/js/index.js"></script>
					<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
	</head>
	<body>
					<header role="banner">

							<div id="cd-logo">
									<img src="<?php echo base_url();?>assets/img/QuoPro Logo.gif" width = "90" height="90" alt="Logo">
							</div>

							<nav class="main-nav">
									<ul>
										<!-- inser more links here	 -->
										<li><a class="cd-signin" href="#0">Sign in</a></li>
										<li><a class="cd-signup" href="#0">Sign up</a></li>
									</ul>
							</nav>

					</header>

					<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->

							<div class="cd-user-modal-container"> <!-- this is the container wrapper -->

									<ul class="cd-switcher">
										<li><a href="#0">Sign in</a></li>
										<li><a href="#0">New account</a></li>
									</ul>

									<div id="cd-login"> <!-- log in form -->
												<form class="cd-form">

														<p class="fieldset">
															<label class="image-replace cd-email" for="signin-email">E-mail</label>
															<input class="full-width has-padding has-border" id="signin-email" type="email" placeholder="E-mail">
															<span class="cd-error-message">Error message here!</span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signin-password">Password</label>
															<input class="full-width has-padding has-border" id="signin-password" type="password"  placeholder="Password">
															<a href="#0" class="hide-password">Show</a>
															<span class="cd-error-message">Error message here!</span>
														</p>

														<p class="fieldset">
														<input type="checkbox" id="remember-me" checked>
														<label for="remember-me">Remember me</label>
														</p>

														<p class="fieldset">
														<input class="full-width" type="submit" value="Login">
														</p>
											  </form>

												<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
												<!-- <a href="#0" class="cd-close-form">Close</a> -->
									</div> <!-- cd-login -->

									<div id="cd-signup"> <!-- sign up form -->
											  <?php $attributes = array("class" => "cd-form");
												echo form_open("index.php/Signup", $attributes);?>

														<p class="fieldset">
															<label class="image-replace cd-username" for="signup-username">Name</label>
															<input class="full-width has-padding has-border" name="Name" id="signup-username" type="text" placeholder="Name" value="<?php echo set_value('Name'); ?>">
															<span class="cd-error-message">Name is empty or is in incorrect format.</span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-email" for="signup-email">E-mail</label>
															<input class="full-width has-padding has-border" name="Email" id="signup-email" type="email" placeholder="E-mail" value="<?php echo set_value('Email'); ?>">
															<span class="cd-error-message">Email ID is empty or is in incorrect format.</span>
														</p>


														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-password">Password</label>
															<input class="full-width has-padding has-border" name="Password" id="signup-password" type="password"  placeholder="Password" value="<?php echo set_value('Password'); ?>">
															<span class="cd-error-message">Password should be more than 8 characters.</span>
															<a href="#0" class="hide-password">Show</a>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-cpassword">Confirm Password</label>
															<input class="full-width has-padding has-border" name="cpassword" id="signup-cpassword" type="password"  placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>">
															<span class="cd-error-message">Passwords do not match.</span>
															<a href="#0" class="hide-password">Show</a>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-mobile">Mobile</label>
															<input class="full-width has-padding has-border" name="Mobile" id="signup-mobile" type="text"  placeholder="Mobile No." value="<?php echo set_value('Mobile'); ?>">
															<span class="cd-error-message">Mobile Field is empty or in incorrect format.</span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-displaypic">Display Picture</label>
															<input type="file" class="full-width has-padding has-border" name="pic" accept="image/jpeg" id="signup-displaypic" type="text"  placeholder="Display Pic">
															<span class="cd-error-message">Error message here!</span>
														</p>

														<p class="fieldset">
															<input type="checkbox" id="accept-terms">
															<label for="accept-terms">I agree to the Terms and Conditions</label>
														</p>

														<p class="fieldset">
															<input type="submit" class="full-width has-padding" value="Create account">
														</p>
	 										<?php echo form_close(); ?>

									<!-- <a href="#0" class="cd-close-form">Close</a> -->
									</div> <!-- cd-signup -->

									<div id="cd-reset-password"> <!-- reset password form -->
											<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>
											<form class="cd-form">
													<p class="fieldset">
												  	<label class="image-replace cd-email" for="reset-email">E-mail</label>
														<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
														<span class="cd-error-message">Error message here!</span>
													</p>

													<p class="fieldset">
														<input class="full-width has-padding" type="submit" value="Reset password">
													</p>
											</form>

											<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
									</div> <!-- cd-reset-password -->
									<a href="#0" class="cd-close-form">Close</a>
							</div> <!-- cd-user-modal-container -->
					</div> <!-- cd-user-modal -->
	</body>
</html>
