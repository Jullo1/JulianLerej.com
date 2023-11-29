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
            
        echo "<script>location.assign('../main')</script>";
        
        }catch (Exception $e) {
            http_response_code(401);
            echo $e->getMessage();
        }
        
    }
    public function logout(){
        session_destroy();
		set_user_auth(false);
		echo "<script>location.assign('../')</script>";
    }
    public function logoutlogin(){
        session_destroy();
		set_user_auth(false);
		echo "<script>location.assign('../login')</script>";
    }
    
    public function guestlogin(){
        set_user_auth(true);
        $_SESSION["user_name"] = "Guests";
        echo "<script>location.assign('../main')</script>";
    }
}

?>