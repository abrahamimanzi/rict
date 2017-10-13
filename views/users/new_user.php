<div class="row">
	<div class="col-md-12">
		<h1 class="page-head-line">Add New User</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				New account
			</div>
			<div class="panel-body">
		
			<form  method="post" accept-charset="UTF-8" role="form"  enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<input class="form-control" placeholder="Full name" name="fullname" type="text">
					</div>
					<div class="form-group">
						<input class="form-control" placeholder="Enter email" name="email" type="text">
					</div>
					<div class="form-group">
						<label for="exampleInputFile">Featured image</label>
						<br/>
						<div class="fileinput fileinput-new" data-provides="fileinput">
						  <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
						  <div>
							<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
							<input id="profilePhoto" type="file" name="profilePhoto"></span>
							<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
						  </div>
						</div>
						<div id="progress-div"><div id="progress-bar"></div></div>
						 <div id="targetLayer"></div>
						<p class="help-block">Choose the image</p>
					</div>
					<div class="form-group">
						<label>Gender</label>
						<select name="gender" class="form-control">
							<option value="F">Female</option>
							<option value="M">Male</option>
						</select>
					</div>
					<div class="form-group">
						<label>Group</label>
						<select name="groups" class="form-control">
							<option value="Reporter">Reporter</option>
							<option value="Chefeditor">Chef Editor</option>
							<option value="Deactivated">Deactivated</option>
						</select>
					</div>
					<input type="hidden" name="token" value="true">
					<input type="hidden" name="task" value="newuser">
						<a href="?request=users" class="btn btn-md btn-default pull-left">Cancel</a>
					<input class="btn btn-md btn-success btn-block" type="submit" value="Submit">
				</fieldset>
			</form>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>