function validateText(val) { // passing the form object
  if (val==null || val.trim()=="") { 
    return false; // cancel submission
  }
  return true; // allow submit
}

function emptyText(val) { // passing the form object
  if (val==null || val.trim()=="") { 
    return false; // cancel submission
  }
  return true; // allow submit
}

var animating = false;
function slideNext(trigger){		
	//jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches

	$sub_level = 1;
	var error = false;
	//if(animating) return false;
	animating = true;
	
	// current_fs = $(trigerf).parent();
	// next_fs = $(trigerf).parent().
	current_fs = $($(trigger).data('currentfs'));
	next_fs = $($(trigger).data('nextfs'));
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
				'transform': 'scale('+scale+')',
				'position': 'absolute'
			  });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 1000, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
}

function slideBack(trigger){	
	if(animating) return false;
	animating = true;
	
	current_fs = $($(trigger).data('currentfs'));
	previous_fs = $($(trigger).data('previousfs'));

	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity,'height': 'auto'});
		}, 
		duration: 800, 
		complete: function(){
			previous_fs.css({'position': 'relative'});
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
}


$(document).ready(function(){
	$(".previous").click(function(){
		if(this.id=="backToPdataBtn"){
			slideBack("#"+this.id)
		}
	});
});

$(document).ready(function(){
	$("#signup_form .previous").click(function(){
		if(this.id=="backToPdataBtn"){
			slideBack("#"+this.id)
		}
	});
});
$(document).ready(function(){
	$("#signup_form .submit").click(function(){
		if(this.id=="backToPdataBtn"){
			slideBack("#"+this.id)
		}
	});
});
$(document).ready(function(){
	$('.lc_store').on('keyup change', function(e) {
		if($('.lc_store').hasClass('error')){
			if(this.id){
				$('#'+this.id).removeClass('error');
			}
		}
		if (localStorage) {
			var el = this.id;
			var value = $('#'+el).val();
			localStorage.setItem(el,value);
		}
	});
});

$(document).ready(function(){
	if (localStorage) {
		$('.lc_store').each(function(index,el){
			var el = el.id;
			$('#'+el).val(localStorage.getItem(el));
		});
	}
});

