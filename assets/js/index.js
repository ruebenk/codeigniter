var tid=0;
var s="";

function chngfollow(a)
{
 var elem = document.getElementById(a);
$.ajax({
    url: 'http://www.quopro.com/Home/followques',
    type: 'POST',
    data:( { qid: a }),
    success: function (data) {
      if (elem.value=="Follow")
        elem.value = "Unfollow";
      else
        elem.value = "Follow";
    },
    error: function () {
        return 0;
    }
});
 return 0;
}

function chngrecans(a)
{
 var elem = document.getElementsByClassName("ans");
alert(a);
$.ajax({
    url: 'http://www.quopro.com/Home/followques',
    type: 'POST',
    data:( { qid: a }),
    success: function (data) {
      if (elem[a-1].value=="Follow") elem[a-1].value = "Unfollow";
          else elem[a-1].value = "Follow";
    },
    error: function () {
        return 0;
    }
});
 return 0;
}

function chngfollowonques(a)
{
 var elem = document.getElementById("ques");
$.ajax({
    url: 'http://www.quopro.com/Home/followques',
    type: 'POST',
    data:( { qid: a }),
    success: function (data) {
      if (elem.value=="Follow")
        elem.value = "Unfollow";
      else
        elem.value = "Follow";
    },
    error: function () {
        return 0;
    }
});
 return 0;
}

function chngfollowontag(a)
{
 var elem = document.getElementById("tag");
alert(a);
$.ajax({
    url: 'http://www.quopro.com//Home/followtag/',
    type: 'POST',
    data:( { tid: a }),
    success: function (data) {
      if (elem.value=="Follow") elem.value = "Unfollow";
          else elem.value = "Follow";
    },
    error: function () {
        return 0;
    }
});
 return 0;
}

function chngfollowonuser(a)
{
 var elem = document.getElementById("user");
alert(a);
$.ajax({
    url: 'http://www.quopro.com//Home/followuser/',
    type: 'POST',
    data:( { uid: a }),
    success: function (data) {
      if (elem.value=="Follow") elem.value = "Unfollow";
          else elem.value = "Follow";
    },
    error: function () {
        return 0;
    }
});
 return 0;
}

function remove()
{
		$form_login.find("#signin-email").next('span').removeClass('is-visible');
		$form_login.find("#signin-password").next('span').removeClass('is-visible');
}

