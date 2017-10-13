<?php
class CompanyController  
{
	public static function edit(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'company-';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_EDIT[end($ar)] = $val;
			}
		}
		$validation = $validate->check($_EDIT, array(
			'company' => array(
				'name' => 'Comany name',
				'string' => true,
				'required' => true
			),
			'motto' => array(
				'name' => 'Motto',
				'string' => true
			),
			'email' => array(
				'name' => 'Address Email',
				'email' => true,
				'required' => true
			),
			'telephone' => array(
				'name' => 'Phone Number'
			),
			'country_ID' => array(
				'name' => 'Country'
			),
			'details' => array(
				'name' => 'Details'
			)
		));
		
		if($validation->passed()){
			$companyTable = new \Company();
			
			$str = new \Str();
			$ID = $str->sanAsName($_EDIT['id']);
			$company = $str->sanAsName($_EDIT['company']);
			$motto = $str->data_in($_EDIT['motto']);
			$email = $str->data_in($_EDIT['email']);
			$telephone = $str->data_in($_EDIT['telephone']);
			$details = $str->data_in($_EDIT['details']);
			$country = $str->sanAsID($_EDIT['country_ID']);
			
			$seconds = \Config::get('time/seconds');
			if($diagnoArray[0] == 'NO_ERRORS'){
				try{
					$companyTable->update(array(
						'company' => $company,
						'motto' => $motto,
						'email' => $email,
						'telephone' => $telephone,
						'details' => $details,
						'country_ID' => $country
					),$ID);
					
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
				'ERRORS_SCRIPT' => ""
			];
		}
	}
    
	public static function create(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'company-';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_EDIT[end($ar)] = $val;
			}
		}
		$validation = $validate->check($_EDIT, array(
			'company' => array(
				'name' => 'Comany name',
				'string' => true,
				'required' => true
			),
			'email' => array(
				'name' => 'Address Email',
				'email' => true,
				'required' => true
			),
			'country_ID' => array(
				'name' => 'Country',
				'required' => true
			)
		));
		
		if($validation->passed()){
			$companyTable = new \Company();
			
			$str = new \Str();
			$company = $str->sanAsName($_EDIT['company']);
			$email = $str->data_in($_EDIT['email']);
			$country = $str->sanAsID($_EDIT['country_ID']);
			
		   $user_ID = Session::get(Config::get('session/session_name'));
            
			if($diagnoArray[0] == 'NO_ERRORS'){
				try{
					$companyTable->insert(array(
						'user_ID' => $user_ID,
						'company' => $company,
						'email' => $email,
						'country_ID' => $country
					));
					
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
				'ERRORS_SCRIPT' => ""
			];
		}
	}
}