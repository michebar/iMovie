<?php
  
require_once('init.php');

class Session{
    private $signed_in;
    private $userName;
    
    public function __construct(){
        session_start();
        $this->check_login();
    }
    
     private function check_login(){
        if (isset($_SESSION['userName'])){
            $this->userName=$_SESSION['userName'];
            $this->signed_in=true;
        }
        else{
            unset($this->userName);
            $this->signed_in=false;
        }
    }
    
    public function login($user){
        if($user){
            $this->userName=$user->get_userName();
            $_SESSION['userName']=$user->get_userName();
            $this->signed_in=true;
        }
    }
    
       
    public function logout(){
        echo 'logout';
        unset($_SESSION['userName']);
        unset($this->userName);
        $this->signed_in=false;
        
    }
    
    public function get_signed_in(){
        return $this->signed_in;
    }
    public function get_userName(){
        return $this->userName;
    }
     
}

$session=new Session();

    
?>

