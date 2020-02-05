function formValidation()
{

	var name 	= document.signup.full_name.value;
	var email 	= document.signup.emailid.value;
	var pwid 	= document.signup.password.value;
	var cpwid 	= document.signup.cpassword.value;
	var std_dob = document.signup.dob.value;
	var contact = document.signup.contactnum.value;
	var contact2 = document.signup.contactnum2.value;
	var url 	 = document.signup.link.value;

	var file 		= document.getElementById('file_nm').files[0];
	var fileInput 	= document.getElementById('file_nm');
	var filePath 	= fileInput.value;
	var edu = document.signup.education.value;
	var add = document.signup.address.value;
	var abt = document.signup.about.value;

	var fnm_vali = /^[A-Za-z ]+$/;
	var email_vali = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var contact_vali = /^[0-9]+$/;
	var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
	var url_vali = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/g;
	
	if(name=="" || name==null ){
		full_name.focus();
		// $(document.signup.full_name).addClass('form-error').parent().append('<small class="error">Full Name is Required</small>');
		$(document.signup.full_name).addClass('form-error').siblings('small').html('Full Name is Required');
		return false;
	}else if(!fnm_vali.test(name)){
		// $(document.signup.full_name).addClass('form-error').parent().append('<small class="error">Full Name should be string or valid</small>');
		full_name.focus();
		$(document.signup.full_name).addClass('form-error').siblings('small').html('Full Name should be string or valid');
		return false;
	}else{
		$(document.signup.full_name).removeClass('form-error').siblings('small').html('');
	}
	
	if(email=="" || email==null){
		emailid.focus();
		$(document.signup.emailid).addClass('form-error').parent().siblings('small').addClass('error').html('Email is Required');
		return false;
	}else if(!email_vali.test(email)){
		emailid.focus;
		$(document.signup.emailid).addClass('form-error').parent().siblings('small').addClass('error').html('Please provide a valid email address');
		return false;
	}else{
		$(document.signup.emailid).removeClass('form-error').parent().siblings('small').removeClass('error').html('Your Email Id is being used for ensuring the security of your account, authorization and access recovery. ');
	}

	if(pwid=="" || pwid==null){
		password.focus();
		$(document.signup.password).addClass('form-error').parent().siblings('small').addClass('error').html('Password is Required');
		return false;
	}else if(pwid.length < 6 && pwid.length > 15){
		password.focus();
		$(document.signup.password).addClass('form-error').parent().siblings('small').addClass('error').html('Password is Length should be 6 > and > 15 ');
		return false;
	}else{
		$(document.signup.password).removeClass('form-error').parent().siblings('small').addClass('error').html('');
	}

	if(cpwid=="" || cpwid==null){
		cpassword.focus();
		$(document.signup.cpassword).addClass('form-error').parent().siblings('small').addClass('error').html('Confirm Password is Required');
		return false;
	}else if(pwid!==cpwid){
		cpassword.focus;
		$(document.signup.cpassword).addClass('form-error').parent().siblings('small').addClass('error').html('confirm password should be matched');
		return false;
	}else{
		$(document.signup.cpassword).removeClass('form-error').parent().siblings('small').addClass('error').html('');
	}
	
	/*var current_dt = new Date();
	var before_dt = new Date();
	before_dt.setFullYear(2011);
	var stddob = new Date(std_dob)
	var std_age = current_dt-stddob;

	if(std_dob=="" || std_dob==null ){
		dob.focus();
		$(document.signup.dob).addClass('form-error').parent().siblings('small').addClass('error').html('Date Of Birth is Required');
		return false;
	}else if(std_age > before_dt.getTime()){
		// alert('Student is Above 18+');
		dob.focus();
		$(document.signup.dob).addClass('form-error').parent().siblings('small').addClass('error').html('student age Should be Above 18+ ');
		return false;
	}else{
		$(document.signup.dob).removeClass('form-error').parent().siblings('small').addClass('error').html('');
	}*/
	
	
	if(contact=="" && contact==null){
		contactnum.focus();
		$(document.signup.contactnum).addClass('form-error').parent().siblings('small').addClass('error').html('Contact is Required');
		return false;
	}else if(!contact_vali.test(contact)){
		contactnum.focus();
		$(document.signup.contactnum).addClass('form-error').parent().siblings('small').addClass('error').html('Contact number should be valid');
		return false;
	}else if(contact.length != 10){
		contactnum.focus();
		$(document.signup.contactnum).addClass('form-error').parent().siblings('small').addClass('error').html('Contact number should be 10 digit');
		return false;
	}else{
		$(document.signup.contactnum).removeClass('form-error').parent().siblings('small').addClass('error').html('');
	}
	
	if( contact2 != "" && contact2 != null ){
		if(!contact_vali.test(contact2)){
			contactnum2.focus();
			$(document.signup.contactnum2).addClass('form-error').parent().siblings('small').addClass('error').html('Alternate number should be valid');
			return false;
		}else if(contact2.length != 10){
			contactnum2.focus();
			$(document.signup.contactnum2).addClass('form-error').parent().siblings('small').addClass('error').html('Alternate number should be 10 digit');
			return false;
		}else{
			$(document.signup.contactnum2).removeClass('form-error').parent().siblings('small').addClass('error').html('');
		}
	}

	if( url != "" || url != null ){
		if(!url_vali.test(url)){
			link.focus();
			$(document.signup.link).addClass('form-error').parent().siblings('small').addClass('error').html('URL should be valid');
			return false;
		}else{
			$(document.signup.link).removeClass('form-error').parent().siblings('small').addClass('error').html('');
		}
	}


	if(fileInput!=''){
		if(!allowedExtensions.exec(filePath)){
			fileInput.value = '';
			file_nm.focus();
			$(document.signup.file_nm).addClass('form-error').parent().siblings('small').addClass('error').html('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
			return false;
		}
		
		if(fileInput.files[0].size >  2048576){  // validation according to file size 2MB
			$(document.signup.file_nm).addClass('form-error').parent().siblings('small').addClass('error').html('Image Size should be less then 2MB ');
			file_nm.focus();
			fileInput.value = '';
			return false;
        }
	}
	
	if(education==null || education==""){
		$(document.signup.education).addClass('form-error').parent().siblings('small').addClass('error').html('Education is Required');
		education.focus();
		return false;		
	}

	
	if(add==null || add==""){
		$(document.signup.address).addClass('form-error').parent().siblings('small').addClass('error').html('Address is Required');
		address.focus();
		return false;		
	}else{
		$(document.signup.address).removeClass('form-error').parent().siblings('small').addClass('error').html('');
	}
	
	if(abt==null || abt==""){
		$(document.signup.about).addClass('form-error').parent().siblings('small').addClass('error').html('About is Required');
		about.focus();
		return false;		
	}else{
		$(document.signup.about).removeClass('form-error').parent().siblings('small').addClass('error').html('');
	}
}