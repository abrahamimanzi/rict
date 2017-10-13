
<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
					<i class="fa fa-book fa-lg pink-col"></i> Events List 
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
          <div class="col-sm-12">
                 <!--RECENT REGISTER -->
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">My Recent Events</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th style="width: 80px">ID</th>
                            <th>Event Name</th>
                            <th style="width: 90px">Status</th>
                            <th style="width: 60px">Menu</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                                $eventsDb = DB::getInstance();
                                $events_select = $eventsDb->get('all','events',array('company_ID','=',$company_data->ID));
                                if(!$events_select->count()){
                                    Functions::errorPage(404);
                                }else{
                                    foreach($events_select->results() as $events_data){
                                        $events_ID = $events_data->ID;
                                    ;?>
                              
                                  <tr>
                                    <td><a href="<?=DN?>/app/EventApp/<?=$events_ID?>"><?=$events_data->ID;?></a></td>
                                      <td><a href="<?=DN?>/app/EventApp/<?=$events_ID?>"><?=$events_data->name?></a></td>
                                    <td><span class="label label-info">Processing</span></td>
                                    <td>
                                      <div><a href="">More</a></div>
                                    </td>
                                  </tr>
                              
                                    <?php   
                                    }
                                }?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                      <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Events</a>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                 <!--RECENT REGISTER -->
          </div>
	  </div><!-- /.row -->
    
	  <div class="row">
		<div class="col-md-8 col-xs-12">
           
		</div><!-- ./col -->
		<div class="col-md-4 col-xs-12">
           
		</div><!-- ./col -->
	  </div><!-- /.row -->
    
</section>