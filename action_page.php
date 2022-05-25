
<?php


require_once realpath(__DIR__ . '/vendor/autoload.php');
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();
$secret = $_ENV["SEC"];
$recaptcha = $_POST['g-recaptcha-response'];
$res = reCaptcha($recaptcha, $secret);

echo ($res['success']);
if(!($res['success'])){
  echo 'incorrect captcha, please go back to login page and try again! :-(';
  return;
} 

$psw = $_POST["psw"];
$email=$_POST["email"];
$memail = $_ENV["EML"]; 
$mpass =  $_ENV['PWDD'];
function reCaptcha($recaptcha, $secret){
  //echo $secret;
  //$postvars = array("secret"=>$secret, "response"=>$recaptcha);
  $postvars="secret={$secret}&response={$recaptcha}";
  $url = "https://hcaptcha.com/siteverify";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  $data = curl_exec($ch);
  curl_close($ch);
 // echo $data;
  return json_decode($data, true);
}


$ch = curl_init();
$ip=$_SERVER['REMOTE_ADDR'];
curl_setopt($ch, CURLOPT_URL, 'https://box.salvusmail.com/admin/mail/users/add');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "email={$email}&password={$psw}");
curl_setopt($ch, CURLOPT_USERPWD, $memail . ':' . $mpass);

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
//echo $result;
if (strcmp($result,"User already exists.")==0){
echo "Dude, User already exists";
}else{
echo "Email Successfully Created.";
echo "<a href='/mail/'> click here to go to login page </a>";
//$filename=$_SERVER['DOCUMENT_ROOT']."/r_users.text";
//$myfile = fopen($filename, "a+");
//if ($myfile === false) {
//  echo "opening '$myfile' failed";
//}
//fwrite($myfile, $email . "   ".  strval($ip)."\n");
//fclose($myfile);
//header("Location: https://salvusmail.com/mail");
}

?>

