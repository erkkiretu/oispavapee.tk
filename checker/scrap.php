<?php
//include('simple_html_dom.php');
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
{
  func();
}
function func()
{
  // do stuff     
}

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://www.dailyfreeproxy.com');
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
if (curl_errno($curl)) {
  echo 'Error:' . curl_error($curl);
}
curl_close($curl);
preg_match_all("!https:\/\/www\.dailyfreeproxy\.com\/.*?-fresh-new-proxy-https-.*?\.html!", $result, $matches1);
$proxy = array();
$link = $matches1[0][1];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($ch);
if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
}
preg_match_all("!\d{1,3}\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}:\d{2,4}!", $page, $matches);
foreach($matches[0] as $match){
 echo $d = $match."\r\n";
  
}
$handle = fopen('proxy.txt','w');
fwrite($handle,$match);
$file_data = json_encode($matches);
fwrite($handle,$d);



//echo $matches[0][array_rand($matches[0])];
//$proxies = array_merge($proxies,$matches);
//$print_r($proxies);

//±±+++++++++++++++++++++++++
//echo $random_keys=array_rand($matches);
//echo $items[array_rand($matches)];
/*$url = "https://www.digi77.com/software/bouncer/data/myipvv-by-web.php";
 
// Get current time to check proxy speed
$loadingtime = time();
 
$theHeader = curl_init($url);
curl_setopt($theHeader, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($theHeader, CURLOPT_TIMEOUT, 20);
curl_setopt($theHeader, CURLOPT_PROXY, $p); 
 
//Execute the request
$curlResponse = curl_exec($theHeader);
 
 
 
if ($curlResponse === false) 
{
    echo "Proxy is not working: ", curl_error($theHeader);
} 
else 
{
    //print the output
  echo $curlResponse;
  // Get Proxy speed speed
  echo "Proxy speed: " . (time() - $loadingtime) . "s<br />\n";
}*/
?>