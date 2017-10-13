
				<div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">All Users</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            All Users
                        </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Profile</th>
                                                <th>Full name</th>
                                                <th>Email</th>
                                                <th>Group</th>
												<?php 
												if($session_user_data->groups == 'Admin'){?>
                                                <th>Last login</th>
												<?php }?>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$userClass = new User();
											$userClass->select("WHERE `groups`!='Deleted'");
											/*Start Pagination Setting*/
												$rowsLimit = 15;
												$pageNumber = 0;
												if(Input::checkInput('page','get','1')){
													$pageNumber = (int)sanAsID(Input::get('page','get'));
												}
												$requesturl = "?request=users";
												
												$totalStore=$userClass->count();
												$totalPages = upfloat($totalStore/$rowsLimit);
												$offsetNumber = $pageNumber*$rowsLimit;
												if($offsetNumber >= $totalStore){
													$pageNumber=0;
													$offsetNumber = $pageNumber*$rowsLimit;
												}
											/*End Pagination Setting*/
								
											$userClass->select("WHERE `groups`!='Deleted' LIMIT {$offsetNumber},{$rowsLimit}");
											if($userClass->count()){
												$i = 0;
												foreach($userClass->data() as $user_data){
													$i++;
												?>
												<tr>
													<td style="width: 50px"><?php echo $i;?></td>
													<td>
														<img src="<?php echo $user_data->profile;?>" style="width: 50px">	
													</td>
													<td>
														<?php echo $user_data->fullname;?>
														<?php if($session_user_ID == $user_data->ID){ ?><span style="font-size: 13px; color: green;" class="glyphicon glyphicon-user"></span><?php }?>
													</td>
													<td>
														<?php echo $user_data->email;?>
													</td>
													
													<td><?php echo $user_data->groups;?></td>
													
													<?php  if($session_user_data->groups == 'Admin'){?>
													<td>
														
														<?php
														if(is_numeric($user_data->last_login)){
															echo Dates::get_timeago($user_data->last_login);
														}else{
															echo 'Never used';
														}?>
														
													</td>
													<?php }?>
													
													<td style="width: 70px;">
														
														<?php if(accessKey('1') || $session_user_ID == $user_data->ID){?>
															<a class="btn btn-xs btn-default" href="?request=edituser&id=<?php echo $user_data->ID;?>" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
														<?php }?>
													</td>
												</tr>
												<?php }?>
												<tr>
													<td colspan="8">
														<?php include 'views/pagination'.PL;?>
													</td>
												</tr>
											<?php }else{?>
												<tr>
													<td><br/>No article recorded</td>
												</tr>
											<?php }?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>