<?php



class Login_Model extends Base_Model {
    
    public function get_user($data){
        try {
            $sth = $this->dbh->prepare("SELECT * FROM event_users WHERE name = :NAME AND password = SHA1(:PASSWORD)");
            $sth->bindValue(":NAME", $data->name);
            $sth->bindValue(":PASSWORD", $data->password);
            $sth->execute();
            
            $result = $sth->fetch(PDO::FETCH_OBJ);
            
            if(!$result){
                throw new Exception('Incorrect login. <a href="../login">Try again</a>.');
            }
            
            return $result;
           
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>