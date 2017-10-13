<div class="nav_fixedspace"></div>
<div class="guest_room_div">
	<img src="assets/img/home/default1.png" class="img img-responsive">
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-3 col-md-4">
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="signup_form_container">
				<!-- multistep form -->
				<form method="post" id="signup_form">
				  <!-- progressbar -->
				  <ul id="progressbar">
					<li class="active">Personal Details</li>
					<li>Account Setup</li>
					<li>Login</li>
				  </ul>
				  <!-- fieldsets -->
				  <?php 
				  $error_fieldset1 = isset($form->ERRORS_SCRIPT['firstname']) || isset($form->ERRORS_SCRIPT['lastname']);
				  $error_fieldset2 = isset($form->ERRORS_SCRIPT['email']) || isset($form->ERRORS_SCRIPT['password']) || isset($form->ERRORS_SCRIPT['repassword']);
				  ?>
				  <fieldset id="signup_personal_data" style="<?php if(Input::checkInput('request','post','1') && !$error_fieldset1){?>transform: scale(0.8); opacity: 0; position: absolute;height: 0px<?php }?>">
					<div class="app_logo">
						<img src="assets/img/logo.png" class="img img-responsive">
					</div>
					<hr>
					<?php
					if($form->ERRORS == true){?>
						<h3 class="st-subtitle error">
							<?php if(isset($form->ERRORS_SCRIPT['firstname'])) echo '<br>'.$form->ERRORS_SCRIPT['firstname'][0];?>
							<?php if(isset($form->ERRORS_SCRIPT['lastname'])) echo '<br>'.$form->ERRORS_SCRIPT['lastname'][0];?>
						</h3>
					<?php }else{ ?>
						<h3 class="st-subtitle">What should we call you?</h3>
					<?php }?>
						
					<input class="lc_store  in_data required" id="signup_firstname" name="signup_firstname" type="text" placeholder="First Name" required/>
					
					<input class="lc_store  in_data required" id="signup_lastname" name="signup_lastname" type="text" placeholder="Last Name" required/>
					<select name="signup_country" id="signup_country" class="countrySelect js-states form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
						<?php 
						$countryArray =Country::getArrays();
						foreach($countryArray as $country_ID=>$country_data){
							$country_data = (object)$country_data;?>
							<option value="<?php echo $country_ID+1; ?>" id="<?php echo $country_data->icon; ?>" <?php if($country_data->code == "RW"){ echo 'selected';}?>><span></span><?php echo $country_data->name; ?></option>
							<?php
						}?>
					</select>
					<button id="signupPDataValidBtn" data-fieldset="#signup_personal_data" data-currentfs="#signup_personal_data" data-nextfs="#signup_account_setup" class="validation_btn pull-right next action-button" type="button" />Next</button>
				  </fieldset>
				  <fieldset id="signup_account_setup" style="<?php if(Input::checkInput('request','post','1') && !$error_fieldset1){?>display: block<?php }?>">
					<div class="app_logo">
						<img src="assets/img/logo.png" class="img img-responsive">
					</div>
					<hr>
					<?php if($form->ERRORS == true &&(isset($form->ERRORS_SCRIPT['email']) || isset($form->ERRORS_SCRIPT['password']) || isset($form->ERRORS_SCRIPT['repassword']) )){?>
						<h3 class="st-subtitle error">
						<?php if(isset($form->ERRORS_SCRIPT['email'])){?>
							<?php echo $form->ERRORS_SCRIPT['email'][0]; ?>
						<?php }?>
						<?php if(isset($form->ERRORS_SCRIPT['password'])){?>
							<?php echo $form->ERRORS_SCRIPT['password'][0]; ?>
						<?php }?>
						<?php if(isset($form->ERRORS_SCRIPT['repassword'])){?>
							<?php echo $form->ERRORS_SCRIPT['repassword'][0]; ?>
						<?php }?>
						</h3>
					<?php }else{ ?>
						<h3 class="st-subtitle">Secure your with a password</h3>
					<?php }?>
					<input class="lc_store in_data required " id="signup_email" name="signup_email" type="email"  placeholder="Your address Email" required/>
					<span>
					</span>
					<input id="signup_password" class="in_data required" name="signup_password" type="password" placeholder="Password" required/>
					<input id="signup_repassword" class="in_data required" name="signup_repassword" type="password" placeholder="Confirm Password" required/>
					<input type="hidden" class="hidden src-only" name="request" value="user_signup" />
					<input type="hidden" class="hidden src-only" name="webToken" value="true" />
					<input id="backToPdataBtn" data-currentfs="#signup_account_setup" data-previousfs="#signup_personal_data" type="button" name="previous" class="pull-left previous action-button" value="Previous" />
					<button id="signupValidBtn" data-fieldset="#signup_account_setup" data-currentfs="#signup_account_setup" data-nextfs="#signup_account_ready" class="validation_btn submit pull-right action-button" name="signupValidBtn" type="submit">Submit</button>
				  
						<?php if(isset($form->ERRORS_SCRIPT['email'])){?>
							<script>
								$(document).ready(function(){
									$('#signup_email').addClass('error');
								});
							</script>
						<?php }?>
						<?php if(isset($form->ERRORS_SCRIPT['password'])){?>
							<script>
								$(document).ready(function(){
									$('#signup_password').addClass('error');
								});
							</script>
						<?php }?>
						<?php if(isset($form->ERRORS_SCRIPT['repassword'])){?>
							<script>
								$(document).ready(function(){
									$('#signup_repassword').addClass('error');
								});
							</script>
						<?php }?>
					</fieldset>
					<fieldset id="signup_account_ready">
						<div class="app_logo">
							<img src="assets/img/logo.png" class="img img-responsive">
						</div>
						<hr>
						<br>
						<br>
						<center><img src="<?=DN?>/icon/load_signup2.gif" style="width: 200px;"></center>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="col-sm-3 col-md-4">
		</div>
	</div>
</div>