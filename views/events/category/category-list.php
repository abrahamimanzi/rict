<style>
    th button{
        border: 0;
        background: transparent;
    }
</style>
<?php include 'category-content_header'.PL;?>
<?php include 'category-content_navbar'.PL;?>


<!-- Main content -->
<section class="content">
		
 <!-- Small boxes (Stat box) -->
	  <div class="row">
          <div class="col-sm-12 col-md-8">
                 <!--RECENT REGISTER -->
              <div>
                  
                <?php 

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
                      <h3 class="box-title">Category list</h3>

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
                                <th><button type="submit" name="sort-id">ID</button></th>
                                <th>Names</th>
                                <th>Prefix</th>
                                <th>String</th>
                              </tr>
                            </form>
                          </thead>
                          <tbody>
                            <?php
                              
                                
                              
                            if(Input::checkInput('keyword','get','0') || strlen(Input::get('keyword','get'))<3){
                                
                              $participantCategTable = new ParticipantCategory();
                              $participantCategTable->selectQuery("SELECT * FROM `events_participant_category`");
                                
                            }
                              
								if($participantCategTable->count()){
									$i = 0;
									foreach($participantCategTable->data() as $participant_category_data){
										$i++;
                                        $participant_ID = $participant_category_data->ID;
                                        ?>

                                      <tr class="row_layout">
                                        <td style="width: 90px">
                                            <a style="border-color: <?=$stateColor?>" class="id popover-el participant-menu-popover-<?=$participant_category_data->ID?>"><?=$i;?> </a>
                                        </td>
                                        <td><?=$participant_category_data->name?></td>
                                        <td><?=$participant_category_data->prefix?></td>
                                        <td><?=$participant_category_data->url?></td>
                                        
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
                    <div class="box-footer clearfix">
                     
                        
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