<html>
	<head>
					<link rel="icon" type="image/x-icon" href="http://www.quopro.com/assets/img/favicon.ico" />
					<title>QuoPro</title>
					<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
	</head>
	<body>
					<header role="banner" style="position:fixed; width:100%; height:110px; z-index:10; background:inherit;">

							<div id="cd-logo">
									<a href="http://www.quopro.com"><img src="<?php echo base_url();?>assets/img/QuoPro Logo.gif" width = "90" height="90" alt="Logo"></a>
							</div>
							<div class="container">
								<div id="search">
									     <form method="get" action="/Home/searchques">
											<input type="search" id="searchbar" name="Question" placeholder="Search a Question."  style="position:absolute; top:-20%;">
											<BUTTON name="submit" value="submit" type="submit">
												<img src='http://www.quopro.com/assets/img/search-icon.png'/ style="position:absolute;left:245%; top:-4%; cursor:pointer;">
                      </BUTTON>
										</form>
							  </div>

											<?php if($this->session->userdata('user_id')){ ?>
													<input type="submit" value="Post a Question" class="button" id="p_q" style="position:relative; left:310%;">
											<?php } else{ ?>
												  <input type="submit" value="Post a Question" class="button" id="p_q_not_logged_in" style="position:relative; left:310%;">
											<?php } ?>

								<<!-- end search -->
						  </div> <!-- end container -->
							<nav class="main-nav" >
                  <?php if($this->session->userdata('user_id')){ ?>
                    <ul>
                      <!-- inser more links here	 -->
                      <li><a href="http://www.quopro.com/Home/profileviewload/<?php echo $this->session->userdata('user_id')?> "><img style="position:absolute; top:20%; left:71%; width:60px; height:60px; border-radius: 50%;"src="http://www.quopro.com/uploads/<?php echo $this->session->userdata('pic');?>" /></a></li>
                      <li><a href="http://www.quopro.com/Home/profileviewload/<?php echo $this->session->userdata('user_id')?> " style="color:#8D623D; position:absolute; top:3%; left:76%;"><?php echo $this->session->userdata('name');?></a></li>
                      <li><a class="cd-logout" href="http://www.quopro.com/Home/logout">Logout</a></li>

                    </ul>

                  <?php }else { ?>
                    <ul>
                      <!-- inser more links here	 -->
                      <li><a class="cd-signin" id="cd_signin" href="#0">Sign in</a></li>
                      <li><a class="cd-signup" id="cd_signup" href="#0">Sign up</a></li>

                    </ul>
                  <?php } ?>

							</nav>
							<br><br><br><br><br><br><hr>
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
															<a href="#0" class="hide-password" id="sihp1">Show</a>
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

														</p>

														<p class="fieldset">
															<label for="accept-terms">I agree to the Terms and Conditions</label>
															<input type="checkbox" id="accept-terms">
															<span class="cd-error-message" id="sue06">Error message here!</span>
														</p>
														<br>
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
									<a href="#0" class="cd-close-form"></a>
							</div> <!-- cd-user-modal-container -->
					</div> <!-- cd-user-modal -->
					<div class="post-question-modal"> <!-- this is the entire modal form, including the background -->

							<div class="cd-user-modal-container"> <!-- this is the container wrapper -->

									<div id="post-question">
												<form class="cd-form" id="postQForm">
														<p class="fieldset">
															<input class="full-width has-padding has-border" name="Title" id="pq-title" type="text" placeholder="Title"\>
															<span class="cd-error-message" id="pqe01"></span>
														</p>

														<p class="fieldset">
															<textarea class="full-width has-padding has-border" name="Description" id="pq-description" rows="5" cols="58" placeholder="Description"></textarea>
															<span class="cd-error-message" id="pqe02"></span>
														</p>
														<label for="tag-typer">
															<div id="tags" class="full-width has-padding has-border">
															  <input id="tag-typer" type="text" placeholder="Add a Tag"/>
															</div>
														</label>

														<p class="fieldset">
														<input class="full-width" type="submit" value="Post Question" id="p_q_submit"\>
														</p>
														<p hidden id="tagvalue" ></p>
											  </form>

									</div> <!-- cd-login -->
									<a href="#0" class="cd-close-form"></a>
							</div> <!-- cd-user-modal-container -->
					</div> <!-- post-question-modal	 -->

					<div class="alert-box"> <!-- this is the entire modal form, including the background -->
							<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
									<div id="post-question" style="width:500px; height:120px;">
											<p id="alert" style="position:absolute; left:5%; top:35%; color:#8D623D;"></p>
									</div>
									<a href="#0" class="cd-close-form"></a>
							</div> <!-- cd-user-modal-container -->
					</div> <!-- alertbox	 -->
