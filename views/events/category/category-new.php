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
          <div class="col-sm-10 col-md-8">
              <form method="post" class="form-horizontal">
                 <!--RECENT NEW PARTICIPANT -->
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 10px 25px 10px 25px; ">
                        <fieldset class="panel-reg">
                            <?php $success = true;?>
                            <div class="form-group">
                              <div class="col-sm-12">
                                  <h4 class="fieldset-header">New Category <span class="req"></span></h4>
                                 <hr class="halfLine">
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="firstname">Category name 
                                    <span  class="req">*</span> 
                                    <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['name'][0];}?> </span>
                                </label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="category-name" id="fname" placeholder="Category name"  value="<?php if($success==false) echo @$_POST['name'] ?>" required>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="firstname">Prefix 
                                    <span  class="req">*</span> 
                                    <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['prefix'][0];}?> </span>
                                </label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="category-prefix" id="prefix" placeholder="Prefix name"  value="<?php if($success==false) echo @$_POST['prefix'] ?>" required maxlength="3">
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="url">Url string 
                                    <span  class="req">*</span> 
                                    <span style="color: red; font-size: 12px; display: block"> <?php if($form->ERRORS){ echo @$form->ERRORS_SCRIPT['url'][0];}?> </span>
                                </label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="category-url" id="prefix" placeholder="Url String name"  value="<?php if($success==false) echo @$_POST['url'] ?>" required maxlength="50">
                              </div>
                            </div>
                        </fieldset>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="webToken" value="56">
                    <input type="hidden" name="request" value="category-new">
                    <input type="hidden" name="category-event_id" value="<?=$event_data->ID?>">
                    <input type="hidden" name="category-company_id" value="<?=$company_data->ID?>">
                    <div class="box-footer clearfix">
                        <a href="<?=DN?>" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-info btn-flat pull-right">Submit</button>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                  <!--END NEW PARTICIPANT-->
              </form>
          </div>
          <div class="col-sm-1 col-md-2"></div>
	  </div><!-- /.row -->
    
</section>