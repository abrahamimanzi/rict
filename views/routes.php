<?php 
if(!empty($url_struc['tree'])){
	switch($url_struc['tree']){
		case 'user':
			Functions::flashMsg();
            if(Input::checkInput('ID','get','1')){
                $profile_user_ID = Str::sanAsID(Input::get('ID','get'));  
            }else{
                $profile_user_ID = $session_user_data->ID;
            }
            
            $profile_user = new User();
            if($profile_user->find_user($profile_user_ID)){
                $profile_user_data = $profile_user->data();
                include 'views/user/profile'.PL;
            }else{
                include 'views/errors/404'.P;
            }
		break;
		case 'newuser':
			Functions::flashMsg();
			include 'views/user/new'.PL;
		break;
		case 'edituser':
			Functions::flashMsg();
			$user_ID = sanAsID(Input::get('id','get'));
			$userClass = new User();
			
			if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID){
				if($userClass->find($user_ID)){
					$user_data = $userClass->data();
					include 'views/user/edit'.PL;
				}else{
					Redirect::to(404);
				}
			}else{
				Redirect::to(404);
			}
		break;
		case 'notes':
			Functions::flashMsg();
            include 'views/notes/list'.PL;
		break;
            
        // Event
            
        case 'app':
			Functions::flashMsg();

            $company_data = $session_company_data;
            $company_ID = $company_data->ID;

            if(count($url_struc['trunk'])){
                switch($url_struc['trunk']){
                    case 'home':
                        $str = new Str();
                        if(Input::get('id','get')){
                            $event_ID = $str->sanAsID(Input::get('id','get'));
                            // Check if item exists
                            $eventDb = DB::getInstance();

                            $event_select = $eventDb->query("SELECT * FROM `events` WHERE `ID`=? AND `company_ID`=?",array($event_ID,$company_ID));

                            if($event_select->count()){  // Event found and registered by this compay, then Display details
                                $event_data = $event_select->first();
                                if($url_struc['branch'] == 'participant'){
                                    switch($url_struc['branch-sub1']){
                                        case 'list':
                                            include 'views/events/participant/participant-list'.PL;
                                            break;
                                        case 'finder':
                                            include 'views/events/participant/participant-finder'.PL;
                                            break;
                                        case 'backtransfer':
                                            include 'views/events/participant/participant-backtransfer'.PL;
                                            break;
                                        default:
                                            if(empty($url_struc['branch-sub1'])){
                                                include 'views/events/participant/participant-list'.PL;
                                            }else{
                                                $requested_categ = $url_struc['branch-sub1'];
                                                $categ_array = array('delegate','exhibitor','speaker','visitor','media','ftg','msgeek','approved','denied','pending','government','missing','noc','organiser','liaison','security','protocol','medical','catering','technician','contractor','armed','participants');
                                                if(in_array($requested_categ,$categ_array)){
                                                    include 'views/events/participant/participant-'.$requested_categ.PL;
                                                }

                                            }
                                        break;
                                    }
                                }elseif($url_struc['branch'] == 'category'){
                                    switch($url_struc['branch-sub1']){
                                        case 'new':
                                            include 'views/events/category/category-new'.PL;
                                            break;
                                        case 'list':
                                            include 'views/events/category/category-list'.PL;
                                            break;
                                        default:
                                            if(empty($url_struc['branch-sub1'])){
                                                include 'views/events/participant/participant-list'.PL;
                                            }else{
                                                $requested_categ = $url_struc['branch-sub1'];
                                                $categ_array = array('delegate','exhibitor','speaker','visitor','media','ftg','msgeek','approved','denied','pending','government','missing','noc','organiser','liaison','security','protocol','medical','catering','technician','contractor','armed','participants');
                                                if(in_array($requested_categ,$categ_array)){
                                                    include 'views/events/participant/participant-'.$requested_categ.PL;
                                                }
                                            }
                                        break;
                                    }
                                }else{
                                    include 'views/events/event-view'.PL;
                                }
                            }else{ // Else show error
                                Functions::errorPage(404);
                            }

                        }else{
                            include 'views/events/event-home'.PL;
                        }
                    break;
                    case 'list':
                        $str = new Str();
                        include 'views/events/event-list'.PL;
                    break;
                    case 'new':
                        include 'views/events/event-new'.PL;
                    break;
                    // case 'payment':
                    //     include 'views/events/participant/payment-list'.PL;
                    // break;
                    default:
                        include 'views/events/event-home'.PL;
                    break;
                }
            }
		break;
            
        // Company
            
        case 'company':
			Functions::flashMsg();
            if(count($url_struc['trunk'])){
                switch($url_struc['trunk']){
                    case 'home':
                        include 'views/payment/event-view'.PL;
                    break;
                    case 'payment':
                        include 'views/payment/payment-list'.PL;
                    break;
                    case 'profile':
                        include 'views/company/profile'.PL;
                    break;
                    case 'users':
                        switch($url_struc['branch']){    
                            case 'list':
                                switch($url_struc['branch-sub1']){
                                    case 'list':
                                        include 'views/company/users/user-list'.PL;
                                    break;
                                    default:
                                        include 'views/company/users/user-list'.PL;
                                    break;
                                }
                            break;
                            case 'new':
                                include 'views/company/users/user-new'.PL;
                            break; 
                            case 'edit':
                                $user_ID = Input::get('id','get');
                                $userTable = new User();
                                $userTable->selectQuery("SELECT * FROM `app_users` WHERE `company_ID`=? AND `ID`= ?",array($session_company_ID,$user_ID));
                                if(!$userTable->count()){
                                    Functions::errorPage(404);
                                }else{
                                    $user_data = $userTable->first();
                                    $user_ID = $user_data->ID;
                                    
                                    switch($url_struc['branch-sub1']){
                                        case 'password':
                                            include 'views/company/users/user-edit-password'.PL;
                                        break;
                                        default:
                                            include 'views/company/users/user-edit'.PL;
                                        break;
                                    }
                                }
                            break;
                            case 'buy':
                                include 'views/company/users/buy-domain'.PL;
                            break; 
                            case 'response':
                                include 'views/company/users/buy-response'.PL;
                            break; 
                         }
                        Functions::flashMsg();
                    break;
                    case 'subscriber':
                        switch($url_struc['branch']){    
                            case 'list':
                                switch($url_struc['branch']){
                                    case 'list':
                                        include 'views/company/subscriber/subscriber-list'.PL;    
                                    break;
                                    case 'admins':
                                        include 'views/company/subscriber/subscriber-list'.PL;    
                                    break;
                                    default:
                                        include 'views/company/subscriber/subscriber-list'.PL;
                                    break;
                                }
                            break;
                            case 'admins':
                                include 'views/company/subscriber/subscriber-admins'.PL;
                            break;
                            case 'new':
                                include 'views/company/subscriber/subscriber-new'.PL;
                            break; 
                            case 'newinvite':
                                include 'views/company/subscriber/subscriber-new-invite'.PL;
                            break; 
                            case 'edit':
                                $user_ID = Input::get('id','get');
                                $userTable = new User();
                                $userTable->selectQuery("SELECT * FROM `subscriber` WHERE `company_ID`=? AND `ID`= ?",array($session_company_ID,$user_ID));
                                if(!$userTable->count()){
                                    Functions::errorPage(404);
                                }else{
                                    $user_data = $userTable->first();
                                    $user_ID = $user_data->ID;
                                    
                                    switch($url_struc['branch-sub1']){
                                        case 'password':
                                            include 'views/company/subscriber/subscriber-edit-password'.PL;
                                        break;
                                        default:
                                            include 'views/company/subscriber/subscriber-edit'.PL;
                                        break;
                                    }
                                }
                            break;
                            case 'category':
                                $subscriber_ID = Input::get('id','get');
                                $subscriberTable = new Subscriber();
                                $subscriberTable->selectQuery("SELECT * FROM `subscriber` WHERE `ID`= ?",array($subscriber_ID));
                                if(!$subscriberTable->count()){
                                    Functions::errorPage(404);
                                }else{
                                    $subscriber_data = $subscriberTable->first();
                                    $subscriber_ID = $subscriber_data->ID;
                                    
                                    
                                    switch($url_struc['branch-sub1']){
                                        case 'password':
//                                            include 'views/company/subscriber/subscriber-edit-password'.PL;
                                        break;
                                        default:
                                            include 'views/company/subscriber/subscriber-category'.PL;
                                        break;
                                    }
                                }
                            break;
                            case 'categoryview':
                                $subscriber_ID = Input::get('id','get');
                                $subscriberTable = new Subscriber();
                                $subscriberTable->selectQuery("SELECT * FROM `subscriber` WHERE `ID`= ?",array($subscriber_ID));
                                if(!$subscriberTable->count()){
                                    Functions::errorPage(404);
                                }else{
                                    $subscriber_data = $subscriberTable->first();
                                    $subscriber_ID = $subscriber_data->ID;
                                    
                                    
                                    switch($url_struc['branch-sub1']){
                                        case 'password':
//                                            include 'views/company/subscriber/subscriber-edit-password'.PL;
                                        break;
                                        default:
                                            include 'views/company/subscriber/subscriber-categoryview'.PL;
                                        break;
                                    }
                                }
                            break;
                            case 'categoryinvite':
                                $subscriber_ID = Input::get('id','get');
                                $subscriberTable = new Subscriber();
                                $subscriberTable->selectQuery("SELECT * FROM `subscriber` WHERE `ID`= ?",array($subscriber_ID));
                                if(!$subscriberTable->count()){
                                    Functions::errorPage(404);
                                }else{
                                    $subscriber_data = $subscriberTable->first();
                                    $subscriber_ID = $subscriber_data->ID;
                                    
                                    
                                    switch($url_struc['branch-sub1']){
                                        case 'password':
//                                            include 'views/company/subscriber/subscriber-edit-password'.PL;
                                        break;
                                        default:
                                            include 'views/company/subscriber/subscriber-categoryinvite'.PL;
                                        break;
                                    }
                                }
                            break;
                         }
                        Functions::flashMsg();
                    break;
                    case 'logs':
                         if($url_struc['branch'] == 'list'){
                            switch($url_struc['branch-sub1']){
                                case 'list':
                                    include 'views/company/users/user-access_log'.PL;
                                break;
                                default:
                                    include 'views/company/users/user-access_log'.PL;
                                break;
                            }
                         }
                        Functions::flashMsg();
                    break;
                    default:
                        include 'views/errors/404'.P;
                    break;
                }
            }else{
                include 'views/errors/404'.P;
            }
		break;
        
            
        //Accomondation
        case 'accommodation':
                $str = new Str();
                if(Input::get('id','get')){
                    $event_ID = $str->sanAsID(Input::get('id','get'));
                    // Check if item exists
                    $eventDb = DB::getInstance();

                    // $event_select = $eventDb->query("SELECT * FROM `events` WHERE `ID`=? AND `company_ID`=?",array($event_ID,$company_ID));
                    $event_select = $eventDb->query("SELECT * FROM `events` WHERE `ID`=? ",array($event_ID));

                    if($event_select->count()){  // Event found and registered by this compay, then Display details
                        $event_data = $event_select->first();
                        switch($url_struc['branch']){
                            case 'list':
                                include 'views/accommodation/booking'.PL;
                            break;
                        }
                    }
                }
            // switch($url_struc['branch']){
            //     case 'list':
            //         include 'views/accommodation/booking'.PL;
            //     break;
            // }
            Functions::flashMsg();
        break;
        case 'newuser':
            Functions::flashMsg();
            include 'views/user/new'.PL;
        break;
        case 'edituser':
            Functions::flashMsg();
            $user_ID = sanAsID(Input::get('id','get'));
            $userClass = new User();
            
            if($session_user_data->groups == "Admin" || $session_user_ID == $user_ID){
                if($userClass->find($user_ID)){
                    $user_data = $userClass->data();
                    include 'views/user/edit'.PL;
                }else{
                    Redirect::to(404);
                }
            }else{
                Redirect::to(404);
            }
        break;

            
		//Events
			
		case 'events':
			include 'views/events/list'.PL;
		break;
		case 'event':
			$event_ID = sanAsID(Input::get('id','get'));
			$eventClass = new Events();
			$eventClass->get($event_ID);
			if($eventClass->count()){
				$event_data = $eventClass->data();
				include 'views/events/event'.PL;
			}else{
				Redirect::to(404);
			}
		break;
		case 'newevent':
			Functions::flashMsg();
			include 'views/events/new'.PL;
		break;
		case 'editevent':
			Functions::flashMsg();
			$agent_ID = sanAsID(Input::get('id','get'));
			$agentClass = new Events();
			
			if($session_user_data->groups == 'Admin'){
				$agentClass->get($agent_ID);
				if($agentClass->count()){
					$agent_data = $agentClass->data();
					include 'views/events/edit'.PL;
				}else{
					Redirect::to(404);
				}
			}else{
				Redirect::to(404);
			}
		break;
		
		//Applicants
			
		case 'applicants':
			include 'views/applicants/list'.PL;
		break;
		case 'newapplicant':
			Functions::flashMsg();
			include 'views/applicants/new'.PL;
		break;
		case 'editapplicant':
			Functions::flashMsg();
			$agent_ID = sanAsID(Input::get('id','get'));
			$agentClass = new Applicants();
			
			if($session_user_data->groups == "Admin"){
				$agentClass->get($agent_ID);
				if($agentClass->count()){
					$agent_data = $agentClass->data();
					include 'views/applicants/edit'.PL;
				}else{
					Redirect::to(404);
				}
			}else{
				Redirect::to(404);
			}
		break;
		
		case 'editapplicant':
			Functions::flashMsg();
			$agent_ID = sanAsID(Input::get('id','get'));
			$agentClass = new Applicants();
			
			if($session_user_data->groups == "Admin"){
				$agentClass->get($agent_ID);
				if($agentClass->count()){
					$agent_data = $agentClass->data();
					include 'views/applicants/edit'.PL;
				}else{
					Redirect::to(404);
				}
			}else{
				Redirect::to(404);
			}
		break;
		 
		
		default:	
			Session::put('errors','Page not found <a href="index">Go Back</a>');
			Functions::flashMsg();
			include 'views/errors/404'.P;
			$_GET['request'] = '404';
			$request = "404";
		break;
	}	
}else{
    Functions::flashMsg();
    $company_data = $session_company_data;
    $company_ID = $company_data->ID;
    $str = new Str();
    $event_ID = 5;
    // Check if item exists
    $eventDb = DB::getInstance();

    $event_select = $eventDb->query("SELECT * FROM `events` WHERE `ID`=? AND `company_ID`=?",array($event_ID,$company_ID));

    if($event_select->count()){  // Event found and registered by this compay, then Display details
        $event_data = $event_select->first();
        // include 'views/events/participant/participant-list'.PL;
        // include 'views/events/event-view'.PL;

        if($session_user_data->groups == 'RG-Admin' || $session_user_data->groups == 'RG-SUPER-Admin'){
            include 'views/events/participant/participant-forapproval'.PL;
        }else{
            include 'views/payment/payment-home'.PL;
        }
    }
}

?>