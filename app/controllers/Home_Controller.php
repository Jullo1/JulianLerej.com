<?php


class Home_Controller {
    
    public function __construct(){
        //parent::__construct();
    }
        
    public function index(){
        require VIEW . "home.html";
    }

    

}

?>