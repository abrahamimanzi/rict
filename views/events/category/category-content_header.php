<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
                    <a href="<?=DN?>/app/EventApp/home"><i class="fa fa-book fa-lg pink-col"></i></a> <small> <i class="fa fa-angle-double-right"></i> </small>
					<?=$event_data->name;?>
				</h3>
			</div>
			<div class="col-xs-12 col-sm-4 hidden-xs">
				<!-- Main search form -->
                <?php
                if($url_struc['branch-sub1']){
                    $search_url = DN.'/app/EventApp/'.$event_ID.'/participant-'.$url_struc['branch-sub1'];
                }else{
                    $search_url = DN."/app/EventApp/$event_ID/participant-list";
                }
                
                ?>
				<form action="<?=$search_url?>" method="get" class="mainsearch-form">
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

