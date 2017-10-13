<?php $success = true;?>
    <div class="form-group">
      <div class="col-sm-12">
          <h4 class="fieldset-header">PROFESSIONAL IDENTIFICATION <span class="req"></span></h4>
         <hr class="halfLine">
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="fname">First Name 
            <span  class="req">*</span> 
            <span class="details">As per your Passport/ID</span>
        </label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="fname" id="fname" placeholder="EnterFirst Name"  value="<?php if($success==false) echo @$_POST['fname'] ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="lname">Last Name  
          <span  class="req">*</span> 
          <span class="details">As per your Passport/ID</span>
        </label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name"  value="<?php if($success==false) echo @$_POST['lname'] ?>" required>
      </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="fname">Company Name  
        <span  class="req">*</span> 
    </label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="company" id="company" placeholder="Enter Company Name" value="<?php if($success==false) echo @$_POST['company'] ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="title">Job Title
        <span  class="req">*</span> 
     </label>
      <div class="col-sm-9">
          <div class="row">
              <div class="col-sm-6">
                <select name="jobtitle" id="e2" class="form-control bordered" onchange="checkFieldToDisable(this.value,'jobtitle1');">
                    <option value="000" selected="selected"> [choose yours] </option>
                    <option value="Ambassador">Ambassador</option>
                    <option value="Associate Director">Associate Director</option>
                    <option value="Board Chairman">Board Chairman</option>
                    <option value="Business Analyst">Business Analyst</option>
                    <option value="Chairman / Executive Chairman ">Chairman / Executive Chairman</option>
                    <option value="Chief Executive Officer (CEO)">Chief Executive Officer (CEO)</option>
                    <option value="Chief Financial Officer (CFO)">Chief Financial Officer (CFO)</option>
                    <option value="Chief Information Officer (CIO)">Chief Information Officer (CIO)</option>
                    <option value="Chief Innovator Officer (CIO)">Chief Innovator Officer (CIO)</option>
                    <option value="Chief Investment Officer	">Chief Investment Officer</option>
                    <option value="Chief Marketing Officer (CMO)">Chief Marketing Officer (CMO)</option>
                    <option value="Chief of Staff">Chief of Staff</option>
                    <option value="Chief Operating Officer (COO)">Chief Operating Officer (COO)</option>
                    <option value="Chief Technology Officer">Chief Technology Officer</option>
                    <option value="Co-Founder">Co-Founder</option>
                    <option value="Commissioner ">Commissioner</option>
                    <option value="Consultant / Freelancer ">Consultant / Freelancer</option>
                    <option value="Coordinator">Coordinator</option>
                    <option value="Country Manager">Country Manager</option>
                    <option value="Creative Director">Creative Director</option>
                    <option value="Deputy CEO">Deputy CEO</option>
                    <option value="Deputy Director">Deputy Director</option>
                    <option value="Director">Director</option>
                    <option value="Director of Operations">Director of Operations</option>
                    <option value="Engineer">Engineer</option>
                    <option value="Entrepreneur">Entrepreneur</option>
                    <option value="Executive Director">Executive Director</option>
                    <option value="Executive President ">Executive President</option>
                    <option value="Executive Secretary">Executive Secretary</option>
                    <option value="Financial Advisor / Financial Specialist">Financial Advisor / Financial Specialist</option>
                    <option value="Founder">Founder</option>
                    <option value="General Manager">General Manager</option>
                    <option value="GIS Specialist ">GIS Specialist</option>
                    <option value="Hon. Consul ">Hon. Consul</option>
                    <option value="ICT Advisor">ICT Advisor</option>
                    <option value="ICT Officer">ICT Officer</option>
                    <option value="ICT Specialist">ICT Specialist</option>
                    <option value="ICT Technician">ICT Technician</option>
                    <option value="Innovation Manager">Innovation Manager</option>
                    <option value="Innovator">Innovator</option>
                    <option value="Legal Advisor ">Legal Advisor</option>
                    <option value="Legal Representative">Legal Representative</option>
                    <option value="Manager">Manager</option>
                    <option value="Managing Director">Managing Director</option>
                    <option value="Managing Partner">Managing Partner</option>
                    <option value="Marketing Director">Marketing Director</option>
                    <option value="Marketing Executive ">Marketing Executive</option>
                    <option value="Member of Parliament">Member of Parliament</option>
                    <option value="Minister / Cabinet Secretary">Minister / Cabinet Secretary</option>
                    <option value="National Coordinator">National Coordinator</option>
                    <option value="Permanent Secretary">Permanent Secretary</option>
                    <option value="President">President</option>
                    <option value="Principal">Principal</option>
                    <option value="Professor/Lecturer ">Professor/Lecturer</option>
                    <option value="Program Analyst">Program Analyst</option>
                    <option value="Program Director">Program Director</option>
                    <option value="Public Relations Manager">Public Relations Manager</option>
                    <option value="Regional Director">Regional Director</option>
                    <option value="Researcher / Research Assistant ">Researcher / Research Assistant</option>
                    <option value="Sales Executive">Sales Executive</option>
                    <option value="Secretary General ">Secretary General</option>
                    <option value="Senior Associate">Senior Associate</option>
                    <option value="Senior Executive Vice President">Senior Executive Vice President</option>
                    <option value="Senior Vice President">Senior Vice President</option>
                    <option value="Software Developer">Software Developer</option>
                    <option value="Student">Student</option>
                    <option value="Team Leader ">Team Leader</option>
                    <option value="Technical Advisor">Technical Advisor</option>
                    <option value="Technical Director">Technical Director</option>
                    <option value="Technical Manager">Technical Manager</option>
                    <option value="Technology Director ">Technology Director</option>
                    <option value="Vice Chancellor ">Vice Chancellor</option>
                    <option value="Vice President ">Vice President</option>
                    <option value="Web Developer">Web Developer</option>
                    <option value="Other">Other </option>
                </select>
              </div>
              <div class="col-sm-6">
                   <input type="text" class="form-control" name="jobtitle1" id="jobtitle1" placeholder="Please specify" value="<?php if($success==false) echo @$_POST['jobtitle1'] ?>" disabled="disabled">
              </div>
          </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="tel1">Telephone
        <span  class="req">*</span> 
        </label>
      <div class="col-sm-9">
            <input type="tel" class="form-control" name="tel1" id="tel1" style="width: 200px; float: left" required="required">
            <br>
            <input type="tel" class="form-control" name="tel2" id="tel2"  style="width: 200px;">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="email">Email
        <span  class="req">*</span> 
        </label>
      <div class="col-sm-9">
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php if($success==false) echo @$_POST['email'] ?>" maxlength="100" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="website">Website:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="website" id="website" placeholder="Enter Website"  value="<?php echo @$_POST['website'] ?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
          <h4 class="fieldset-header">IDENTIFICATION <span class="req"></span></h4>
         <hr class="halfLine">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="location">Country of residence
        <span  class="req">*</span> 
        </label>
      <div class="col-sm-9">
          <div class="row">
              <div class="col-sm-6 col">
                  <select class="countrySelect2 js-states form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="residence-country" id="residence-country" placeholder="Country of residence">
                    <?php 
                    $countryArray =Country::getArrays();
                    foreach($countryArray as $country_ID=>$country_data){
                        $country_data = (object)$country_data;?>
                        <option value="<?php echo $country_ID+1; ?>" id="<?php echo $country_data->icon; ?>" <?php if($country_data->code == "RW"){ echo 'selected';}?>><span></span><?php echo $country_data->name; ?></option>
                        <?php
                    }?>
                </select>
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="address-city" id="address-city" placeholder="City of residence" value="<?php if($success==false) echo @$_POST['address-city'];?>" required>
              </div>
          </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="location">CitizenShip
        <span  class="req">*</span> 
        </label>
      <div class="col-sm-9 col">
        <select class="countrySelect2 js-states form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="citizenship-country" id="citizenship-country" placeholder="Citizenship Country">
            <?php 
            $countryArray =Country::getArrays();
            foreach($countryArray as $country_ID=>$country_data){
                $country_data = (object)$country_data;?>
                <option value="<?php echo $country_ID+1; ?>" id="<?php echo $country_data->icon; ?>" <?php if($country_data->code == "RW"){ echo 'selected';}?>><span></span><?php echo $country_data->name; ?></option>
                <?php
            }?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="location">Document
        <span  class="req">*</span> 
        </label>
      <div class="col-sm-9">
          <div class="row">
              <div class="col-sm-6">
                  <select name="passport" class="form-control bordered">
                    <option value="000" selected="selected"> [Please choose one] </option>
                    <option value="Passport">Passport</option>
                    <option value="ID card" id="notrwanda">ID card</option>
                </select>
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="passport-number" id="town" placeholder="Document number"  value="<?php if($success==false) echo @$_POST['passport-number'] ?>" required>
              </div>
          </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
          <h4 class="fieldset-header">PARTICIPANT <span class="req"></span></h4>
         <hr class="halfLine">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="location">Category 
        <span  class="req">*</span> 
        </label>
      <div class="col-sm-9">
          <div class="row">
              <div class="col-sm-12">
                   <select id="category-select" name="pass" class="form-control bordered" onchange="checkParticipantToDisable(this.value);" required>
                        <option value="000" selected="selected"> [choose yours] </option>
                        <option value="Delegate">Delegate</option>
                        <option value="Exhibitor">Exhibitor</option>
                        <option value="Sponsor">Sponsor</option>
                        <option value="Media">Media</option>
                    </select>
              </div>
          </div>
      </div>
    </div>
    <div id="dynamic_delegate" class="dynamic_form">
        <div class="form-group">
          <div class="col-sm-12">
              <h4 class="fieldset-header">PASS <span class="req"></span></h4>
             <hr class="halfLine">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="location">Type of Pass 
            <span  class="req">*</span> 
            </label>
          <div class="col-sm-9">
              <div class="row">
                  <div class="col-sm-6">
                       <select name="pass" class="form-control bordered" onchange="checkPassToDisable(this.value,'payment-type');">
                            <option value="000" selected="selected"> [choose yours] </option>
                            <option value="Conference-Pass">Conference pass (Free)</option>
                            <option value="Golden pass">Golden pass (500$)</option> 
                        </select>
                  </div>
                  <div class="col-sm-6">
                    <select name="payment-type" id="payment-type" class="form-control bordered">
                        <option value="000"> [choose yours] </option>
                         <option value="Debit/Credit Card (Online)"> Debit/Credit Card (Online)</option>
                        <option value="MobileMoney (local residents only)">MobileMoney (local residents only)</option>
                        <option value="On Site" selected="selected">On Site</option>
                    </select>
                  </div>
              </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
              <h4 class="fieldset-header">GOAL <span class="req"></span></h4>
             <hr class="halfLine">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="message">Tell us abit about what you would like your interest:</label>
          <div class="col-sm-9">
            <textarea name="message" type="text" rows="6" cols="10" class="form-control" id="message" maxlength="2000"> <?php if($success==false) echo @$_POST['message'] ?></textarea>
          </div>
        </div>
    </div>

<script>
  function checkFieldToDisable(value,field1){
    if(value=="Other"){
        $('#'+field1).prop('disabled', false);
        var input =$('#'+field1);
        input[0].selectionStart = input[0].selectionEnd = input.val().length;
    }else{
        $('#'+field1).prop('disabled', true);
    }
  }
    
    $("#tel1").intlTelInput({
        utilsScript: "<?=DN?>/plugins/intlTelInput/build/js/utils.js" 
    });
    $("#tel2").intlTelInput({
        utilsScript: "<?=DN?>/plugins/intlTelInput/build/js/utils.js" 
    });


    
    // Country flags
$(document).ready(function(){
	//var DN = $('#appdata').data('dn');
	$('.countrySelect2').select2();
	function formatCountry (country) {
		if (!country.id) { return country.text; }
		var $country = $(
			'<span><img src="<?=DN?>/plugins/country_flags/16/' + country.element.id.toLowerCase() + '" class="img-flag" /> ' + country.text + '</span>'
		);
		return $country;
	};

	$(".countrySelect2").select2({
		templateResult: formatCountry,
		templateSelection: formatCountry
	});
});
</script>