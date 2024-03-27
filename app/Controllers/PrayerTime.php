<?php
namespace Controllers;
use Resources\Response;
use Models\Box_M;
use Models\Subscriber_M;
use Models\Song_M;
use Resources\Parsing;

class PrayerTime {
    public function __construct(){
        $this->box = new Box_M();
        $this->Subscriber = new Subscriber_M(); 
        $this->song = new Song_M(); 
        $this->parsing = new Parsing();
    }
    public function index(){
        $data = json_decode($this->song->iniMaxPrayer(), true);
        if($data[0]['song_id']){
            $data = [];
            $data['prayerzone'] = $data[0]['prayer_zone'];
            $this->extractData($data);
        }else{
            $data = $this->song->getData();
            $data2 = $this->Subscriber->getData();
            require_once('app/Views/index.php');
        }
    }   
    public function extractData($data){
        $ch = curl_init();  
        $headers = ['Content-Type: application/json'];  
        $url = 'https://www.e-solat.gov.my/index.php?r=esolatApi/TakwimSolat&period=week&zone=';
        curl_setopt($ch, CURLOPT_URL, $url.$data['prayerzone']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch); 
        
        $song = [];
        $box = $this->box->simpanData($data); 
        $decode = json_decode($box, true);  
        $result->box_id= $decode[0]['box_id']; 
        $result->subs_id= $decode[0]['subs_id']; 
        
        $i = 0;
        foreach ($result->prayerTime as $prayerTimeObject) { 
            // echo $i; 
            $data = array("zone"=>$result->zone, "subs_id"=>$result->subs_id, "box_id"=> $result->box_id);
            $this->parsing->parseDate($result->prayerTime[$i], $data);
            $i++;
        }
        header('Location: /');
        exit(); 
    }
}