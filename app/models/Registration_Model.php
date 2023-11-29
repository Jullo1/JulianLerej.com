<?php


class Registration_Model extends Base_Model {
    
    public function set_user($data){

        try {
            $sth = $this->dbh->prepare("INSERT INTO event_users (name, email, password) VALUES (:NAME, :EMAIL, SHA1(:PASSWORD))");
            $sth->bindValue(":NAME", $data->name);
            $sth->bindValue(":EMAIL", $data->email);
            $sth->bindValue(":PASSWORD", $data->password);
            //$sth->errorInfo();

            $sth->execute();
            return $this->dbh->lastInsertId();

            
        } catch (Exception $e) {
            if ($e->getCode() == 23000 ) {
                throw new Exception("Username taken. Click <a href='../recover_password'>here</a> to reset password. Click <a href='../registration'>here</a> to go back to the registration form.");
            }
            throw $e;
        }
    }

}

?>