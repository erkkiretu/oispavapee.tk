<!DOCTYPE html>
<html>
<head>
	<title>SK KEY GEN</title>
</head>
<body>

<form action='' method='POST'>
<input type="text" name="number">
<input type="submit" name="submit" value='generate'>
</form>
</body>
</html>



	<?php 
  

function random_strings($length_of_string) 
{ 
  
   
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
    
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 
} 
  
$number = $_POST['number'];
if(isset($_POST['submit'])){

for($i = 0;	$i < $number; $i++){



echo('<table>');
echo('<tr>');
echo ('<td>'.'sk_live_'.random_strings(34).'</td>');
echo('</tr>');
echo('</table>');


	
}


}




  
?>



