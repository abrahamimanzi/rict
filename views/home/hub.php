
<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-6 col-sm-8">
				<h3 class="content-title text-center">
					MY HUB
					<small></small>
				</h3>
			</div>
			<div class="col-xs-6 col-sm-4">
	  
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
               
              <!-- New activities Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-plus-circle"></i> New
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 165px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="<?=DN?>/project/new">
                          <i class="fa fa-plus skyblue-col"></i>New Project
                        </a>
                      </li><!-- end notification -->
                      <li><!-- start notification -->
                        <a href="#">
                            <i class="fa fa-plus pink-col"></i>New Note
                        </a>
                      </li><!-- end notification -->
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-plus orange-col"></i> New Message
                        </a>
                      </li><!-- end notification -->
                      <li><!-- start notification -->
                        <a href="<?=DN?>/app/EventApp/new">
                          <i class="fa fa-plus blue-col"></i> New Event
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                </ul>
              </li>
                

              <!-- Tasks Menu -->
              <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bars"></i> List
                  <span class="label label-danger"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 165px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="<?=DN?>/project/new"> 
                        
                          <i class="fa fa-minus skyblue-col"></i> My Projects
                        </a>
                      </li><!-- end notification -->
                      <li><!-- start notification -->
                        <a href="#">
                            <i class="fa fa-minus pink-col"></i> My Notes
                        </a>
                      </li><!-- end notification -->
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-minus orange-col"></i> My Messages
                        </a>
                      </li><!-- end notification -->
                      <li><!-- start notification -->
                        <a href="<?=DN?>/app/EventApp/list">
                          <i class="fa fa-minus blue-col"></i> My Events
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                </ul>
              </li>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-angle-down"></i> Apps</a>
                <ul class="dropdown-menu">
                  <!-- Menu Body -->
                  <li class="dropdown-body">
                    <div class="col-xs-6 text-center">
                      <a href="<?=DN?>/app/EventApp/"><i class="fa fa-book  blue-col"></i> Events-Apps</a>
                    </div>
                    <div class="col-xs-6">
                      <a href="#"><i class="fa fa-bell tgreen-col"></i> Reminder</a>
                    </div>
                  </li>
                  <li class="dropdown-body">
                    <div class="col-xs-6">
                      <a href="<?=DN?>/app/EventApp/"><i class="fa fa-envelope orange-col"></i> Messager</a>
                    </div>
                    <div class="col-xs-6">
                      <a href="#"><i class="fa fa-file-text-o pink-col"></i> Notes</a>
                    </div>
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
              <div class="row">
                  <div class="col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-thumbs-up"></i></span>

                        <div class="info-box-content">
                            
                          <span class="info-box-number"><?=$session_user_data->firstname.' '.$session_user_data->lastname?><small></small></span>
                          <p>Good Morning, BPR Meeting at 2 PM <br> 
                            <a href="" class="block">Read More</a>
                          </p>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                  </div>
                  
                  <div class="col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow" ><i class="glyphicon glyphicon-bell"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-number"><?=Dates::get("D, d M Y")?><small></small></span>
                          <p>
                            Lorem missionipsum dolor<br> 
                            <a href="" class="block">Read More</a>
                        </p>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                  </div>
                
              </div><!-- /.row -->
              
              
              
                 <!--RECENT PROJECTS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Recent Projects</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Project Number</th>
                            <th>Project Name</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td><a href="#">NO7429</a></td>
                            <td>BPR Re-Branding</td>
                            <td><span class="label label-info">Processing</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">NO7429</a></td>
                            <td>BPR Re-Branding</td>
                            <td><span class="label label-info">Processing</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">NO7429</a></td>
                            <td>BPR Re-Branding</td>
                            <td><span class="label label-info">Processing</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">N09842</a></td>
                            <td>Inyange Brand</td>
                            <td><span class="label label-success">Done</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">N09842</a></td>
                            <td>Inyange Brand</td>
                            <td><span class="label label-warning">Pending</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">NO1848</a></td>
                            <td>Rugarama </td>
                            <td><span class="label label-warning">Pending</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">N09842</a></td>
                            <td>Inyange Brand</td>
                            <td><span class="label label-warning">Pending</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">NO7429</a></td>
                            <td>ISCO Re-branding</td>
                            <td><span class="label label-danger">Delivered</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">N09842</a></td>
                            <td>Inyange Brand</td>
                            <td><span class="label label-success">Done</span></td>
                            <td>
                              <div><a href="">More</a></div>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                      <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Create New Project</a>
                      <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Projects</a>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                  <!--END RECENT PROJECTs-->
          </div>
          <div class="col-sm-4">
               <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Notifications</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list list-unstyled">
                            <li><span class="label label-default" >New Task</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >Pending</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >Tasks</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >New Task</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >Pending</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >Tasks</span> Lorem ipsum number 2<hr></li>
                        </ul>
                    </div>
                </div>
          </div>
	  </div><!-- /.row -->
    
	  <div class="row">
		<div class="col-md-8 col-xs-12">
           
		</div><!-- ./col -->
		<div class="col-md-4 col-xs-12">
           
		</div><!-- ./col -->
	  </div><!-- /.row -->
    
</section>