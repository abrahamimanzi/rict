<style>
    th button{
        border: 0;
        background: transparent;
    }
</style>
<?php include 'participant-content_header'.PL;?>
<?php include 'participant-content_navbar'.PL;?>

<!-- Main content -->
<section class="content">
		
 <!-- Small boxes (Stat box) -->
	  <div class="row">
          <div class="col-sm-12 col-md-12">
                 <!--RECENT REGISTER -->
              <div>
                  
                <?php 
                    if(@empty($_SESSION['participant_sort'])){
                        $_SESSION['participant_sort'] = "`ID` DESC";  
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    if(Input::checkInput('sort-id','post','0')){
                        $_SESSION['participant_sort'] = $_SESSION['participant_sort'] == "`ID` ASC" ? "`ID` DESC" : "`ID` ASC";
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    if(Input::checkInput('sort-name','post','0')){
                        $_SESSION['participant_sort'] = $_SESSION['participant_sort'] == "`firstname` ASC" ? "`firstname` DESC" : "`firstname` ASC";
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    if(Input::checkInput('sort-category','post','0')){
                        $_SESSION['participant_sort'] = $_SESSION['participant_sort'] == "`category` ASC" ? "`category` DESC" : "`category` ASC";
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    if(Input::checkInput('sort-pass_type','post','0')){
                        $_SESSION['participant_sort'] = $_SESSION['participant_sort'] == "`pass_type` ASC" ? "`pass_type` DESC" : "`pass_type` ASC";
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    if(Input::checkInput('sort-company_name','post','0')){
                        $_SESSION['participant_sort'] = $_SESSION['participant_sort'] == "`company_name` ASC" ? "`company_name` DESC" : "`company_name` ASC";
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    if(Input::checkInput('sort-added_date','post','0')){
                        $_SESSION['participant_sort'] = $_SESSION['participant_sort'] == "`added_temp` ASC" ? "`added_temp` DESC" : "`added_temp` ASC";
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    if(Input::checkInput('sort-payment_state','post','0')){
                        $_SESSION['participant_sort'] = $_SESSION['participant_sort'] == "`payment_state` ASC" ? "`payment_state` DESC" : "`payment_state` ASC";
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    if(Input::checkInput('sort-state','post','0')){
                        $_SESSION['participant_sort'] = $_SESSION['participant_sort'] == "`state` ASC" ? "`state` DESC" : "`state` ASC";
                         Redirect::to("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }

                    $search_sql = "";
                    $search_form = false;
                    $sql_val_array = array('Deleted',$event_ID);
                   
                    if(Input::checkInput('search','get','1')){
                        $search_form = true;
                        $fullname = urldecode(Input::get('name','get'));
                        $keyword = urldecode(Input::get('keyword','get'));
                        $state = urldecode(Input::get('state','get'));

                        if(Input::checkInput('keyword','get','1')){
                            $search_sql .= " 
                                AND (`firstname` LIKE '%{$keyword}%' || 
                                    `lastname` LIKE '%{$keyword}%' || 
                                    `category` LIKE '%{$keyword}%'|| 
                                    `email` LIKE '%{$keyword}%' ||
                                    `telephone` LIKE '%{$keyword}%' ||
                                    `package_type` LIKE '%{$keyword}%' ||
                                    `state` LIKE '%{$keyword}%' ||
                                    `company_name` LIKE '%{$keyword}%' ||
                                    `code` LIKE '%{$keyword}%' ||
                                    `residence_country` LIKE '%{$keyword}%' ||
                                    `residence_city` LIKE '%{$keyword}%' ||
                                    `citizenship_country` LIKE '%{$keyword}%' ||
                                    `document_type` LIKE '%{$keyword}%' ||
                                    `document_number` LIKE '%{$keyword}%' ||
                                    `media_card` LIKE '%{$keyword}%' ||
                                    `category` LIKE '%{$keyword}%' ||
                                    `pass_type` LIKE '%{$keyword}%' ||
                                    `jobtitle` LIKE '%{$keyword}%' ||
                                    `telephone_office` LIKE '%{$keyword}%' ||
                                    `gender` LIKE '%{$keyword}%' ||
                                    `website` LIKE '%{$keyword}%' ||
                                    `ID` = '{$keyword}')";
                        }
                        if(Input::checkInput('name','get','1')){
                            $search_sql .= " 
                                AND (`firstname` LIKE '%{$fullname}%' || 
                                    `lastname` LIKE '%{$fullname}%' || 
                                    `category` LIKE '%{$fullname}%')";
                        }
                        if(Input::checkInput('state','get','1')){
                            if(Input::get('state','get')=='Activated'){
                                $search_sql .= " AND `state` = ?";
                                $sql_val_array[] = $state;
                            }elseif(Input::get('state','get')=='Deactivated'){
                                $search_sql .= " AND `state` = ?";
                                $sql_val_array[] = $state;
                            }
                        }
                    }
                    ?>
                    
                        
                    
                </div>
              
              
                <div class="box">
                    <div class="box-header with-border">
                    
                    <?php

                        $participantTable = new Participant();
                        $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE  (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum') AND `state`!=? AND `event_ID`=? $search_sql ",$sql_val_array);
                        $participantApprovalNumber = $participantTable ->count();
                    ?>
                      <h3 class="box-title">Delegate list  <span style='color:#01aef0'><?=$participantApprovalNumber?></span></h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <br>
                    <div class="box-body">
                        
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                            <form method="post">
                              <tr>
                                <th><button type="submit" name="sort-id">Reg. ID</button></th>
                                <th><button type="submit" name="sort-name">Full Name</button></th>
                                <th><button type="submit" name="sort-category">Category</button></th>
                                <th><button type="submit" name="sort-pass_type">Pass</button></th>
                                <th><button type="submit" name="sort-residence_country">Country</button></th>
                                <th><button type="submit" name="sort-company_name">Company</button></th>
                                <th style="width: 95px" title="Registration Date">
                                    <button type="submit" name="sort-added_date">Reg Date</button>
                                </th>
                                <th title="Time Lapsed" style="width: 85px;">
                                    <button type="submit" name="sort-added_date">Days left</button>
                                </th>
                                <th style="width: 90px"><button type="submit" name="sort-payment_state">Payment</button></th>
                                <th style="width: 90px"><button type="submit" name="sort-state">Status</button></th>
                                <th style="width: 90px"><button type="submit" name="sort-state">Update</button></th>
                                <th style="width: 60px">Menu</th>
                              </tr>
                            </form>
                          </thead>
                          <tbody>
                            <?php
                              
                            $seconds = \Config::get('time/seconds');
                              $participantTable = new Participant();
                                $participantTable->selectQuery("SELECT* FROM `events_participant` WHERE (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum') AND `state`!=? AND `event_ID`=? $search_sql ORDER BY {$_SESSION['participant_sort']}",$sql_val_array);
                                // $participantTable->selectQuery("SELECT* FROM `events_participant` WHERE (`category`='Silver' || `category`='Gold' || `category`='Platinum') AND `state`!=? AND `event_ID`=? $search_sql ORDER BY {$_SESSION['participant_sort']}",$sql_val_array);
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
                              
                                
                              
                            if(Input::checkInput('keyword','get','0') || strlen(Input::get('keyword','get'))<3){
                                
                                $participantTable = new Participant();
                                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum') AND `state`!=? AND `event_ID`=? $search_sql ORDER BY {$_SESSION['participant_sort']} LIMIT {$offsetNumber},{$rowsLimit}",$sql_val_array);
                                // $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE (`category`='Silver' || `category`='Gold' || `category`='Platinum') AND `state`!=? AND `event_ID`=? $search_sql ORDER BY {$_SESSION['participant_sort']} LIMIT {$offsetNumber},{$rowsLimit}",$sql_val_array);
                                
                            }
                              
								if($participantTable->count()){
									$i = 0;
									foreach($participantTable->data() as $participant_data){
										$i++;
                                        $participant_ID = $participant_data->ID;
                                        $reg_time_ago = Dates::get_timeago($participant_data->added_temp);
                                        $reg_time_ago_array = explode(' ',$reg_time_ago);
                                        $reg_time_ago_n = $reg_time_ago_array[0];
                                        $reg_time_ago_u = $reg_time_ago_array[1];
                                        
                                        $stateColor =  Functions::getStateCol($participant_data->state);
                                        
                                        if($participant_data->pass_type == 'Visitor'){
                                            $deadline = 14;
                                        }elseif($participant_data->pass_type == 'Media'){
                                            $deadline = 5;
                                        }else{
                                            $deadline = 7;
                                        }
                                        
                                        $lapsed_time = Dates::get_daylapsed($participant_data->added_temp,$deadline,'day');
                                        $lapsed_time_n = (int)$lapsed_time;
                                        if($participant_data->state == 'Pending'){
                                            if($lapsed_time_n < 0){
                                                $stateColor = "red";
                                            }
                                        }
                                        if(($participant_data->payment_state == 'Confirmed' || 
                                            $participant_data->category == 'Media'|| 
                                            $participant_data->category == 'Speaker'|| 
                                            $participant_data->category == 'Visitor') && $participant_data->state == 'Confirmed'){
                                            $stateColor = "#18ab86";                                    
                                            $lapsed_time = "--";
                                        }
                                        if(($participant_data->pass_type == 'Silver'|| 
                                            $participant_data->pass_type == 'Gold'|| 
                                            $participant_data->pass_type == 'Platinum'|| 
                                            $participant_data->category == 'Exhibitor') && 
                                            $participant_data->payment_state != 'Confirmed' &&
                                            $participant_data->state == 'Confirmed'){
                                            $stateColor = "#01aef0";                                    
                                            $lapsed_time = "--";
                                        }
                                        if($participant_data->payment_state == 'Confirmed' &&
                                            $participant_data->state == 'Denied'){
                                            $stateColor = "#fb00a1";                                            
                                            $lapsed_time = "--";
                                        }
                                        
                                        if($participant_data->payment_state != 'Confirmed' &&
                                            $participant_data->state == 'Denied'){
                                            $stateColor = "#777";                            
                                            $lapsed_time = "--";    
                                        }
                              ?>
                              
                              <?php
                                $updated=false;
                                if($participant_data->user_ID){
                                    $updated=true;
                                    $userTable = new User();
                                    $userTable->selectQuery("SELECT `ID`,`firstname`,`lastname`,`phone` FROM `app_users` WHERE `ID`=?",array($participant_data->user_ID));
                                    if($userTable->count()){
                                        $user_data = $userTable->first();
                                    }
                                }
                                ?>

                              
                                      <tr class="row_layout" >
                                        <td>
                                            <a style="border-color: <?=$stateColor?>" class="id popover-el participant-menu-popover-<?=$participant_data->ID?>"><?=$participant_data->code;?> <i class="fa fa-angle-down pull-right menu_icon"></i></a>
                                        </td>
                                        <td>
                                            <span data-toggle="modal" data-target="#myModal_<?=$participant_data->ID?>" ><?=$participant_data->firstname?> <?=$participant_data->lastname?></span>
                                        </td>
                                        <td>
                                            <?php echo $participant_data->category;?>
                                        </td>
                                        <td><?=$participant_data->pass_type?></td>
                                        <td><?=$participant_data->residence_country?></td>
                                        <td><?=$participant_data->company_name?></td>
                                        <td><span><?=$participant_data->added_date?></span></td>
                                        <td class="text-center"><span><?php echo $lapsed_time;?></span></td>
                                        <td><?=$participant_data->payment_state?></td>
                                        <td ><span style="color: #fff; background: <?=$stateColor?>; display: block; padding: 2px 5px"><?=$participant_data->state?></span></td>
                                        <td><span><?php echo $updated == true ? $user_data->firstname : '';?></span></td>
                                        <td>
                                            <div>
                                              <a class="participant-menu-popover-<?=$participant_data->ID?> popover-el" tabindex="0" role="button" >More</a>
                                            </div>
                                            
                                            <div id="participant-menu-content-<?=$participant_data->ID?>" class="hidden">
                                                <form method="post">
                                                    <input type="hidden" name="webToken" value="56">
                                                    <input type="hidden" name="request" value="participant-state">
                                                    <input type="hidden" name="participant-event_id" value="<?=$event_ID?>">
                                                    <input type="hidden" name="participant-company_id" value="<?=$company_data->ID?>">
                                                    <input type="hidden" name="participant-id" value="<?=$participant_data->ID?>">
                                                    <ul class="popover-menu-list">
                                                        <li><a class="menu popover-close" data-popoverid=".participant-menu-popover-<?=$participant_data->ID?>" data-toggle="modal" data-target="#myModal_<?=$participant_data->ID?>"><i class="fa fa-eye icon"></i> View</a></li>
                                                        
                                                        <?php  
                                                        if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-Admin' || $session_user_data->groups == 'RG-SUPER-Admin'){?>

                                                            <?php if($participant_data->state!='Confirmed' AND $participant_data->category!='Government' || ($participant_data->state!='Confirmed' AND $participant_data->category=='Government' AND $participant_data->payment_state=='Confirmed')){?>
                                                            <li> 
                                                                <button class="menu" name="confirm" type="submit"><i class="fa fa-check-circle icon"></i> Confirm</button>
                                                            </li>
                                                            <?php }?>

                                                            <?php if($participant_data->state!='Denied'){?>
                                                            <li> 
                                                                <button class="menu" name="deny" type="submit"><i class="fa fa-times-circle icon"></i> Deny</button>
                                                            </li>
                                                            <?php }?>

                                                            <?php if($participant_data->state!='Pending'){?>
                                                            <li> 
                                                                <button class="menu" name="pending" type="submit"><i class="fa fa-times-circle icon"></i> Pending</button>
                                                            </li>
                                                            <?php }?>
                                                        <?php }?>
                                                        
                                                        <?php
                                                        if(($session_user_data->groups == 'Admin' || $session_user_data->groups == 'Admin-User' || $session_user_data->groups == 'Super-Admin-User' || $session_user_data->groups == 'OGS-User') && ($participant_data->category == 'Silver' ||$participant_data->category == 'Gold' ||$participant_data->category == 'Platinum' || $participant_data->category == 'Exhibitor')){?>
                                                            <?php if($participant_data->payment_state=='Confirmed'){?>
                                                            <li><a class="menu" href="<?=DN?>/receipt-single/<?=$participant_data->token?>" target="invoice_tab"><i class="fa fa-print icon"></i> Print Invoice</a></li>
                                                            <?php }?>

                                                            <?php if($participant_data->payment_state!='Confirmed'){?>
                                                            <li> 
                                                                <button class="menu" name="payment-confirm" type="submit"><i class="fa fa-check-circle icon"></i> Confirm Payment</button>
                                                            </li>
                                                            <?php }?>

                                                            <?php if($participant_data->payment_state!='Refunded'){?>
                                                            <li> 
                                                                <button class="menu" name="payment-refund" type="submit"><i class="fa fa-check-circle icon"></i> Refunded Payment</button>
                                                            </li>
                                                            <?php }?>
                                                        
                                                            <?php if($participant_data->state=='Denied' && $participant_data->payment_state!='Closed'){?>
                                                            <li> 
                                                                <button class="menu" name="payment-close" type="submit"><i class="fa fa-check-circle icon"></i> Close Payment</button>
                                                            </li>
                                                            <?php }?>

                                                            <?php if($participant_data->payment_state!='Pending'){?>
                                                            <li> 
                                                                <button class="menu" name="payment-pending" type="submit"><i class="fa fa-check-circle icon"></i> Pending Payment</button>
                                                            </li>
                                                            <?php }?>
                                                        <?php }?>
                                                        <?php  
                                                        if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-Admin' || $session_user_data->groups == 'RG-SUPER-Admin' || $session_user_data->groups == 'Admin-User' || $session_user_data->groups == 'Super-Admin-User' || $session_user_data->groups == 'OGS-User'){?>
                                                            <li><a class="menu popover-close" data-popoverid=".participant-menu-popover-<?=$participant_data->ID?>" data-toggle="modal" data-target="#myEditModal_<?=$participant_data->ID?>"><i class="fa fa-pencil icon"></i> Edit</a></li>
                                                        <?php }?>
                                                        <?php  
                                                        if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-Admin' || $session_user_data->groups == 'RG-SUPER-Admin' || $session_user_data->groups == 'Admin-User' || $session_user_data->groups == "Super-Admin-User" || $session_user_data->groups == 'OGS-User' || $session_user_data->groups == 'Sessions-Admin'){?>
                                                            <li><a class="menu popover-close" data-popoverid=".participant-menu-popover-<?=$participant_data->ID?>" data-toggle="modal" data-target="#sessionsInvite_<?=$participant_data->ID?>"><i class="fa fa-pencil icon"></i> Sessions invite</a></li>
                                                        <?php }?>
                                                        <li><a class="menu popover-close" data-popoverid=".participant-menu-popover-<?=$participant_data->ID?>"><i class="fa fa-times icon"></i> Close</a></li>
                                                    </ul>
                                                </form>
                                            </div>
                                            

                                            <script>
                                                $(function(){
                                                    // Enables popover #2
                                                    $(".participant-menu-popover-<?=$participant_data->ID?>").popover({
                                                        html : true, 
                                                        placement : 'bottom', 
                                                        trigger: 'manual',
                                                        content: function() {
                                                          return $("#participant-menu-content-<?=$participant_data->ID?>").html();
                                                        },
                                                        title: function() {
                                                          return $("#participant-menu-title-<?=$participant_data->ID?>").html();
                                                        }
                                                    });
                                                });
                                            </script>
                                        </td>
                                      </tr>	
                              <!-- Modal -->
                                            <div class="modal fade" id="myModal_<?=$participant_data->ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">More Details</h4>
                                                  </div>
                                                  <div class="modal-body">


                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Unique ID</div>
                                                          <div class="participant_details-a"><?=$participant_data->code?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i">
                                                          <div class="participant_details-q">Category</div>
                                                          <div class="participant_details-a">
                                                                <?php
                                                                    echo $participant_data->category;
                                                                ?>             
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Pass type</div>
                                                          <div class="participant_details-a"><?=$participant_data->pass_type?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Names</div>
                                                          <div class="participant_details-a"><?=$participant_data->firstname?> <?=$participant_data->lastname?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Email</div>
                                                          <div class="participant_details-a"><?=$participant_data->email?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Telephone</div>
                                                          <div class="participant_details-a"><?=$participant_data->telephone?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Telephone office</div>
                                                          <div class="participant_details-a"><?=$participant_data->telephone_office?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Company name</div>
                                                          <div class="participant_details-a"><?=$participant_data->company_name?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Company category</div>
                                                          <div class="participant_details-a"><?=$participant_data->company_category?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Company Address</div>
                                                          <div class="participant_details-a"><?=$participant_data->company_address?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Job title</div>
                                                          <div class="participant_details-a"><?=$participant_data->jobtitle?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Website</div>
                                                          <div class="participant_details-a"><?=$participant_data->website?></div>
                                                        </div>
                                                    </div>

                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Country of Residence </div>
                                                          <div class="participant_details-a"><?=$participant_data->residence_country?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >City of Residence</div>
                                                          <div class="participant_details-a"><?=$participant_data->residence_city?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Country Citizenship</div>
                                                          <div class="participant_details-a"><?=$participant_data->citizenship_country?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Document type</div>
                                                          <div class="participant_details-a"><?=$participant_data->document_type?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Document number</div>
                                                          <div class="participant_details-a"><?=$participant_data->document_number?></div>
                                                        </div>
                                                    </div>
                                                      
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Payment method</div>
                                                          <div class="participant_details-a"><?=$participant_data->payment_method?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Amount</div>
                                                          <div class="participant_details-a"><?=$participant_data->amount?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Payment rn</div>
                                                          <div class="participant_details-a"><?=$participant_data->payment_rn?></div>
                                                        </div>
                                                    </div>
                                                      
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Added date</div>
                                                          <div class="participant_details-a"><?=$participant_data->added_date?></div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >State</div>
                                                          <div class="participant_details-a"><?=$participant_data->state?></div>
                                                        </div>
                                                    </div>
                                                    <div class="participant_details">
                                                        <div class="participant_details-i" >
                                                          <div class="participant_details-q" >Form</div>
                                                          <div class="participant_details-a"><?=$participant_data->form?></div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer" style="text-align: left">
                                                         
                                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>





                                    <!-- Modal -->
                                            <!-- Edit modal -->
                                            <div class="modal fade" id="myEditModal_<?=$participant_data->ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Edit category</h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <?php
                                                                $foredit = 'edit';
                                                                include 'participant_edit'.P;
                                                            ?>
                                                        </div>
                                                        <div class="modal-footer" style="text-align: left">
                                                                 
                                                            <?php if($participant_data->category == "Speaker" || $participant_data->category == "Media"){
                                                                $participant_attach = @end(@explode("/",$participant_data->path));
                                                                if($participant_attach){
                                                                  ?>
                                                                  <div style="display: inline-block"> 
                                                                  <a href="<?=DN._.$participant_data->path?>" class="pull-left btn-sm btn btn-default" download="<?=$participant_attach?>">
                                                                     <span class="glyphicon glyphicon-download-alt"></span> Attachment 
                                                                    </a>
                                                                      <span style="display: inline-block; margin: 5px"><?php echo $participant_attach?></span>
                                                                  </div>
                                                                <?php }?>
                                                            <?php }?>
                                                            <button name="edit" type="submit" class="btn btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- Edit modal -->
                                            <div class="modal fade" id="sessionsInvite_<?=$participant_data->ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Invite <?=$participant_data->firstname?> <?=$participant_data->lastname?></h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <?php
                                                                $foredit = 'edit';
                                                                include 'participant_sessions'.P;
                                                            ?>
                                                        </div>
                                                        <div class="modal-footer" style="text-align: left">
                                                                 
                                                            <?php if($participant_data->category == "Speaker" || $participant_data->category == "Media"){
                                                                $participant_attach = @end(@explode("/",$participant_data->path));
                                                                if($participant_attach){
                                                                  ?>
                                                                  <div style="display: inline-block"> 
                                                                  <a href="<?=DN._.$participant_data->path?>" class="pull-left btn-sm btn btn-default" download="<?=$participant_attach?>">
                                                                     <span class="glyphicon glyphicon-download-alt"></span> Attachment 
                                                                    </a>
                                                                      <span style="display: inline-block; margin: 5px"><?php echo $participant_attach?></span>
                                                                  </div>
                                                                <?php }?>
                                                            <?php }?>
                                                            <button name="sessions" type="submit" class="btn btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- end of sessions  -->
                                    <!-- end of modal -->




                                  <?php }?>
                                <tr>
                                    <?php 
                                        if(Input::checkInput('keyword','get','0') || strlen(Input::get('keyword','get'))<3){?>
                                    <td colspan="9">
                                        <?php include 'views/pagination'.PL;?>
                                    </td>
                                    <?php }?>
                                </tr>
                            <?php }else{?>
                                <tr>
                                    <td colspan="7"><br/>No Participant recorded</td>
                                </tr>
                            <?php }?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                        
                        <script>
                            $(document).on("click", ".popover-close", function(e) {
                                $($(this).data('popoverid')).popover('hide');
                                $($(this).data('popoverid')).removeClass('open');
                            });
                            
                            $('.popover-el').click(function (e) {
                                if(!$(this).hasClass('open')){
                                    $(this).popover('show');
                                    $(this).addClass('open');
                                }else{
                                    $(this).popover('hide');
                                    $(this).removeClass('open');
                                }
                            });

                       
                            $(document).ready(function(){
                                $('body').on('click', function (e) {
                                    $('.popover-el.open').each(function () {
                                        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                                            $(this).popover('hide');
                                            $(this).removeClass('open');
                                        }
                                    });
                                });
                            });
                        </script>
                        
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                      <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-list" class="btn btn-sm btn-default btn-flat pull-right">View All Participants</a>
                        <?php  
                            if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-Admin' || $session_user_data->groups == 'RG-SUPER-Admin' || $session_user_data->groups == 'Super-Admin-User' || $session_user_data->groups == 'OGS-User'){?>
                            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-list-exportdelegate" class="btn btn-sm btn-primary btn-flat pull-right">Export</a>
                        <?php } ?>
                    </div>
                    <!-- /.box-footer -->
                </div>
              
              
                
                    <div class="box collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">List color code</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="box-body" style="display: none;">

                            <div class="pull-left" >
                                <span type="button"style="background: orange; color: #fff; padding: 3px 5px">Pending</span>
                                <span type="button" style="background: red; color: #fff; padding: 3px 5px">Pending delaying</span>
                                <span type="button" style="background: #01aef0; color: #fff; padding: 3px 5px">Payment Delaying</span>
                                <span type="button" style="background: #18ab86; color: #fff; padding: 3px 5px">Pass Confirmed</span>
                                <span type="button" style="background: #fb00a1; color: #fff; padding: 3px 5px">Denied & Need refund</span>
                                <span type="button" style="background: #777; color: #fff; padding: 3px 5px">Denied</span>
                            </div>
                        </div>
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