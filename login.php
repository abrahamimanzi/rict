<?php   
require_once 'core/init.php'; 
require_once 'app/controller.php'; 
if(!$session_user->isLoggedIn()){ 

        
    if(Input::CheckInput('login_username','post','1')){
        $pageviewClass = new PageView();
        $page_type = 'Login';
        $page_item_ID = 1;

        $grab_info = '';

        $grab_info .= Input::get('login_username','post');
        $pageviewClass->insert(array('page_ID'=>$page_item_ID,
                             'type'=>$page_type,
                             'grabbed_info'=>$grab_info));
    }

    include 'layout/login.layout.php';
}else{
	Redirect::to(DN);
}?>

