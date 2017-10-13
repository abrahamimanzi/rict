<!DOCTYPE html>
<html>
<head>
	<?php include 'includes'._.'app_head_init'.P; ?>
	<link href="<?=DN?>/css/app_login_form.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<header class="main-header">
			<?php include view_session_off_.'app_header'.P ?>
		</header>
		<div class="content-wrapper">
			<div class="app_guest_room" >
                
				<?php 
                    if(Input::checkInput('request','get','1')){
                        $post_request = Input::get('request','get');
                        switch($post_request){
                            case 'resetpassword':
				                include 'views/login/login-resetpassword'.P;
                                break; 
                            case 'forgotpassword':
				                include 'views/login/login-forgotpassword'.P;
                                break;   
                            default:
				                include 'views/login/login-form'.P;
                            break;
                        }
                    }?>
            
            <br>
			</div>
            
<div class="text-center" style="font-size: 12px;;padding: 20px 10px 15px 10px; background: #fff; color: #888">
All rights reserved | Copyright 2017 NEXT 
</div>
            
            
		</div>
	</div>
</body>
</html>