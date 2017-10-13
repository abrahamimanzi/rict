<div class=" text-center">
	<ul class = "pagination" style="display: inline-block; font-size: 11px">
		<li class="<?php if($pageNumber==0){ echo 'disabled';}?>"><a href = "<?=$requesturl?>"><i class="fa fa-fast-backward"></i> </a></li>
		
		<?php 
		$pagesLimit = 6;
		$offsetNumber = $pageNumber*$rowsLimit;
		$pageList=1;
		if($totalPages-$pageNumber>0){
			if($pageNumber-3>0){
				$pageList = $pageNumber-3;
			}
		}else{
			$pageList = $pageNumber;
		}
		$pagesBreak = $pageList+$pagesLimit;
		if($pageList>1){?>
		<li><a href = "<?=$requesturl?>&page=<?=$pageNumber-1?>"> <i class="fa fa-step-backward"></i></a></li>	
		<?php
		}
		while($pageList<$totalPages){
			if($pageList==0){ 
				$pageList++;
				continue;
			}
			if($pageList>$pagesBreak){ 
				if($pageList<$totalPages){?>
					<?php if($pageNumber>0){?>
					<li><a href="<?=$requesturl?>&page=<?=$pageNumber+1?>"> <i class="fa fa-step-forward"></i></a></li>	
					<?php }?>
					<li class="<?php if($pageNumber==$pageList){ echo 'disabled';}?>"><a href = "<?=$requesturl?>&page=<?=$totalPages-1?>"><i class="fa fa-fast-forward"></i> </a></li>
				<?php
				}
				break;
			}
			?>
		   <li class="<?php if($pageNumber==$pageList){ echo 'active';}?>"><a  href = "<?=$requesturl?>&page=<?=$pageList?>"><?php echo $pageList; ?></a></li>
			<?php 
			$pageList++;
		}?>
	</ul>
</div>