<?php
class UserController  
{
    public static function signup(){
        $diagnoArray[0] = 'NO_ERRORS';
        $validate = new \Validate();
        $prfx = 'signup_';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }
        $validation = $validate->check($_SIGNUP, array(
            'firstname' => array(
                'name' => 'Company Name',
                'string' => true,
                'required' => true,
                'min' => 2
            ),
            // 'lastname' => array(
            //  'name' => 'Your Names',
            //  'string' => true
            // ),
            'country' => array(
                'name' => 'Last Name',
                'required' => true
            ),
            'password' => array(
                'name' => 'Password',
                'strong_password' => true,
                'min' => 6,
                'required' => true
            ),
            'repassword' => array(
                'name' => 'Confirm Password',
                'matches' => 'password',
            ),
            'email' => array(
                'name' => 'Address Email',
                'email' => true,
                'unique' => "app_users",
                'required' => true
            )
        ));
        
        if($validation->passed()){
            $userTable = new \User();
            
            $str = new \Str();
            $_SIGNUP = (object)$_SIGNUP;
            
            $companyname = $str->sanAsName($_SIGNUP->firstname);
            
            $names = $str->sanAsName($_SIGNUP->lastname);
            
            $lastnameArray = explode(' ',$names);
            $firstname = $lastnameArray[0];
            
            // if(!empty($lastnameArray[1])){
            //     $lastname = @$lastnameArray[1];
            // }else{
            //     $lastname = @$lastnameArray[0];
            // }
            
            $pre_username = $str->sanAsUsername(remSpaces($firstname));
            $username = $validate->autoUniqueMaker('app_users','username',$pre_username);
            $_POST['signup_username'] = $username;
            $email = $str->data_in($_SIGNUP->email);
            $country_ID = $str->sanAsID($_SIGNUP->country);
            $password_txt = $str->data_in($_SIGNUP->password);
            $repassword = $str->data_in($_SIGNUP->repassword);
            
            $salt = \Hash::salt(32);
            $password = \Hash::make($password_txt,$salt);
            
            $seconds = \Config::get('time/seconds');
            if($diagnoArray[0] == 'NO_ERRORS'){
                try{
                    $userTable->insert(array(
                        'firstname' => $firstname,
                        // 'lastname' => $lastname,
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'salt' => $salt,
                        'country_ID' => $country_ID,
                        'date_insert' => $seconds,
                        'state' => "Activated"
                    ));

                    $_POST['company-company']=$_SIGNUP->firstname;
                    $_POST['company-email']=$_SIGNUP->email;
                    $_POST['company-country_ID']=$_SIGNUP->country;
                    
                    $userTable->find_user($email,array('ID'));
                    if($userTable->count()){
                        //done
                    }
                    
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }
            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
            $error_msg = ul_array($validation->errors());
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_SCRIPT' => $validate->getErrorLocation()
            ];
        }else{
            $userTable->find_user($username);
            $user_data = $userTable->data();
            $login = $userTable->login($user_data->username,$user_data->password,$remeber=false);
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_SCRIPT' => $validate->errors()
            ];
        }
    }
    
    public static function add(){
        $diagnoArray[0] = 'NO_ERRORS';
        $validate = new \Validate();
        $prfx = 'user-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }
        
        global $session_user_data;
        global $session_company_data;
        
        $validation = $validate->check($_SIGNUP, array(
            'firstname' => array(
                'name' => 'First Name',
                'string' => true,
                'required' => true
            ),
            // 'lastname' => array(
            //  'name' => 'Last Names',
            //  'string' => true
            // ),
            'email' => array(
                'name' => 'Email Address',
                'email' => true,
                'unique' => "app_users",
                'required' => true
            ),
            'telephone' => array(
                'name' => 'Telephone',
                'required' => true
            )
        ));
        
        if($validation->passed()){
            $userTable = new \User();
            
            $str = new \Str();
            
            $_SIGNUP = (object)$_SIGNUP;
            
            $firstname = $str->sanAsName($_SIGNUP->firstname);
            
            // $lastname = $str->sanAsName($_SIGNUP->lastname);
            
            $telephone = $_SIGNUP->telephone;
            
            $groups = $_SIGNUP->groups;
            
            $company_ID = $session_company_data->ID;
            
            $pre_username = $str->sanAsUsername(remSpaces($firstname));
            $username = $validate->autoUniqueMaker('app_users','username',$pre_username);
            $_POST['signup_username'] = $username;
            $email = $str->data_in($_SIGNUP->email);
            
            $seconds = \Config::get('time/seconds');
            
            $salt = Hash::salt(32);
            $generate_password = Functions::generateStrongPassword(6);
            $password = Hash::make($generate_password,$salt);
            
            if($diagnoArray[0] == 'NO_ERRORS'){
                try{
                    $userTable->insert(array(
                        'admin_ID' => $session_user_data->ID,
                        'firstname' => $firstname,
                        // 'lastname' => $lastname,
                        'phone' => $telephone,
                        'username' => $username,
                        'company_ID' => $company_ID,
                        'email' => $email,
                        'password' => $password,
                        'salt' => $salt,
                        'date_insert' => Dates::get('d-m-Y H:i:s',$seconds),
                        'groups' => $groups,
                        'state' => "Activated"
                    ));
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }
                
                $find_user = $userTable->find_user($email,array('ID'));
                if($find_user){
                    
                    Session::put("success","Account created successfully. The Default password was sent to $email");


                    $link = DN."/login/";

                    $subject = "Your User Account for RICTA has been created";

                    $messageText_0= 'Dear <b>'.$firstname.'</b>,';

                    // $messageText_1= 'Your account has been successfully created by '.$session_user_data->firstname.' '.$session_user_data->lastname;

                    $messageText_1= 'Your account as a user on the RICTA system has been created.';

                    // $messageText_2= 'Your default password is: '.$generate_password.' You can easily change it once have logged in.';
                    
                    $messageText_2= '
                        <b>Your Username:</b> '.$email.'<br>
                        <b>Your Password:</b> '.$generate_password.'<br>
                        <b>Link:</b> <a href="'.$link.'">[LINK]</a>
                    ';

                    $messageText_3= '<b>Key information:-</b>';

                    $messageText_4= 'Change your password immediately<br>
                    Do not share your username and/or password with anyone including your colleagues, family or friends.<br>
                    Should you find that your password has been compromised, send an email immediately 
                    to noc@ricta.org.rw and call RICTA contact + 250 788 424 148. Should you not 
                    reach the contact by phone, please send a message by SMS.';

                    $messageText_5= 'Any changes made to any data should be logged and kept for referral.';


                    $message_body = '
                        <body>
                            <div style="padding: 10px; margin-left: 10px; margin-right: 10px">

                                <section>
                                    <p style="margin-bottom: 25px; font-size: 13px;">
                                        '.$messageText_0.'
                                    </p>
                                    <p style="font-size: 13px;">
                                        '.$messageText_1.'
                                    </p>
                                    <p style="font-size: 13px;">
                                         '.$messageText_2.'
                                    </p>
                                    <p style="font-size: 13px;">
                                         '.$messageText_3.'
                                    </p>
                                    <p style="font-size: 13px;">
                                         '.$messageText_4.'
                                    </p>
                                    <p style="font-size: 13px;">
                                         '.$messageText_5.'
                                    </p>
                                
                                    <p style="font-size: 13px;">
                                        <b>Stay connected</b> <br>
                                        <b>Twitter / Facebook:</b> RICTA <br>
                                        <b>Connect with our official tag:</b> #rw<br>
                                        <b>Youtube:</b> ricta<br>
                                    </p>
                                    <br>
                                </section>
                                <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                                    <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
                                        Regards,<br><br>

                                        RICTA Team<br>
                                        E:  noc@ricta.org.rw<br>
                                        T:  + 250 788 424 148<br>
                                        <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                                        <a href="'.DN.'/privacy">Privacy Policy</a>
                                    </div>
                                </div>
                            </div>
                        </body>
                    ';

                    $message_alt = $messageText_0.' '.$messageText_1.' '.$messageText_2;

                    $contactDetails['from_email'] = EMAIL1;
                    $contactDetails['from_names'] = EVENT;
                    $contactDetails['to_email'] = $email;

                    $contactDetails['attach'] = false;

                    $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt); 
                }
                
            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
            $error_msg = ul_array($validation->errors());
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_SCRIPT' => $validate->getErrorLocation()
            ];
        }else{
            $userTable->find_user($username);
            $user_data = $userTable->data();
            $login = $userTable->login($user_data->username,$user_data->password,$remeber=false);
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_SCRIPT' => $validate->errors()
            ];
        }
    }
    
    public static function updatePassword($user_ID){
        $diagnoArray[0] = 'NO_ERRORS';
        $errors_str = '';
        $validate = new \Validate();
        $prfx = 'user-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }

        global $user_data;

        $validation = $validate->check($_SIGNUP, array(
            'password' => array(
                'name' => 'Password',
                'strong_password' => true,
                'min' => 6,
                'required' => true
            ),
            'repassword' => array(
                'required' => true,
                'name' => 'Confirm Password',
                'matches' => 'password',
            )
        ));
        
        $current_salt = $user_data->salt;
        $current_passwordText = Input::get($prfx.'current_password','post');
        $current_password = Hash::make($current_passwordText,$current_salt);

        if($current_password != $user_data->password){
            $diagnoArray[0] == 'ERRORS_FOUND';
            $errors_str = "Current password is incorect<br>";
        }
        
        if($validation->passed()){
             $userTable = new \User();

            $str = new \Str();

            $_SIGNUP = (object)$_SIGNUP;

            $seconds = \Config::get('time/seconds');    

            $salt = Hash::salt(32);
            $passwordText = Input::get($prfx.'password','post');
            $password = Hash::make($passwordText,$salt);
            
            if($diagnoArray[0] == 'NO_ERRORS'){
                try{
                    $userTable->update(array(
                        'password' => $password,
                        'salt' => $salt
                    ),$user_ID);
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }
   
                Session::put("success","Password updated successfully.");

                $subject = "Password changed";

                $messageText_0= 'Dear <b>'.$user_data->firstname.'</b>,';

                $messageText_1= 'Your password was successfully updated ';

                $messageText_2= ' ';

                $message_body = '
                    <body>
                        <div style="padding: 10px; margin-left: 10px; margin-right: 10px">

                            <section>
                                <p style="margin-bottom: 25px; font-size: 13px;">
                                    '.$messageText_0.'
                                </p>
                                <p style="font-size: 13px;">
                                    '.$messageText_1.'
                                </p>
                                <p style="font-size: 13px;">
                                     '.$messageText_2.'
                                </p>
                                <p style="font-size: 13px;">
                                    <b>Stay connected</b> <br>
                                    <b>Twitter / Facebook:</b> RICTA <br>
                                    <b>Connect with our official tag:</b> #rw<br>
                                    <b>Youtube:</b> ricta<br>
                                </p>
                                <br>
                            </section>
                            <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                                <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
                                    Regards,<br><br>

                                    RICTA Team<br>
                                    E:  noc@ricta.org.rw<br>
                                    T:  + 250 788 424 148<br>
                                    <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                                    <a href="'.DN.'/privacy">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                    </body>
                ';

                $message_alt = $messageText_0.' '.$messageText_1.' '.$messageText_2;

                $contactDetails['from_email'] = 'noc@ricta.org.rw';
                $contactDetails['from_names'] = 'RICTA';
                $contactDetails['to_email'] = $user_data->email;

                $contactDetails['attach'] = false;

                $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt); 

            }else{
                $diagnoArray[0] = 'ERRORS_FOUND';
                $error_msg = ul_array($validation->errors());
            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => $validate->getErrorLocation()
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => $validate->errors()
            ];
        }
    }
    
    public static function requestPasswordReset($user_ID){
        
        $diagnoArray[0] = 'NO_ERRORS';
        $errors_str = '';
        
        $validate = new \Validate();
        $prfx = 'recover-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }
        
        $userTable = new \User();

        $str = new \Str();

        $seconds = \Config::get('time/seconds'); 

        global $user_data;

        $salt = Hash::salt(32);
        $generated_string = Functions::generateStrongPassword(32,false,'ud');
        
        $secret_key = $user_data->password;
        $recovery_string = strtoupper(hash_hmac('SHA256', $generated_string, pack('H*',$secret_key)));

        if($diagnoArray[0] == 'NO_ERRORS'){
            try{
                $userTable->update(array(
                    'recovery_string' => $recovery_string
                ),$user_ID);
            }catch(Exeption $e){
                $diagnoArray[0] = "ERRORS_FOUND";
                $diagnoArray[] = $e->getMessage();
            }

            $subject = "Click here to reset your password";

            $link = DN."/login/resetpassword/{$user_ID}/{$generated_string}";

            $messageText_0= 'Dear <b>'.$user_data->firstname.'</b>,';

            $messageText_1= 'Click on this link to reset your password <a href="'.$link.'">[ Click here to passsword reset ]</a>';

            $message_body = '
                <body>
                    <div style="padding: 10px; margin-left: 10px; margin-right: 10px">

                        <section>
                            <p style="margin-bottom: 25px; font-size: 13px;">
                                '.$messageText_0.'
                            </p>
                            <p style="font-size: 13px;">
                                '.$messageText_1.'
                            </p>
                            <p style="font-size: 13px;">
                                <b>Stay connected</b> <br>
                                <b>Twitter / Facebook:</b> RICTA <br>
                                <b>Connect with our official tag:</b> #rw<br>
                                <b>Youtube:</b> ricta<br>
                            </p>
                            <br>
                        </section>
                        <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                            <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
                                Regards,<br><br>

                                RICTA Team<br>
                                E:  noc@ricta.org.rw<br>
                                T:  + 250 788 424 148<br>
                                <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                                <a href="'.DN.'/privacy">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </body>
            ';

            $message_alt = $messageText_0.' '.$messageText_1;

            $contactDetails['from_email'] = 'noc@ricta.org.rw';
            $contactDetails['from_names'] = 'RICTA';
            $contactDetails['to_email'] = $user_data->email;

            $contactDetails['attach'] = false;

            $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt); 

        }
        
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_STRING' => $errors_str,
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => ''
            ];
        }
    }
    
    public static function resetPassword($user_ID){
        
        $diagnoArray[0] = 'NO_ERRORS';
        $errors_str = '';
        
        $validate = new \Validate();
        $prfx = 'reset-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }
        
        $validation = $validate->check($_SIGNUP, array(
            'password' => array(
                'name' => 'Password',
                'strong_password' => true,
                'min' => 6,
                'required' => true
            )
        ));

        if($validation->passed()){
            $userTable = new \User();

            $str = new \Str();

            $seconds = \Config::get('time/seconds'); 

            global $user_data;

            $salt = Hash::salt(32);
            $generate_password = $_SIGNUP['password'];
            $password = Hash::make($generate_password,$salt);

            if($diagnoArray[0] == 'NO_ERRORS'){
                try{
                    $userTable->update(array(
                        'password' => $password,
                        'salt' => $salt,
                        'recovery_string' => ''
                    ),$user_ID);
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }

                Session::put("success","Password updated successfully.");

                $subject = "Your password has changed successfully";

                $messageText_0= 'Dear <b>'.$user_data->firstname.'</b>,';

                $messageText_1= 'Your password has changed successfully';

                $messageText_2= ' ';

                $message_body = '
                    <body>
                        <div style="padding: 10px; margin-left: 10px; margin-right: 10px">

                            <section>
                                <p style="margin-bottom: 25px; font-size: 13px;">
                                    '.$messageText_0.'
                                </p>
                                <p style="font-size: 13px;">
                                    '.$messageText_1.'
                                </p>
                                <br>
                                <p style="font-size: 13px;">
                                    <b>Stay connected</b> <br>
                                    <b>Twitter / Facebook:</b> RICTA <br>
                                    <b>Connect with our official tag:</b> #rw<br>
                                    <b>Youtube:</b> ricta<br>
                                </p>
                                <br>
                            </section>
                            <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                                <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
                                    Regards,<br><br>

                                    RICTA Team<br>
                                    E:  noc@ricta.org.rw<br>
                                    T:  + 250 788 424 148<br>
                                    <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                                    <a href="'.DN.'/privacy">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                    </body>
                ';

                $message_alt = $messageText_0.' '.$messageText_1.' '.$messageText_2;

                $contactDetails['from_email'] = 'noc@ricta.org.rw';
                $contactDetails['from_names'] = 'RICTA';
                $contactDetails['to_email'] = $user_data->email;

                $contactDetails['attach'] = false;

                $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt); 

            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
            $errors_str = ul_array($validation->errors());
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_STRING' => $errors_str,
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => ''
            ];
        }
    }
    
    public static function update($user_ID){
        $diagnoArray[0] = 'NO_ERRORS';
        $validate = new \Validate();
        $prfx = 'user-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }
        
        global $session_user_data;
        global $session_company_data;
        
        $validation = $validate->check($_SIGNUP, array(
            'firstname' => array(
                'name' => 'First Name',
                'required' => true
            ),
            // 'lastname' => array(
            //     'name' => 'Last Names',
            //     'string' => true
            // ),
            'telephone' => array(
                'name' => 'Telephone',
                'required' => true
            )
        ));

        if($validation->passed()){
            $userTable = new \User();

            $str = new \Str();

            $_SIGNUP = (object)$_SIGNUP;

            $firstname = $str->sanAsName($_SIGNUP->firstname);

            // $lastname = $str->sanAsName($_SIGNUP->lastname);

            $telephone = $str->sanAsName($_SIGNUP->telephone);

            $groups = $_SIGNUP->groups;

            $company_ID = $session_company_data->ID;

            $seconds = \Config::get('time/seconds');    

            if($diagnoArray[0] == 'NO_ERRORS'){
                try{
                    $userTable->update(array(
                        'firstname' => $firstname,
                        // 'lastname' => $lastname,
                        'phone' => $telephone,
                        'groups' => $groups
                    ),$user_ID);
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }
            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
            $error_msg = ul_array($validation->errors());
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_SCRIPT' => $validate->getErrorLocation()
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_SCRIPT' => $validate->errors()
            ];
        }
    }
    public static function login($origin=null){
        $diagnoArray[0] = 'NO_ERRORS';
        $validate = new \Validate();
        $prfx = 'login_';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_LOGIN[end($ar)] = $val;
            }
        }
        $validation = $validate->check($_LOGIN, array(
            'username' => array(
                'name' => 'Username',
                'required' => true
            ),
            'password' => array(
                'name' => 'Password',
                'required' => true
            )
        ));
        
        if($validation->passed()){
            $userTable = new \User();
            $db = DB::getInstance();
            
            $str = new \Str();
            $_LOGIN = (object)$_LOGIN;
            $username = $str->data_in($_LOGIN->username);
            $password_txt = $str->data_in($_LOGIN->password);
            $remember = false;
            if(Input::checkInput($prfx.'remember','post',1)){
                $remember = (Input::get($prfx.'remember','post') == 'on')? true : false;
            }
            $login = $userTable->login($username,$password_txt,$remember);
            if($login !== true){
                $diagnoArray[0] = "ERRORS_FOUND";
            }
            if(count($userTable->errors())){
                if($login == 'password'){
                    $form_error = true;
                    $diagnoArray[0] = "ERRORS_FOUND";
                    Session::put('loginerror','Password');
                }else if($login == 'username'){
                    $form_error = true;
                    $diagnoArray[0] = "ERRORS_FOUND";
                    Session::put('loginerror','Username');
                }
            }
            
            $seconds = \Config::get('time/seconds');
            if($diagnoArray[0] == 'NO_ERRORS'){
                
            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
            $error_msg = ul_array($validation->errors());
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'SUCCESS'=>false,
                'ERRORS_SCRIPT' => $validate->getErrorLocation()
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_SCRIPT' => ""
            ];
        }
    }
    
    
    public static function changeState($state,$user_ID){
        $diagnoArray[0] = 'NO_ERRORS';
        $validate = new \Validate();
        
        $ID = $user_ID;
        
        $seconds = \Config::get('time/seconds');
        
        $userTable = new User();
        global $session_user_data;

        try{
            switch($state){
                case 'Activate';
                    $userTable->update(array(
                        'state' => 'Activated'
                    ),$ID);
                break;
                case 'Block';
                    $userTable->update(array(
                        'state' => 'Blocked'
                    ),$ID);
                break;
            }
        }catch(Exeption $e){
            $diagnoArray[0] = "ERRORS_FOUND";
            $diagnoArray[] = $e->getMessage();
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_SCRIPT' => $diagnoArray
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_SCRIPT' => ""
            ];
        }
    }
}


