<?php
class User {
	
	protected $group_id;
	protected $user_email;
    protected $name;
	protected $user_password;
		
	public function getID() {
		return $this->group_id;
	}
	public function setID($newId) {
		$this->group_id=$newId;
	}
	public function getEmail() {
		return $this->user_email;
	}
	public function setEmail($newMail) {
		$this->user_email=$newMail;
	}
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
	public function getPassword() {
		return $this->user_password;
	}
	public function setPassword($pswd) {
		$this->user_password=$pswd;
	}
	
}

?>