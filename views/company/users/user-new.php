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
                      
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-SUPER-Admin'){?>
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
                      <h3 class="box-title">Create New User</h3>

                      <div class="box-tools pull-right">
                        
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 30px; ">
                         
                          <label>Names</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['firstname'][0];}?></span>
                          <input name="user-firstname" class="form-control" placeholder="Names">
                          <br>
                          <!-- <label>Last Name</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['lastname'][0];}?></span>
                          <input name="user-lastname" class="form-control" placeholder="Last name">
                          <br> -->
                          <label>Email</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['email'][0];}?></span>
                          <input name="user-email" type="email" class="form-control" placeholder="Email">
                          <br>
                          <label>Telephone</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['telephone'][0];}?></span>
                          <input name="user-telephone" class="form-control" placeholder="Telephone number">
                          <br>                        
                            
                            <div class="form-group">
                                <label>Permission</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['groups'][0];}?></span>
                                <select name="user-groups" class="form-control">
                                    <option value="Register-User">Register-User</option>
                                    <option value="View-User">View-User</option>
                                    <!-- <option value="Sessions-Admin">Sessions-Admin</option> -->
                                    <!-- <option value="OGS-User">OGS-User</option> -->
                                    <option value="Admin-User">Admin-User</option>
                                    <option value="Super-Admin-User">Super-Admin-User</option>
                                    <!-- <option value="RG-Admin">RG-Admin</option> -->
                                    <!-- <option value="RG-SUPER-Admin">RG-SUPER-Admin</option> -->
                                </select>
                            </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="webToken" value="56">
                    <input type="hidden" name="request" value="user-new">
                    <div class="box-footer clearfix">
                        <a href="<?=DN?>/company/users/list" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-info btn-flat pull-right">Submit</button>
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


