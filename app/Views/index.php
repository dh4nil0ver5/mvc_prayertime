<?php

$data = json_decode($data, true);  
$data2 = json_decode($data2, true);  

if(count($data)==0){

}else{
?>
<?php 
    $zone ="";
    foreach ($data as $row): 
        $zone = $row['prayer_zone']; 
        echo "".preg_replace('/\s\(\d{2}-\d{2}\)/', '', $row['song_title'])."&nbsp";
    endforeach; 
    echo '</br>';
    foreach ($data as $row):
        echo $row['prayer_time']."&nbsp"; 
    endforeach;  
} 
?>
    <!-- echo '</br>';
    echo '</br>';
    echo '</br>';
    echo 'Default '.$zone;    
    echo '</br>';
<?php    
// if(count($data)==0){
//     echo "<form method='post' action='run'>"
//     ."<input name='box_name' placeholder='box name' type='text' />"
//     ."&nbsp;&nbsp;"
//     ."<input name='zone' placeholder='zone' type='text'/>"
//     ."&nbsp;&nbsp;"
//     ."<select name='subs'>";
//     foreach ($data2 as $row) {
//         echo "<option value='" . $row['subs_id'] . "' >" . $row['subs_name'] . "</option>";
//     }
//     echo "</select>"
//     ."&nbsp;&nbsp;"
//     ."<input name='run' type='submit' />"
//     ."</form>"
//     ;
// }else{ 

//     echo "<pre>";
//     print_r($data);
//     echo "</pre>";
// }
    ?>    -->



 