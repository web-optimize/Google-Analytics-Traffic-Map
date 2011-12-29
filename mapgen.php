<?php 

/************************************************************
Configuration Section
*************************************************************/
$username="email@domain.com";
$password="PASSWORD HERE";
$profile="12345678"; // See http://www.google.com/support/forum/p/Google%20Analytics/thread?tid=73f5507df43705db&hl=en - 
$usaonly=1; //Set to filter out non-US information.
$hsize=640; //Horizontal Size
$vsize=480; // Vertical Size
$days=14; // Days to show results from
$maxtoshow = 40; //Show so many dots.




/* Moving Parts Below - No need to edit*/


header("Content-Type: image/png");
require 'analytics.class.php';

$ana=new analytics($username, $password);
$ana->useCache();
$ana->setProfileById('ga:'.$profile);
$ana->setDateRange(date("Y-m-d", strtotime("-".$days." days")), date("Y-m-d"));
$conf=array(
'dimensions' => 'ga:city,ga:region',
'metrics'=>'ga:visitors',
'sort'=>'-ga:visitors',
'max-results'=>$maxtoshow
);
if($usaonly) $conf['filters']='ga:country%3D%3DUnited%20States';

$results=$ana->getData($conf);

foreach($results as $k=>$v) {
$c++;
if($c<=$maxtoshow) 
$nr[$k]=$v;

}

$results=$nr;
$rt=0;
foreach($results as $line) {
if($rt < $line)  $rt=$line;


}

$address="http://maps.googleapis.com/maps/api/staticmap?sensor=false&size=".$hsize."x".$vsize;


foreach($results as $k=>$line) {


$color=dechex(floor(255*$line/$rt));
if(strlen($color)==1) $color="0".$color;

$markers=$markers."&markers=color:0x".$color."0000|".urlencode($k);



}
$address=$address.$markers.$locs;

$ch = curl_init($address); 
curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resp = curl_exec($ch); //execute post and get results
curl_close ($ch);
echo $resp;

?>


