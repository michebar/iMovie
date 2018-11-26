<?php header('Content-Type: text/html; charset=utf-8');
  
require_once('database.php');

class User{
    private $userName;
    private $password;
    private $name;
    private $age;
    private $gender;
    private $city;
    private $finish_status;
    
    public static function fetch_users(){
        global $database;
        $result_set=$database->query("select * from users");
        $users;
        $i=0;
        
        if ($result_set->num_rows>0){ 
            while($row=$result_set->fetch_assoc()){ 
                $user=new User();
                $user->instantation($row);
                $users[$i]=$user;
                $i+=1;
            }
        }
        
        return $users;
    }
    
    private function has_attribute($attribute){
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
    private function instantation($user_array){
        foreach ($user_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
        }
    }
    
    public function find_user_by_userName($userName){
        global $database;
        $userName = strtolower($userName);
        $result_set=$database->query("select * from users where userName='$userName'");
        $found_user=$result_set->fetch_assoc();
		
        if ($found_user==null)
			return false;
        
        $this->instantation($found_user);
        return $this;
    }
    
    public static function authenticate_user($userName, $password){
        global $database;
        $userName = strtolower($userName);
        $encrypt_pass = md5($userName.$password);
        $found_user = new user;
        $found_user->find_user_by_userName($userName);
		
        return ($found_user->password == $encrypt_pass);
    }
    
    public static function add_user($userName,$password,$name,$age,$gender,$city){
        global $database;
        $userName = strtolower($userName);
        $encrypt_pass=md5($userName.$password);
        $sql="Insert into users(userName,password,name,age,gender,city) values ('$userName','$encrypt_pass','$name',$age,'$gender','$city')";
        $result=$database->query($sql);
        return $result;
    }
    
    public function set_start_quiz($userName){
        global $database;
        $finishStatus=false;
        $sql="UPDATE users SET finish_status='$finish_status' WHERE userName='$userName'";
        $result=$database->query($sql);
    }
    
       public function set_finish_quiz($userName){
        global $database;
        $finish_status=true;
        $sql="UPDATE users SET finish_status='$finish_status' WHERE userName='$userName'";
        $result=$database->query($sql);
    }
    

    public function get_userName(){
        return $this->userName;
    }
        
    public function get_name(){
        return $this->name;
    }
    
    public function get_age(){
        return $this->age;
    }
    
    public function get_gender(){
        return $this->gender;
    }
    
    public function get_city(){
        return $this->city;
    }
    
    public function get_finishStatus(){
        return $this->finish_status;
    }
}

    
?>