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
                <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/"> <i class="fa fa-home"></i> Home </a>
              </li>
              <!-- New activities Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Participants
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-list">
                            <i class="fa fa-bars text-blue"></i>All participants
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-delegate">
                            <i class="fa fa-bars text-blue"></i>Delegates
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-exhibitor">
                            <i class="fa fa-bars text-blue"></i>Exhibitors
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-visitor">
                            <i class="fa fa-bars text-blue"></i>Visitors
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-speaker">
                            <i class="fa fa-bars text-blue"></i>Speakers
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-media">
                            <i class="fa fa-bars text-blue"></i>Media
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-ftg">
                            <i class="fa fa-bars text-blue"></i>Face the gorilla
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-msgeek">
                            <i class="fa fa-bars text-blue"></i>Ms geek
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="<?=DN?>/app/EventApp/5/participant-finder"> <i class="fa fa-search"></i> Advanced Filter </a>
              </li>
                <?php  if($session_user_data->groups == 'Admin'){?>
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Category
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/category-new">
                            <i class="fa fa-bars text-blue"></i>New Category
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/category-list">
                            <i class="fa fa-bars text-blue"></i>Category List
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
                <?php }?>
                <?php  if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'Admin-User' || $session_user_data->groups == 'Super-Admin-User' || $session_user_data->groups == 'OGS-User'){?>
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Group accounts
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li>
                        <a href="<?=DN?>/company/subscriber/new">
                            <i class="fa fa-bars text-blue"></i>Book new group
                        </a>
                      </li>
                      <li>
                        <a href="<?=DN?>/company/subscriber/list">
                            <i class="fa fa-bars text-blue"></i>Group lists
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
                <?php }?>
                
            </ul>
          </div>
        </nav>
	</div>
</section>