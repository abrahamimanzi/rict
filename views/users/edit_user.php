<div class="row">
	<div class="col-md-12">
		<h1 class="page-head-line">Edit User</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Update account
			</div>
			<div class="panel-body">
		
				<form  method="post" accept-charset="UTF-8" role="form"  enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<label>Full name : </label>
							<input class="form-control" placeholder="Full name" value="<?php echo $user_data->fullname;?>" name="fullname" type="text"  maxlength="15">
						</div>
						<div class="form-group">
							<label>Email-Address :</label>
							<input class="form-control" placeholder="Enter email" value="<?php echo $user_data->email;?>"  name="email" type="email">
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Featured image</label>
							<br/>
							<div class="row">
								<div class="col-sm-6">
									Current:<br/>
									<img src="<?php echo $user_data->profile;?>" class="img img-thumbnail" style="width: 150px; height: 150px;" align="top">
								</div>
								<div class="col-sm-6" >
									New:<br/>
									<div class="fileinput fileinput-new" data-provides="fileinput">
									  <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px;"></div>
									  <div>
										<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
										<input id="profilePhoto" type="file" name="profilePhoto"></span>
									  </div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Gender</label>
							<select name="gender" class="form-control">
								<option value="F" <?php if($user_data->gender == 'F'){ echo 'selected';}?>>Female</option>
								<option value="M" <?php if($user_data->gender == 'M'){ echo 'selected';}?>>Male</option>
							</select>
						</div>
						<div class="form-group">
							<label>Permission</label>
							<select name="groups" class="form-control">
								<option value="<?php echo $user_data->groups;?>" selected><?php echo $user_data->groups;?></option>
								<?php if($session_user_data->groups == "Admin" && $session_user_ID != $user_ID){?>
								<option value="Admin" <?php if($user_data->groups == 'Admin'){ echo 'selected';}?>>Admin</option>
								<option value="Reporter" <?php if($user_data->groups == 'Reporter'){ echo 'selected';}?>>Reporter</option>
                                <option value="Chefeditor" <?php if($user_data->groups == 'Chefeditor'){ echo 'selected';}?>>Chef Editor</option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>New Password : <small><a id="pwdvisibility">Show password</a></small></label>
							
							<small><i>Uppercase, lowercase, Special, Numbers</i></small>
							<input class="form-control passwordField" id="changePasswordType" placeholder="New password"  name="password" type="password">
						</div>
						<div class="form-group">
							<label>Re-tip Password :</label>
							<input class="form-control passwordField" placeholder="Re-tip password"  name="repassword" type="password">
						</div>
						<input type="hidden" name="id" value="<?php echo  $user_data->ID;?>">
						<input type="hidden" name="token" value="true">
						<input type="hidden" name="task" value="updateuser">
						<a href="?request=users" class="btn btn-md btn-default pull-left">Cancel</a>
						<input class="btn btn-md btn-success pull-right" type="submit" value="Save">
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>