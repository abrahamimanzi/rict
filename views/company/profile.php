<?php 
$CompanyDb = DB::getInstance();
$Company_select = $CompanyDb->get('all','app_company',array('user_ID','=',$session_user_ID));
if(!$Company_select->count()){
    Functions::errorPage(404);
}else{
    $company_data = $Company_select->first();
?>
<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-6 col-sm-8">
				<h3 class="content-title text-center">
					My Company
					<small></small>
				</h3>
			</div>
			<div class="col-xs-6 col-sm-4">
	  
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
		<nav class="navbar navbar-default navbar_content">
			<div class="navbar-header">
			  <span class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			  </span>
			  <a class="navbar-brand" href="#"><span >New </span><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Actions
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
					  <li><a href="#">Select all</a></li>
					  <li><a href="#">Setting 1</a></li>
					  <li><a href="#">PSetting 1</a></li> 
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Setting
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
					  <li><a href="#">Setting 1</a></li>
					  <li><a href="#">PSetting 1</a></li> 
					</ul>
				</li>
				<li><a href="#">Page</a></li> 
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="#"> </a></li>
			  </ul>
			</div>
		</nav>
	</div>
</section>

<!-- Main content -->
<section class="content user_profile_section">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="#"><span  class="fa fa-refresh has_tooltip" title="Refresh the page"></span></a> <a href="#"> Companies >></a> <?=$company_data->company;?>
        </div>
        <div class="panel-body">
            <h3><?=$company_data->company;?> <small><?=$company_data->motto;?></small></h3>
        </div>
    </div>
    <div class="layout">
	  <div class="row main_row">
		<div class="col-sm-3 col_menu">
		  <!-- small box -->
		  <div class="panel profile_menu_panel">
                <div class="photo_inner">
                    <div class="layout">
                        <img style="width: 200px; border-radius: 0px;" src="<?=DN?>/data_user/logo/cube-logo.png" class="img p_photo">
                        <div class="options_div">
                            <a href="#section-change_photo" data-toggle="tab" aria-expanded="true" class="update_btn btn btn-sm btn-primary"><i class="fa fa-camera"></i> Change photo</a>
                        </div>
                    </div>
                    <div class="blur_bg" style="background-image: url('<?=DN?>/data_user/logo/cube-logo.png');"></div>
                </div>
                <div class="profile_menu">
                    <ul id="myTab" class="nav nav-pills">
                        <li class="active">
                            <a href="#service-1" data-toggle="tab" aria-expanded="true"><i class="fa fa-arrow-circle-right"></i> Basic Information</a>
                        </li>
                        <li>
                            <a href="#service-2" data-toggle="tab" aria-expanded="true"><i class="fa fa-arrow-circle-right"></i> Privacy & Security</a>
                        </li>
                        <li>
                            <a href="#section-licence" data-toggle="tab" aria-expanded="true"><i class="fa fa-arrow-circle-right"></i> Licence</a>
                        </li>
                        <li>
                            <a href="#section-team" data-toggle="tab" aria-expanded="true"><i class="fa fa-arrow-circle-right"></i> Teams</a>
                        </li>
                        <li>
                            <a href="#section-archive-sign_in" data-toggle="tab" aria-expanded="true"><i class="fa fa-arrow-circle-right"></i> Archives</a>
                        </li>
                    </ul>
                </div>
		  </div>
		</div><!-- ./col -->
		<div class="col-sm-9 col_details">
            <!-- small box -->
            <div id="profileTabContent" class="tab-content">
                <div class="tab-pane active" id="service-1">
                    <h2>Basic Information</h2>
                    <br/>
                    <div class="tab-content" id="personalInfoContent">
                        <div class="tab-pane pi_tab active" id="personalInfo">
                            <p>
                            Manage your companu's information - to help others find your company on Timbaktu and make it easier to get in touch.
                            </p>
                            <div class="panel profile_details_panel">
                                <div class="panel-heading">

                               </div>
                                <div class="panel-body">
                                    <a class="row_detail" href="#company_details" data-toggle="tab" aria-expanded="true" >
                                        <div class="row">
                                            <div class="col col-xs-3">
                                                <h5 class="label">Company name</h5>
                                            </div>
                                            <div class="col col-xs-8">
                                                <div class="value"><?=$company_data->company;?></div>
                                            </div>
                                            <div class="col col-xs-1">
                                                <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a> 
                                    <a class="row_detail" href="#company_details" data-toggle="tab" aria-expanded="true">
                                        <div class="row">
                                            <div class="col col-xs-3">
                                                <h5 class="label">Motto</h5>
                                            </div>
                                            <div class="col col-xs-8">
                                                <div class="value"><?=$company_data->motto;?></div>
                                            </div>
                                            <div class="col col-xs-1">
                                                <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a> 
                                    <a class="row_detail" href="#company_details" data-toggle="tab" aria-expanded="true">
                                        <div class="row">
                                            <div class="col col-xs-3">
                                                <h5 class="label">Primary Email</h5>
                                            </div>
                                            <div class="col col-xs-8">
                                                <div class="value"><?=$company_data->email;?></div>
                                            </div>
                                            <div class="col col-xs-1">
                                                <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a> 
                                    <a class="row_detail" href="#company_details" data-toggle="tab" aria-expanded="true">
                                        <div class="row">
                                            <div class="col col-xs-3">
                                                <h5 class="label">Phone</h5>
                                            </div>
                                            <div class="col col-xs-8">
                                                <div class="value"><?=$company_data->telephone;?></div>
                                            </div>
                                            <div class="col col-xs-1">
                                                <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a> 
                                    <a class="row_detail" href="#company_details" data-toggle="tab" aria-expanded="true">
                                        <div class="row">
                                            <div class="col col-xs-3">
                                                <h5 class="label">Country</h5>
                                            </div>
                                            <div class="col col-xs-8">
                                                <div class="value"><?=$company_data->country_ID;?></div>
                                            </div>
                                            <div class="col col-xs-1">
                                                <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a> 
                                    <a class="row_detail" href="#company_details" data-toggle="tab" aria-expanded="true">
                                        <div class="row">
                                            <div class="col col-xs-3">
                                                <h5 class="label">Address</h5>
                                            </div>
                                            <div class="col col-xs-8">
                                                <div class="value"><?=$company_data->address;?> </div>
                                            </div>
                                            <div class="col col-xs-1">
                                                <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a> 
                                    <a class="row_detail" href="#company_details" data-toggle="tab" aria-expanded="true">
                                        <div class="row">
                                            <div class="col col-xs-3">
                                                <h5 class="label">Details</h5>
                                            </div>
                                            <div class="col col-xs-8">
                                                <div class="value"><?=$company_data->details;?></div>
                                            </div>
                                            <div class="col col-xs-1">
                                                <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane pi_tab" id="company_details">
                            <div class="row">
                                <div class="col-md-9">
                                    <form method="post">
                                    <label for="">Company name</label>
                                    <input name="company-company" class="form-control" max-length="100" value="<?=$company_data->company;?>">
                                    <br>
                                    <label for="">Motto</label>
                                        <textarea name="company-motto" class="form-control" max-length="200"><?=$company_data->motto;?></textarea>
                                    <br>
                                    <label for="">Email</label>
                                    <input name="company-email" type="email" class="form-control" max-length="100" value="<?=$company_data->email;?>">
                                    <br>
                                    <label for="">Telephone</label>
                                    <input name="company-telephone" class="form-control" max-length="15" value="<?=$company_data->telephone;?>">
                                    <br>
                                    <label for="">Country</label>
                                    <input name="company-country_ID" class="form-control" value="<?=$company_data->country_ID;?>">
                                    <br>
                                        
                                    <label for="">Details</label>
                                        <textarea name="company-details" type="company-motto" class="form-control" max-length="200"><?=$company_data->details;?></textarea>
                                    <br>
                                    <input type="hidden" name="webToken" value="56">
                                    <input type="hidden" name="request" value="company-edit">
                                    <input type="hidden" name="company-id" value="<?=$company_data->ID?>">
                                    <a class="btn btn-sm btn-default" href="#personalInfo" data-toggle="tab" aria-expanded="true">Back</a>
                                    <button type="submit" class="btn btn-sm btn-primary pull-right">Save</button>
                                    <br>
                                    <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="service-2">
                    <h2>Privacy and Security</h2>
                    <div class="">
                        <p>
                            Your account privacy maters, Manage your account accessibility.
                        </p>
                    </div>
                    <div class="panel profile_details_panel">
                        <div class="panel-heading">

                       </div>
                        <div class="panel-body">
                            <a class="row_detail">
                                <div class="row">
                                    <div class="col col-xs-3">
                                        <h5 class="label">Lock</h5>
                                    </div>
                                    <div class="col col-xs-8">
                                        <div class="value">****</div>
                                    </div>
                                    <div class="col col-xs-1">
                                        <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </a> 
                           
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="section-archive-sign_in">
                    <h2>Privacy and Security</h2>
                    <div class="">
                        <p>
                            Your account privacy maters, Manage your account accessibility.
                        </p>
                    </div>
                    <div class="panel profile_details_panel">
                        <div class="panel-heading">

                       </div>
                        <div class="panel-body">
                            <a class="row_detail">
                                <div class="row">
                                    <div class="col col-xs-3">
                                        <h5 class="label">Lock</h5>
                                    </div>
                                    <div class="col col-xs-8">
                                        <div class="value">****</div>
                                    </div>
                                    <div class="col col-xs-1">
                                        <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </a> 
                           
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="section-licence">
                    <h2>Software Licence.</h2>
                    <div class="">
                        <p>
                            Software licence.
                        </p>
                    </div>
                    <div class="panel profile_details_panel">
                        <div class="panel-heading">

                       </div>
                        <div class="panel-body">
                            <a class="row_detail">
                                <div class="row">
                                    <div class="col col-xs-3">
                                        <h5 class="label">Lock</h5>
                                    </div>
                                    <div class="col col-xs-8">
                                        <div class="value">****</div>
                                    </div>
                                    <div class="col col-xs-1">
                                        <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </a> 
                            <a href="" class="row_detail">
                                <div class="row">
                                    <div class="col col-xs-3">
                                        <h5 class="label">Licence type</h5>
                                    </div>
                                    <div class="col col-xs-8">
                                        <div class="value">Deluxe </div>
                                    </div>
                                    <div class="col col-xs-1">
                                        <div class="more_btn"><i class="fa fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </a> 
                           
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="section-team">
                    <h2>Team members</h2>
                    <div class="">
                        <p>
                            Come together is the begining, Stay together is the loremipsum
                        </p>
                    </div>
                    <div class="panel profile_details_panel">
                        <div class="panel-heading">

                       </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                  <!-- USERS LIST -->
                                  <div class="box box-pink">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Latest Members</h3>

                                      <div class="box-tools pull-right">
                                        <span class="label label-aqua">8 New Members</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                      </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                                      <ul class="users-list clearfix">
                                        <li>
                                           <img style="width: 100px; height: 100px" src="<?=DN?>/data_user/icons/lady.jpg" alt="User Image">
                                          <a class="users-list-name" href="#">Jane</a>
                                          <span class="users-list-date">12 Jan</span>
                                        </li>
                                        <li>
                                          <img style="width: 100px" src="<?=DN?>/data_user/icons/user.png" alt="User Image">
                                          <a class="users-list-name" href="#">Alexander Pierce</a>
                                          <span class="users-list-date">Today</span>
                                        </li>
                                        <li>
                                           <img style="width: 100px" src="<?=DN?>/data_user/icons/janette.png" alt="User Image">
                                          <a class="users-list-name" href="#">Norman</a>
                                          <span class="users-list-date">Yesterday</span>
                                        </li>
                                        <li>
                                          <img style="width: 100px" src="<?=DN?>/data_user/icons/Serge.jpeg" alt="User Image">
                                          <a class="users-list-name" href="#">Alexander Pierce</a>
                                          <span class="users-list-date">12 Jan</span>
                                        </li>
                                        <li>
                                           <img style="width: 100px" src="<?=DN?>/data_user/icons/janette.png" alt="User Image">
                                          <a class="users-list-name" href="#">Alexander</a>
                                          <span class="users-list-date">13 Jan</span>
                                        </li>
                                        <li>
                                          <img style="width: 100px" src="<?=DN?>/data_user/icons/akon.jpg" alt="User Image">
                                          <a class="users-list-name" href="#">Sarah</a>
                                          <span class="users-list-date">14 Jan</span>
                                        </li>
                                        <li>
                                           <img style="width: 100px" src="<?=DN?>/data_user/icons/janette.png" alt="User Image">
                                          <a class="users-list-name" href="#">Nora</a>
                                          <span class="users-list-date">15 Jan</span>
                                        </li>
                                        <li>
                                           <img style="width: 100px" src="<?=DN?>/data_user/icons/user.png" alt="User Image">
                                          <a class="users-list-name" href="#">Nadia</a>
                                          <span class="users-list-date">15 Jan</span>
                                        </li>
                                      </ul>
                                      <!-- /.users-list -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer text-center">
                                      <a href="javascript:void(0)" class="uppercase">View All Members</a>
                                    </div>
                                    <!-- /.box-footer -->
                                  </div>
                                  <!--/.box -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane" id="section-change_photo">
                    <div class="panel profile_details_panel">
                        <div class="panel-body">
                           
    <script src="<?=DN?>/plugins/jquery.cropit/jquery.cropit.js"></script>

    <style>
      .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 250px;
        height: 250px;
      }

      .cropit-preview-image-container {
        cursor: move;
      }

      .image-size-label {
        margin-top: 10px;
      }

      input, .export {
        display: block;
      }

      button {
        margin-top: 10px;
      }
    </style>
      
    <div class="image-editor">
      <div class="cropit-preview"></div>
      <div class="image-size-label">
        Resize image
      </div>
      <input type="range" class="cropit-image-zoom-input">
        <button class="rotate-ccw"><i class="fa fa-undo"></i></button>
        <button class="rotate-cw"><i class="fa fa-repeat"></i></button>

      <input type="file" class="cropit-image-input">
      <button class="export">Save</button>
    </div>

    <script>
      $(function() {
        $('.image-editor').cropit({
          imageState: {
            src: '<?=DN?>/data_user/logo/cube-logo.png',
          },
        });

        $('.rotate-cw').click(function() {
          $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
          $('.image-editor').cropit('rotateCCW');
        });

        $('.export').click(function() {
          var imageData = $('.image-editor').cropit('export');
          window.open(imageData);
        });
      });
    </script>

                    
                        </div>
                    </div>
                </div>
            </div>
		</div><!-- ./col -->
	  </div><!-- /.row -->
    </div>
</section>

<?php }?>