// Validate fieldset 
$(document).ready(function(){
	$('.validation_btn').click(function(){
		var errorFound = false;
		var valid_btn_id = '#'+this.id;
		var fieldset_el = $(valid_btn_id).data('fieldset');
		$(fieldset_el+' .data_in.required').each(function(index,el){
			if(el.id){
				var el_id = '#'+el.id;
				
				if(emptyText($(el_id).val())==false){
					errorFound = true;
				}
				if(!$(el_id).hasClass('error') && emptyText($(el_id).val())==false){
					$(el_id).addClass('error');
				}
			}
		});
		
		if(errorFound==false && valid_btn_id=="#signupPDataValidBtn"){
			slideNext(valid_btn_id);
		}
		if(errorFound==false && (valid_btn_id=="#signupValidBtn" || valid_btn_id=="#loginValidBtn" || valid_btn_id=="#recoverValidBtn" || valid_btn_id=="#resetPasswordValidBtn")){
			slideNext(valid_btn_id);
			return true;
		}
        if(errorFound==true && valid_btn_id=="#resetPasswordValidBtn"){
            
			var reset_password = $('#reset-password').val();
			$("#error_message #error_lo").html('<h6 class="st-subtitle error bg-danger "><span class="">Please enter your new password.</span></h6>');
			$('#error_message #no_visible').css({"display":"none"});
			$('#error_message').css({"display":"block","padding":"0"});
		}
        if(errorFound==true && valid_btn_id=="#recoverValidBtn"){
            
			var recover_email = $('#recover-email').val();
			$("#error_message #error_lo").html('<h6 class="st-subtitle error bg-danger "><span class="">Username not found. For any inquires, please contact the administrator.</span></h6>');
			$('#error_message #no_visible').css({"display":"none"});
			$('#error_message').css({"display":"block","padding":"0"});
		}
        if(errorFound==true && valid_btn_id=="#loginValidBtn"){
			var login_username = $('#login_username').val();
			var login_password = $('#login_password').val();
			// if(login_username.trim()==""){
			// 	$(#error_message).text("Username cannot be empty");
			// }
			$("#error_message #error_lo").html('<h6 class="st-subtitle error bg-danger "><span class="">Username or Password don\'t match, Please retry.</span></h6>');
			$('#error_message #no_visible').css({"display":"none"});
			$('#error_message').css({"display":"block","padding":"0"});
		}
		if(errorFound==true && (valid_btn_id=="#signupPDataValidBtn")){
			var fname = $('#signup_form #signup_firstname').val();
   			var letters = /^[A-Za-z]+$/;  
			var error = false;
			if(!validateText(fname)){
				$("#handerror_firstname").text("Company name can not be empty.");
				error = true;
			}else if(!(fname.match(letters))){
				$("#handerror_firstname").text("Only letters.");
				error = true;
			}else{
				$("#handerror_firstname").text("");
			}
			
			var lname = $('#signup_form #signup_lastname').val();
			var error = false;
			if(!validateText(lname)){
				$("#handerror_lastname").text("Your name can not be empty.");
				error = true;
			}else if(!(lname.match(letters))){
				$("#handerror_lastname").text("Only letters.");
				error = true;
			}else{
				$("#handerror_lastname").text("");
			}
		}
		if(errorFound==true && (valid_btn_id=="#signupValidBtn")){
			var testemail;
			var check_email=$('#signup_email').val();
			var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
			if (filter.test(check_email)){
				document.getElementById("emailerror").innerHTML = ("");
				testemail=true
			}else if(check_email==""){
				document.getElementById("emailerror").innerHTML = ("Field can not be empty.");
				testemail=false
			}else{
				//alert("Please input a valid email address!")
				document.getElementById("emailerror").innerHTML = ("Please enter a correct email address.");
				testemail=false
			}

			var signup_password = $('#signup_form #signup_password').val();
			var signup_repassword =  $('#signup_form #signup_repassword').val();
			var check_pass = false;
			//alert(signup_password + " "+ signup_repassword);

			if(signup_password==""){
				$("#pass_error").text("Field can not be empty.");
				check_pass=true;
			}else if(!(/^[A-Za-z0-9\d=!\-@._*]*$/.test(signup_password) // consists of only these
					&& /[a-z]/.test(signup_password) // has a lowercase letter
					&& /[A-Z]/.test(signup_password) // has a lowercase letter
					&& /\d/.test(signup_password) // has a digit
					)){
				$("#pass_error").text("Password must contain a uppercase, lowercase and digit.");

				check_pass = true;
			}else if((/^[A-Za-z0-9\d=!\-@._*]*$/.test(signup_password) // consists of only these
					&& /[a-z]/.test(signup_password) // has a lowercase letter
					&& /[A-Z]/.test(signup_password) // has a lowercase letter
					&& /\d/.test(signup_password) // has a digit
					)){
				$("#pass_error").text("");

				check_pass = false;
			}else {
				$("#repass_error").text("");
				check_pass=false;
			}
			
			var check_pass = false;
			//alert(signup_password + " "+ signup_repassword);

			if(signup_repassword==""){
				$("#repass_error").text("Field can not be empty.");
				check_pass=true
			}else if(!(/^[A-Za-z0-9\d=!\-@._*]*$/.test(signup_repassword) // consists of only these
					&& /[a-z]/.test(signup_repassword) // has a lowercase letter
					&& /[A-Z]/.test(signup_repassword) // has a lowercase letter
					&& /\d/.test(signup_repassword) // has a digit
					)){
				//alert("no");
				$("#repass_error").text("Password must contain a uppercase, lowercase and digit.");

				check_pass = true;
			}else if((signup_password) != (signup_repassword)){
				$("#repass_error").text("Password not match");

			}else{
				$("#repass_error").text("");
			}
		}
		return false;
	});
});

// Reset Errors signs
$(document).ready(function(){
	$('.data_in.required').keyup(function(){
		if(this.id){
			var el_id = '#'+this.id;
			if($(el_id).hasClass('error')){
				$(el_id).removeClass('error');
			}
		}
	});
});

// Country flags
$(document).ready(function(){
    if($('#signup_country').length >0 ){
        var DN = $('#appdata').data('dn');
        $('#signup_country').select2();
        function formatCountry (country) {
            if (!country.id) { return country.text; }
            var $country = $(
                '<span><img src="'+DN+'/plugins/country_flags/16/' + country.element.id.toLowerCase() + '" class="img-flag" /> ' + country.text + '</span>'
            );
            return $country;
        };

        $(".countrySelect").select2({
            templateResult: formatCountry,
            templateSelection: formatCountry
        });
    }
});




