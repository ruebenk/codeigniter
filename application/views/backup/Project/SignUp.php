<html >
	<head>
       		<title>User Details</title>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/Validate.js"></script>
    		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
	</head>
	<body>
		<form name="myForm" >
			<div>
				<br>
				<center><img src="<?php echo base_url();?>assets/img/QuoPro Logo.gif" width="200" height="200"></center>
				<br>
			    	<font size="6px" color="#2A8CA4">User Details</font>
			</div>
			<br>
		  	<div>
		    		<input type="text" name="name" required/>
		   		<label>Name</label>
		  	</div>
			<br>
		  	<div>
		    		<input type="text" name="email" required/>
		    		<label>Email</label>
		 	</div>
			<br>
		  	<div>
		  		<input type="text" name="ph" required/>
		    		<label>Mobile</label>
		  	</div>
			<br>
		  	<div>
		    		<input type="password" name="pwd" required/>
		    		<label>Password</label>
		  	</div>
			<br>
			<div>
		    		<input type="password" name ="cpwd" required/>
		    		<label>Confirm Password</label>
		  	</div>
			<br>	

			<div class="upload-file-container">
				<label>Display Picture</label>
			    	<input type="file">
			</div>			
					    		
			<center><button onclick="return validateForm()">Submit</button></center>
	  	</form>

  	</body>
</html>
