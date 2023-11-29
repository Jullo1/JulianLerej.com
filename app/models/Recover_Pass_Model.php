<?php


class Recover_Pass_Model extends Base_Model {
    
    public function get_user($data){
        try {
            $sth = $this->dbh->prepare("SELECT * FROM event_users WHERE email = :EMAIL AND name = :NAME");
            $sth->bindValue(":EMAIL", $data->email);
            $sth->bindValue(":NAME", $data->name);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_OBJ);
            
            if(!$result){
                throw new Exception("Email and username combination not found. <a href='../recover_password'>Back</a>.");
            }
            
            return $result;
           
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($data){
        try {
            $sth = $this->dbh->prepare("UPDATE event_users SET password = SHA1(:PASSWORD)  WHERE id = :ID");
            $sth->bindValue(":ID", $data->id);
            $sth->bindValue(":PASSWORD", $data->password);
            return $sth->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>