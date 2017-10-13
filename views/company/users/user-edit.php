<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
					<i class="fa fa-users fa-lg pink-col"></i> Users
					<small></small>
				</h3>
			</div>
			<div class="col-xs-12 col-sm-4 hidden-xs">
				<!-- Main search form -->
				<form action="#" method="get" class="mainsearch-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<section class="content-header navbar_header">
	<div>
        <nav class="navbar navbar-static-top navbar_content" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-branch-menu">
            <ul class="nav navbar-nav">
                
              <li class="">
                <a href="<?=DN?>/company/users/list"> <i class="fa fa-home"></i> Home </a>
              </li>
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Users
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 83px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                        
                      
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-Admin' || $session_user_data->groups == 'RG-SUPER-Admin'){?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/users/new">
                          <i class="fa fa-plus text-blue"></i>New user
                        </a>
                      </li><!-- end notification -->
                    <?php }?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/users/list">
                            <i class="fa fa-bars text-blue"></i>User
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                </ul>
              </li>
                
            </ul>
          </div>
        </nav>
	</div>
</section>

<!-- Main content -->
<section class="content">
		
 <!-- Small boxes (Stat box) -->
	  <div class="row">
          <div class="col-sm-8">
              <form method="post">
                 <!--RECENT REGISTER -->
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title"> Edit User</h3>

                      <div class="box-tools pull-right">
                        
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 30px; ">
                        <label>First Name</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['firstname'][0];}?></span>
                          <input name="user-firstname" value="<?=$user_data->firstname?>" class="form-control" placeholder="First name">
                          <br>
                        <label>Last Name</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['lastname'][0];}?></span>
                          <input name="user-lastname" value="<?=$user_data->lastname?>" class="form-control" placeholder="Last name">
                          <br>
                          <label>Telephone</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['telephone'][0];}?></span>
                          <input name="user-telephone" value="<?=$user_data->phone?>" class="form-control" placeholder="Telephone nummber">
                          <br>
                        
						<div class="form-group">
							<label>Permission</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['groups'][0];}?></span>
							<select name="user-groups" class="form-control">
                <?php if($session_user_data->groups == "Admin"){?>
								<option value="<?php echo $user_data->groups;?>" selected><?php echo $user_data->groups;?></option>
                <?php }?>
								<?php if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID || $session_user_data->groups == 'RG-SUPER-Admin' || $user_data->groups == 'View-User'){?>
                <option value="View-User" <?php if($user_data->groups == 'View-User'){ echo 'selected';}?>>View-User</option>
                <?php }?>
                <?php if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID || $session_user_data->groups == 'RG-SUPER-Admin' || $user_data->groups == 'Sessions-Admin'){?>
                <option value="Sessions-Admin" <?php if($user_data->groups == 'Sessions-Admin'){ echo 'selected';}?>>Sessions-Admin</option>
                <?php }?>
                <?php if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID || $session_user_data->groups == 'RG-SUPER-Admin' || $user_data->groups == 'Admin-User'){?>
                <option value="Admin-User" <?php if($user_data->groups == 'Admin-User'){ echo 'selected';}?>>Admin-User</option>
                <?php }?>
                <?php if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID || $session_user_data->groups == 'RG-SUPER-Admin' || $user_data->groups == 'OGS-User'){?>
                <option value="OGS-User" <?php if($user_data->groups == 'OGS-User'){ echo 'selected';}?>>OGS-User</option>
                <?php }?>
                <?php if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID || $session_user_data->groups == 'RG-SUPER-Admin' || $user_data->groups == 'Super-Admin-User'){?>
                <option value="Super-Admin-User" <?php if($user_data->groups == 'Super-Admin-User'){ echo 'selected';}?>>Super-Admin-User</option>
                <option value="RG-Admin" <?php if($user_data->groups == 'RG-Admin'){ echo 'selected';}?>>RG-Admin</option>
                <option value="RG-SUPER-Admin" <?php if($user_data->groups == 'RG-SUPER-Admin'){ echo 'selected';}?>>RG-SUPER-Admin</option>
								<?php }?>
							</select>
						</div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="webToken" value="56">
                    <input type="hidden" name="request" value="user-update">
                    <input type="hidden" name="id" value="<?php echo  $user_data->ID;?>">
                    <input type="hidden" name="token" value="true">
                    <input type="hidden" name="task" value="user-update">
                    <div class="box-footer clearfix">
                        <a href="<?=DN?>/company/users/list" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                        <button type="submit" value="Save" class="btn btn-sm btn-info btn-flat pull-right">Submit</button>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                 <!--RECENT REGISTER -->
              </form>
          </div>
	  </div><!-- /.row -->
    
	  <div class="row">
		<div class="col-md-8 col-xs-12">
           
		</div><!-- ./col -->
		<div class="col-md-4 col-xs-12">
           
		</div><!-- ./col -->
	  </div><!-- /.row -->
    
</section>

<script>
    
$(document).ready(function(){
	$('#pwdvisibility').click(function(){
		if($('.passwordField').attr("type")=='password'){
			$('.passwordField').attr("type","text");
			$('#pwdvisibility').html("Hide password");
		}else{
			$('.passwordField').attr("type","password");
			$('#pwdvisibility').html("Show password");
		}
	});
});
</script>