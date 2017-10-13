<style>
    .popover-content{
        width: 140px   
    }
</style>
<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
					<i class="fa fa-users fa-lg pink-col"></i> Users
					<small></small>
				</h3>
			</div>
			<div class="col-xs-12 col-sm-4 hidden-xs">
				<!-- Main search form -->
				<form action="#" method="get" class="mainsearch-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Quick search">
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
                <a href="<?=DN?>"> <i class="fa fa-home"></i> Home </a>
              </li>
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Users
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 83px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                        
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-SUPER-Admin'){?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/users/new">
                          <i class="fa fa-plus text-blue"></i>New user
                        </a>
                      </li><!-- end notification -->
                    <?php }?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/users/list">
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
                 <!--RECENT REGISTER -->
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">User</h3>

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
                            <th>Names</th>
                            <th>Email</th>
                            <th style="width: 90px">Access Type</th>
                            <th style="width: 90px">Status</th>
                            <th style="width: 60px">Menu</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                                $userTable = new User();
                                $userTable->selectQuery("SELECT * FROM `app_users` WHERE `company_ID`=? AND `state`!= 'Deleted'",array($session_company_ID));
                                if(!$userTable->count()){
                                    Functions::errorPage(404);
                                }else{
                                    $i = 0;
                                    foreach($userTable->data() as $user_data){
                                        $i++;
                                        $user_ID = $user_data->ID;
                                        if($user_data->ID == $session_company_data->user_ID) continue;
                                    ?>
                                      <?php if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID || $session_user_data->groups == "RG-Admin" || $session_user_data->groups == "RG-SUPER-Admin"){?>
                                      <tr <?php if($user_data->state =='Blocked'){?>style="color: #aaa"<?php }?>>
                                        <td><a><?=$i;?></a></td>
                                        <td><?=$user_data->firstname.' '.$user_data->lastname?></td>
                                        <td><?=$user_data->email?></td>
                                        <?php if($user_data->state !='Blocked'){?>
                                            <td><span class="label label-<?php echo $user_data->account_session == '1'? 'success' : 'info'; ?>">
                                            <?php
                                              if ($user_data->groups=='End-User') {
                                                echo "View-User";
                                              }else{
                                                echo $user_data->groups;
                                              }
                                            // $user_data->groups;
                                            ?>
                                            </span>
                                            </td>
                                        <?php }else{?>
                                          <td><span class="label label-default"><?=$user_data->groups?></span></td>
                                        <?php }?>
                                        <td><?=$user_data->state?></td>
                                        <td>
                                          <div><a class="user-menu-popover-<?=$user_data->ID?>  popover-el" style="cursor: pointer">More</a></div>

                                            <div id="user-menu-content-<?=$user_data->ID?>" class="hidden">
                                                <form method="post">
                                                    <input type="hidden" name="webToken" value="56">
                                                    <input type="hidden" name="request" value="user-state">
                                                    <input type="hidden" name="user-id" value="<?=$user_data->ID?>">
                                                    <ul class="popover-menu-list">

								                                        <?php if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID || $session_user_data->groups == "RG-Admin" || $session_user_data->groups == "RG-SUPER-Admin"){?>
                                                            <li><a class="menu" href="<?=DN."/company/users/$user_data->ID/edit";?>"><i class="fa fa-pencil icon"></i> Edit</a></li>
                                                            <li><a class="menu" href="<?=DN."/company/users/$user_data->ID/edit-password";?>"><i class="fa fa-unlock-alt icon"></i> Change password</a></li>
                                                            <?php if($session_user_data->ID!=$user_data->ID){?>
                                                                <?php if($user_data->state!='Blocked'){?>
                                                                <li> 
                                                                    <button class="menu" name="block" type="submit"><i class="fa fa-times-circle icon"></i> Block</button>
                                                                </li>
                                                                <?php }?>
                                                                <?php if($user_data->state!='Activated'){?>
                                                                <li> 
                                                                    <button class="menu" name="activate" type="submit"><i class="fa fa-times-circle icon"></i> Activate</button>
                                                                </li>
                                                                <?php }?>
                                                            <?php }?>
                                                        <?php }?>
                                                        
                                                        
                                                        </li><li role="separator" class="divider"></li>
                                                        <li><a class="menu popover-close" data-popoverid=".user-menu-popover-<?=$user_data->ID?>"><i class="fa fa-times icon"></i> Close</a></li>

                                                    </ul>
                                                </form>
                                            </div>

                                            <script>
                                                $(function(){
                                                    // Enables popover #2
                                                    $(".user-menu-popover-<?=$user_data->ID?>").popover({
                                                        html : true, 
                                                        placement : 'bottom', 
                                                        trigger: 'manual',
                                                        content: function() {
                                                          return $("#user-menu-content-<?=$user_data->ID?>").html();
                                                        },
                                                        title: function() {
                                                          return $("#user-menu-title-<?=$user_data->ID?>").html();
                                                        }
                                                    });
                                                });
                                            </script>
                                        </td>
                                      </tr>
                                      <?php } ?>
                                    <?php   
                                    }
                                }?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-SUPER-Admin'){?>
                    <div class="box-footer clearfix">
                      <a href="<?=DN?>/company/users/new" class="btn btn-sm btn-info btn-flat pull-left">Create New User</a>
                    </div>
                    <?php }?>
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