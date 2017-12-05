<?php
class Timetable {
	
	protected $timetable_id;
	protected $course_code;
	protected $course_name;
    protected $semester;
    protected $teacher_name;
	protected $st_group;
    protected $timeofday;
    protected $dayofweek;
    protected $hours_total;
    
	//get ID
	public function getID() {
		return $this->timetable_id;
	}
    //get course code
	public function getCourseCode() {
		return $this->course_code;
	}
    //set course code
	public function setCourseCode($code) {
		$this->course_code=$code;
	}
    //get course name
	public function getCourseName() {
		return $this->course_name;
	}
    //set course name
	public function setCourseName($name) {
		$this->course_name=$name;
	}
    //get semester
	public function getSemester(){
        return $this->semester;
    }
    //set semester
	public function setSemester($s){
        $this->semester = $s;
    }
    //get teacher's name
	public function getTeacherName(){
        return $this->teacher_name;
    }
    //set teacher's name
	public function setTeacherName($tname){
        $this->teacher_name = $tname;
    }
    //get students' group
    public function getGroup() {
        return $this->st_group;
    }
    //set students' group
    public function setGroup($group) {
        $this->st_group=$group;
    }
    //get time
	public function getTime(){
        return $this->timeofday;
    }
    //set time
	public function setTime($t){
        $this->timeofday = $t;
    }
    //get day 
	public function getDay(){
        return $this->dayofweek;
    }
    //set day 
	public function setDay($d){
        $this->dayofweek = $d;
    }
    //get total number of hours
	public function getTotal(){
        return $this->hours_total;
    }
    //set total number of hours
	public function setTotal($t){
        $this->hours_total = $t;
    }
    
}

?>