function su_validate(){
  $email = $("#signup-email").val();
  $data = {'Email' : $email};
  $.post('http://www.quopro.com/Home/email_validate',$data,function(res){
	  if(res=="false"){

	  }
	  else{
			event.preventDefault();
			document.getElementById("sue02").innerHTML="Email-ID already exists.";
			$("#signup-email").next('span').addClass('is-visible');
			return false;
	  }
  });
	$.post('http://www.quopro.com/Home/mobile_validate',$data,function(res){
		if(res=="false"){
			$("#signupform").submit();
			$('.cd-user-modal').removeClass('is-visible');
			$('#alert').text("A Verification email has been sent to your email address. Kindly verify your account to login.")
			$('.alert-box').addClass('is-visible');
		}
		else{
			event.preventDefault();
			document.getElementById("sue05").innerHTML="Mobile No. already exists.";
			$("#signup-mobile").next('span').addClass('is-visible');
			return false;
		}
	});
}
function si_validate(){
  $email = $("#signin-email").val();
	$pwd = $("#signin-password").val();
  $data = {'Email' : $email,'Password' : $pwd };
  $.post('http://www.quopro.com/Home/login_validate',$data,function(res){
	  if(res=="emaildoesnotexist"){
			event.preventDefault();
			document.getElementById("sie01").innerHTML="Email-ID does not exist. Please Signup.";
			$("#signin-email").next('span').addClass('is-visible');
			return false;
	  }
		else if(res=="emailisinvalid"){
			event.preventDefault();
			document.getElementById("sie01").innerHTML="Please Verify your Email-ID before login.";
			$("#signin-email").next('span').addClass('is-visible');
			return false;
		}
		else if(res=="invalidpassword")
		{
			event.preventDefault();
			document.getElementById("sie02").innerHTML="Password is Invalid";
			$("#signin-password").next('span').addClass('is-visible');
			return false;
		}
	  else{
			$("#signinform").submit();
			$('.cd-user-modal').removeClass('is-visible');
			$('#alert').text("Logged in Successfully.")
			$('.alert-box').addClass('is-visible');
	  }
  });
}
jQuery(document).ready(function($){
	var $form_modal = $('.cd-user-modal'),
	  $post_question_modal = $('.post-question-modal'),
		$alert_box=$('.alert-box'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_forgot_password = $form_modal.find('#cd-reset-password'),
		$form_modal_tab = $('.cd-switcher'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
		$back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
		$main_nav = $('.main-nav');

	//open modal
	/*$main_nav.on('click', function(event){

		if( $(event.target).is($main_nav) ) {
			// on mobile open the submenu
			$(this).children('ul').toggleClass('is-visible');
		} else {
			// on mobile close submenu
			$main_nav.children('ul').removeClass('is-visible');
			//show modal layer
			$form_modal.addClass('is-visible');
			//show the selected form
			( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
		}

	});*/
  $("#postSubmit").on('click', function(event){
  	event.preventDefault();
  	s=s.substring(0,s.length-1);
  	$data = {'Title' : $("#pq-title").val() , 'Description' : $("#pq-description").val() , 'Tags' : s 	};
  	$.post('http://www.quopro.com/Home/insertques',$data,function(res){
  		if(res=="true"){
  			$('.post-question-modal').removeClass('is-visible');
  			location.reload();
  		}
  	});
  	return false;
  });
	$('#cd_signup').on('click', function(event){
		$form_modal.addClass('is-visible');
		signup_selected();
	});

	$('#cd_signin').on('click', function(event){
		$form_modal.addClass('is-visible');
		login_selected();
	});

	$('#p_q').on('click', function(event){
		  $post_question_modal.addClass('is-visible');
	});

	$('#p_q_not_logged_in').on('click', function(event){
			$form_modal.addClass('is-visible');
			login_selected();
	});


	$("#tag-typer").bind("keypress", function (key)  {
		if (key.keyCode == 13){
		 event.preventDefault();
		 var tag = $(this).val();
			if(tag.length > 0){
				$("<span class='tag' id='"+tid+"'style='display:none'><span class='close'>&times;</span>"+tag+" </span>").insertBefore(this).fadeIn(100);
				s=s+($(this).val());
				s=s+";";
				$("#tagvalue").text(s);
				$(this).val("");
				tid++;
			}
		}
		if (key.keyCode == 8){
		 event.preventDefault();
		 $("#"+tid).remove();
		 if(tid>0)
		 	tid--;
	  }
	});



$("#tags").on("click", ".close", function() {
	$(this).parent("span").fadeOut(100);
});

$(".colors li").click(function() {
	var c = $(this).css("background-color");
	$(".tag").css("background-color",c);
	$("#title").css("color",c);
});

	//close modal
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}
	});

	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
				$post_question_modal.removeClass('is-visible');
				$alert_box.removeClass('is-visible');
	    }
  });
	// close post-question-modal
	$('.post-question-modal').on('click', function(event){
		if( $(event.target).is($post_question_modal) || $(event.target).is('.cd-close-form') ) {
			$post_question_modal.removeClass('is-visible');
		}
	});

	// close alert-box
	$('.alert-box').on('click', function(event){
		if( $(event.target).is($alert_box) || $(event.target).is('.cd-close-form') ) {
			$alert_box.removeClass('is-visible');
		}
	});


	//switch from a tab to another
	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? login_selected() : signup_selected();
	});

	//hide or show password
	$('.hide-password').on('click', function(){
		var $this= $(this);
		var $password_field;
		if($this.attr('id')=='suhp1')
			$password_field = document.getElementById('signup-password');
		else if($this.attr('id')=='suhp2')
			$password_field = document.getElementById('signup-cpassword');
		else if($this.attr('id')=='sihp1')
			$password_field = document.getElementById('signin-password');
 		( 'password' == $($password_field).attr('type') ) ? $($password_field).attr('type', 'text') : $($password_field).attr('type', 'password');
		( 'Hide' == $this.text() ) ? $this.text('Show') : $this.text('Hide');
		//focus and move cursor to the end of input field
		$($password_field).putCursorAtEnd();
	});

  //Signin Field Validations
	var flag=0;
	$('#signin-email').on('blur', function(){
		if(flag==0)
		{
			var emailID =document.getElementById("signin-email").value;
			/*Regular Expression*/
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			 if(emailID==null||emailID==""){
				 event.preventDefault();
				 document.getElementById("sie01").innerHTML="Email-ID field cannot be empty.";
				 $form_login.find("#signin-email").next('span').addClass('is-visible');
				 return false;

			}
			else if(!re.test(emailID)){
				 event.preventDefault();
				 document.getElementById("sie01").innerHTML="Email-ID is in incorrect format.";
				 $form_login.find("#signin-email").next('span').addClass('is-visible');
				 return false;
			}
			else{
				 $form_login.find("#signin-email").next('span').removeClass('is-visible');
				 flag=1;
		  }
		}
	});

	$('#signin-password').on('blur', function(){
  		 if(flag==1){
				 var z = document.getElementById("signin-password").value;
					 if (z == null || z == "") {
						event.preventDefault();
						document.getElementById("sie02").innerHTML="Password field cannot be empty.";
						$form_login.find("#signin-password").next('span').addClass('is-visible');
						return false;
				 }
				 else
						$form_login.find("#signin-password").next('span').removeClass('is-visible');
			}
  });


	//show forgot-password form
	$forgot_password_link.on('click', function(event){
		event.preventDefault();
		forgot_password_selected();
	});

	//back to login from the forgot-password form
	$back_to_login_link.on('click', function(event){
		event.preventDefault();
		login_selected();
	});
  function remove(){
		$form_login.find("#signin-email").next('span').removeClass('is-visible');
		$form_login.find("#signin-password").next('span').removeClass('is-visible');
	}
	function login_selected(){
		remove();
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}

	function signup_selected(){
		remove();
		$form_login.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	}

	function forgot_password_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.addClass('is-selected');
	}

	//REMOVE THIS - it's just to show error messages
	$form_login.find('input[type="submit"]').on('click', function(event){
		var emailID =document.getElementById("signin-email").value;
		/*Regular Expression*/
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		 if(emailID==null||emailID==""){
			 event.preventDefault();
			 document.getElementById("sie01").innerHTML="Email-ID field cannot be empty.";
			 $form_login.find("#signin-email").next('span').addClass('is-visible');
			 return false;

		}
		else if(!re.test(emailID)){
			 event.preventDefault();
			 document.getElementById("sie01").innerHTML="Email-ID is in incorrect format.";
			 $form_login.find("#signin-email").next('span').addClass('is-visible');
			 return false;
		}
		else
			 $form_login.find("#signin-email").next('span').removeClass('is-visible');
		var z = document.getElementById("signin-password").value;
		if (z == null || z == "") {
			 event.preventDefault();
			 document.getElementById("sie02").innerHTML="Password field cannot be empty.";
			 $form_login.find("#signin-password").next('span').addClass('is-visible');
			 return false;
		}
		else
			 $form_login.find("#signin-password").next('span').removeClass('is-visible');
		si_validate();
		return false;
});

	$form_signup.find('input[type="submit"]').on('click', function(event){

			 var x = document.getElementById("signup-username").value;

	     if (x == null || x == ""){
				 	event.preventDefault();
					document.getElementById("sue01").innerHTML="Name field cannot be empty.";
				 	$form_signup.find("#signup-username").next('span').addClass('is-visible');
				 	return false;
	     }
	     else if (!(/^[A-Za-z\s]+$/.test(x))) {
			    event.preventDefault();
					document.getElementById("sue01").innerHTML="Name can contain alphabets only.";
			 	  $form_signup.find("#signup-username").next('span').addClass('is-visible');
			 	  return false;
	     }
			 else
			 	  $form_signup.find("#signup-username").next('span').removeClass('is-visible');

			 var emailID =document.getElementById("signup-email").value;
			 /*Regular Expression*/
			 var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       if(emailID==null||emailID=="")
			 {
				  event.preventDefault();
				  document.getElementById("sue02").innerHTML="Email-ID field cannot be empty.";
				  $form_signup.find("#signup-email").next('span').addClass('is-visible');
				  return false;

			 }
			 else if(!re.test(emailID))
	     {
			 		event.preventDefault();
					document.getElementById("sue02").innerHTML="Email-ID is in incorrect format.";
			 		$form_signup.find("#signup-email").next('span').addClass('is-visible');
			 		return false;
	     }
		   else
			 		$form_signup.find("#signup-email").next('span').removeClass('is-visible');

			 var z = document.getElementById("signup-password").value;
 		   if (z == null || z == "") {
			 		event.preventDefault();
					document.getElementById("sue03").innerHTML="Password field cannot be empty.";
			 		$form_signup.find("#signup-password").next('span').addClass('is-visible');
			 		return false;
	     }
			 else if(z.length < 8){
					event.preventDefault();
					document.getElementById("sue03").innerHTML="Password must contain atleast 8 characters.";
					$form_signup.find("#signup-password").next('span').addClass('is-visible');
					return false;
			 }
			 else
			 		$form_signup.find("#signup-password").next('span').removeClass('is-visible');

			 var y= document.getElementById("signup-cpassword").value;

			 if(z!=y){
			 		event.preventDefault();
					document.getElementById("sue04").innerHTML="Passwords do not match.";
				 	$form_signup.find("#signup-cpassword").next('span').addClass('is-visible');
				 	return false;
			 }
			 else
			 		$form_signup.find("#signup-cpassword").next('span').removeClass('is-visible');

			var x = document.getElementById("signup-mobile").value;

			if (x == null || x == "") {
					event.preventDefault();
					document.getElementById("sue05").innerHTML="Mobile field cannot be empty.";
					$form_signup.find("#signup-mobile").next('span').addClass('is-visible');
					return false;
			}
			else if(x.length<10 || x.length>10){
				  event.preventDefault();
					document.getElementById("sue05").innerHTML="Mobile No. must contain exactly 10 digits";
				  $form_signup.find("#signup-mobile").next('span').addClass('is-visible');
				  return false;
			}
			else if(isNaN(x)||x.indexOf(" ")!=-1)
			{
			   event.preventDefault();
				 document.getElementById("sue05").innerHTML="Mobile No. is in incorrect format.";
				 $form_signup.find("#signup-mobile").next('span').addClass('is-visible');
				 return false;
			}
			var x = document.getElementById("accept-terms");
			if(!x.checked)
			{
				event.preventDefault();
				document.getElementById("sue06").innerHTML="You must agree to the Terms and Conditions";
				$form_signup.find("#accept-terms").next('span').addClass('is-visible');
				return false;
			}
		  su_validate();
			return false;
	});

});


//credits http://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});
};

jQuery('#cody-info ul li').eq(1).on('click', function(){
$('#cody-info').hide();
});
