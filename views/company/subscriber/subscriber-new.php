<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
					<i class="fa fa-users fa-lg pink-col"></i> Group Administrator
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
                <a href="<?=DN?>/"> <i class="fa fa-home"></i> Home </a>
              </li>
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Menu
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 83px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'Admin-User' || $session_user_data->groups == "Super-Admin-User" || $session_user_data->groups == "RG-SUPER-Admin" || $session_user_data->groups == "RG-Admin"){?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/subscriber/new">
                          <i class="fa fa-plus text-blue"></i>New user
                        </a>
                      </li><!-- end notification -->
                    <?php }?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/subscriber/list">
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
                      <h3 class="box-title">Create group admin</h3>

                      <div class="box-tools pull-right">
                        
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 30px; ">
                         
                          <label>First Name</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['firstname'][0];}?></span>
                          <input name="subscriber-firstname" class="form-control" placeholder="First name" <?php if($form->ERRORS && Input::get('subscriber-firstname','post')){?> value="<?php echo Input::get('subscriber-firstname','post');?>" <?php }?>>
                          <br>
                          <label>Last Name</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['lastname'][0];}?></span>
                          <input name="subscriber-lastname" class="form-control" placeholder="Last name" <?php if($form->ERRORS && Input::get('subscriber-lastname','post')){?> value="<?php echo Input::get('subscriber-lastname','post');?>" <?php }?>>
                          <br>
                          <label>Email</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['email'][0];}?></span>
                          <input name="subscriber-email" type="email" class="form-control" placeholder="Email" <?php if($form->ERRORS && Input::get('subscriber-email','post')){?> value="<?php echo Input::get('subscriber-email','post');?>" <?php }?>>
                          <br>
                          <label>Company name</label>
                            <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['company_name'][0];}?></span>
                          <input name="subscriber-company_name" class="form-control" placeholder="Company name" <?php if($form->ERRORS && Input::get('subscriber-company_name','post')){?> value="<?php echo Input::get('subscriber-company_name','post');?>" <?php }?>>
                          <br> 
                    </div>
                    <!-- /.box-body -->
                    <!-- -->

                      <?php /* ?>
                      <div class="box-header with-border">
                        <h3 class="box-title">Assigned Passes list</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                            <form method="post">
                              <tr>
                                <th>ID</th>
                                <th>Names</th>
                                <th>Apply</th>
                                <th>Total</th>
                                <th>Registered</th>
                                <th>Payment</th>
                                <th>Discount</th>
                              </tr>
                            </form>
                          </thead>
                          <tbody>
                            <?php
                              
                              $categTable = new ParticipantCategory();
                              $categTable->selectQuery("SELECT * FROM `events_participant_category` ORDER BY `type`");
                             
                              if($categTable->count()){
                                $i = 0;
                                foreach($categTable->data() as $category_data){
                                  $i++;
                                        $category_ID = $category_data->ID;
                                        $linkexists = false;
                                        $size_used = '';
                                        
                                        $subscategTable = new \SubscriberCategory();
                                        // $subscategTable->selectQuery("SELECT* FROM `subscriber_category` WHERE `subscriber_ID`=? AND `category_ID`=? AND `type`='Assigned'",array($subscriber_ID,$category_ID));
                                        $subscategTable->selectQuery("SELECT* FROM `subscriber_category`");
                                        if($subscategTable->count()){
                                            $linkexists = true;
                                            $subscateg_data = $subscategTable->first();
                                            $size_used = $subscateg_data->size_used;
                                        }else{
                                            $subscateg_data = '';
                                        }
                                        ?>

                                      <tr class="row_layout">
                                        <td  style="width: 40px">
                                            <a style="width: 40px" class="id popover-el participant-menu-popover-<?=$category_data->ID?>"><?=$i;?> </a>
                                        </td>
                                        <td style="width: 250px"><?=$category_data->name?></td>
                                        
                                        <td  class="text-center"><input id="<?=$category_data->name?>_check" type="checkbox" name="subscateg-<?=$category_data->name?>" onChange="Checkother1(this,'#<?=$category_data->name?>_size')" value="true" class="<?php echo $linkexists == true ? 'checked' : ''; ?>" <?php echo $linkexists == true ? 'checked' : ''; ?>></td>
                                        
                                        <td><input id="<?=$category_data->name?>_size" type="text" name="subscateg-<?=$category_data->name?>_size" style="width: 80px" maxlength="4" <?php if($linkexists){?> value="<?=$subscateg_data->size?>" <?php }else{ ?>disabled="disabled"<?php }?> ></td>
                                        <td class="text-center"><?=$size_used?></td>
                                        <td>
                                            <?php
                                            if($category_data->type == 'paid'){?>
                                                <select id="<?=$category_data->name?>_plan" name="subscateg-<?=$category_data->name?>_plan" >
                                                    <option <?php if(@$subscateg_data->plan=='Paid'){ echo 'selected="selected"'; }?> value="Paid">Paid</option>
                                                    <option <?php if(@$subscateg_data->plan=='Free'){ echo 'selected="selected"';}?> value="Free">Complimentary</option>
                                                </select>
                                            <?php }else{?>
                                            <span>Free</span>
                                                <input id="<?=$category_data->name?>_plan" type="hidden" name="subscateg-<?=$category_data->name?>_plan" maxlength="4" value="Free" >
                                            <?php }?>
                                        </td>
                                        <td class="text-center" >
                                            <?php
                                            if($category_data->type == 'paid'){?>
                                                <input class="text-center" style="width: 80px" id="<?=$category_data->name?>_discount" type="text" name="subscateg-<?=$category_data->name?>_discount" maxlength="2" <?php if($linkexists){?> value="<?=$subscateg_data->discount?>" <?php }?>>
                                            <?php }else{?>
                                            <span>--</span>
                                                <input id="<?=$category_data->name?>_discount" value="0" type="hidden" name="subscateg-<?=$category_data->name?>_discount" maxlength="2" value="Free" >
                                            <?php }?>
                                        </td>
                                          
                                      </tr> 
                                  <?php }?>
                            <?php }else{?>
                                <tr>
                                    <td colspan="7"><br/>No Category recorded</td>
                                </tr>
                            <?php }?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                      <?php */ ?>


                    <!-- -->
                    <input type="hidden" name="webToken" value="56">
                    <input type="hidden" name="request" value="subscriber-new">
                    <div class="box-footer clearfix">
                        <a href="<?=DN?>/company/subscriber/list" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
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