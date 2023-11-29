<?php

session_start();
header("X-XSS-Protection: 1");
header("Cache-Control: public");

require_once "include/functions.php";
require_once "include/class.phpmailer.php";
require_once "include/class.smtp.php";
require_once "include/config.php";
require_once "app/models/Base_Model.php";

require_once "app/controllers/Home_Controller.php";
require_once "app/controllers/Login_Controller.php";
require_once "app/controllers/Event_Controller.php";
require_once "app/controllers/Game_Controller.php";
require_once "app/controllers/Registration_Controller.php";
require_once "app/controllers/Recover_Pass_Controller.php";


switch ($_GET["controller"]) {
    case '' :
    case '/' :
        include VIEW . "start.html";
        exit;
	case 'main' :
        $event_controller = new Event_Controller();

        switch ($_GET["function"]) {
            case "location_selected":
                $event_controller->location_selected();
                exit;
        }
        $event_controller->index();
        exit;
	case 'memotest':
		$game_controller = new Game_Controller();
        switch ($_GET["function"]) {
            case "location_selected":
                $game_controller->location_selected();
                exit;
        }
        $game_controller->index('memotest');
		exit;
	case 'puzzle':
		$game_controller = new Game_Controller();
        switch ($_GET["function"]) {
            case "location_selected":
                $game_controller->location_selected();
                exit;
        }
        $game_controller->index('puzzle');
		exit;
	case 'trivias':
		$game_controller = new Game_Controller();
        switch ($_GET["function"]) {
            case "location_selected":
                $game_controller->location_selected();
                exit;
        }
        $game_controller->index('trivias');
		exit;
	case 'rush':
		$game_controller = new Game_Controller();
        switch ($_GET["function"]) {
            case "location_selected":
                $game_controller->location_selected();
                exit;
        }
        $game_controller->index('rush');
		exit;
	case 'ranking':
		echo "<script>location.replace('app/views/ranking.php')</script>";
		exit;
    case "login":
        $login_controller = new Login_Controller();

        switch ($_GET["function"]) {
            case "login":
                $login_controller->login();
                exit;
            case "logout":
                $login_controller->logout();
		        exit;
		    case "logoutlogin":
                $login_controller->logoutlogin();
		        exit;
		    case "guest":
		        $login_controller->guestlogin();
		        exit;
        }
        $login_controller->index2();
        exit;
    case "registration":
        $registration_controller = new Registration_Controller();
        
        switch ($_GET["function"]) {
            case "signup":
                $registration_controller->signup();
                exit;
        }
        
        $registration_controller->index();
        exit;
    case "recover_password" :
        $recover_pass_controller = new Recover_Pass_Controller();
        
        switch ($_GET["function"]) {
            case "recover":
                $recover_pass_controller->recover();
                exit;
        }
        
        $recover_pass_controller->index();
        exit;
}

?>
