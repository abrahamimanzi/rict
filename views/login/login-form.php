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
				<form method="post" id="login_form">
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
                           
                            <?php if($form->ERRORS == true ){?>
                                <h6 class="st-subtitle error bg-danger"><span class="">Username or Password don't match, Please retry.</span></h6>
                            <?php }else{?>
                                    <h6 id="error_message" style='display: none'><span id="error_lo"></span><span id="no_visible"> Username or Password don't match, Please retry.</span></h6>
                            <?php }?>
                            <div class="login_fieldset">
                                <div class="field">
                                    <div class="input-group ">
                                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                      <input id="login_username" class="data_in one required" name="login_username" type="text"  placeholder="Username" required aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <br>
                                <div class="field">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                      <input id="login_password" class="data_in two required" name="login_password" type="password" placeholder="Password" required  placeholder="Username" required aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="hidden" name="request" value="user_login" />
                            <input type="hidden" class="hidden" name="webToken" value="true" />
                            <div class="row">
                                <div class="col-sm-12 text-center submit_btn_div">
                                    <button id="loginValidBtn" data-fieldset="#login_form"  class="btn validation_btn login_btn submit action-button" name="loginValidBtn" type="submit"><span class="btn_icon glyphicon glyphicon-log-in"></span> <span class="btn_label">Login</span></button>
                                    <?php if(isset($form->ERRORS_SCRIPT['username'])){?>
                                        <script>
                                            $(document).ready(function(){
                                                $('#login_username').addClass('error');
                                            });
                                        </script>
                                    <?php }?>
                                    <?php if(isset($form->ERRORS_SCRIPT['password'])){?>
                                        <script>
                                            $(document).ready(function(){
                                                $('#login_password').addClass('error');
                                            });
                                        </script>
                                    <?php }?>
                                </div>
                                <div class="col-sm-6">
<!--                                    <label class="remeber_label"><input type="checkbox" name="login_remember" value="on"> Remeber me</label>-->
                                </div>
                            </div>
                           
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <a href="<?=DN?>/login/forgotpassword">Forgot Your Password? </a>
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
