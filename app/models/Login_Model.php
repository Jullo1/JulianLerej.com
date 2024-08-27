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
    
    public function get_user_guest($data){
        try {
            if ($_SESSION["user_guest_name"] != "")
            {
                $sth = $this->dbh->prepare("SELECT * FROM event_users WHERE name=:GUESTNAME");
                $sth->bindValue(":GUESTNAME", $_SESSION["user_guest_name"]);
                $sth->execute();
                $result = $sth->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $sth = $this->dbh->prepare("SELECT * FROM event_users WHERE name like 'Guest%' ORDER BY name DESC LIMIT 1");
                $sth->execute();
                
                $result = $sth->fetch(PDO::FETCH_OBJ);
                $newGuestNumber = intval(str_replace("Guest", "", $result->name)) + 1;
                
                $sth2 = $this->dbh->prepare("INSERT INTO event_users (name) VALUES ('Guest" . $newGuestNumber . "')");
                $sth2->execute();
                
                $sth->execute();
                $result = $sth->fetch(PDO::FETCH_OBJ);
            }
            return $result;
           
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>