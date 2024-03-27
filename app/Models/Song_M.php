<?php
namespace Models;
use Libraries\Database;
use \PDO;
class Song_M{
    public function __construct(){
        $db = new Database();
        $this->dbh = $db->getInstance();
    } 
    public function iniMaxPrayer(){ 
        try { 
            $time = date('H:m');
            $date_f = date('Y-m-d'); 
            // 
            $sql = "select max(song_id) song_id, prayer_zone
            from song_prayer
            where prayer_zone='JHR01' and prayer_timedate='$date_f' and prayer_time='$time'";
                // where prayer_timedate='$date_f'";
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
    public function getData(){
        try {
            $date_f = date('Y-m-d'); 
            $sql = "select prayer_timedate, song_title, prayer_time, prayer_zone
            from song_prayer
            where prayer_timedate='$date_f'";
            // where prayer_zone='JHR01'";
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

    public function nextUpdate(){
        
        // get max sequence
        $sql = "UPDATE song_prayer 
                SET prayer_sequence = (
                    SELECT song_id
                    FROM song_prayer AS sp2
                    WHERE song_prayer.song_id = sp2.song_id
                )";
        $rs = $this->dbh->prepare($sql); 
        $rs->execute();
    }
    public function saveData($data){   
        $sql = "INSERT INTO song_prayer 
                ( 
                song_title, subs_id, box_id, prayer_zone, prayer_timedate, prayer_time
                ) VALUES 
                ( ?, ?, ?, ?, ?, ? )";
        $rs = $this->dbh->prepare($sql);
        $rs->execute(
            [
                $data["song_title"], 
                $data["subs_id"],
                $data["box_id"],
                $data["zone"],
                $data["prayer_timedate"],
                $data["prayer_time"], 
            ]
        );
        $this->nextUpdate();
    }
}