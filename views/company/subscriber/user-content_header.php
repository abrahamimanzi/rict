<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
                    <a href="<?=DN?>"><i class="fa fa-shield fa-lg pink-col"></i></a> 
					Access Logs
				</h3>
			</div>
			<div class="col-xs-12 col-sm-4 hidden-xs">
				<!-- Main search form -->
				<form action="<?=DN?>/company/logs/list" method="get" class="mainsearch-form">
					<div class="input-group">
						<input type="text" name="keyword" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
                            <input name="search" value="1" type="hidden">
							<button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

