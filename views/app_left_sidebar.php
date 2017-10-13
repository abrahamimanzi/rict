<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel" style="height: 58px;">
			<div class="pull-left image">
				<?php
				if(file_exists(DN._.$session_user_data->profile)){?>
					<img src="<?=DN._.$session_user_data->profile;?>" class="img-circle" alt="User Image">
				<?php }else{?>
					<span style="display: block; padding: 8px 18px; border-radius: 100%; background: #333d41; color: #fff; font-size: 20px; font-weight: 600; border"><?php echo substr($session_user_data->firstname,0,1);?></span>
				<?php }?>
			</div>
			<div class="pull-left info">
			  <p><?=$session_user_data->firstname?></p>
			  <!-- Status -->
			  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">Menu</li>
			<!-- Optionally, you can add icons to the links -->
            <li class=""><a href="<?=DN?>/"><i class="fa fa-laptop"></i> <span>Dashboard</span></a></li>
           


            
			<li class="header">Company</li>
            <li class="treeview <?php if($url_struc['tree'] == "company" && $url_struc['trunk']=="users"){ echo 'actived';}?>">
                <a href="#"><i class="fa fa-fort-awesome"></i> <span>Accounts</span></a>
                <ul class="treeview-menu">
					<li class="<?php if($url_struc['tree']=="company" && $url_struc['trunk']=="users"){ echo 'actived';}?>">
                        <a href="<?=DN?>/company/users/list"><i class="fa fa-circle-o icon"></i><span>Users</span></a></li>
                    <?php
                        if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-Admin' || $session_user_data->groups == 'RG-SUPER-Admin'){?>
					<li class="<?php if($url_struc['tree']=="company" && $url_struc['trunk']=="users"){ echo 'actived';}?>">
                        <a href="<?=DN?>/company/logs/list"><i class="fa fa-circle-o icon"></i><span>Logs</span></a></li>
                    <?php } ?>
				</ul>
            </li>
            <li class=""><a href="<?=DN?>/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
			
		</ul><!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->