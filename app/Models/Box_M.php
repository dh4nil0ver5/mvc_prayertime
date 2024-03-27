<?php
namespace Models;
use Libraries\Database;
use \PDO;
class Box_M {
    public function __construct(){
        $db = new Database();
        $this->dbh = $db->getInstance();
    }
    function simpanData($data){
        if(count($data) == 0){
            return[];
        }else{ 
            $sql = "INSERT INTO box 
                ( box_name, prayerzone, subs_id) VALUES 
                ( ?, ?, ? )";
            $rs = $this->dbh->prepare($sql);
            // $executedQuery = $rs->debugDumpParams();
            $rs->execute(
                [
                    $data["box"], 
                    $data["prayerzone"],
                    $data["subs_id"] 
                ]
            );
            // 
            $sql = "select max(box_id) as box_id, subs_id ".
                " from box where prayerzone='".$data['prayerzone']."'";
            $rs = $this->dbh->prepare($sql);
            // $executedQuery = $rs->debugDumpParams();
            $rs->execute(); 
            $data = $rs->fetchAll(PDO::FETCH_ASSOC); 
            $json = json_encode($data);
            return $json;  
        }
    } 
}
