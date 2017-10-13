
				<div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Web data</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Web data
                        </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
										
											<?php
											$agentClass = new About();
											$agentClass->select(" WHERE `state` != 'Deleted' LIMIT 1");
											if($agentClass->count()){
												$i = 0;
												foreach($agentClass->data() as $agent_data){
													$i++;
												?>
												<tr>
                                                    <th>#</th>
													<td><?php echo $i;?></td>
                                                </tr>
                                                <tr>
                                                    <th>Profile</th>
													<td>
														<img src="<?php echo $agent_data->profile;?>" style="width: 50px">	
													</td>
                                                </tr>
                                                <tr>
                                                    <th>Company name</th>
													<td>
														<?php echo $agent_data->name;?>
													</td>
												</tr>
                                                <tr>
                                                    <th>Address</th>
													<td><?php echo $agent_data->address;?></td>
												</tr>
                                                <tr>
                                                    <th>Email</th>
													<td><?php echo $agent_data->email;?></td>
                                                </tr>
                                                <tr> 
                                                    <th>Description</th>
													<td><?php echo $agent_data->description;?></td>
												</tr>
                                                <tr> 
                                                    <th>Mission</th>
													<td><?php echo $agent_data->mission;?></td>
												</tr>
                                                <tr> 
                                                    <th>Vision</th>
													<td><?php echo $agent_data->vision;?></td>
												</tr>
                                                <tr> 
                                                    <th>Work Motiv.</th>
													<td><?php echo $agent_data->work_motiv;?></td>
												</tr>
                                                <tr>
                                                    <th>Team word</th>
													<td>
														<?php echo $agent_data->teamword;?>
													</td>
                                                </tr>
                                                <tr>
                                                    <th>Links</th>
													<td>
                                                        <?php if($agent_data->facebooklink){?>
                                                        <a href="<?php echo $agent_data->facebooklink;?>" target="newtab">Facebook</a>
                                                         <?php }?>
                                                        <?php if($agent_data->twitterlink){?>
                                                        <a href="<?php echo $agent_data->twitterlink;?>" target="newtab">Twitter</a> 
                                                        <?php }?>
                                                        <?php if($agent_data->youtubelink){?>
                                                        <a href="<?php echo $agent_data->youtubelink;?>" target="newtab">Youtube</a>
                                                         <?php }?>
													</td>
												</tr>
                                                <tr>
                                                    <th>Tweets</th>
													<td>
                                                        <?php if(!empty($agent_data->tweets)){?>
														Available
                                                        <?php }else{?>
														Not available
                                                        <?php }?>
													</td>
												</tr>
                                                <tr>
                                                        <th>Edit</th>
													<td>
														
													<?php if(accessKey('2')){?>
														<a href="?request=editabout">Edit</a>&nbsp;&nbsp;
													<?php }?>
														
													</td>
                                                </tr>
                                                <tr>
												</tr>
												<?php }?>
											<?php }else{?>
												<tr>
													<td><br/>No Agent recorded</td>
												</tr>
											<?php }?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>