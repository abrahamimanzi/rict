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
                <a href="<?=DN?>/"> <i class="fa fa-home"></i> Home </a>
              </li>
              
                <?php  if($session_user_data->groups == 'Admin'){?>
              
                <?php }?>
                <?php  if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'Admin-User' || $session_user_data->groups == 'Super-Admin-User' || $session_user_data->groups == 'OGS-User'){?>
              
                <?php }?>
                
            </ul>
          </div>
        </nav>
	</div>
</section>