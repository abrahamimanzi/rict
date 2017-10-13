
<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
                    <i class="fa fa-book fa-lg pink-col"></i>
					Create New Event
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
                <a href="<?=DN?>/app/EventApp/"> <i class="fa fa-home"></i> Route </a>
              </li>
               <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Event
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 83px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="<?=DN?>/app/EventApp/new">
                          <i class="fa fa-plus text-blue"></i>New event
                        </a>
                      </li><!-- end notification -->
                      <li><!-- start notification -->
                        <a href="<?=DN?>/app/EventApp/list">
                            <i class="fa fa-bars text-blue"></i>List event
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
                 <!--RECENT NEW EVENT -->
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">New Event</h3>

                      <div class="box-tools pull-right">
                        
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 30px; ">
                         
                          <label>Name</label>
                          <input name="event-name" class="form-control" placeholder="Project title">
                          <br>
                          <label>Description</label>
                          <textarea name="event-description" class="form-control" placeholder="Project title" rows="3"></textarea>
                          <br>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="webToken" value="56">
                    <input type="hidden" name="request" value="event-new">
                    <input type="hidden" name="company-id" value="<?=$company_data->ID?>">
                    <div class="box-footer clearfix">
                        <a href="<?=DN?>/app/EventApp/home" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-info btn-flat pull-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                  <!--END NEW EVENT-->
              </form>
          </div>
          <div class="col-sm-4">
               <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Notifications</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                          <div class="col-xs-6">
                              <!-- small box -->
                              <div class="small-box bg-aqua">
                                <div class="inner" style="height: 50px;">
                                 <h3  style="font-size: 30px">50<sup>%</sup></h3>
                                </div>
                                <div class="icon"  style="bottom: 0px; top: auto">
                                  <i style="font-size: 35px;" class="fa fa-briefcase"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                          </div><!-- ./col -->
                          <div class="col-xs-6">
                              <!-- small box -->
                              <div class="small-box bg-yellow">
                                  <div class="inner" style="height: 50px;">
                                      <h3  style="font-size: 30px">53<sup>%</sup></h3>
                                  </div>
                                <div class="icon"  style="bottom: 0px; top: auto">
                                      <i class="fa fa-tasks"  style="font-size: 35px;"></i>
                                  </div>
                                  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                          </div><!-- ./col -->
                        </div>
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