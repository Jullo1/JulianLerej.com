<?php
require_once "app/models/Recover_Pass_Model.php";


class Recover_Pass_Controller {
    
    private $model;

    public function __construct(){
        //parent::__construct();
        $this->model = new Recover_Pass_Model();
        
    }
    
    public function index(){
        require VIEW . "recover_password.html";
    }
    
    public function recover(){
        $user = (object) $_POST;
        try{
            $user = $this->model->get_user($user);

            $user->password = random_int(11111, 99999);
            $this->model->update($user);
            $this->send_mail($user);

            echo "The new password will be sent to your registered email address. <a href='../login'>Login</a>.";
        }catch (Exception $e) {
            http_response_code(401);
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

        $mail->Subject = EMAIL_RECOVER_PASSWORD_SUBJECT; 

        $mail->Body = " Username: $data->name
                        <br/>
                        New Password: $data->password"; 

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