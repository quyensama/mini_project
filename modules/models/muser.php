<?php
/**
 * 
 */
class MUser extends Model
{
	
	function __construct(){
        parent::__construct();
    }
    
    function login($data){
        
    }
	function getInfor($username, $password){
		$query = $this->db->table('users')->getAll('`username` = \''.$username.'\' AND `password` = \''.$password.'\'');
		$info = $query->fetch_array(MYSQLI_ASSOC);
		return $info;
	}

	
	function checkInfor($username){
		$query = $this->db->table('users')->getAll('`username` = \''.$username.'\'');
		$info = $query->fetch_array(MYSQLI_ASSOC);
		return $info;
	}
    
    function register($data){
        $sql    = 'INSERT INTO users SET username =\''.$data['username'].'\', password =\''.$data['password'].'\', full_name =\''.$data['full_name'].'\', email =\''.$data['email'].'\'';
    }
    
    function updateInfo($data){
        $sql    = 'UPDATE users SET username =\''.$data['username'].'\', password =\''.$data['password_new'].'\', full_name =\''.$data['full_name'].'\', email =\''.$data['email'].'\' WHERE id =\''.$data['id'].'\'';
        $this->db->query($sql);
    }


}