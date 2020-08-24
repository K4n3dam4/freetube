<?php

class Database extends DatabaseConfig {
    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        //create a new instance of pdo
        try {
            $this->dbh = new PDO($dsn,$this->user, $this->pw, $options);
        } catch(PDOException $ex) {
            $this->error = $ex->getMessage();
            echo $this->error;
        }
    }

    //prepare sql statement
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    //bind values
    public function bind($param, $value, $type=null) {
        if(is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param,$value,$type);
    }

    //execute query
    public function execute(){
        return $this->stmt->execute();
    }

    //result Set
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //single record
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //count rows
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}

?>