<style>
    th button{
        border: 0;
        background: transparent;
    }
</style>


<script>
    $( function() {
        $( "#datepicker" ).datepicker();
    } );
</script>
<link href="<?=DN?>/plugins/multiple-select/multiple-select.css" rel="stylesheet"/>

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
                        <h3 class="box-title">Search Participant</h3>

                    <?php 
                        if(Input::checkInput('request','post',0)){
                        ?>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <?php }elseif(Input::checkInput('request','post',1)){ 
                            $bodySearchDisplay = "none";
                            ?>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool searchAgain">Search Again</i>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="bodyt" <?php if(isset($bodySearchDisplay)){?> style="display: none;" <?php } ?>>

                    <?php 
                        if(Input::checkInput('request','post',1)){

                        }
                        $operatorsArray = array(
                                                '='=>'=',
                                                '!='=>'!=',
                                                '>'=>'>',
                                                '>='=>'>=',
                                                '<'=>'<',
                                                '<='=>'<=',
                                                'LIKE ...%'=>'LIKE_LEFT',
                                                'LIKE %...%'=>'LIKE_MID',
                                                'LIKE %...'=>'LIKE_RIGHT',
                                                'NOT LIKE %...'=>'NOT_LIKE'
                                            );
                        $operatorsEqualContainsArray = array(
                                                'Equal'=>'=',
                                                'Contains'=>'LIKE_MID'
                                            );
                        $operatorsEqualArray = array(
                                                'Equal'=>'='
                                            );
                        $operatorsContainsArray = array(
                                                'Contains'=>'LIKE_MID'
                                            );
                    ?>


                        
                        <div class="table-responsive">
                            <form method="POST" autocomplete="on">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Select</th>
                                        <th>Parameter</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td>Registration ID</td>
                                        <td><input type="checkbox" name="search-check-code" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-code" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>For search more than one ID: eg:"TAS-SIL-8, TAS-FTG-20, TAS-GOL-10, TAS-PLA-43"
                                            <input type="text" name="search-value-code" class="form-control bordered">
                                        </td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Registration ID number</td>
                                        <td><input type="checkbox" name="search-check-ID" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-ID" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>For search more than one ID: eg:"8, 20, 10, 43, 44, 56"
                                            <input type="text" name="search-value-ID" class="form-control bordered">
                                        </td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Title</td>
                                        <td><input type="checkbox" name="search-check-title" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-title" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>H.E., Hon., Amb., Prof., Dr., Mr., Mrs., Ms.
                                            <!-- <input type="text" name="search-value-title"> -->
                                            <input type="text" name="search-value-title" class="form-control bordered">
                                            <!-- <select name="search-value-title" class="form-control bordered">
                                                <option value="">[--Select--]</option>
                                                <option value="H.E.">H.E.</option>
                                                <option value="Hon.">Hon.</option>
                                                <option value="Amb.">Amb.</option>
                                                <option value="Prof.">Prof.</option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Ms.">Ms.</option>
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>First name</td>
                                        <td><input type="checkbox" name="search-check-firstname" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-firstname" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-firstname" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Last name</td>
                                        <td><input type="checkbox" name="search-check-lastname" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-lastname" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-lastname" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Other name</td>
                                        <td><input type="checkbox" name="search-check-othername" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-othername" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-othername" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Category</td>
                                        <td><input type="checkbox" name="search-check-category" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-category" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Exhibition-Visitor, Individual-Silver, Individual-Gold, 
                                        Individual-Platinum, Individual-Silver-Discounted, Individual-Gold-Discounted,
                                                Individual-Platinum-Discounted, Individual-Silver-Complimentary, 
                                                Individual-Gold-Complimentary, Individual-Platinum-Complimentary, 
                                                Diplomatic-Mission-Silver-Complimentary, Diplomatic-Mission-Gold-Complimentary, 
                                                Diplomatic-Mission-Platinum-Complimentary, Private-Sector-Federation-Silver-Complimentary, 
                                                Private-Sector-Federation-Gold-Complimentary, Private-Sector-Federation-Platinum-Complimentary, 
                                                Development-Partners-Silver-Complimentary, Development-Partners-Gold-Complimentary, 
                                                Development-Partners-Platinum-Complimentary, Moderator-Silver-Complimentary,
                                                Moderator-Gold-Complimentary, Moderator-Platinum-Complimentary,
                                                Panelist-Silver-Complimentary, Panelist-Gold-Complimentary, Panelist-Platinum-Complimentary, 
                                                Speaker-Silver-Complimentary, Speaker-Gold-Complimentary, Speaker-Platinum-Complimentary, 
                                                    Group-Silver, Group-Gold, Group-Platinum, Group-Silver-Discounted, Group-Gold-Discounted, 
                                                    Group-Platinum-Discounted, Group-Silver-Complimentary, Group-Gold-Complimentary, 
                                                    Group-Platinum-Complimentary, Exhibitor-Silver-Discounted, Exhibitor-Gold-Discounted, 
                                                    Exhibitor-Platinum-Discounted, Exhibitor-Silver-Complimentary, Exhibitor-Gold-Complimentary, 
                                                    Sponsor-Silver-Discounted, Sponsor-Gold-Discounted, Sponsor-Silver-Complimentary, 
                                                    Sponsor-Gold-Complimentary, Sponsor-Platinum-Complimentary, Smart-Africa-Member-Silver-Discounted, 
                                                    Smart-Africa-Member-Gold-Discounted, Smart-Africa-Member-Platinum-Discounted, 
                                                    Face-the-Gorillas-Silver-Discounted, Face-the-Gorillas-Gold-Discounted, 
                                                    Face-the-Gorillas-Platinum-Discounted, Face-the-Gorillas-Silver-Complimentary, 
                                                    Face-the-Gorillas-Gold-Complimentary, Face-the-Gorillas-Platinum-Complimentary, 
                                                    Ms-Geek-2017-Silver-Discounted, Ms-Geek-2017-Gold-Discounted, Ms-Geek-2017-Platinum-Discounted, 
                                                    Ms-Geek-2017-Silver-Complimentary, Ms-Geek-2017-Gold-Complimentary, Ms-Geek-2017-Platinum-Complimentary,
                                                    Government-Silver-Complimentary, Government-Gold-Complimentary, Government-Platinum-Complimentary, 
                                                    Media, NOC, Organiser
<!-- 
    <select name="search-value-category" class="multiple-select form-control bordered" multiple="multiple">
        <option value="Exhibition-Visitor">Exhibition-Visitor</option>
        <option value="Individual-Silver">Individual-Silver</option>
        <option value="Individual-Gold">Individual-Gold</option>
        <option value="Exhibition-Visitor">Exhibition-Visitor</option>
    </select> -->
                                            <input type="text" name="search-value-category" class="form-control bordered">
                                            <!-- <select name="search-value-category" id="category" class="form-control bordered" required="required">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-category','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                    


                                                    <option value="Exhibition-Visitor" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Exhibition-Visitor'){ echo 'selected="selected"';}?>>Exhibition-Visitor</option>

                                                    <option value="Individual-Silver" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Silver'){ echo 'selected="selected"';}?>>Individual-Silver</option>
                                                
                                                    <option value="Individual-Gold" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Gold'){ echo 'selected="selected"';}?>>Individual-Gold</option>
                                                
                                                    <option value="Individual-Platinum" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Platinum'){ echo 'selected="selected"';}?>>Individual-Platinum</option>
                                                
                                                    <option value="Individual-Silver-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Silver-Discounted'){ echo 'selected="selected"';}?>>Individual-Silver-Discounted</option>
                                                
                                                    <option value="Individual-Gold-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Gold-Discounted'){ echo 'selected="selected"';}?>>Individual-Gold-Discounted</option>
                                                
                                                    <option value="Individual-Platinum-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Platinum-Discounted'){ echo 'selected="selected"';}?>>Individual-Platinum-Discounted</option>

                                                    <option value="Individual-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Silver-Complimentary'){ echo 'selected="selected"';}?>>Individual-Silver-Complimentary</option>
                                                
                                                    <option value="Individual-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Gold-Complimentary'){ echo 'selected="selected"';}?>>Individual-Gold-Complimentary</option>
                                                
                                                    <option value="Individual-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Individual-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Individual-Platinum-Complimentary</option>
                                                
                                                    <option value="Diplomatic-Mission-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Diplomatic-Mission-Silver-Complimentary'){ echo 'selected="selected"';}?>>Diplomatic-Mission-Silver-Complimentary</option>
                                                
                                                    <option value="Diplomatic-Mission-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Diplomatic-Mission-Gold-Complimentary'){ echo 'selected="selected"';}?>>Diplomatic-Mission-Gold-Complimentary</option>
                                                
                                                    <option value="Diplomatic-Mission-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Diplomatic-Mission-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Diplomatic-Mission-Platinum-Complimentary</option>
                                                
                                                    <option value="Private-Sector-Federation-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Private-Sector-Federation-Silver-Complimentary'){ echo 'selected="selected"';}?>>Private-Sector-Federation-Silver-Complimentary</option>
                                                
                                                    <option value="Private-Sector-Federation-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Private-Sector-Federation-Gold-Complimentary'){ echo 'selected="selected"';}?>>Private-Sector-Federation-Gold-Complimentary</option>
                                                
                                                    <option value="Private-Sector-Federation-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Private-Sector-Federation-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Private-Sector-Federation-Platinum-Complimentary</option>
                                                
                                                    <option value="Development-Partners-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Development-Partners-Silver-Complimentary'){ echo 'selected="selected"';}?>>Development-Partners-Silver-Complimentary</option>
                                                
                                                    <option value="Development-Partners-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Development-Partners-Gold-Complimentary'){ echo 'selected="selected"';}?>>Development-Partners-Gold-Complimentary</option>
                                                
                                                    <option value="Development-Partners-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Development-Partners-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Development-Partners-Platinum-Complimentary</option>
                                                
                                                    <option value="Moderator-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Moderator-Silver-Complimentary'){ echo 'selected="selected"';}?>>Moderator-Silver-Complimentary</option>
                                                
                                                    <option value="Moderator-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Moderator-Gold-Complimentary'){ echo 'selected="selected"';}?>>Moderator-Gold-Complimentary</option>
                                                
                                                    <option value="Moderator-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Moderator-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Moderator-Platinum-Complimentary</option>
                                                
                                                    <option value="Panelist-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Panelist-Silver-Complimentary'){ echo 'selected="selected"';}?>>Panelist-Silver-Complimentary</option>
                                                
                                                    <option value="Panelist-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Panelist-Gold-Complimentary'){ echo 'selected="selected"';}?>>Panelist-Gold-Complimentary</option>
                                                
                                                    <option value="Panelist-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Panelist-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Panelist-Platinum-Complimentary</option>
                                                
                                                    <option value="Speaker-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Speaker-Silver-Complimentary'){ echo 'selected="selected"';}?>>Speaker-Silver-Complimentary</option>
                                                
                                                    <option value="Speaker-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Speaker-Gold-Complimentary'){ echo 'selected="selected"';}?>>Speaker-Gold-Complimentary</option>
                                                
                                                    <option value="Speaker-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Speaker-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Speaker-Platinum-Complimentary</option>
                                                
                                                    <option value="Group-Silver" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Silver'){ echo 'selected="selected"';}?>>Group-Silver</option>
                                                
                                                    <option value="Group-Gold" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Gold'){ echo 'selected="selected"';}?>>Group-Gold</option>
                                                
                                                    <option value="Group-Platinum" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Platinum'){ echo 'selected="selected"';}?>>Group-Platinum</option>
                                                
                                                    <option value="Group-Silver-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Silver-Discounted'){ echo 'selected="selected"';}?>>Group-Silver-Discounted</option>
                                                
                                                    <option value="Group-Gold-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Gold-Discounted'){ echo 'selected="selected"';}?>>Group-Gold-Discounted</option>
                                                
                                                    <option value="Group-Platinum-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Platinum-Discounted'){ echo 'selected="selected"';}?>>Group-Platinum-Discounted</option>
                                                
                                                    <option value="Group-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Silver-Complimentary'){ echo 'selected="selected"';}?>>Group-Silver-Complimentary</option>
                                                
                                                    <option value="Group-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Gold-Complimentary'){ echo 'selected="selected"';}?>>Group-Gold-Complimentary</option>
                                                
                                                    <option value="Group-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Group-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Group-Platinum-Complimentary</option>
                                                
                                                    <option value="Exhibitor-Silver-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Exhibitor-Silver-Discounted'){ echo 'selected="selected"';}?>>Exhibitor-Silver-Discounted</option>
                                                
                                                    <option value="Exhibitor-Gold-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Exhibitor-Gold-Discounted'){ echo 'selected="selected"';}?>>Exhibitor-Gold-Discounted</option>
                                                
                                                    <option value="Exhibitor-Platinum-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Exhibitor-Platinum-Discounted'){ echo 'selected="selected"';}?>>Exhibitor-Platinum-Discounted</option>
                                                
                                                    <option value="Exhibitor-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Exhibitor-Silver-Complimentary'){ echo 'selected="selected"';}?>>Exhibitor-Silver-Complimentary</option>
                                                
                                                    <option value="Exhibitor-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Exhibitor-Gold-Complimentary'){ echo 'selected="selected"';}?>>Exhibitor-Gold-Complimentary</option>

                                                    <option value="Sponsor-Silver-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Sponsor-Silver-Discounted'){ echo 'selected="selected"';}?>>Sponsor-Silver-Discounted</option>
                                                
                                                    <option value="Sponsor-Gold-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Sponsor-Gold-Discounted'){ echo 'selected="selected"';}?>>Sponsor-Gold-Discounted</option>
                                                
                                                    <option value="Sponsor-Platinum-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Sponsor-Platinum-Discounted'){ echo 'selected="selected"';}?>>Sponsor-Platinum-Discounted</option>
                                                
                                                    <option value="Sponsor-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Sponsor-Silver-Complimentary'){ echo 'selected="selected"';}?>>Sponsor-Silver-Complimentary</option>
                                                
                                                    <option value="Sponsor-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Sponsor-Gold-Complimentary'){ echo 'selected="selected"';}?>>Sponsor-Gold-Complimentary</option>
                                                
                                                    <option value="Sponsor-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Sponsor-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Sponsor-Platinum-Complimentary</option>
                                                
                                                    <option value="Smart-Africa-Member-Silver-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Smart-Africa-Member-Silver-Discounted'){ echo 'selected="selected"';}?>>Smart-Africa-Member-Silver-Discounted</option>
                                                
                                                    <option value="Smart-Africa-Member-Gold-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Smart-Africa-Member-Gold-Discounted'){ echo 'selected="selected"';}?>>Smart-Africa-Member-Gold-Discounted</option>
                                                
                                                    <option value="Smart-Africa-Member-Platinum-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Smart-Africa-Member-Platinum-Discounted'){ echo 'selected="selected"';}?>>Smart-Africa-Member-Platinum-Discounted</option>
                                                
                                                    <option value="Face-the-Gorillas-Silver-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Face-the-Gorillas-Silver-Discounted'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Silver-Discounted</option>
                                                
                                                    <option value="Face-the-Gorillas-Gold-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Face-the-Gorillas-Gold-Discounted'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Gold-Discounted</option>
                                                
                                                    <option value="Face-the-Gorillas-Platinum-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Face-the-Gorillas-Platinum-Discounted'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Platinum-Discounted</option>
                                                
                                                    <option value="Face-the-Gorillas-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Face-the-Gorillas-Silver-Complimentary'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Silver-Complimentary</option>
                                                
                                                    <option value="Face-the-Gorillas-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Face-the-Gorillas-Gold-Complimentary'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Gold-Complimentary</option>
                                                
                                                    <option value="Face-the-Gorillas-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Face-the-Gorillas-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Platinum-Complimentary</option>
                                                
                                                    <option value="Ms-Geek-2017-Silver-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Ms-Geek-2017-Silver-Discounted'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Silver-Discounted</option>
                                                
                                                    <option value="Ms-Geek-2017-Gold-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Ms-Geek-2017-Gold-Discounted'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Gold-Discounted</option>
                                                
                                                    <option value="Ms-Geek-2017-Platinum-Discounted" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Ms-Geek-2017-Platinum-Discounted'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Platinum-Discounted</option>
                                                
                                                    <option value="Ms-Geek-2017-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Ms-Geek-2017-Silver-Complimentary'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Silver-Complimentary</option>
                                                
                                                    <option value="Ms-Geek-2017-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Ms-Geek-2017-Gold-Complimentary'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Gold-Complimentary</option>
                                                
                                                    <option value="Ms-Geek-2017-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Ms-Geek-2017-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Platinum-Complimentary</option>
                                                
                                                    <option value="Government-Silver-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Government-Silver-Complimentary'){ echo 'selected="selected"';}?>>Government-Silver-Complimentary</option>
                                                
                                                    <option value="Government-Gold-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Government-Gold-Complimentary'){ echo 'selected="selected"';}?>>Government-Gold-Complimentary</option>
                                                
                                                    <option value="Government-Platinum-Complimentary" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Government-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Government-Platinum-Complimentary</option>
                                                
                                                    <option value="Media" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Media'){ echo 'selected="selected"';}?>>Media</option>
                                                
                                                    <option value="NOC" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'NOC'){ echo 'selected="selected"';}?>>NOC</option>
                                                
                                                    <option value="Organiser" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Organiser'){ echo 'selected="selected"';}?>>Organiser</option>

                                                    <option value="Delegate-Liaison" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Delegate-Liaison'){ echo 'selected="selected"';}?>>Delegate-Liaison</option>
                                                
                                                    <option value="Armed-Security" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Armed-Security'){ echo 'selected="selected"';}?>>Armed-Security</option>
                                                
                                                    <option value="Security" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Security'){ echo 'selected="selected"';}?>>Security</option>
                                                
                                                    <option value="Protocal" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Protocal'){ echo 'selected="selected"';}?>>Protocal</option>
                                                
                                                    <option value="Medical" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Medical'){ echo 'selected="selected"';}?>>Medical</option>
                                                
                                                    <option value="Catering" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Catering'){ echo 'selected="selected"';}?>>Catering</option>
                                                
                                                    <option value="Production-Technician" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Production-Technician'){ echo 'selected="selected"';}?>>Production-Technician</option>
                                                
                                                    <option value="Contractor" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Contractor'){ echo 'selected="selected"';}?>>Contractor</option>
                                                
                                                    <option value="Face-the-Gorillas-Applicant" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Face-the-Gorillas-Applicant'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Applicant</option>
                                                
                                                    <option value="Ms-geek-Applicant" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Ms-geek-Applicant'){ echo 'selected="selected"';}?>>Ms-geek-Applicant</option>
                                                
                                                    <option value="Speaker-Applicant" <?php if($form->ERRORS && Input::get('search-value-category','post') == 'Speaker-Applicant'){ echo 'selected="selected"';}?>>Speaker-Applicant</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Pass type</td>
                                        <td><input type="checkbox" name="search-check-pass_type" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-pass_type" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>
                                            Visitor, Silver, Gold, Platinum, Media, NOC, Organiser, Delegate Liaison, Armed Security, Security, Protocal, Medical, Catering, Production Technician, Contractor
                                            <input type="text" name="search-value-pass_type" class="form-control bordered">
                                            <!-- <select name="search-value-pass_type" id="orgcategory" class="form-control bordered" required="required">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Gold" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Gold'){ echo 'selected="selected"';}?>>Gold</option>
                                                
                                                    <option value="Silver" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Silver'){ echo 'selected="selected"';}?>>Silver</option>

                                                    <option value="Platinum" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Platinum'){ echo 'selected="selected"';}?>>Platinum</option>


                                                    <option value="Ftg" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Ftg'){ echo 'selected="selected"';}?>>Ftg</option>

                                                    <option value="Visitor" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Visitor'){ echo 'selected="selected"';}?>>Visitor</option>

                                                    <option value="Msgeek" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Msgeek'){ echo 'selected="selected"';}?>>Msgeek</option>

                                                    <option value="Media" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Media'){ echo 'selected="selected"';}?>>Media</option>
                                                
                                                    <option value="NOC" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'NOC'){ echo 'selected="selected"';}?>>NOC</option>
                                                
                                                    <option value="Organiser" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Organiser'){ echo 'selected="selected"';}?>>Organiser</option>
                                                
                                                    <option value="Delegate-Liaison" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Delegate-Liaison'){ echo 'selected="selected"';}?>>Delegate-Liaison</option>
                                                
                                                    <option value="Armed-Security" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Armed-Security'){ echo 'selected="selected"';}?>>Armed-Security</option>
                                                
                                                    <option value="Security" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Security'){ echo 'selected="selected"';}?>>Security</option>
                                                
                                                    <option value="Protocal" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Protocal'){ echo 'selected="selected"';}?>>Protocal</option>
                                                
                                                    <option value="Medical" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Medical'){ echo 'selected="selected"';}?>>Medical</option>
                                                
                                                    <option value="Catering" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Catering'){ echo 'selected="selected"';}?>>Catering</option>
                                                
                                                    <option value="Production-Technician" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Production-Technician'){ echo 'selected="selected"';}?>>Production-Technician</option>
                                                
                                                    <option value="Contractor" <?php if($form->ERRORS && Input::get('search-value-pass_type','post') == 'Contractor'){ echo 'selected="selected"';}?>>Contractor</option>
                                            </select> -->
                                        </td>
                                    </tr>
                                    
                                    <!-- <tr class="">
                                        <td>Package type</td>
                                        <td><input type="checkbox" name="search-check-package_type"></td>
                                        <td>
                                            <select name="search-operator-package_type">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-package_type"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Residence country</td>
                                        <td><input type="checkbox" name="search-check-residence_country" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-residence_country" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Afghanistan, Albania, Algeria, American Samoa, Andorra, Angola, Anguilla, 
                                        Antigua & Barbuda, Argentina, Armenia, Aruba, Australia, Austria, Azerbaijan, 
                                        Bahamas, Bahrain, Bangladesh, Barbados, Belarus, Belgium, Belize, Benin, Bermuda, 
                                        Bhutan, Bolivia, Bosnia and Herzegovina, Botswana, Brazil, British Indian Ocean Territory, 
                                        British Virgin Islands, Brunei, Bulgaria, Burkina Faso, Burma Myanmar, Burundi, 
                                        Cambodia, Cameroon, Canada, Cape Verde, Cayman Islands, Central African Republic, 
                                        Chad, Chile, China, Colombia, Comoros, Cook Islands, Costa Rica, Cote d'Ivoire,
                                        Croatia, Cuba, Cyprus, Czech Republic, Democratic Republic of Congo, Denmark, 
                                        Djibouti, Dominica, Dominican Republic, Ecuador, Egypt, El Salvador, Equatorial Guinea, 
                                        Eritrea, Estonia, Ethiopia, Falkland Islands, Fiji, Finland, France, Gabon, 
                                        Gambia, Georgia, Germany, Ghana, Greece, Grenada, Guatemala, Guinea, 
                                        Guinea-Bissau, Guyana, Haiti, Holy See, Honduras, Hong Kong, Hungary, Iceland, 
                                        India, Indonesia, Iran, Iraq, Ireland, Israel, 
                                        Italy, Jamaica, Japan, Jordan, Kazakhstan, Kenya, Kiribati, North Korea, South Korea, Kosovo, 
                                        Kuwait, Kyrgyzstan, Laos, Latvia, Lebanon, Lesotho, Liberia, Libya, Liechtenstein, 
                                        Lithuania, Luxembourg, Macau, Macedonia, Madagascar, Malawi, Malaysia, Maldives, Mali, 
                                        Malta, Marshall Islands, Mauritania, Mauritius, Mexico, Micronesia, Moldova, Monaco, 
                                        Mongolia, Montenegro, Morocco, Mozambique, Namibia, Nauru, Nepal, Netherlands, New Zealand, 
                                        Nicaragua, Niger, Nigeria, North Korea, Norway, Oman, Pakistan, Palau, Palestinian Territories, Panama, 
                                        Papua New Guinea, Paraguay, Peru, Philippines, Poland, Portugal, Qatar, Romania, Russia, 
                                        Rwanda, Saint Kitts and Nevis, Saint Lucia, Saint Vincent and the Grenadines, Samoa, 
                                        San Marino, Sao Tome and Principe, Saudi Arabia, Senegal, Serbia, 
                                        Seychelles, Sierra Leone, Singapore, Sint Maarten, Slovakia, Slovenia, Solomon Islands, Somalia, 
                                        South Africa, South Korea, South Sudan, Spain, Sri Lanka, Sudan, Suriname, Swaziland, 
                                        Sweden, Switzerland, Syria, Taiwan, Tajikistan, Tanzania, Thailand, Timor-Leste, 
                                        Togo, Tonga, Trinidad and Tobago, Tunisia, Turkey, Turkmenistan, Tuvalu, Uganda, Ukraine, 
                                        United Arab Emirates, United Kingdom, Uruguay, Uzbekistan, Vanuatu, Venezuela, Vietnam, Yemen, Zambia, Zimbabwe
                                        <input type="text" name="search-value-residence_country" class="form-control bordered">
                                  <!-- <select name="search-value-residence_country" id="citizenship-country" placeholder="Citizenship Country" class="select2-country js-states form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" onchange="citizenshipDoc(this)" required="required"> -->
                                            <!-- <select name="search-value-residence_country" id="citizenship-country" placeholder="Citizenship Country" class="select2-country js-states form-control" tabindex="-1" aria-hidden="true">
                                                <option value="">[--Select country--]</option>
                                                <?php 
                                                $countryArray =Country::getArrays();
                                                foreach($countryArray as $country_ID=>$country_data){
                                                    $country_data = (object)$country_data;?>
                                                    <option value="<?php echo $country_data->name; ?>" id="<?php echo $country_data->icon; ?>"
                                                            
                                                            <?php if($form->ERRORS && Input::get('search-value-residence_country','post')==$country_data->name){ echo 'selected';}?>
                                                            
                                                            <?php // if(!$form->ERRORS && $country_data->code == "RW"){ echo 'selected';}?>>
                                                            <span></span>
                                                        <?php echo $country_data->name; ?></option>
                                                    <?php
                                                }?>
                                            </select> -->

                                        <!-- <input type="text" name="search-value-residence_country"> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Residence city</td>
                                        <td><input type="checkbox" name="search-check-residence_city" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-residence_city" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <!-- <option value="LIKE">LIKE</option> -->
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-residence_city" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Company name</td>
                                        <td><input type="checkbox" name="search-check-company_name" value="id" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-company_name" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-company_name" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Company industry</td>
                                        <td><input type="checkbox" name="search-check-company_industry" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-company_industry" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Academics/ Education, Advertising/Public Relations, Agricultural Services &amp; Products, 
                                        Attorneys and law, Clergy &amp; Religious Organizations, Clothing and Textiles, Defence and security, 
                                        Energy and Natural Resources and Environment, Entertainment Industry, Financial and Commercial Services, 
                                        Hospitality and Tourism, Healthcare services, ICT, Infrastructure, Logistics and Transportation, 
                                        Manufacturing, Mining, Media, Non-profits, Foundations &amp; Philanthropists, 
                                        Printing &amp; Publishing, Private Equity &amp; Investment Firms, Real Estate, 
                                        Religious Organizations/Clergy, Sports, Professional, Telecommunications
                                            <input type="text" name="search-value-company_industry" class="form-control bordered">
                                            <!-- <select name="search-value-company_industry" id="industry" class="form-control bordered">
                                              
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                              
                                                <option value="Academics/ Education" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Academics/ Education'){ echo 'selected="selected"';}?>>Academics/ Education</option>
                                              
                                                <option value="Advertising/Public Relations" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Advertising/Public Relations'){ echo 'selected="selected"';}?>>Advertising/Public Relations</option>
                                              
                                                <option value="Agricultural Services &amp; Products" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Agricultural Services &amp; Products'){ echo 'selected="selected"';}?>>Agricultural Services &amp; Products</option>
                                              
                                                <option value="Attorneys and law" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Attorneys and law'){ echo 'selected="selected"';}?>>Attorneys and law</option>
                                              
                                                <option value="Clergy &amp; Religious Organizations" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Clergy &amp; Religious Organizations'){ echo 'selected="selected"';}?>>Clergy &amp; Religious Organizations </option>
                                              
                                                <option value="Clothing and Textiles" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Clothing and Textiles'){ echo 'selected="selected"';}?>>Clothing and Textiles</option>
                                              
                                                <option value="Defence and security" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Defence and security'){ echo 'selected="selected"';}?>>Defence and security</option>
                                              
                                                <option value="Energy and Natural Resources and Environment" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Energy and Natural Resources and Environment'){ echo 'selected="selected"';}?>>Energy and Natural Resources and Environment</option>
                                              
                                                <option value="Entertainment Industry" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Entertainment Industry'){ echo 'selected="selected"';}?>>Entertainment Industry</option>
                                              
                                                <option value="Financial and Commercial Services" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Financial and Commercial Services'){ echo 'selected="selected"';}?>>Financial and Commercial Services</option>
                                              
                                                <option value="Hospitality and Tourism" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Hospitality and Tourism'){ echo 'selected="selected"';}?>>Hospitality and Tourism</option>
                                              
                                                <option value="Healthcare services" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Healthcare services'){ echo 'selected="selected"';}?>>Healthcare services</option>
                                              
                                                <option value="ICT" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'ICT'){ echo 'selected="selected"';}?>>ICT</option>
                                              
                                                <option value="Infrastructure" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Infrastructure'){ echo 'selected="selected"';}?>>Infrastructure</option>
                                              
                                                <option value="Logistics and Transportation" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Logistics and Transportation'){ echo 'selected="selected"';}?>>Logistics and Transportation</option>
                                              
                                                <option value="Manufacturing" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Manufacturing'){ echo 'selected="selected"';}?>>Manufacturing</option>
                                              
                                                <option value="Mining" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Mining'){ echo 'selected="selected"';}?>>Mining</option>
                                              
                                                <option value="Media" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Media'){ echo 'selected="selected"';}?>>Media </option>
                                              
                                                <option value="Non-profits, Foundations &amp; Philanthropists" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Non-profits, Foundations &amp; Philanthropists'){ echo 'selected="selected"';}?>>Non-profits, Foundations &amp; Philanthropists</option>
                                              
                                                <option value="Printing &amp; Publishing" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Printing &amp; Publishing'){ echo 'selected="selected"';}?>>Printing &amp; Publishing</option>
                                              
                                                <option value="Private Equity &amp; Investment Firms" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Private Equity &amp; Investment Firms'){ echo 'selected="selected"';}?>>Private Equity &amp; Investment Firms</option>
                                              
                                                <option value="Real Estate" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Real Estate'){ echo 'selected="selected"';}?>>Real Estate</option>
                                              
                                                <option value="Religious Organizations/Clergy" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Religious Organizations/Clergy'){ echo 'selected="selected"';}?>>Religious Organizations/Clergy</option>
                                              
                                                <option value="Sports, Professional" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Sports, Professional'){ echo 'selected="selected"';}?>>Sports, Professional</option>
                                                
                                                <option value="Telecommunications" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Telecommunications'){ echo 'selected="selected"';}?>>Telecommunications </option>
                                                
                                                <option value="Other" <?php if($form->ERRORS && Input::get('search-value-company_industry','post') == 'Other'){ echo 'selected="selected"';}?>>Other </option>
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Gender</td>
                                        <td><input type="checkbox" name="search-check-gender" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-gender" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Female, Male
                                        <input type="text" name="search-value-gender" class="form-control bordered">
                                            <!-- <select name="search-value-gender" id="orgcategory" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-gender','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Female" <?php if($form->ERRORS && Input::get('search-value-gender','post') == 'Female'){ echo 'selected="selected"';}?>>Female</option>

                                                    <option value="Male" <?php if($form->ERRORS && Input::get('search-value-gender','post') == 'Male'){ echo 'selected="selected"';}?>>Male</option>


                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Email</td>
                                        <td><input type="checkbox" name="search-check-email" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-email" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-email" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Telephone</td>
                                        <td><input type="checkbox" name="search-check-telephone" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-telephone" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-telephone" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Telephone office</td>
                                        <td><input type="checkbox" name="search-check-telephone_office" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-telephone_office" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-telephone_office" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Company category</td>
                                        <td><input type="checkbox" name="search-check-company_category" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-company_category" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Academia, Civil Society, International Organization, Non-Governmental Organization, Non-Profit Organization,
                                        Private/Corporation, Regional Organization
                                            <input type="text" name="search-value-company_category" class="form-control bordered">
                                            <!-- <select name="search-value-company_category" id="orgcategory" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Academia" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == 'Academia'){ echo 'selected="selected"';}?>>Academia</option>

                                                    <option value="Civil Society" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == 'Civil Society'){ echo 'selected="selected"';}?>>Civil Society </option>


                                                    <option value="International Organization" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == 'International Organization'){ echo 'selected="selected"';}?>>International Organization</option>

                                                    <option value="Non-Governmental Organization" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == 'Non-Governmental Organization'){ echo 'selected="selected"';}?>>Non-Governmental Organization</option>

                                                    <option value="Non-Profit Organization" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == 'Non-Profit Organization'){ echo 'selected="selected"';}?>>Non-Profit Organization</option>

                                                    <option value="Private/Corporation" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == 'Private/Corporation'){ echo 'selected="selected"';}?>>Private/Corporation</option>

                                                    <option value="Regional Organization" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == 'Regional Organization'){ echo 'selected="selected"';}?>>Regional Organization </option>
                                                
                                                <option value="Other" <?php if($form->ERRORS && Input::get('search-value-company_category','post') == 'Other'){ echo 'selected="selected"';}?>>Other </option>
                                            </select> -->
                                        </td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Company address</td>
                                        <td><input type="checkbox" name="search-check-company_address" value="id"></td>
                                        <td>
                                            <select name="search-operator-company_address">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-company_address"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Company country</td>
                                        <td><input type="checkbox" name="search-check-company_country" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-company_country" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Afghanistan, Albania, Algeria, American Samoa, Andorra, Angola, Anguilla, 
                                        Antigua & Barbuda, Argentina, Armenia, Aruba, Australia, Austria, Azerbaijan, 
                                        Bahamas, Bahrain, Bangladesh, Barbados, Belarus, Belgium, Belize, Benin, Bermuda, 
                                        Bhutan, Bolivia, Bosnia and Herzegovina, Botswana, Brazil, British Indian Ocean Territory, 
                                        British Virgin Islands, Brunei, Bulgaria, Burkina Faso, Burma Myanmar, Burundi, 
                                        Cambodia, Cameroon, Canada, Cape Verde, Cayman Islands, Central African Republic, 
                                        Chad, Chile, China, Colombia, Comoros, Cook Islands, Costa Rica, Cote d'Ivoire,
                                        Croatia, Cuba, Cyprus, Czech Republic, Democratic Republic of Congo, Denmark, 
                                        Djibouti, Dominica, Dominican Republic, Ecuador, Egypt, El Salvador, Equatorial Guinea, 
                                        Eritrea, Estonia, Ethiopia, Falkland Islands, Fiji, Finland, France, Gabon, 
                                        Gambia, Georgia, Germany, Ghana, Greece, Grenada, Guatemala, Guinea, 
                                        Guinea-Bissau, Guyana, Haiti, Holy See, Honduras, Hong Kong, Hungary, Iceland, 
                                        India, Indonesia, Iran, Iraq, Ireland, Israel, 
                                        Italy, Jamaica, Japan, Jordan, Kazakhstan, Kenya, Kiribati, North Korea, South Korea, Kosovo, 
                                        Kuwait, Kyrgyzstan, Laos, Latvia, Lebanon, Lesotho, Liberia, Libya, Liechtenstein, 
                                        Lithuania, Luxembourg, Macau, Macedonia, Madagascar, Malawi, Malaysia, Maldives, Mali, 
                                        Malta, Marshall Islands, Mauritania, Mauritius, Mexico, Micronesia, Moldova, Monaco, 
                                        Mongolia, Montenegro, Morocco, Mozambique, Namibia, Nauru, Nepal, Netherlands, New Zealand, 
                                        Nicaragua, Niger, Nigeria, North Korea, Norway, Oman, Pakistan, Palau, Palestinian Territories, Panama, 
                                        Papua New Guinea, Paraguay, Peru, Philippines, Poland, Portugal, Qatar, Romania, Russia, 
                                        Rwanda, Saint Kitts and Nevis, Saint Lucia, Saint Vincent and the Grenadines, Samoa, 
                                        San Marino, Sao Tome and Principe, Saudi Arabia, Senegal, Serbia, 
                                        Seychelles, Sierra Leone, Singapore, Sint Maarten, Slovakia, Slovenia, Solomon Islands, Somalia, 
                                        South Africa, South Korea, South Sudan, Spain, Sri Lanka, Sudan, Suriname, Swaziland, 
                                        Sweden, Switzerland, Syria, Taiwan, Tajikistan, Tanzania, Thailand, Timor-Leste, 
                                        Togo, Tonga, Trinidad and Tobago, Tunisia, Turkey, Turkmenistan, Tuvalu, Uganda, Ukraine, 
                                        United Arab Emirates, United Kingdom, Uruguay, Uzbekistan, Vanuatu, Venezuela, Vietnam, Yemen, Zambia, Zimbabwe


                                            <input type="text" name="search-value-company_country" class="form-control bordered">
                                            <!-- <select name="search-value-company_country" id="company-country" placeholder="Company Country" class="select2-country js-states form-control" tabindex="-1" aria-hidden="true">
                                                <option value="">[--Select country--]</option>
                                                <?php 
                                                $countryArray =Country::getArrays();
                                                foreach($countryArray as $country_ID=>$country_data){
                                                    $country_data = (object)$country_data;?>
                                                    <option value="<?php echo $country_data->name; ?>" id="<?php echo $country_data->icon; ?>"
                                                            
                                                            <?php if($form->ERRORS && Input::get('search-value-company_country','post')==$country_data->name){ echo 'selected';}?>
                                                            
                                                            <?php // if(!$form->ERRORS && $country_data->code == "RW"){ echo 'selected';}?>>
                                                            <span></span>
                                                        <?php echo $country_data->name; ?></option>
                                                    <?php
                                                }?>
                                            </select> -->
                                        <!-- <input type="text" name="search-value-company_country"> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Company city</td>
                                        <td><input type="checkbox" name="search-check-company_city" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-company_city" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-company_city" class="form-control bordered"></td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Job title</td>
                                        <td><input type="checkbox" name="search-check-jobtitle"></td>
                                        <td>
                                            <select name="search-operator-jobtitle">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-jobtitle"></td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>Website</td>
                                        <td><input type="checkbox" name="search-check-website"></td>
                                        <td>
                                            <select name="search-operator-website">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-website"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Citizenship country</td>
                                        <td><input type="checkbox" name="search-check-citizenship_country" value="id" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-citizenship_country" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Afghanistan, Albania, Algeria, American Samoa, Andorra, Angola, Anguilla, 
                                        Antigua & Barbuda, Argentina, Armenia, Aruba, Australia, Austria, Azerbaijan, 
                                        Bahamas, Bahrain, Bangladesh, Barbados, Belarus, Belgium, Belize, Benin, Bermuda, 
                                        Bhutan, Bolivia, Bosnia and Herzegovina, Botswana, Brazil, British Indian Ocean Territory, 
                                        British Virgin Islands, Brunei, Bulgaria, Burkina Faso, Burma Myanmar, Burundi, 
                                        Cambodia, Cameroon, Canada, Cape Verde, Cayman Islands, Central African Republic, 
                                        Chad, Chile, China, Colombia, Comoros, Cook Islands, Costa Rica, Cote d'Ivoire,
                                        Croatia, Cuba, Cyprus, Czech Republic, Democratic Republic of Congo, Denmark, 
                                        Djibouti, Dominica, Dominican Republic, Ecuador, Egypt, El Salvador, Equatorial Guinea, 
                                        Eritrea, Estonia, Ethiopia, Falkland Islands, Fiji, Finland, France, Gabon, 
                                        Gambia, Georgia, Germany, Ghana, Greece, Grenada, Guatemala, Guinea, 
                                        Guinea-Bissau, Guyana, Haiti, Holy See, Honduras, Hong Kong, Hungary, Iceland, 
                                        India, Indonesia, Iran, Iraq, Ireland, Israel, 
                                        Italy, Jamaica, Japan, Jordan, Kazakhstan, Kenya, Kiribati, North Korea, South Korea, Kosovo, 
                                        Kuwait, Kyrgyzstan, Laos, Latvia, Lebanon, Lesotho, Liberia, Libya, Liechtenstein, 
                                        Lithuania, Luxembourg, Macau, Macedonia, Madagascar, Malawi, Malaysia, Maldives, Mali, 
                                        Malta, Marshall Islands, Mauritania, Mauritius, Mexico, Micronesia, Moldova, Monaco, 
                                        Mongolia, Montenegro, Morocco, Mozambique, Namibia, Nauru, Nepal, Netherlands, New Zealand, 
                                        Nicaragua, Niger, Nigeria, North Korea, Norway, Oman, Pakistan, Palau, Palestinian Territories, Panama, 
                                        Papua New Guinea, Paraguay, Peru, Philippines, Poland, Portugal, Qatar, Romania, Russia, 
                                        Rwanda, Saint Kitts and Nevis, Saint Lucia, Saint Vincent and the Grenadines, Samoa, 
                                        San Marino, Sao Tome and Principe, Saudi Arabia, Senegal, Serbia, 
                                        Seychelles, Sierra Leone, Singapore, Sint Maarten, Slovakia, Slovenia, Solomon Islands, Somalia, 
                                        South Africa, South Korea, South Sudan, Spain, Sri Lanka, Sudan, Suriname, Swaziland, 
                                        Sweden, Switzerland, Syria, Taiwan, Tajikistan, Tanzania, Thailand, Timor-Leste, 
                                        Togo, Tonga, Trinidad and Tobago, Tunisia, Turkey, Turkmenistan, Tuvalu, Uganda, Ukraine, 
                                        United Arab Emirates, United Kingdom, Uruguay, Uzbekistan, Vanuatu, Venezuela, Vietnam, Yemen, Zambia, Zimbabwe
                                        <input type="text" name="search-value-citizenship_country" class="form-control bordered">
                                        <!-- <input type="text" name="search-value-citizenship_country" class="form-control bordered"> -->
                                            <!-- <select name="search-value-citizenship_country" id="citizenship-country" placeholder="Citizenship Country" class="select2-country js-states form-control" tabindex="-1" aria-hidden="true">
                                                <option value="">[--Select country--]</option>
                                                <?php 
                                                $countryArray =Country::getArrays();
                                                foreach($countryArray as $country_ID=>$country_data){
                                                    $country_data = (object)$country_data;?>
                                                    <option value="<?php echo $country_data->name; ?>" id="<?php echo $country_data->icon; ?>"
                                                            
                                                            <?php if($form->ERRORS && Input::get('search-value-citizenship_country','post')==$country_data->name){ echo 'selected';}?>
                                                            
                                                            <?php // if(!$form->ERRORS && $country_data->code == "RW"){ echo 'selected';}?>>
                                                            <span></span>
                                                        <?php echo $country_data->name; ?></option>
                                                    <?php
                                                }?>
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Document type</td>
                                        <td><input type="checkbox" name="search-check-document_type" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-document_type" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>ID card, Passport
                                        <input type="text" name="search-value-document_type" class="form-control bordered">
                                            <!-- <select name="search-value-document_type" id="orgcategory" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-document_type','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="ID card" <?php if($form->ERRORS && Input::get('search-value-document_type','post') == 'ID card'){ echo 'selected="selected"';}?>>ID card</option>

                                                    <option value="Passport" <?php if($form->ERRORS && Input::get('search-value-document_type','post') == 'Passport'){ echo 'selected="selected"';}?>>Passport</option>


                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Document number</td>
                                        <td><input type="checkbox" name="search-check-document_number" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-document_number" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-document_number" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Media card number</td>
                                        <td><input type="checkbox" name="search-check-media_card" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-media_card" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-media_card" class="form-control bordered"></td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Media card expiry</td>
                                        <td><input type="checkbox" name="search-check-media_card_expiry"></td>
                                        <td>
                                            <select name="search-operator-media_card_expiry" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-media_card_expiry" class="form-control bordered"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Media card authority</td>
                                        <td><input type="checkbox" name="search-check-media_card_authority" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-media_card_authority" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-media_card_authority" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Media equipment</td>
                                        <td><input type="checkbox" name="search-check-media_equipment" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-media_equipment" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-media_equipment" class="form-control bordered"></td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Exhibition type</td>
                                        <td><input type="checkbox" name="search-check-exhibition_type"></td>
                                        <td>
                                            <select name="search-operator-exhibition_type">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-exhibition_type"></td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>Exhibition row number</td>
                                        <td><input type="checkbox" name="search-check-exhibition_row_number"></td>
                                        <td>
                                            <select name="search-operator-exhibition_row_number">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-exhibition_row_number"></td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>Exhibition booth number</td>
                                        <td><input type="checkbox" name="search-check-exhibition_booth_number"></td>
                                        <td>
                                            <select name="search-operator-exhibition_booth_number">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-exhibition_booth_number"></td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>Exhibition booth name</td>
                                        <td><input type="checkbox" name="search-check-exhibition_booth_name"></td>
                                        <td>
                                            <select name="search-operator-exhibition_booth_name">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-exhibition_booth_name"></td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>Path</td>
                                        <td><input type="checkbox" name="search-check-path"></td>
                                        <td>
                                            <select name="search-operator-path">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-path"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Payment method</td>
                                        <td><input type="checkbox" name="search-check-payment_method" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-payment_method" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Bank-Transfer, Debit/Credit Card, Mobile-Money
                                        <input type="text" name="search-value-payment_method" class="form-control bordered">
                                            <!-- <select name="search-value-payment_method" id="orgcategory" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-payment_method','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Bank-Transfer" <?php if($form->ERRORS && Input::get('search-value-payment_method','post') == 'Bank-Transfer'){ echo 'selected="selected"';}?>>Bank transfer</option>

                                                    <option value="Debit/Credit Card" <?php if($form->ERRORS && Input::get('search-value-payment_method','post') == 'Debit/Credit Card'){ echo 'selected="selected"';}?>>Debit/Credit Card </option>


                                                    <option value="Mobile-Money" <?php if($form->ERRORS && Input::get('search-value-payment_method','post') == 'Mobile-Money'){ echo 'selected="selected"';}?>>Mobile Money</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Amount</td>
                                        <td><input type="checkbox" name="search-check-amount"></td>
                                        <td>
                                            <select name="search-operator-amount">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-amount"></td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>Discount</td>
                                        <td><input type="checkbox" name="search-check-discount"></td>
                                        <td>
                                            <select name="search-operator-discount">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-discount"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Payment reference no</td>
                                        <td><input type="checkbox" name="search-check-payment_rn" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-payment_rn" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-payment_rn" class="form-control bordered"></td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Payment date</td>
                                        <td><input type="checkbox" name="search-check-payment_date"></td>
                                        <td>
                                            <select name="search-operator-payment_date">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-payment_date"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Payment status</td>
                                        <td><input type="checkbox" name="search-check-payment_state" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-payment_state" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Confirmed, Pending, Free
                                            <input type="text" name="search-value-payment_state" class="form-control bordered">
                                            <!-- <select name="search-value-payment_state" id="search-value-payment_state" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-payment_state','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Confirmed" <?php if($form->ERRORS && Input::get('search-value-payment_state','post') == 'Confirmed'){ echo 'selected="selected"';}?>>Confirmed</option>

                                                    <option value="Pending" <?php if($form->ERRORS && Input::get('search-value-payment_state','post') == 'Pending'){ echo 'selected="selected"';}?>>Pending</option>

                                                    <option value="Free" <?php if($form->ERRORS && Input::get('search-value-payment_state','post') == 'Free'){ echo 'selected="selected"';}?>>Free</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Approval status</td>
                                        <td><input type="checkbox" name="search-check-status"></td>
                                        <td>
                                            <select name="search-operator-status" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="search-value-status" id="search-value-status" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-status','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Confirmed" <?php if($form->ERRORS && Input::get('search-value-status','post') == 'Confirmed'){ echo 'selected="selected"';}?>>Confirmed</option>

                                                    <option value="Pending" <?php if($form->ERRORS && Input::get('search-value-status','post') == 'Pending'){ echo 'selected="selected"';}?>>Pending</option>

                                                    <option value="Free" <?php if($form->ERRORS && Input::get('search-value-status','post') == 'Free'){ echo 'selected="selected"';}?>>Free</option>
                                                
                                            </select>
                                        <input type="text" name="search-value-status" class="form-control bordered">
                                        </td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>Receipt string</td>
                                        <td><input type="checkbox" name="search-check-receipt_string"></td>
                                        <td>
                                            <select name="search-operator-receipt_string">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-receipt_string"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Receipt number</td>
                                        <td><input type="checkbox" name="search-check-receipt_number" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-receipt_number" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-receipt_number" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Transaction number</td>
                                        <td><input type="checkbox" name="search-check-transaction_number" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-transaction_number" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-transaction_number" class="form-control bordered"></td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Added date</td>
                                        <td><input type="checkbox" name="search-check-added_date" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-added_date" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="datepicker" name="search-value-added_date" class="form-control bordered">
                                        </td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>Last Updated date</td>
                                        <td><input type="checkbox" name="search-check-updated_date"></td>
                                        <td>
                                            <select name="search-operator-updated_date" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-updated_date" class="form-control bordered"></td>
                                    </tr> -->
                                    <!-- <tr class="">
                                        <td>State</td>
                                        <td><input type="checkbox" name="search-check-state"></td>
                                        <td>
                                            <select name="search-operator-state">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-state"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Group ID</td>
                                        <td><input type="checkbox" name="search-check-host_ID" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-host_ID" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-host_ID" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Host account ID</td>
                                        <td><input type="checkbox" name="search-check-host_account_ID" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-host_account_ID" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-host_account_ID" class="form-control bordered"></td>
                                    </tr>
                                    <!-- <tr class="">
                                        <td>Invite ID</td>
                                        <td><input type="checkbox" name="search-check-invite_ID"></td>
                                        <td>
                                            <select name="search-operator-invite_ID">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-invite_ID"></td>
                                    </tr> -->
                                    <tr class="">
                                        <td>Registration type</td>
                                        <td><input type="checkbox" name="search-check-registration_type" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-registration_type" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-registration_type" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Group size</td>
                                        <td><input type="checkbox" name="search-check-group_size" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-group_size" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="search-value-group_size" class="form-control bordered"></td>
                                    </tr>
                                    <tr class="">
                                        <td>Approval status</td>
                                        <td><input type="checkbox" name="search-check-state" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-state" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Confirm, Pending, Denied
                                        <input type="text" name="search-value-state" class="form-control bordered">
                                            <!-- <select name="search-value-state" id="search-value-state" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-state','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Confirmed" <?php if($form->ERRORS && Input::get('search-value-state','post') == 'Confirmed'){ echo 'selected="selected"';}?>>Confirmed</option>

                                                    <option value="Pending" <?php if($form->ERRORS && Input::get('search-value-state','post') == 'Pending'){ echo 'selected="selected"';}?>>Pending</option>

                                                    <option value="Denied" <?php if($form->ERRORS && Input::get('search-value-state','post') == 'Denied'){ echo 'selected="selected"';}?>>Deny</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Gala dinner</td>
                                        <td><input type="checkbox" name="search-check-gala_dinner" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-gala_dinner" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Confirm, Pending, Denied
                                        <input type="text" name="search-value-gala_dinner" class="form-control bordered">
                                            <!-- <select name="search-value-gala_dinner" id="search-value-gala_dinner" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-gala_dinner','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Confirm" <?php if($form->ERRORS && Input::get('search-value-gala_dinner','post') == 'Confirm'){ echo 'selected="selected"';}?>>Confirmed</option>

                                                    <option value="Pending" <?php if($form->ERRORS && Input::get('search-value-gala_dinner','post') == 'Pending'){ echo 'selected="selected"';}?>>Pending</option>

                                                    <option value="Denied" <?php if($form->ERRORS && Input::get('search-value-gala_dinner','post') == 'Denied'){ echo 'selected="selected"';}?>>Deny</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Board meeting</td>
                                        <td><input type="checkbox" name="search-check-board_meeting" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-board_meeting" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Confirm, Pending, Denied
                                        <input type="text" name="search-value-board_meeting" class="form-control bordered">
                                            <!-- <select name="search-value-board_meeting" id="search-value-board_meeting" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-board_meeting','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Confirm" <?php if($form->ERRORS && Input::get('search-value-board_meeting','post') == 'Confirm'){ echo 'selected="selected"';}?>>Confirm</option>

                                                    <option value="Pending" <?php if($form->ERRORS && Input::get('search-value-board_meeting','post') == 'Pending'){ echo 'selected="selected"';}?>>Pending</option>

                                                    <option value="Denied" <?php if($form->ERRORS && Input::get('search-value-board_meeting','post') == 'Denied'){ echo 'selected="selected"';}?>>Deny</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Mayor's forum</td>
                                        <td><input type="checkbox" name="search-check-mayors_lunch" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-mayors_lunch" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Confirm, Pending, Denied
                                        <input type="text" name="search-value-mayors_lunch" class="form-control bordered">
                                            <!-- <select name="search-value-mayors_lunch" id="search-value-mayors_lunch" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-mayors_lunch','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Confirm" <?php if($form->ERRORS && Input::get('search-value-mayors_lunch','post') == 'Confirm'){ echo 'selected="selected"';}?>>Confirmed</option>

                                                    <option value="Pending" <?php if($form->ERRORS && Input::get('search-value-mayors_lunch','post') == 'Pending'){ echo 'selected="selected"';}?>>Pending</option>

                                                    <option value="Denied" <?php if($form->ERRORS && Input::get('search-value-mayors_lunch','post') == 'Denied'){ echo 'selected="selected"';}?>>Deny</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>Women's lunch</td>
                                        <td><input type="checkbox" name="search-check-smart_women" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-smart_women" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Confirm, Pending, Denied
                                        <input type="text" name="search-value-smart_women" class="form-control bordered">
                                            <!-- <select name="search-value-smart_women" id="search-value-smart_women" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-smart_women','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Confirm" <?php if($form->ERRORS && Input::get('search-value-smart_women','post') == 'Confirm'){ echo 'selected="selected"';}?>>Confirmed</option>

                                                    <option value="Pending" <?php if($form->ERRORS && Input::get('search-value-smart_women','post') == 'Pending'){ echo 'selected="selected"';}?>>Pending</option>

                                                    <option value="Denied" <?php if($form->ERRORS && Input::get('search-value-smart_women','post') == 'Denied'){ echo 'selected="selected"';}?>>Deny</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>CEO's lunch</td>
                                        <td><input type="checkbox" name="search-check-ceo_lunch" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-ceo_lunch" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsEqualContainsArray as $key => $value) {?>
                                                        <option value="<?=$value?>"><?=$key?></option>
                                                    <?php }
                                                ?>
                                                <option value="IN">Search more</option>
                                            </select>
                                        </td>
                                        <td>Confirm, Pending, Denied
                                        <input type="text" name="search-value-ceo_lunch" class="form-control bordered">
                                            <!-- <select name="search-value-ceo_lunch" id="search-value-ceo_lunch" class="form-control bordered">
                                               
                                                <option value="" <?php if($form->ERRORS && Input::get('search-value-ceo_lunch','post') == ''){ echo 'selected="selected"';}?>> [--Select--] </option>
                                                
                                                    <option value="Confirm" <?php if($form->ERRORS && Input::get('search-value-ceo_lunch','post') == 'Confirm'){ echo 'selected="selected"';}?>>Confirmed</option>

                                                    <option value="Pending" <?php if($form->ERRORS && Input::get('search-value-ceo_lunch','post') == 'Pending'){ echo 'selected="selected"';}?>>Pending</option>

                                                    <option value="Denied" <?php if($form->ERRORS && Input::get('search-value-ceo_lunch','post') == 'Denied'){ echo 'selected="selected"';}?>>Deny</option>
                                                
                                            </select> -->
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>From date</td>
                                        <td><input type="checkbox" name="search-check-from_date" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-from_date" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <!-- <option value="<?=$value?>"><?=$key?></option> -->
                                                    <?php }
                                                ?>
                                                <option value=">=">from</option>
                                            </select>
                                        </td>
                                        <td>eg format: dd-mm-yyyy eg: "12-03-2017"
                                            <input type="text" name="search-value-from_date" class="form-control bordered">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>To date</td>
                                        <td><input type="checkbox" name="search-check-to_date" checked="checked"></td>
                                        <td>
                                            <select name="search-operator-to_date" class="form-control bordered">
                                                <?php
                                                    foreach ($operatorsArray as $key => $value) {?>
                                                        <!-- <option value="<?=$value?>"><?=$key?></option> -->
                                                    <?php }
                                                ?>
                                                <option value="<=">to</option>
                                            </select>
                                        </td>
                                        <td>eg format: dd-mm-yyyy eg: "24-03-2017"
                                            <input type="text" name="search-value-to_date" class="form-control bordered">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="request" value="finder">
                            <input type="hidden" name="webToken" value="56">
                            <button type="submit" name="search" class="btn btn-sm btn-success btn-flat pull-right">Search</button>
                            <button type="reset" name="clear" class="btn btn-sm btn-info btn-flat pull-right">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if(Input::checkInput('request','post',1)){ ?>

                <div class="box">


                    <?php 
                        $searchParticipant = new Participant();
                        $_FIELDS = array();
                        $_VAL = array();
                        $_OPT = array();
                        $prfx_check = 'search-check-';
                        $prfx_opt = 'search-operator-';
                        $prfx_val = 'search-value-';
                        foreach($_POST as $index=>$val){
                            $ar = explode($prfx_check,$index);
                            if(count($ar) > 1){
                                $field_name = end($ar);
                                $field_name1 = ''; //add for from_date
                                $field_name2 = ''; //add for from_date
                                if ($field_name=='from_date') { //add for from_date
                                    $field_name='added_date'; //add for from_date
                                    $field_name1='from_date';
                                }elseif ($field_name=='to_date') { //add for to_date
                                    $field_name='added_date_to'; //add for to_date
                                    $field_name2='to_date';
                                } //add for from_date

                                $_FIELDS[$field_name] = $field_name;
                                if ($field_name1!='') {//add for from_date
                                    $_OPT[$field_name] = $_POST[$prfx_opt.$field_name1];//add for from_date
                                }elseif($field_name2!=''){
                                    $_OPT[$field_name] = $_POST[$prfx_opt.$field_name2];//add for to_date
                                }else{
                                    $_OPT[$field_name] = $_POST[$prfx_opt.$field_name];//add for from_date
                                }
                                //$_OPT[$field_name] = $_POST[$prfx_opt.$field_name];//removed for from_date
                                
                                if(!empty($_POST[$prfx_val.$field_name])){
                                    $_VAL[$field_name] = $_POST[$prfx_val.$field_name];
                                }elseif (!empty($_POST[$prfx_val.$field_name1])) {
                                    $_VAL[$field_name] = $_POST[$prfx_val.$field_name1];
                                }elseif (!empty($_POST[$prfx_val.$field_name2])) {
                                    $_VAL[$field_name] = $_POST[$prfx_val.$field_name2];
                                }
                            }
                        }

                        if(count($_FIELDS)){
                            $sql_fields = '`'.implode('`,`', $_FIELDS).'`';
                            $sql_vals = '';
                            $_vals = false;

                            $sql_vals = '';

                            if(count($_VAL)){
                                $_vals = true;
                                $c = 0;
                                foreach ($_VAL as $key => $value) {
                                    $c++;
                                    if($c>1){
                                        $sql_vals .= ' AND ';    
                                    }

                                    switch ($_OPT[$key]) {
                                        case 'LIKE_MID':
                                            $sql_vals .= '`'.$key.'`'." LIKE '%".$value."%'";
                                            break;
                                        case 'LIKE_RIGHT':
                                            $sql_vals .= '`'.$key.'`'." LIKE '%".$value."'";
                                            break;
                                        case 'LIKE_LEFT':
                                            $sql_vals .= '`'.$key.'`'." LIKE '".$value."%'";
                                            break;
                                        case 'NOT_LIKE':
                                            $sql_vals .= '`'.$key.'`'." NOT LIKE '%".$value."%'";
                                            break;
                                        case 'IN':
                                            $value = str_replace(" ","",$value);
                                            $value = str_replace(",","','",$value);
                                            $sql_vals .= '`'.$key.'`'." IN ('".$value."')";
                                            break;
                                        default:
                                            $sql_vals .= '`'.$key.'` '.$_OPT[$key]." '".$value."'";
                                            break;
                                    }
                                }
                            }
                                            // echo highlight_string($sql_vals);


                                                $sql_conditions='';

                                                if($_vals){
                                                    $sql_conditions = "WHERE  $sql_vals";
                                                }


                                                $_SESSION["export"]["fieldArray"] = $_FIELDS;
                                                $_SESSION["export"]["fieldSQL"] = $sql_fields;
                                                $_SESSION["export"]["conditionSQL"] = $sql_conditions;

                                                $searchParticipant ->selectQuery("SELECT $sql_fields FROM `events_participant` $sql_conditions");

                                                $searchParticipantNumber=$searchParticipant->count();
                                                if($searchParticipant->count()){

                            ?>
                    <div class="box-header with-border">
                        <h3 class="box-title">Search Result <span style='color:#01aef0'><?=$searchParticipantNumber?></span></h3>

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
                                                    <?php
                                                        foreach($_POST as $index=>$val){
                                                            $ar = explode($prfx_check,$index);
                                                            if(count($ar) > 1){
                                                                $field_name = end($ar);
                                                                echo '<th>',firstUC($field_name), '</th>';
                                                            }
                                                        }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                    foreach ($searchParticipant->data() as $result_data) {
                                                    ?>
                                                        <tr class="">
                                                        <?php
                                                            foreach ($_FIELDS as $field_name) { 
                                                               //echo $field_name;?>
                                                                <td><?=$result_data->$field_name?></td>
                                                                <?php
                                                            }
                                                        ?>
                                                        </tr>
                                                        <?php
                                                    }
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php 

                            }else{
                                echo 'No field checked';
                            }
                        ?>

                    </div>
                        <?php
                        if($searchParticipant->count()){?>
                        <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-list" class="btn btn-sm btn-default btn-flat pull-right">View All Participants</a>
                                <?php  
                                    if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-Admin' || $session_user_data->groups == 'RG-SUPER-Admin' || $session_user_data->groups == 'Super-Admin-User' || $session_user_data->groups == 'OGS-User'){?>
                                    <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-list-exportsearch" class="btn btn-sm btn-primary btn-flat pull-right">Export</a>
                                <?php } ?>
                            </div>
                            <!-- /.box-footer -->

                        <?php }?>
                    <?php }?>
                    
                </div>


            <!-- page script -->
            <script>

    $(function () {
        //Datemask dd/mm/yyyy
        $(".datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
     });
            $(".searchAgain").click(function () {

                $header = $(this);
                //getting the next element
                $content = $( "#bodyt" );
                //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
                $content.slideToggle(500, function () {
                    //execute this after slideToggle is done
                    //change text of header based on visibility of content div
                    $header.text(function () {
                        //change text based on condition
                        //var expand = $(".header").html('<button type="button" class="btn btn-box-tool"><i class="fa fa-plus"></button>');
                        return $content.is(":visible") ? "Collapse" : "Search Again";
                    });
                });

            });
            </script>

    <script src="<?=DN?>/plugins/multiple-select/multiple-select.js"></script>
    <script>
        $('select.multiple-select').multipleSelect();
    </script>

              
	  </div><!-- /.row -->
    
</section>