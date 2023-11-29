<?php


require_once "app/models/Registration_Model.php";

class Registration_Controller {
    
    private $model;

    public function __construct(){
        //parent::__construct();
        $this->model = new Registration_Model();
    }
        
    public function index(){
        require VIEW . "registration.html";
    }
    
    public function signup(){
        $user = (object) $_POST;
        try{
            $user->id = $this->model->set_user($user);
      
            set_user_auth(true);
            $_SESSION["user_id"] = $user->id;
            $_SESSION["user_name"] =  $user->name;
            $_SESSION["user_email"] = $user->email;
            
            $this->send_mail($user);
            echo "Registration success. <a href=\"../login\">Login</a>.";
            session_destroy();
            set_user_auth(false);
            
        }catch (Exception $e) {
            http_response_code(422);
            echo $e->getMessage();
        }
        
    }
       


    private function send_mail($data){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Port = 587; 
        $mail->IsHTML(true); 
        $mail->CharSet = "utf-8";

        $mail->Host = EMAIL_REGISTRATION_HOST; 
        $mail->Username = EMAIL_REGISTRATION_USER; 
        $mail->Password = EMAIL_REGISTRATION_PASSWORD;

        $mail->From = EMAIL_REGISTRATION_FROM; 
        $mail->FromName = EMAIL_REGISTRATION_FROM_NAME;
        $mail->AddAddress($data->email);
        $mail->AddReplyTo(EMAIL_REGISTRATION_REPLAY_TO); 

        $mail->Subject = EMAIL_REGISTRATION_SUBJECT . " " . $data->name; 

        $mail->Body = file_get_contents(EMAIL_REGISTRATION_HTML_TEMPLATE_PATH);
        
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        return $mail->Send();
       
    }

}

?>