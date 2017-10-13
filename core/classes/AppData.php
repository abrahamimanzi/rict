<?php 
class AppData
{
	private $db_status;
	
	public function setDBStatus($value){
		$this->db_status = $value;
	}
	public function getDBStatus(){
		return $this->db_status;
	}
}?>