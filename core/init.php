<?php
ob_start();
session_start();
ini_set('session.save_path',realpath(dirname('sessions')));
//error_reporting(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//------------------//
// CONFIGURE HTTPS //

// if($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != '127.0.0.1'){
//     $http = 'https'; 
//     if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
//         $redirect = $http.'://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//         header('HTTP/1.1 301 Moved Permanently');
//         header('Location: ' . $redirect);
//         exit();
//     }
// }else{
//     $http = 'http';
// }

$http = 'http';

function def(){
	define("CT","Controller");
	define("_","/");
	define("view_session_off_","views/app_session_off/");
	define("view_session_off","views/app_session_off");
	define("P",".php");
	define("PL",".php");
	define("_PATH_","/");
	define("_VIEWS_","resources/views/");
	define("_PATH_VIEWS_","./views/");
	define("DN",Config::get('url/home'));
	define('Controller_NS','app\Http\Controllers\\');  // NS => Namespace
	define('Url_NS','app\Http\Url\\');
	define("DNADMIN",DN._.Config::get('url/bk_dir'));
}

// Initialize Global Date Class >> Timezone
require 'classes/Dates.php';
// Initialize Global Functions
require_once 'functions/global.php';

$GLOBALS['config'] = array(
	'mysql' => array(

        
		// 'host' => 'localhost',
		// 'username' => 'ginosoft_user',
		// 'password' => 'zT$0APTe}Nz4',
		// 'db' => 'valwallet_db'
	
        
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db' => '01_ricta_db'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'subscriber' => 'gino_hash',
		'cookie_expiry' => 604800,
		'browser_token_expiry' => 60*60*12,
	),
	'var' => array(
		'browser_token_name' => 'TimBrowse',
		'browser_token_ID' => 'TimBrowserID',
	),
	'session' => array(
		'session_name' => 'timbaktu_ID',
		'subscriber' => 'gino_hash',
		'token_name' => 'token'
	),
	'submit' => array(
		'method' => ''
	),
	'token' => array(
		//'smskey' => "63e6292c250db86b80b8ac64a71e154e46622b79"
	),
	'url' => array(
		'app_dir'=>"",
		'home' => "$http://{$_SERVER['HTTP_HOST']}/rict",
		// 'home' => "$http://{$_SERVER['HTTP_HOST']}/tas17_test",
		// 'home' => "$http://{$_SERVER['HTTP_HOST']}",
		'bk_dir' => "rict",
	),
	'time' => array(
		'date_time' => Dates::get('D, Y-m-d h:i:s a'),
		'timestamp' => $time,
		'seconds' => $time,
		'browser_token_expiry' => 60*60*12,
	),
	'dev' => array(
		'devMode' => true
	)
);

$uri = $_SERVER['REQUEST_URI'];
$uri_array = explode('?',$uri);
if(count($uri_array)>1){
    $uri_get = $uri_array[1];
    $uri_get_array = explode('&',$uri_get);
    for($i=0;$i<count($uri_get_array);$i++){
        $uri_get_el = $uri_get_array[$i];
        $uri_get_el = explode('=',$uri_get_el);
        if($uri_get_el){
            $_GET[$uri_get_el[0]] = @$uri_get_el[1];
        }
    }
}

// Load Classes
function __autoload($class){
	$pathArray = explode('\\',$class);
	if(count($pathArray)>1){
		require_once $class . '.php';
	}else{
		require_once 'classes/'.$class . '.php';
	}
}

//Initialize Define
def();

$db = DB::getInstance();

$init = (object)[
		'db_status'=>$db->connected(),
		'app_token'=>microtime(true)
	];
	
$appData = new AppData();
$appData->setDBStatus($db->connected());

/* Logout */

if(Input::checkInput('logout','get',0)){
	$userClass = new User();
	$sessionName = Config::get('session/session_name');
	$cookieName = Config::get('remember/cookie_name');
	if(Session::exists($sessionName)){
		$userID = Session::get($sessionName);
		$userTokenClass = new UserToken();
		$userTokenClass->select(array('ID','user_ID'),"WHERE `user_ID`= ? ",array($userID));
		if($userTokenClass->count()){
			$usertoken_data = $userTokenClass->first();
			$userTokenClass->delete($usertoken_data->ID);
			Redirect::to('logout');
		}else{
			$userClass->logout();
		}
	}
	$userClass->logout();
    
}

/* START LOGIN CHECKING*/
$userClass = new User();
$sessionName = Config::get('session/session_name');
$cookieName = Config::get('remember/cookie_name');
if(Session::exists($sessionName)){
    $userID = Session::get($sessionName);
    $userTokenClass = new UserToken();
    $userTokenClass->select(array('ID','user_ID'),"WHERE `user_ID`= ? ",array($userID));
    if($userTokenClass->count()){
        $usertoken_data = $userTokenClass->first();
        if($usertoken_data->user_ID == $userID){
            Session::put($sessionName,$userID);
        }else{
            $userClass->logout();
        }
    }else{
        $userClass->logout();
    }
}else{
     // REMEMBER USER
    if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
        $hash = Cookie::get(Config::get('remember/cookie_name'));
        $hashCheck = DB::getInstance()->get('user_session', array('hash','=',$hash));

        if($hashCheck->count()){
            $userID = $hashCheck->first()->user_ID;
            $user = new User($userID);
            $userTokenClass = new UserToken();
            $userTokenClass->select(array('ID','user_ID'),"WHERE `user_ID`= ? ",array($userID));
            if($userTokenClass->count()){
                $user->login();
            }else{
                $userClass->logout();
            }
        }else{
            $userClass->logout();
        }
    }
}
/* END LOGIN CHECKING*/

$session_user = new User();
if($session_user->isLoggedIn()){
	$session_user_data = $session_user->data();
	$session_user_ID = $session_user_data->ID;
    
    $companyTable = new Company();
    $companyTable->selectQuery("SELECT* FROM `app_company` WHERE `ID`=? LIMIT 1",array($session_user_data->company_ID));
    if($companyTable->count()){
        $session_company_data = $companyTable->first();
        $session_company_ID = $session_company_data->ID;
    }else{
        Redirect::to(404);
    }
}
?>

