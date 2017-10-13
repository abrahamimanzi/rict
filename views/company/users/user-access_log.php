<?php include 'user-content_header'.PL;?>
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
                <a href="<?=DN?>"> <i class="fa fa-home"></i> Route </a>
              </li>
              <!-- New activities Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Access Logs
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 83px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="<?=DN?>">
                            <i class="fa fa-bars text-blue"></i>All Logs
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
          <div class="col-sm-12 col-md-12">
                 <!--RECENT REGISTER -->
              <div>
                  
                     <?php 

                    $search_sql = "";
                    $search_form = false;
                    $sql_val_array = array('Deleted');
                   
                    if(Input::checkInput('search','get','1')){
                        $search_form = true;
                        $keyword = urldecode(Input::get('keyword','get'));
                        $state = urldecode(Input::get('state','get'));

                        if(Input::checkInput('keyword','get','1')){
                            $search_sql .= " 
                                AND (`device` LIKE '%{$keyword}%' || 
                                    `user_country` LIKE '%{$keyword}%' || 
                                    `email` LIKE '%{$keyword}%' ||
                                    `type` LIKE '%{$keyword}%' ||
                                    `ID` = '{$keyword}')";
                        }
                    }
                    ?>
                    
                        
                    
                </div>
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Access log list</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    
                    <div class="box-header with-border">
                        <form method="get" action="">	
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-xs-5 col-md-3">
                                    <input class="form-control" name="name" type="search" value="<?php if($search_form == true){ echo Input::get('title','post');}?>" placeholder="Names ">
                                </div>
                                <div class="col-xs-5  col-md-3">
                                    <select class="form-control" name="state" >
                                        <option value="">-all-</option>
                                        <option value="Activated">Activated</option>
                                        <option value="Deactivated">Deactivated</option>
                                    </select>
                                </div>
                                <div class="col-xs-2 col-md-2">
                                    <input name="search" value="1" type="hidden">
                                    <button class="btn btn-default pull-right" type="submit" style="display: inline-block; margin-top: 4px!important"><i class=" fa fa-search"></i> <span class="hidden-xs">Search</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-header -->
                    
                    <div class="box-body">
                        
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th style="width: 70px">#</th>
                            <th>Account name</th>
                            <th>Device</th>
                            <th>IP</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Page/Action</th>
                            <th>Detail</th>
                            <th>Time</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                              $participantTable = new Participant();
								$participantTable->selectQuery("SELECT* FROM `pageview` WHERE `state`!=? $search_sql ",$sql_val_array);
                               // $events_select = $participantDb->get('all','events_participant',array('company_ID','=',$company_data->ID));
                                
								/*Start Pagination Setting*/
									$rowsLimit = 50;
									$pageNumber = 0;
									if(Input::checkInput('page','get','1')){
										$pageNumber = (int)sanAsID(Input::get('page','get'));
									}
									$requesturl = "?check";
									
									$totalStore=$participantTable->count();
									$totalPages = upfloat($totalStore/$rowsLimit);
									$offsetNumber = $pageNumber*$rowsLimit;
									if($offsetNumber >= $totalStore){
										$pageNumber=0;
										$offsetNumber = $pageNumber*$rowsLimit;
									}
								/*End Pagination Setting*/
                                
                                $dataArr = array();
                              
                              $participantTable = new Participant();
                                                          
                              $participantTable->selectQuery("SELECT * FROM `pageview` WHERE `state`!=? $search_sql ORDER BY ID DESC LIMIT {$offsetNumber},{$rowsLimit}",$sql_val_array);
                              
								if($participantTable->count()){
									$i = 0;
									foreach($participantTable->data() as $participant_data){
										$i++;
                                        $participant_ID = $participant_data->ID;?>
                                        <?php $stateColor =  Functions::getStateCol($participant_data->state);?>
                              
                                      <tr class="row_layout" >
                                        <td>
                                            <a style="border-color: <?=$stateColor?>" ><?=$i;?> <i class="fa fa-angle-down pull-right menu_icon"></i></a>
                                        </td>
                                        <td><?=$participant_data->email?></td>
                                        <td><?=$participant_data->device?></td>
                                        <td><?=$participant_data->user_IP?></td>
                                        <td><?=$participant_data->user_country?></td>
                                        <td><?=$participant_data->user_city?></td>
                                        <td><?=$participant_data->user_latitude?></td>
                                        <td><?=$participant_data->user_longitude?></td>
                                        <td>
                                            <span data-toggle="modal" data-target="#myModal_<?=$participant_data->ID?>" ><?=$participant_data->type?></span>
                                        </td>
                                        <td><?=$participant_data->grabbed_info?></td>
                                        <td><?php echo "$participant_data->day-$participant_data->month-$participant_data->year $participant_data->hour:$participant_data->minute:$participant_data->second"?></td>
                                      </tr>	
                              <!-- Modal -->
                                  <?php }?>
                                <tr>
                                    <td colspan="9">
                                        <?php include 'views/pagination'.PL;?>
                                    </td>
                                </tr>
                            <?php }else{?>
                                <tr>
                                    <td colspan="7"><br/>No Log recorded</td>
                                </tr>
                            <?php }?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                       
                        
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                      <a href="<?=DN?>/list" class="btn btn-sm btn-default btn-flat pull-right">View All Participants</a>
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