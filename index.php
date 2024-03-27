<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *"); 
header('Access-Control-Allow-Headers: Content-Type');
date_default_timezone_set('Asia/Jakarta');
require_once __DIR__ . '/vendor/autoload.php';
use Controllers\PrayerTime;
$ctr = new PrayerTime(); 




if( !isset($_GET['act']) ){
  $ctr->index();
}else{
  switch($_GET['act'])
    { 
      default:
        break;
    }
}
// Your code for displaying the table...

if(isset($_POST)) {  
	if (isset($_POST['run'])) {   
      $zone = htmlspecialchars($_POST['zone']);  
	  $box = htmlspecialchars($_POST['box_name']);  
	  $subs = htmlspecialchars($_POST['subs']);  
	  $data = [
		'prayerzone'=>$zone,
		'box'=>$box,
		'subs_id'=>$subs
	  ];
	  $ctr->extractData($data);
	} 
}

?>
