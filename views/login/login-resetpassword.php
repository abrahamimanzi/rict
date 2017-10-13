<div class="nav_fixedspace"></div>
<!--
<div class="guest_room_div">
	<img src="assets/img/home/default1.png" class="img img-responsive">
</div>
-->
<div class="container">
	<div class="row">
		<div class="col-sm-3 col-md-3">
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="signup_form_container">
				<!-- multistep form -->
				<form method="post" id="resetpassword_form">
				  <!-- fieldsets -->
				  <br/>
				  <br/>
				  <br/>
				  <br/>
				  <br/>
				  <br/>

				  	<fieldset id="login_personal_data">
				    <div class="panel login_panel">
                      
					<div class="panel-heading">
                        <div class="app_logo">
                            <img src="<?=DN?>/img/ricta_logo.png" class="app_icon img" style="width: 135px;">
                        </div>
					</div>
					   <div class="panel-body">
                           <hr style="margin-top: 0px;">
                           
                            <?php if(Input::get('response','get') != 'success'){?>
                                <?php if($form->ERRORS==true){?>
                               <h6 class="st-subtitle error bg-danger"><span class=""> <?=$form->ERRORS_STRING?></span></h6>
                                <?php }elseif(Input::get('response','get') == 'success'){?>
                                    <h6 class="st-subtitle error bg-danger" style="color: #4fab90"><span class="">Password changed successfuly. <a href="<?=DN?>/login">Login now</a></span></h6>
                                <?php }else{?>
                                        <h6 id="error_message" style='display: none'><span id="error_lo"></span><span id="no_visible"> Please enter your new password.</span></h6>
                                <?php }?>
                                <div class="login_fieldset">
                                    <div class="field">
                                        <div class="input-group ">
                                            <label class="input-group-addon" for="reset-password"><span class="glyphicon glyphicon-lock"></span></label>
                                            <input id="reset-password" class="data_in one required" name="reset-password" type="password" placeholder="Enter new password" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="hidden" name="request" value="reset-password" />
                                <input type="hidden" class="hidden" name="webToken" value="true" />
                                <div class="row">
                                    <div class="col-sm-12 text-center submit_btn_div">
                                        <button id="resetPasswordValidBtn" data-fieldset="#resetpassword_form"  class="btn validation_btn resetpassword_btn submit action-button" name="resetPasswordValidBtn" type="submit">
                                            <span class="btn_icon glyphicon glyphicon-log-in"></span> <span class="btn_label">Submit</span>
                                        </button>
                                        <?php if(isset($form->ERRORS_SCRIPT['reset-password'])){?>
                                            <script>
                                                $(document).ready(function(){
                                                    $('#reset-password').addClass('error');
                                                });
                                            </script>
                                        <?php }?>
                                    </div>
                                </div>
                           <?php }else{?> 
                                <br>
                               <h6 class="st-subtitle error bg-danger" style="color: #4fab90; font-size: 15px"><span class="">Your password has been changed. You can now go back and login</span></h6>
                                <div class="text-center" style="padding: 10px 20px 20px 20px; color: #c0c0c0">
                                    <i class="glyphicon glyphicon-check" style="font-size: 100px;"></i> 
                               </div>
                           <?php }?>
                           
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="glyphicon glyphicon-menu-left"></span>  <a href="<?=DN?>/login"> Back to Login </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        
					</fieldset>
				</form>
			</div>
		</div>
		<div class="col-sm-3 col-md-3">
		</div>
	</div>
</div>
