<?php



abstract class Base_Model {
    
	private $hostname	=	DB_HOSTNAME;
	private $username	=	DB_USERNAME;
	private $password 	=	DB_PASSWORD;
	private $database	=	DB_NAME;
    protected $dbh;    


    public function __construct(){
        try {
            $this->dbh = new PDO("mysql:dbname=$this->database;host=$this->hostname", $this->username, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->query("SET NAMES 'utf8'");
            $this->dbh->query("SET lc_time_names = 'es_MX'");
            return $this->dbh;
        } catch (PDOException $ex) {
            echo "Error en la conexion a la DB : ".$ex->getMessage();
            die;
        }

	}
}
?>


