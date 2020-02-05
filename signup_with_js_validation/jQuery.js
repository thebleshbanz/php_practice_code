jQuery(document).ready(function()
{
	$('#submit').on('click', function() {
		valid = true;   
		var fullname = $('#full_name');
		var email = $('#emailid');
		var pswd = $('#password');
		var cpswd = $('#cpassword');
		var dob = $('#dob');
		
		var name_regex = /^[a-zA-Z ]+$/;
		var email_regex = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		
		if (valid && fullname.val() == '') {
			alert ("please enter your Fullname");
			$("input#full_name").focus();
			valid = false;
		}else if(!fullname.val().match(name_regex) ||  $('#full_name').length == 0 )
		{
			alert("please enter string!!");
			$("input#full_name").focus();
			valid = false;
		}
		
		
		if (valid && email.val() == '') {
			alert ("please enter your Email ID");
			$("input#email").focus();
			valid = false;
		}else if(!email.val().match(email_regex))
		{
			alert("please enter valid Email!!");
			$("input#email").focus();
			valid = false;
		}
		
		if(valid && pswd.val()=='')
		{
			alert("Please Enter password");
			$("input#password").focus();
			valid = false;
		}else if(pswd.val().length < 8)
		{
			alert("Please Enter strong password more then 8 digits");
			$("input#password").focus();
			valid = false;
		}
		
		
		if(valid && cpswd.val()=='')
		{
			alert("Please Enter Confirm password");
			$("input#cpassword").focus();
			valid = false;
		}else if(cpswd.val()!==pswd.val())
		{
			alert("Confirm password should be match..");
			$("input#cpassword").focus();
			valid = false;
		}
		
		//var current_date = $.now
		if(valid && dob.val()=='')
		{
			alert("Please Enter Dath of Birth");
			$("input#dob").focus();
			valid = false;			
		}
		
		return valid;
	});

});