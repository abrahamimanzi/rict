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
          <i class="fa fa-users fa-lg pink-col"></i> Subscribers
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
                        
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'YCA-Admin' || $session_user_data->groups == "YCA-SUPER-Admin" || $session_user_data->groups == "RG-Admin" || $session_user_data->groups == "RG-SUPER-Admin"){?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/subscriber/new">
                          <i class="fa fa-plus text-blue"></i>New subscriber
                        </a>
                      </li><!-- end notification -->
                    <?php }?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/subscriber/list">
                            <i class="fa fa-bars text-blue"></i>Menu
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
                      <h3 class="box-title">List</h3>

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
                            <th>Company</th>
                            <th style="width: 90px">Status</th>
                            <th style="width: 60px">Plan</th>
                            <th style="width: 60px">Menu</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                                $subscriberTable = new Subscriber();
                                $subscriberTable->selectQuery("SELECT * FROM `subscriber` WHERE `type`= 'Individual' AND `state`!= 'Deleted'");
                                if($subscriberTable->count()){
                                    $i = 0;
                                    foreach($subscriberTable->data() as $subscriber_data){
                                        $i++;
                                        $subscriber_ID = $subscriber_data->ID; ?>

                                      <tr <?php if($subscriber_data->state =='Blocked'){?>style="color: #aaa"<?php }?>>
                                        <td><a><?=$i;?></a></td>
                                        <td><?=$subscriber_data->firstname.' '.$subscriber_data->lastname?></td>
                                        <td><?=$subscriber_data->email?></td>
                                        <td><?=$subscriber_data->company_name?></td>
                                        <td><?=$subscriber_data->state?></td>
                                        <?php if ($subscriber_data->type == 'Group') {?>
                                        <td class="text-center"><a href="<?=DN."/company/subscriber/$subscriber_data->ID/category";?>">View</a></td>
                                        <?php
                                        }else{ ?>
                                        <td class="text-center"><a href="<?=DN."/company/subscriber/$subscriber_data->ID/categoryinvite";?>">View</a></td>
                                        <?php } ?>
                                        <td>
                                          <div><a class="subscriber-menu-popover-<?=$subscriber_data->ID?>  popover-el" style="cursor: pointer">More</a></div>

                                            <div id="subscriber-menu-content-<?=$subscriber_data->ID?>" class="hidden">
                                                <form method="post">
                                                    <input type="hidden" name="webToken" value="56">
                                                    <input type="hidden" name="request" value="subscriber-state">
                                                    <input type="hidden" name="subscriber-id" value="<?=$subscriber_data->ID?>">
                                                    <ul class="popover-menu-list">
                                         <?php if($session_user_data->groups == "Admin" || $session_user_data->groups == "YCA-Admin" || $session_user_data->groups == "YCA-SUPER-Admin" || $session_user_data->groups == "RG-SUPER-Admin" || $session_user_data->groups == "RG-Admin"){?>
                                                            <li><a class="menu" href="<?=DN."/company/subscriber/$subscriber_data->ID/category";?>"><i class="fa fa-pencil icon"></i> Set Passes</a></li>
                                                        <?php }?>
                                                        
                                                        <li><a class="menu popover-close" data-popoverid=".subscriber-menu-popover-<?=$subscriber_data->ID?>"><i class="fa fa-times icon"></i> Close</a></li>

                                                    </ul>
                                                </form>
                                            </div>

                                            <script>
                                                $(function(){
                                                    // Enables popover #2
                                                    $(".subscriber-menu-popover-<?=$subscriber_data->ID?>").popover({
                                                        html : true, 
                                                        placement : 'bottom', 
                                                        trigger: 'manual',
                                                        content: function() {
                                                          return $("#subscriber-menu-content-<?=$subscriber_data->ID?>").html();
                                                        },
                                                        title: function() {
                                                          return $("#subscriber-menu-title-<?=$subscriber_data->ID?>").html();
                                                        }
                                                    });
                                                });
                                            </script>
                                        </td>
                                      </tr>
                              
                                    <?php   
                                    }
                                }else{?>
                                <tr>
                                    <td colspan="7">Empty list</td>    
                                </tr>
                                    <?php
                                }
                              ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'YCA-Admin' || $session_user_data->groups == "YCA-SUPER-Admin" || $session_user_data->groups == "RG-Admin" || $session_user_data->groups == "RG-SUPER-Admin"){?>
                    <div class="box-footer clearfix">
                      <a href="<?=DN?>/company/subscriber/newinvite" class="btn btn-sm btn-info btn-flat pull-left">Create New Individual Admin</a>
                    </div>
                    <?php }?>
                    <!-- /.box-footer -->
                  </div>
                 <!--RECENT REGISTER -->
          </div>
          <div class="col-sm-8">
                 <!--RECENT REGISTER -->
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">List</h3>

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
                            <!-- <th>Company</th> -->
                            <!-- <th style="width: 90px">Status</th> -->
                            <th style="width: 60px">Plan</th>
                            <th style="width: 60px">Menu</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                                $subscriberTable = new Subscriber();
                                // $subscriberTable->selectQuery("SELECT * FROM `subscriber` WHERE `type`= 'Individual' AND `state`!= 'Deleted'");
                                $subscriberTable->selectQuery("SELECT * FROM `subscriber_category_invite` WHERE `status` != 'Available'");
                                if($subscriberTable->count()){
                                    $i = 0;
                                    foreach($subscriberTable->data() as $subscriber_data){
                                        $i++;
                                        $subscriber_ID = $subscriber_data->ID; ?>

                                      <!-- <tr <?php if($subscriber_data->state =='Blocked'){?>style="color: #aaa"<?php }?>> -->
                                      <tr>
                                        <td><a><?=$i;?></a></td>
                                        <td><?=$subscriber_data->firstname.' '.$subscriber_data->lastname?></td>
                                        <td><?=$subscriber_data->email?></td>
                                        <!-- <td><?=$subscriber_data->company_name?></td> -->
                                        <!-- <td><?=$subscriber_data->state?></td> -->
                                        <?php /* if ($subscriber_data->type == 'Group') { */?>
                                        <?php if ($subscriber_data->status == 'Invited') {?>
                                        <td class="text-center">

                                                  <form method="post" id="reg-form" class="form-horizontal">
                                                      <input value="<?=$subscriber_data->firstname?>" name="subscriber-firstname" type="hidden" class="form-control rl_store custom_input input-md" placeholder="First name">
                                                      <input value="<?=$subscriber_data->lastname?>" type="hidden" name="subscriber-lastname" class="form-control rl_store custom_input input-md" placeholder="Last name">
                                                      <input value="<?=$subscriber_data->email?>" type="hidden" name="subscriber-email" class="form-control rl_store custom_input input-md" placeholder="Email">
                                                      <input type="hidden" name="webToken" value="1">
                                                      <input type="hidden" name="invite_submited" value="1">
                                                      <input type="hidden" name="subscriber-id" value="<?=$subscriber_data->ID?>">
                                                      <input type="hidden" name="request" value="subscriber-new-invite-reminder">
                                                      <input type="hidden" name="invite-event_token" value="de220168957bd2ccff08f88e9939b95f">
                                                      
                                                      <?php if($subscriber_data->status == 'Invited'){?>
                                                      <button type="submit" name="inviteReminderBtn" class="btn green-bg dark-color btn-success btn-xs pull-right"> Reminder </button>
                                                      <?php }?>
                                                      
                                                  </form>
                                          <!-- <a href="<?=DN."/company/subscriber/$subscriber_data->ID/category";?>">View</a> -->
                                        </td>
                                        <?php
                                        }else{ ?>
                                        <td class="text-center"> </td>
                                        <?php } ?>
                                        <td>
                                          <div><a class="subscriber-menu-popover-<?=$subscriber_data->ID?>  popover-el" style="cursor: pointer">More</a></div>

                                            <div id="subscriber-menu-content-<?=$subscriber_data->ID?>" class="hidden">
                                                <form method="post">
                                                    <input type="hidden" name="webToken" value="56">
                                                    <input type="hidden" name="request" value="subscriber-state">
                                                    <input type="hidden" name="subscriber-id" value="<?=$subscriber_data->ID?>">
                                                    <ul class="popover-menu-list">
                                         <?php if($session_user_data->groups == "Admin" || $session_user_data->groups == "YCA-Admin" || $session_user_data->groups == "YCA-SUPER-Admin" || $session_user_data->groups == "RG-SUPER-Admin" || $session_user_data->groups == "RG-Admin"){?>
                                                            <li><a class="menu" href="<?=DN."/company/subscriber/$subscriber_data->ID/category";?>"><i class="fa fa-pencil icon"></i> Set Passes</a></li>
                                                        <?php }?>
                                                        
                                                        <li><a class="menu popover-close" data-popoverid=".subscriber-menu-popover-<?=$subscriber_data->ID?>"><i class="fa fa-times icon"></i> Close</a></li>

                                                    </ul>
                                                </form>
                                            </div>

                                            <script>
                                                $(function(){
                                                    // Enables popover #2
                                                    $(".subscriber-menu-popover-<?=$subscriber_data->ID?>").popover({
                                                        html : true, 
                                                        placement : 'bottom', 
                                                        trigger: 'manual',
                                                        content: function() {
                                                          return $("#subscriber-menu-content-<?=$subscriber_data->ID?>").html();
                                                        },
                                                        title: function() {
                                                          return $("#subscriber-menu-title-<?=$subscriber_data->ID?>").html();
                                                        }
                                                    });
                                                });
                                            </script>
                                        </td>
                                      </tr>
                              
                                    <?php   
                                    }
                                }else{?>
                                <tr>
                                    <td colspan="7">Empty list</td>    
                                </tr>
                                    <?php
                                }
                              ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'YCA-Admin' || $session_user_data->groups == "YCA-SUPER-Admin" || $session_user_data->groups == "RG-Admin" || $session_user_data->groups == "RG-SUPER-Admin"){?>
                    <div class="box-footer clearfix">
                      <a href="<?=DN?>/company/subscriber/newinvite" class="btn btn-sm btn-info btn-flat pull-left">Create New Individual Admin</a>
                    </div>
                    <?php }?>
                    <!-- /.box-footer -->
                  </div>
                 <!--RECENT REGISTER -->
          </div>
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