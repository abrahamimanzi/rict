<?php
class Participant 
{
	private $_db,
			$_data,
			$_count = 0,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn,
			$_errors = array();
	
	public function __construct($user = null){
		$this->_db = DB::getInstance();
		
		if($user){
			//$this->find($user);
		}
	}

//USER CREATE AN ACCOUNT
	public function insert($fields = array()){
//		$user_ID = Session::get(Config::get('session/session_name'));
        $seconds = \Config::get('time/seconds');
		if(!$this->_db->insert('events_participant', $fields)){
			throw new Exception("There was a problem submiting your information.");
		}
	}

// WEB LAST UPDATE
	public function web_update(){
		$sessionName = Config::get('session/session_name');
//		$user_ID = Session::get($sessionName);
//		$fields = array('last_update'=>Config::get('time/temp'),'update_user_ID'=>$user_ID);
//		$this->update($fields,1);
	}

// USER DATA UPDATE
	public function update($fields = array(),$id = null){
		if(!$this->_db->update('events_participant',$id,$fields)){
			throw new Exception('There was a problem updating');
		}
	}

// FIND USER
	public function find($user = null,$limit = null){
		if($user){
			$hit = false;
			if(is_numeric($user)){
				$field = 'ID';
				$data = $this->_db->get('events_participant', array($field, '=', $user),$limit);
				if($data->count()){
					$this->_data = $data->first();
					$hit = true;
				}
			}
			
			if($hit == false){
				if($this->findUserByPhone($user)){
					return true;
				}
			}else{
				return true;
			}
		}
		return false;
	}

	// Select	
	public function select($sql = null){
		$data = $this->_db->query("SELECT* FROM `events_participant` {$sql}");
		if($data->count()){
			$this->_count = $data->count();
			$this->_data = $data->results();
		}
	}
	// Select	
	public function selectQuery($sql,$params=array()){
		$data = $this->_db->query($sql,$params);
		if($data->count()){
			$this->_count = $data->count();
			$this->_data = $data->results();
		}
	}
	

// DATA COLLECT
	public function data(){
		return $this->_data;
	}
// first
	public function first(){
		$data = $this->data();
		if(isset($data[0])){
			return $data[0];
		}
		return '';
	}
	
// DATA COUNT
	public function count(){
		return $this->_count;
	}
	
// ADD ERRORS NOTIF
	private function addError($error){
		$this->_errors[] = $error;
	}
// ERROR COLLECT
	public function errors(){
		return $this->_errors;
	} 
}
?> 