$(document).ready(function(){
	$('#signup_firstname').on('keyup', function() {
		var fname = $('#signup_form #signup_firstname').val();
   			var letters = /^[A-Za-z]+$/;  
			var error = false;
			if(!validateText(fname)){
				$("#handerror_firstname").text("Company name can not be empty.");
				error = true;
			}else if(!(fname.match(letters))){
				$("#handerror_firstname").text("Only letters.");
				error = true;
			}else{
				$("#handerror_firstname").text("");
			}
			if(error == true){
				//alert("Please feel the form with your Companyname and Yourname");
				return false;
			}
    });
	$('#signup_lastname').on('keyup', function() {
			var lname = $('#signup_form #signup_lastname').val();
   			var letters = /^[A-Za-z]+$/;  
			var error = false;
			if(!validateText(lname)){
				$("#handerror_lastname").text("Your name can not be empty.");
				error = true;
			}else if(!(lname.match(letters))){
				$("#handerror_lastname").text("Only letters.");
				error = true;
			}else{
				$("#handerror_lastname").text("");
			}
			if(error == true){
				//alert("Please feel the form with your Companyname and Yourname");
				return false;
			}
    });
	$('#signup_email').on('keyup', function() {
		var testemail;
		var check_email=$('#signup_email').val();
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
		if (filter.test(check_email)){
			document.getElementById("emailerror").innerHTML = ("");
			testemail=true
		}else if(check_email==""){
			document.getElementById("emailerror").innerHTML = ("Field must not empty.");
			testemail=false
		}else{
			//alert("Please input a valid email address!")
			document.getElementById("emailerror").innerHTML = ("Please enter a correct email address.");
			testemail=false
		}
		if(testemail != true){
			return false;
		}
    });
	$('#signup_password').on('keyup', function() {

		var signup_password = $('#signup_form #signup_password').val();
		var signup_repassword =  $('#signup_form #signup_repassword').val();
		var check_pass = false;
		//alert(signup_password + " "+ signup_repassword);

		if(signup_password==""){
			$("#pass_error").text("Field must not empty.");
			//document.getElementById("pass_error").innerHTML = ("Field must not empty.");
			check_pass=true;
		}else if(!(/^[A-Za-z0-9\d=!\-@._*]*$/.test(signup_password) // consists of only these
				&& /[a-z]/.test(signup_password) // has a lowercase letter
				&& /[A-Z]/.test(signup_password) // has a lowercase letter
				&& /\d/.test(signup_password) // has a digit
				)){
			$("#pass_error").text("Password must contain a uppercase, lowercase and digit.");

			check_pass = true;
		}else if((/^[A-Za-z0-9\d=!\-@._*]*$/.test(signup_password) // consists of only these
				&& /[a-z]/.test(signup_password) // has a lowercase letter
				&& /[A-Z]/.test(signup_password) // has a lowercase letter
				&& /\d/.test(signup_password) // has a digit
				)){
			$("#pass_error").text("");

			check_pass = false;
		}else {
			$("#repass_error").text("");
			check_pass=false;
		}
    });
	$('#signup_repassword').on('keyup', function() {

		var signup_password = $('#signup_form #signup_password').val();
		var signup_repassword =  $('#signup_form #signup_repassword').val();
		var check_pass = false;
		//alert(signup_password + " "+ signup_repassword);

		if(signup_repassword==""){
			$("#repass_error").text("Field must not empty.");
			//document.getElementById("repass_error").innerHTML = ("Field must not empty.");
			check_pass=true
		}else if(!(/^[A-Za-z0-9\d=!\-@._*]*$/.test(signup_repassword) // consists of only these
				&& /[a-z]/.test(signup_repassword) // has a lowercase letter
				&& /[A-Z]/.test(signup_repassword) // has a lowercase letter
				&& /\d/.test(signup_repassword) // has a digit
				)){
			//alert("no");
			$("#repass_error").text("Password must contain a uppercase, lowercase and digit.");

			check_pass = true;
		}else if((signup_password) != (signup_repassword)){
			$("#repass_error").text("Password not match");

		}else{
			$("#repass_error").text("");
		}
    });
});
