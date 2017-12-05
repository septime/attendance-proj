<?php
class Student {
	
	protected $student_id;
    protected $student_group;
	protected $first_name;
	protected $last_name;
	protected $attendance;
    protected $timetable_id;
	//get ID
	public function getID() {
		return $this->student_id;
	}
    //set ID
	public function setID($newId) {
		$this->student_id=$newId;
	}
    //get group
	public function getGroup() {
		return $this->student_group;
	}
    //set group
	public function setGroup($gr) {
		$this->student_group=$gr;
	}
    //get first name
	public function getFirstName() {
		return $this->first_name;
	}
    //set first name
	public function setFirstName($name) {
		$this->first_name=$name;
	}
    //get last name
	public function getLastName() {
		return $this->last_name;
	}
    //set last name
	public function setLastName($name) {
		$this->last_name=$name;
	}
    //get attendance
    public function getAttendance() {
        return $this->attendance;
    }
    //set attendance
    public function setAttendance($data) {
        $this->attendance=$data;
    }
    //get timetable ID
	public function getTimetable(){
        return $this->timetable_id;
    }
}

?>