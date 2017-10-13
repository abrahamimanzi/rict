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
                    <i class="fa fa-user fa-lg pink-col"></i> Group booking Admin <i class="fa fa-angle-double-right"></i> <?php echo $subscriber_data->firstname.' '.$subscriber_data->lastname;?>
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
                <a href="<?=DN?>/company/subscriber/admins"> <i class="fa fa-angle-double-left"></i> Back </a>
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
          <div class="col-sm-12 col-md-8">
                <!--RECENT REGISTER -->
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Purchased Passes list</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Names</th>
                                <th>Total</th>
                                <th>Registered</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php

                                $subscategTable = new \SubscriberCategory();
                                $subscategTable->selectQuery("SELECT* FROM `subscriber_category` WHERE `subscriber_ID`=? AND `type`='Allocated'",array($subscriber_ID));

                                if($subscategTable->count()){
                                    $i = 0;
                                    foreach($subscategTable->data() as $subscateg_data){
                                        $i++;
                                        $category_ID = $subscateg_data->category_ID;
                                        $size_used = $subscateg_data->size_used;
                                        $linkexists = false;
                                        $size_used = '';


                                        $categTable = new ParticipantCategory();
                                        $categTable->selectQuery("SELECT * FROM `events_participant_category` WHERE `ID`=? ORDER BY `type`",array($category_ID));

                                        $linkexists = true;
                                        $category_data = $categTable->first();
                                        ?>

                                      <tr class="row_layout">
                                        <td  style="width: 40px">
                                            <a style="width: 40px" class="id popover-el participant-menu-popover-<?=$category_data->ID?>"><?=$i;?> </a>
                                        </td>
                                        <td style="width: 250px"><?=$category_data->name?></td>

                                        <td><?=$subscateg_data->size?></td>
                                        <td class="text-center"><?=$size_used?></td>

                                      </tr>	
                                  <?php }?>
                            <?php }else{?>
                                <tr>
                                    <td colspan="7"><br/>Empty Purchased Pass list</td>
                                </tr>
                            <?php }?>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->

                    </div>
                </div>
                <!--RECENT REGISTER -->
          </div>
	  </div><!-- /.row -->
		
 <!-- Small boxes (Stat box) -->
	  <div class="row">
          <div class="col-sm-12 col-md-8">
                 <!--RECENT REGISTER -->
              
              <form method="post">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Assigned Passes list</h3>

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
                              $categTable->selectQuery("SELECT * FROM `events_participant_category` WHERE `interface`='group' ORDER BY `ID`");
                             
              								if($categTable->count()){
              									$i = 0;
              									foreach($categTable->data() as $category_data){
              										$i++;
                                        $category_ID = $category_data->ID;
                                        $linkexists = false;
                                        $size_used = '';
                                        
                                        $subscategTable = new \SubscriberCategory();
                                        $subscategTable->selectQuery("SELECT* FROM `subscriber_category` WHERE `subscriber_ID`=? AND `category_ID`=? AND `type`='Assigned'",array($subscriber_ID,$category_ID));
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
                                        
                                        <td  class="text-center"><input id="<?=$category_data->name?>_check" type="checkbox" name="subscateg-<?=$category_data->name?>" onChange="Checkother1(this,'#<?=$category_data->name?>_size')" value="true" class="<?php echo $linkexists == true ? 'checked' : ''; ?>" <?php echo $linkexists == true ? 'checked' : ''; ?> disabled="disabled"></td>
                                        
                                        <td><input id="<?=$category_data->name?>_size" type="text" name="subscateg-<?=$category_data->name?>_size" style="width: 80px" maxlength="4" <?php if($linkexists){?> value="<?=$subscateg_data->size?>" <?php }else{ ?>disabled="disabled"<?php }?> disabled="disabled"></td>
                                        <td class="text-center"><?=$size_used?></td>
                                        <?php  ?>
                                        <td>
                                            <?php
                                            if($category_data->type == 'paid'){?>
                                            <span>Paid</span>
                                                <input id="<?=$category_data->name?>_plan" type="hidden" name="subscateg-<?=$category_data->name?>_plan" maxlength="4" value="discount" disabled="disabled">

                                                <!-- <select id="<?=$category_data->name?>_plan" name="subscateg-<?=$category_data->name?>_plan" >
                                                    <option <?php if(@$subscateg_data->plan=='Paid'){ echo 'selected="selected"'; }?> value="Paid">Paid</option>
                                                    <option <?php if(@$subscateg_data->plan=='Free'){ echo 'selected="selected"';}?> value="Free">Complimentary</option>
                                                </select> -->
                                            <?php
                                            }elseif($category_data->type == 'discount'){?>
                                            <span>Discount</span>
                                                <input id="<?=$category_data->name?>_plan" type="hidden" name="subscateg-<?=$category_data->name?>_plan" maxlength="4" value="discount" disabled="disabled">

                                            <?php }else{?>
                                            <span>Free</span>
                                                <input id="<?=$category_data->name?>_plan" type="hidden" name="subscateg-<?=$category_data->name?>_plan" maxlength="4" value="Free" disabled="disabled">
                                            <?php }?>
                                        </td>
                                        <?php  ?>
                                        <td class="text-center" >
                                            <?php
                                            if($category_data->type == 'discount'){?>
                                                <input class="text-center" style="width: 80px" id="<?=$category_data->name?>_discount" type="text" name="subscateg-<?=$category_data->name?>_discount" maxlength="2" <?php if($linkexists){?> value="<?=$subscateg_data->discount?>" <?php }?> disabled="disabled">
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
                       
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box-body -->
                    <input type="hidden" name="webToken" value="56">
                    <input type="hidden" name="request" value="subscateg-update">
                    <input type="hidden" name="id" value="<?php echo $subscriber_ID;?>">
                    <input type="hidden" name="token" value="true">
                    <input type="hidden" name="task" value="subscateg-update">
                    <div class="box-footer clearfix">
                        <a href="<?=DN?>/company/subscriber/list" class="btn btn-sm btn-default btn-flat pull-left">Back</a>
                        <!-- <button type="submit" value="Save" class="btn btn-sm btn-info btn-flat pull-right">Submit</button> -->
                    </div>
                    <!-- /.box-footer -->
                  </div>
              </form>
              
                
                 <!--RECENT REGISTER -->
          </div>
	  </div><!-- /.row -->

</section>

<script>
    function Checkother1(field,field1){
      var value = $(field).val();
      var name = $(field).attr('name');
      var name1 = $(field1).attr('name');
    if($(field).hasClass('checked')){
        $(field).removeClass('checked');
        $(field1).prop('disabled', true);
    }else{
        $(field).addClass('checked');
        $(field1).prop('disabled', false);
        var input =$(field1);
        input[0].selectionStart = input[0].selectionEnd = input.val().length;
    }
  }
</script>