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
				<form method="post" id="recover_form">
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
                                <?php if(Input::get('response','get') == 'errors'){?>
                                    <h6 class="st-subtitle error bg-danger"><span class="">Username not found. For any inquires, please contact the administrator.</span></h6>
                                <?php }elseif(Input::get('response','get') == 'success'){?>
                                    <h6 class="st-subtitle error bg-danger" style="color: #4fab90"><span class="">Check your email now to recover your password.</span></h6>
                                <?php }else{?>
                                        <h6 id="error_message" style='display: none'><span id="error_lo"></span><span id="no_visible"> Username not found. For any inquires, please contact the administrator</span></h6>
                                <?php }?>
                                <div class="login_fieldset">
                                    <div class="field">
                                        <div class="input-group ">
                                            <label class="input-group-addon" for="recover-email"><span class="glyphicon glyphicon-user"></span></label>
                                            <input id="recover-email" class="data_in one required" name="recover-email" type="email" placeholder="Enter your Email address" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="hidden" name="request" value="recover-login" />
                                <input type="hidden" class="hidden" name="webToken" value="true" />
                                <div class="row">
                                    <div class="col-sm-12 text-center submit_btn_div">
                                        <button id="recoverValidBtn" data-fieldset="#recover_form"  class="btn validation_btn recover_btn submit action-button" name="recoverValidBtn" type="submit">
                                            <span class="btn_icon glyphicon glyphicon-log-in"></span> <span class="btn_label">Submit</span>
                                        </button>
                                        <?php if(isset($form->ERRORS_SCRIPT['recover-email'])){?>
                                            <script>
                                                $(document).ready(function(){
                                                    $('#recover-email').addClass('error');
                                                });
                                            </script>
                                        <?php }?>
                                    </div>
                                </div>
                           <?php }else{?> 
                               <h6 class="st-subtitle error bg-danger" style="color: #4fab90; font-size: 15px"><span class="">Check your email now to recover your password.</span></h6>
                                <div class="text-center" style="padding: 10px 20px 20px 20px; color: #c0c0c0">
                                    <i class="glyphicon glyphicon-envelope" style="font-size: 100px;"></i> 
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
