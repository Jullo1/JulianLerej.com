<?php

session_start();
require_once "app/models/Login_Model.php";

class Login_Controller {
    
    private $model;

    public function __construct(){
        //parent::__construct();
        $this->model = new Login_Model();
        
    }
    
    public function index(){
       require VIEW . "start.html";
    }
    
    public function index2(){
        if (!is_user_auth()) {
            require VIEW . "login.html";
            return;
        }
       echo "<script>location.assign('main')</script>";
    }
    
    public function login(){
        $user = (object) $_POST;
        try{
            $user = $this->model->get_user($user);

            set_user_auth(true);
            $_SESSION["user_id"] = $user->id;
            $_SESSION["user_name"] = $user->name;
            $_SESSION["user_email"] = $user->email;
            $_SESSION["user_guest"] = false;
            
        echo "<script>location.assign('../main')</script>";
        
        }catch (Exception $e) {
            http_response_code(401);
            echo $e->getMessage();
        }
        
    }
    public function logout(){
        if ($_SESSION["user_guest_name"])
            $guestname = $_SESSION["user_guest_name"];
        session_destroy();
		set_user_auth(false);
		session_start();
		if ($guestname) $_SESSION["user_guest_name"] = $guestname;
		echo "<script>location.assign('../')</script>";
    }
    public function logoutlogin(){
        $name = $_SESSION["user_name"];
        session_destroy();
		set_user_auth(false);
		session_start();
		$_SESSION["user_guest_name"] = $name;
		echo "<script>location.assign('../login')</script>";
    }
    
    public function guestlogin(){
        $user = (object) $_POST;
        try{
            $user = $this->model->get_user_guest($user);

            set_user_auth(true);
            $_SESSION["user_id"] = $user->id;
            $_SESSION["user_name"] = $user->name;
            $_SESSION["user_guest"] = true;
            
        echo "<script>location.assign('../main')</script>";
        
        }catch (Exception $e) {
            http_response_code(401);
            echo $e->getMessage();
        }
    }
}

?>