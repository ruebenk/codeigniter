

<html>
	<head>
					<link rel="icon" type="image/x-icon" href="http://www.quopro.com/assets/img/favicon.ico" />
					<title>QuoPro</title>
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

					<script src="http://www.quopro.com/assets/js/index.js"></script>
					<link rel="stylesheet" href="http://www.quopro.com/assets/css/style.css">
	</head>
	<body>
					<header role="banner">

							<div id="cd-logo">
									<img src="<?php echo base_url();?>assets/img/QuoPro Logo.gif" width = "90" height="90" alt="Logo">
							</div>
							<div class="container">
								<div id="search">

											<input type="search" name="search" placeholder="Search or Post a Question.">
											<input type="submit" value="Search" class="button">
											<input type="submit" value="Post a Question" class="button" id="p_q">

								</div> <!-- end search -->
						  </div> <!-- end container -->
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
												<?php $attributes = array("class" => "cd-form");
												echo form_open_multipart("Home/login", $attributes);?>
														<p class="fieldset">
															<label class="image-replace cd-email" for="signin-email">E-mail</label>
															<input class="full-width has-padding has-border" name="Email" id="signin-email" type="email" placeholder="E-mail" value="<?php echo set_value('Email'); ?>">
															<span class="cd-error-message" id="sie01"></span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signin-password">Password</label>
															<input class="full-width has-padding has-border" name="Password" id="signin-password" type="password"  placeholder="Password" value="<?php echo set_value('Password'); ?>">
															<span class="cd-error-message" id="sie02"></span>
															<a href="#0" class="hide-password" id="sihp1c">Show</a>
														</p>

														<p class="fieldset">
														<input type="checkbox" id="remember-me" checked>
														<label for="remember-me">Remember me</label>
														</p>

														<p class="fieldset">
														<input class="full-width" type="submit" value="Login">
														</p>
											  <?php echo form_close(); ?>

												<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
												<!-- <a href="#0" class="cd-close-form">Close</a> -->
									</div> <!-- cd-login -->

									<div id="cd-signup"> <!-- sign up form -->
											  <?php $attributes = array("class" => "cd-form");
												echo form_open_multipart("Home/signup", $attributes);?>

														<p class="fieldset">
															<label class="image-replace cd-username" for="signup-username">Name</label>
															<input class="full-width has-padding has-border" name="Name" id="signup-username" type="text" placeholder="Name" value="<?php echo set_value('Name'); ?>">
															<span class="cd-error-message" id="sue01"></span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-email" for="signup-email">E-mail</label>
															<input class="full-width has-padding has-border" name="Email" id="signup-email" type="email" placeholder="E-mail" value="<?php echo set_value('Email'); ?>">
															<span class="cd-error-message" id="sue02"></span>
														</p>


														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-password">Password</label>
															<input class="full-width has-padding has-border" name="Password" id="signup-password" type="password"  placeholder="Password" value="<?php echo set_value('Password'); ?>">
															<span class="cd-error-message" id="sue03"></span>
															<a href="#0" class="hide-password" id="suhp1">Show</a>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-cpassword">Confirm Password</label>
															<input class="full-width has-padding has-border" name="cpassword" id="signup-cpassword" type="password"  placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>">
															<span class="cd-error-message" id="sue04"></span>
															<a href="#0" class="hide-password" id="suhp2">Show</a>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-mobile">Mobile</label>
															<input class="full-width has-padding has-border" name="Mobile" id="signup-mobile" type="text"  placeholder="Mobile No." value="<?php echo set_value('Mobile'); ?>">
															<span class="cd-error-message" id="sue05"></span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-displaypic">Display Picture</label>
															<input type="file" class="full-width has-padding has-border" name="Photo" id="signup-displaypic" placeholder="Display Pic">
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
					<div class="cd-user-modal1"> <!-- this is the entire modal form, including the background -->

							<div class="cd-user-modal-container"> <!-- this is the container wrapper -->

									<ul class="cd-switcher">
										<li><a href="#0">Sign in</a></li>
										<li><a href="#0">New account</a></li>
									</ul>

									<div id="cd-login"> <!-- log in form -->
												<?php $attributes = array("class" => "cd-form");
												echo form_open_multipart("Home/login", $attributes);?>
														<p class="fieldset">
															<label class="image-replace cd-email" for="signin-email">E-mail</label>
															<input class="full-width has-padding has-border" name="Email" id="signin-email" type="email" placeholder="E-mail" value="<?php echo set_value('Email'); ?>">
															<span class="cd-error-message" id="sie01"></span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signin-password">Password</label>
															<input class="full-width has-padding has-border" name="Password" id="signin-password" type="password"  placeholder="Password" value="<?php echo set_value('Password'); ?>">
															<span class="cd-error-message" id="sie02"></span>
															<a href="#0" class="hide-password" id="sihp1c">Show</a>
														</p>

														<p class="fieldset">
														<input type="checkbox" id="remember-me" checked>
														<label for="remember-me">Remember me</label>
														</p>

														<p class="fieldset">
														<input class="full-width" type="submit" value="Login">
														</p>
											  <?php echo form_close(); ?>

												<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
												<!-- <a href="#0" class="cd-close-form">Close</a> -->
									</div> <!-- cd-login -->

									<div id="cd-signup"> <!-- sign up form -->
											  <?php $attributes = array("class" => "cd-form","id"=>"signupform");
												echo form_open_multipart("Home/signup", $attributes);?>

														<p class="fieldset">
															<label class="image-replace cd-username" for="signup-username">Name</label>
															<input class="full-width has-padding has-border" name="Name" id="signup-username" type="text" placeholder="Name" value="<?php echo set_value('Name'); ?>">
															<span class="cd-error-message" id="sue01"></span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-email" for="signup-email">E-mail</label>
															<input class="full-width has-padding has-border" name="Email" id="signup-email" type="email" placeholder="E-mail" value="<?php echo set_value('Email'); ?>">
															<span class="cd-error-message" id="sue02"></span>
														</p>


														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-password">Password</label>
															<input class="full-width has-padding has-border" name="Password" id="signup-password" type="password"  placeholder="Password" value="<?php echo set_value('Password'); ?>">
															<span class="cd-error-message" id="sue03"></span>
															<a href="#0" class="hide-password" id="suhp1">Show</a>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-cpassword">Confirm Password</label>
															<input class="full-width has-padding has-border" name="cpassword" id="signup-cpassword" type="password"  placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>">
															<span class="cd-error-message" id="sue04"></span>
															<a href="#0" class="hide-password" id="suhp2">Show</a>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-mobile">Mobile</label>
															<input class="full-width has-padding has-border" name="Mobile" id="signup-mobile" type="text"  placeholder="Mobile No." value="<?php echo set_value('Mobile'); ?>">
															<span class="cd-error-message" id="sue05"></span>
														</p>

														<p class="fieldset">
															<label class="image-replace cd-password" for="signup-displaypic">Display Picture</label>
															<input type="file" class="full-width has-padding has-border" name="Photo" id="signup-displaypic" placeholder="Display Pic">
															<span class="cd-error-message">Error message here!</span>
														</p>

														<p class="fieldset">
															<input type="checkbox" id="accept-terms">
															<label for="accept-terms">I agree to the Terms and Conditions</label>
														</p>

														<p class="fieldset">
															<input type="submit" class="full-width has-padding" value="Create account" id="submitButton"/>
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
				<table style="width:100%">
				<?php
				foreach($user as $a){
					?>
					 <tr>
						 <td><?php echo $a["Id"];?></td>
             <td><a href="/Home/profileviewload/<?php echo $a["Id"];?>"><?php echo $a["Name"];?></a></td>
					 </tr>
					 <?php }?>
	      </table>
	</body>
</html>
