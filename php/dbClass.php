<?php
require_once("Timetable.php");
require_once("User.php");
require_once("Student.php");
define("MYSQL_CONN_ERROR", "Unable to connect to database");

class dbClass {
private $host;
private $db;
private $charset;
private $user;
private $pass;
private $opt = array(
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
private $connection;
//mysqli_report(MYSQLI_REPORT_STRICT);
//constructor
public function __construct(string $host="localhost",string $db="id3884973_attendancedb",
							string $charset="utf8",string $user="id3884973_septime",string $pass="4charslong")
	{
		$this->host=$host;
		$this->db=$db;
		$this->charset=$charset;
		$this->user=$user;
		$this->pass=$pass;
	}
//connect to the database
private function connect() {
	$dsn="mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
    try {
        $this->connection=new PDO($dsn,$this->user,$this->pass,$this->opt);
        }catch (mysqli_sql_exception $e) {
            throw $e;
            }
	}
//disconnect from the database
public function disconnect() {
	$this->connection = null;
	}

//add a new timetable to the database "timetables" table
public function addTimetable(Timetable $t) {
	$this->connect(); 
	$code = $t->getCourseCode();
    $name = $t->getCourseName();
    $semester = $t->getSemester();
    $teacher = $t->getTeacherName();
    $group = $t->getGroup();
    $time = $t->getTime();
    $day = $t->getDay();
    $hours=$t->getTotal();
	$query=$this->connection->prepare("INSERT INTO timetables (course_code,course_name,semester,teacher_name,student_group,timeofday,dayofweek,hours_total) VALUES (:code,:name,:semester,:teacher,:group,:time,:day,:hours)");
    $query->execute([':code'=>$code,':name'=>$name,':semester'=>$semester,':teacher'=>$teacher,':group'=>$group,':time'=>$time,':day'=>$day,':hours'=>$hours]);
    $this->disconnect();
}
    
//add a new student to the database "Students" table
public function addStudent(Student $s) {
    $this->connect();
    $id = $s->getID();
    $group = $s->getGroup();
    $fname = $s->getFirstName();
    $lname = $s->getLastName();
    $query=$this->connection->prepare("INSERT INTO students (student_id,student_group,first_name,last_name) VALUES (:id,:group,:fname,:lname)");
    $query->execute([':id'=>$id,':group'=>$group,':fname'=>$fname,':lname'=>$lname]);
    $this->disconnect();
}
    
//check whether the user exists in the DB
public function checkUser($email) {
    $this->connect();
    $query = $this->connection->prepare("SELECT COUNT(email) AS 'count' FROM users WHERE email=:email");
    $query->execute([':email'=>$email]);
    $val=$query->fetch(PDO::FETCH_ASSOC);
    $this->disconnect();
    if ($val['count']>0)
        return true;
    else return false;
}
    

    
//check timetable's existence in the DB by students' group
public function checkTimetable($group) {
    $this->connect();
    $query = $this->connection->prepare("SELECT COUNT(student_group) AS 'count' FROM timetables WHERE student_group=:group");
    $query->execute([':group'=>$group]);
    $val=$query->fetch(PDO::FETCH_ASSOC);
    $this->disconnect();
    if ($val['count']>0)
        return true;
    else return false;
}
    
//check student's existence in the DB by ID
public function studentExists($id) {
    $this->connect();
    $query = $this->connection->prepare("SELECT COUNT(student_id) AS 'count' FROM students WHERE student_id=:id");
    $query->execute([':id'=>$id]);
    $val=$query->fetch(PDO::FETCH_ASSOC);
    $this->disconnect();
    if ($val['count']>0)
        return true;
    else return false;
}

//check student's existence in the DB by group
public function checkStudent($group) {
    $this->connect();
    $query = $this->connection->prepare("SELECT COUNT(student_group) AS 'count' FROM students WHERE student_group=:group");
    $query->execute([':group'=>$group]);
    $val=$query->fetch(PDO::FETCH_ASSOC);
    $this->disconnect();
    if ($val['count']>0)
        return true;
    else return false;
}

//add a new user to the "users" table
public function addUser(User $u) {
    $this->connect();
    $id = $u->getID();
    $email = $u->getEmail();
    $pswd = $u->getPassword();
    $query=$this->connection->prepare("INSERT INTO users(email,password,groupID) VALUES (:email,:pswd,:id)");
    $query->execute([':email'=>$email,':pswd'=>$pswd,':id'=>$id]);
    $this->disconnect();
}
//add teacher's name to the 'users' table
public function addTeacherName($name,$email){
    $this->connect();
    $query=$this->connection->prepare("UPDATE users SET name=:name WHERE email=:email");
    $query->execute([':email'=>$email,':name'=>$name]);
    $this->disconnect();
}
    
//delete a user from the "users" table
public function deleteUser($email) {
    $this->connect();
    $query=$this->connection->prepare("DELETE FROM users WHERE email=:email");
    $query->execute([':email'=>$email]);
    $this->disconnect();
} 

//get group ID of user by email
public function getIDbyEmail($email) {
    $this->connect();
    $query=$this->connection->prepare("SELECT groupID AS id FROM users WHERE email=:email");
    $query->execute([':email'=>$email]);
    $id = $query->fetch(PDO::FETCH_ASSOC);
    $this->disconnect();
    return $id['id'];
}
    
//get password of user by email
public function getPasswordbyEmail($email) {
    $this->connect();
    $query=$this->connection->prepare("SELECT password AS pswd FROM users WHERE email=:email");
    $query->execute([':email'=>$email]);
    $pswd = $query->fetch(PDO::FETCH_ASSOC);
    $this->disconnect();
    return $pswd['pswd'];
}
    
//get the list of courses for a specific teacher
public function getListOfCourses($teacher) {
    $this->connect();
    $query=$this->connection->prepare("SELECT DISTINCT course_name FROM timetables WHERE teacher_name=:teacher");
    $query->execute([':teacher'=>$teacher]);
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $courses[] = $row;
    }
    $this->disconnect();
    return $courses;
}
    
//get total hours for a specific course for a specific group 
public function getTotalHours($group,$teacher,$course) {
    $this->connect();
    $query=$this->connection->prepare("SELECT hours_total as hours FROM timetables WHERE teacher_name=:teacher AND student_group=:group AND course_name=:course");
    $query->execute([':teacher'=>$teacher,':group'=>$group,':course'=>$course]);
    $hours = $query->fetch(PDO::FETCH_ASSOC);
    $this->disconnect();
    return $hours['hours'];
}

//get dates and classes in which the specific student was absent
public function getAbsence($id) {
    $this->connect();
    $query=$this->connection->prepare("SELECT c.date, c.class_name from students s, classes c, students_classes sc WHERE s.student_id=:id AND sc.attended='0'");
    $query->execute([':id'=>$id]);
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $classes[] = $row;
    }
    $this->disconnect();
    return $classes;
    }
      
    
//update user's password when the user pressed "forgot password"
public function updatePswd($pswd,$email) {
    $this->connect();
    $query=$this->connection->prepare("UPDATE users SET password=:pswd WHERE email=:email");
    $query->execute([':pswd'=>$pswd,':email'=>$email]);
    $this->disconnect();
}
}

?>