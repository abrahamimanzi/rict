<?php

$error_message = '';
$form_error = false;
$form = (object)['ERRORS' => false];

$request = Input::get('request','get');
$url_struc['tree'] = Input::get('request','get');
$url_struc['trunk'] = Input::get('trunk','get');
$url_struc['branch'] = Input::get('branch','get');
$var_branch = array();

if(Input::checkInput('branch','get','1')){
    $var_branch = explode('-',Input::get('branch','get'));
    $url_struc['branch'] = $var_branch[0];
}

$url_struc['branch-sub1'] = @$var_branch[1];
$url_struc['branch-sub2'] = @$var_branch[2];


if($url_struc['tree'] =='app'){
    $url_struc['app-idname'] = Input::get('idname','get');
}
if($url_struc['branch-sub2'] =='export'){
    
    $event_ID = Input::get('id','get');
    Redirect::to(DN.'/export/'.$event_ID);
}

if($url_struc['branch-sub2'] =='exportsearch'){
    
    $event_ID = Input::get('id','get');
    Redirect::to(DN.'/exportsearch/');
}


//********************//
//    GET DETECTS    //
//******************//

if(Input::checkInput('request','get','1')){
	$post_request = Input::get('request','get');
	switch($post_request){
            
       // Logout
            
		case 'logout':
			$db = DB::getInstance();
            $sessionName = Config::get('session/session_name');
            $cookieName = Config::get('remember/cookie_name');
            $temp = Config::get('time/seconds');
            if(isset($_SESSION[$sessionName])){
                $user_ID = Session::get($sessionName);
                
                $pageviewClass = new PageView();
                $page_type = 'Logout';
                $page_item_ID = 3;

                $grab_info = '';
                $pageviewClass->insert(array('page_ID'=>$page_item_ID,
                                         'user_ID'=>$session_user_ID,
                                         'email'=>$session_user_data->email,
                                         'type'=>$page_type));
        
                $db->delete('user_session',array('user_ID','=',$user_ID));
                $db->update('app_users',$user_ID,array('account_session'=>'0','last_access'=>$temp));
                Cookie::delete($cookieName);
                
                session_destroy();
                session_unset();
                session_regenerate_id(true);

                $sessionName = Config::get('session/session_name');
                $cookieName = Config::get('remember/cookie_name');

                if(isset($_COOKIE["$sessionName"])){
                    unset($_COOKIE["$sessionName"]);
                    setcookie($sessionName, null, -1, '/');
                    Cookie::delete($cookieName);
                } 
            }
            Redirect::to(DN.'/login');
		break;
            
		case 'resetpassword':
            if(Input::checkInput('id','get','1')){
               $generated_string = Input::get('code','get');

                $user_id = Input::get('id','get');
                $userTable = new User();
                $userTable->selectQuery("SELECT * FROM `app_users` WHERE `ID`= ? AND `recovery_string`!=''",array($user_id));
                if(!$userTable->count()){
                    Redirect::to(DN.'/login/forgotpassword');
                }else{

                    $user_data = $userTable->first();
                    $secret_key = $user_data->password;
                    $recovery_string = strtoupper(hash_hmac('SHA256', $generated_string, pack('H*',$secret_key)));
                    if($recovery_string == $user_data->recovery_string){

                        $user_ID = $user_data->ID;                 
                    }else{
                        Redirect::to(DN.'/login/forgotpassword');
                    }
                } 
            }else{
                if(Input::get('response','get') != 'success'){
                    Redirect::to(DN.'/login/forgotpassword');
                }
            }
		break;
    }
    
}
?>
  


<?php 
          
		// USERS
