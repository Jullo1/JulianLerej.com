<?php


class Game_Model extends Base_Model {
    
    public function set_location($data){

        try {
            $sth = $this->dbh->prepare("INSERT INTO location_selected VALUES (NULL, :ID_EVENT_USER, :LOCATION_NAME, NOW()) ");
            $sth->bindValue(":ID_EVENT_USER", $data->id_event_user);
            $sth->bindValue(":LOCATION_NAME", $data->location_name);
            $sth->execute();
        } catch (Exception $e) {
           //Do nothing
        }
    }

}

?>