<?php


require_once "app/models/Event_Model.php";

class Event_Controller {
    
    public function __construct(){
        $this->model = new Event_Model();
    }
    
    public function index(){
        if (!is_user_auth()) {
            echo "<script>location.replace('login')</script>";
        }
        require VIEW . "main.html";
        
        echo "<p style=\"font-size: 18px; margin-top:-150px; magin:auto;text-align:center;\">Logged in as: " . $_SESSION['user_name'] . "</p>";
        
        if ($_SESSION['user_name'] == "Guests")
            echo "<button class=\"button smallButton\" style=\"margin-top:-10px;width:80%;\" onclick=\"location.assign('login/logoutlogin');\">Login</button>";
    }
    

    public function location_selected(){
        $location_selected = new stdClass;
        $location_selected->location_name = $_POST['location_name'];
        $location_selected->id_event_user = $_SESSION['user_id'];
        $this->model->set_location($location_selected);
    }

}

?>