if(Input::checkInput('webToken','post','1') && Input::checkInput('request','post','1')){
	$post_request = Input::get('request','post');
	switch($post_request){
		// USERS
		case 'user_sigggnup':
			$form = UserController::signup();
			if($form->ERRORS == false){
                $_POST['login_username'] = $_POST['signup_username'];
                $_POST['login_password'] = $_POST['signup_password'];
                $form = UserController::login('Signup');
                $form = CompanyController::create();
				Redirect::to('login');
			}else{
				// echo errors
			}
		break;
		case 'user_login':
			$form = UserController::login();
			if($form->ERRORS == false){
				Redirect::to(DN);
			}else{
				//echo errors
			}
		break;
		case 'recover-login':
            if(Input::checkInput('recover-email','post','1')){
                $user_email = Input::get('recover-email','post');
                $userTable = new User();
                $userTable->selectQuery("SELECT * FROM `app_users` WHERE `email`= ?",array($user_email));
                if(!$userTable->count()){
                    $form->ERRORS = true;
                }else{
                    $user_data = $userTable->first();
                    if($user_data->email == $user_email){
                        
                        $user_ID = $user_data->ID;

                        $form = UserController::requestPasswordReset($user_ID);

                        if($form->ERRORS == false){
                            Redirect::to(DN.'/login/forgotpassword/success');
                        }else{
                            //echo errors
                        }                   
                    }
                }
			}
            Redirect::to(DN.'/login/forgotpassword/errors');
		break;
		case 'user-new':
            $CompanyDb = DB::getInstance();
            $Company_select = $CompanyDb->get(array('ID'),'app_company',array('ID','=',$session_company_ID));
            if($Company_select->count()){
                $_POST['user-company_ID'] = $session_company_ID;
                $form = UserController::add();
                if($form->ERRORS == false){
                   Redirect::to(DN.'/company/users/list');
                }else{
                    //echo errors
                }
            }
		break;
		case 'user-update':
            if(Input::checkInput('id','get','1')){
                $user_ID = Input::get('id','get');
                $userTable = new User();
                $userTable->selectQuery("SELECT * FROM `app_users` WHERE `company_ID`=? AND `ID`= ?",array($session_company_ID,$user_ID));
                if(!$userTable->count()){
                    Functions::errorPage(404);
                }else{
                    $user_data = $userTable->first();
                    $user_ID = $user_data->ID;
                
                    $user_ID = Str::sanAsID(Input::get('id','get'));
                    if($url_struc['branch-sub1'] == 'password'){
                        $form = UserController::updatePassword($user_ID);
                    }else{
                        $form = UserController::update($user_ID);
                    }
                    
                    if($form->ERRORS == false){
				        Session::put('success','User account updated successfully');
                        Redirect::to(DN.'/company/users/list');
                    }else{
                        //echo errors
                    }
                }
			}else{
				Session::put('errors','Bad request! Please, contact the Admin'); 
                Redirect::to(DN.'/company/users/list');
			}
		break;
		case 'reset-password':
            if(Input::checkInput('id','get','1')){
                $user_ID = Input::get('id','get');
                $userTable = new User();
                $userTable->selectQuery("SELECT * FROM `app_users` WHERE `ID`= ?",array($user_ID));
                if(!$userTable->count()){
                   // Redirect::to(DN.'/404');
                }else{
                    $user_data = $userTable->first();
                    $user_ID = $user_data->ID;
                
                    $form = UserController::resetPassword($user_ID);
                    
                    if($form->ERRORS == false){
				        Session::put('success','Password changed successfully');
                        Redirect::to(DN.'/login/resetpassword/success');
                    }else{
                        //echo errors
                    }
                }
			}else{
                Redirect::to(DN.'/404');
			}
		break;
            
		case 'user-state':
            $user_ID = Str::sanAsID(Input::get('user-id','post'));
            $userTable = new User();
            $userTable->selectQuery("SELECT * FROM `app_users` WHERE `company_ID`=? AND `ID`= ?",array($session_company_ID,$user_ID));
            if(!$userTable->count()){
                Functions::errorPage(404);
            }else{
                $user_data = $userTable->first();
                if(Input::checkInput('block','post','0')){
                     $state = 'Block';
                     $form = UserController::changeState($state,$user_ID);
                 }elseif(Input::checkInput('activate','post','0')){
                     $state = 'Activate';
                     $form = UserController::changeState($state,$user_ID);
                     if($form){
                         
                     }
                    
                    if($form->ERRORS == false){
                       Redirect::to(DN.'/company/users/list');
                    }else{
                        //echo errors
                    }
                }
			}
        break;
        // Ricta payment
        case 'make-payment':
            $_POST['pay-admin_ID'] = $session_user_ID;
            $form = Payment::bkPayment();
            if($form->ERRORS == false){
                //$subscriber_data = $form->ERRORS_SCRIPT['data'];
               //Redirect::to(DN.'/company/subscriber/'.$subscriber_data->ID.'/category');
            }else{
                //echo errors
            }



            $CompanyDb = DB::getInstance();
            $Company_select = $CompanyDb->get(array('ID'),'app_company',array('ID','=',$session_company_ID));
            if($Company_select->count()){
                $_POST['user-company_ID'] = $session_company_ID;
                $form = UserController::add();
                if($form->ERRORS == false){
                   Redirect::to(DN.'/company/users/list');
                }else{
                    //echo errors
                }
            }
        break;
            

	}
}

?>