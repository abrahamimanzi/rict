<div class="row">
	<div class="col-md-12">
		<h1 class="page-head-line">Web data</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Update web data
			</div>
			<div class="panel-body">
		
				<form  method="post" accept-charset="UTF-8" role="form"  enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<label>Company name : </label>
							<input class="form-control" placeholder="Company name" value="<?php echo $about_data->name;?>" name="name" type="text">
						</div>
                        <div class="form-group">
                            <label for="full_name"> Description :</label>
                            <textarea class="form-control" placeholder="Description"  rows="10" name="description" maxlength="2000" type="text" style="max-width: 100%" required><?php echo $about_data->description;?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="full_name"> Mission :</label>
                            <textarea class="form-control" placeholder="Mission" rows="10" name="mission" maxlength="500" type="text"  style="max-width: 100%" required><?php echo $about_data->mission;?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="full_name"> Vision :</label>
                            <textarea class="form-control" placeholder="Vision" rows="10" name="vision" maxlength="500" type="text"  style="max-width: 100%" required><?php echo $about_data->vision;?></textarea>
                        </div>
						<div class="form-group">
                            <label for="full_name"> Work Motiv. :</label>
                            <textarea class="form-control" placeholder="Work Motivation" rows="10" name="work_motiv" maxlength="500" type="text"  style="max-width: 100%" required><?php echo $about_data->work_motiv;?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="full_name"> Team word :</label>
                            <textarea class="form-control" placeholder="Description" rows="10" name="teamword" maxlength="500" type="text"  style="max-width: 100%" required><?php echo $about_data->teamword;?></textarea>
                        </div>
						<div class="form-group">
							<label>Location </label>
							<input class="form-control" placeholder="Location" value="<?php echo $about_data->address;?>" maxlength="200"  name="address" type="text">
						</div>
						<div class="form-group">
							<label>Email-Address :</label>
							<input class="form-control" placeholder="Enter email" value="<?php echo $about_data->email;?>"  name="email" type="email">
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Logo</label>
							<br/>
							<div class="row">
								<div class="col-sm-6">
									Current:<br/>
									<img src="<?php echo $about_data->profile;?>" class="img img-thumbnail" align="top">
								</div>
								<div class="col-sm-6" >
									New:<br/>
									<div class="fileinput fileinput-new" data-provides="fileinput">
									  <div class="fileinput-preview thumbnail" data-trigger="fileinput" ></div>
									  <div>
										<span class="btn btn-default btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
										    <input id="profilePhoto" type="file" name="profilePhoto">
                                        </span>
									  </div>
									</div>
								</div>
							</div>
						</div> 
                        <div class="form-group">
                            <label>Facebook link </label>
                            <input name="facebooklink" class="form-control" value="<?php echo $about_data->facebooklink; ?>" type="url" placeholder="Facebook link">
                        </div>
                        <div class="form-group">
                            <label>Twitter link </label>
                            <input name="twitterlink" class="form-control" value="<?php echo $about_data->twitterlink; ?>" type="url" placeholder="Twitter link">
                        </div>
                        <div class="form-group">
                            <label>Youtube link </label>
                            <input name="youtubelink" class="form-control" value="<?php echo $about_data->youtubelink; ?>" type="url" placeholder="Youtube link">
                        </div>
                        <div class="form-group">
                            <label for="full_name"> Tweets plugin :</label>
                            <textarea class="form-control" placeholder="Tweets plugin" rows="6" name="tweets" type="text"  style="max-width: 100%" required><?php echo $about_data->tweets;?></textarea>
                        </div>
						<input type="hidden" name="id" value="<?php echo $about_data->ID;?>">
						<input type="hidden" name="token" value="true">
						<input type="hidden" name="task" value="updateabout">
                        <a href="index" class="btn btn-sm btn-default pull-left">Cancel</a>
						<input class="btn btn-sm btn-success pull-right" type="submit" value="Save">
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>