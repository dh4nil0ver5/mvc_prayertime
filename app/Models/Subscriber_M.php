<?php
namespace Models;
use Libraries\Database;
use \PDO;

class Subscriber_M{
    public function __construct(){
        $db = new Database();
        $this->dbh = $db->getInstance();
    } 
    public function getData(){
        try {
            $sql = "select * from subscriber ";
            $rs = $this->dbh->prepare($sql);
            $rs->execute();
            $data = $rs->fetchAll(PDO::FETCH_ASSOC); 
            $json = json_encode($data);
            return $json; 
        } catch (PDOException $e) {
            echo "Error fetching data: " . $e->getMessage();
            return false; 
        } 
    }
}