<?php
$proxy = $_GET['lista'];
$url = 'https://www.netflix.com/login';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
//curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_TIMEOUT,10);
 $output = curl_exec($ch);
$info = curl_getinfo($ch);
  $result =  $info["http_code"];
curl_close($ch);

if (strpos($result, "200") === 0){
  echo '<span class="badge badge-success">'.$proxy.'</span></br>';
} 
elseif(strpos($result, "403") === 0) {
  echo '<span class="new badge red">'.$proxy.'</span></br>';
}
elseif(strpos($result, "0") === 0) {
  echo '<span class="new badge red">'.$proxy.'</span></br>';
}
else {
  echo '<span class="new badge red">'.$proxy.'<span class="badge badge-info">'.$result.'</span></br>';
}
    
?>