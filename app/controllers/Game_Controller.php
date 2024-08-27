<?php


require_once "app/models/Game_Model.php";

class Game_Controller {
    
    public function __construct(){
        $this->model = new Game_Model();
    }
    
    public function index($gameName){
        require VIEW . $gameName . ".html";
    }
    

    public function location_selected(){
        $location_selected = new stdClass;
        $location_selected->location_name = $_POST['location_name'];
        $location_selected->id_event_user = $_SESSION['user_id'];
        $this->model->set_location($location_selected);
    }

}

?>