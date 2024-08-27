<?php


class Registration_Model extends Base_Model {
    
    public function set_user($data){
        try {
            $sth = $this->dbh->prepare("UPDATE event_users SET name=:NAME, email=:EMAIL, password=SHA1(:PASSWORD) WHERE name=:GUESTNAME");
            $sth->bindValue(":NAME", $data->name);
            $sth->bindValue(":EMAIL", $data->email);
            $sth->bindValue(":PASSWORD", $data->password);
            $sth->bindValue(":GUESTNAME", $_SESSION["user_guest_name"]);
            //$sth->errorInfo();

            $sth->execute();
            $returnValue = $this->dbh->lastInsertId();
            
            $sth2 = $this->dbh->prepare("UPDATE leaderboard SET Username=:NEWNAME WHERE Username=:GUESTNAME");
            $sth2->bindValue(":NEWNAME", $data->name);
            $sth2->bindValue(":GUESTNAME", $_SESSION["user_guest_name"]);
            $sth2->execute();
            
            return $returnValue;
            
        } catch (Exception $e) {
            if ($e->getCode() == 23000 ) {
                throw new Exception("Username taken. Click <a href='../recover_password'>here</a> to reset password. Click <a href='../registration'>here</a> to go back to the registration form.");
            }
            throw $e;
        }
    }
    
    public function get_user_registration(){
        try {
            $sth = $this->dbh->prepare("SELECT * FROM event_users WHERE name = :NAME");
            $sth->bindValue(":NAME", $_SESSION["user_name"]);
            $sth->execute();
            
            $result = $sth->fetch(PDO::FETCH_OBJ);
            
            return $result;
           
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>