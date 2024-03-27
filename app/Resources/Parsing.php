<?php
namespace Resources;
use Resources\PrayerTime;
use Models\Song_M;
class Parsing{
    public function __construct(){ 
        $this->sg = new SOng_M();
    }
    
    public function parseDate($data="", $data2=""){
        
        $parsing = new Parsing(); 



        // $parsing = new PrayerTime();
        if (isset($data) &&  isset($data2)) { // Check if $data is set
            // --
            $date_only = ['date'];
            $dates_tgl = '';
            foreach ($date_only as $key) {
                if (property_exists($data, $key)) {
                    $dates_tgl.=$data->$key; // . PHP_EOL;
                }
            } 
            $desiredKeys = [
                'fajr'
                , 'dhuhr'
                , 'asr'
                , 'maghrib'
                , 'isha' 
            ];
            $a = 1;
            foreach ($desiredKeys as $key) { 
                if (property_exists($data, $key) ) {
                    // echo "$key: " . $data->$key . PHP_EOL; 
                    $name = '';
                    if($key == 'fajr'){
                        $name .= 'Subuh';
                    }else if($key == 'dhuhr'){
                        $name .= 'Dohor';
                    }else if($key == 'asr'){
                        $name .= 'Ashar';   
                    }else if($key =='maghrib'){
                        $name .= 'Maghrib';
                    }else if($key == 'isha'){ 
                        $name .='Isyak';
                    }
                    $this->sg->saveData(
                        array(  
                            'song_title'=>$name.' ('.date('m-d', strtotime($dates_tgl)).')',
                            'prayer_timedate'=>date('Y-m-d', strtotime($dates_tgl)),
                            'prayer_time'=>str_replace(':00', '', $data->$key),
                            'zone'=>$data2['zone'], 
                            'subs_id'=>$data2['subs_id'], 
                            'box_id'=>$data2['box_id'], 
                        )); 
                }
                $a++;
            } 
        }
    }
}
 