<!DOCTYPE html>
<html lang="pl">
  <head>
	<!-- Design: 	Patryk Kalinowski, AIESEC Kraków | PATRYK.KALINOWSKI@GMAIL.COM 
					Tomasz Jaśkiewicz, AIESEC Kraków | JASKIEWICZTOMASZ@GMAIL.COM -->
	<!-- This project is developed on github.com/AIESECKrakow/GlobalTalents-LandingPage -->	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Global Talents to międzynarodowy program wymiany praktyk zawodowych prowadzony przez AIESEC na całym świecie. W bazie Global Talents znajdują się tysiące ofert praktyk i staży zarówno w lokalnych firmach, jak i najbardziej znanych globalnych korporacjach.">
    <title>Gratulacje!</title>
	
	<!-- Favicon image -->
	<link rel="icon" type="image/png" href="img/favicon.png"/>
	
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>
  <body>

	
							<!-- Google Tag Manager --
					<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KH5H2F"
					height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
					<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
					j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
					'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
					})(window,document,'script','dataLayer','GTM-KH5H2F');</script>
					<!-- End Google Tag Manager -->


		<!-- FIRST PAGE -->
	<div id="summary">
	
	<div id="title-summary">Gratulacje!</div>
	<div id="text-summary">Zrobiłeś pierwszy krok do przeżycia wspaniałej przygody!<br/>
							Twoje konto zostało założone. Zaloguj się na swoją skrzynkę e-mail i zobacz, co dla Ciebie przygotowaliśmy.
	</div>
	</div>	
	
		
	
	
		
		
		
		
		
	</body>
</html>
<?
   require "config.php";
connection();

$date = date("Y-m-d H:i");
$email = $_POST["email"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$email2 = $_POST["email"];
$email = str_replace("@", "%40", $email);
$password = $_POST["password"];
$lc = $_POST["lc"];

// save applicant data to our database
$ $wpcpost2 = mysql_query("SELECT * FROM `mp_landing_gt` WHERE mail='$email'")
	or die('Strona nie istnieje');
	if(mysql_num_rows($wpcpost2) > 0) 
		{ } 
	else {
	mysql_query("INSERT INTO mp_landing_gt (name, surname, mail, date, lc) VALUES ('$name', '$surname', '$email2' , '$date', '$lc')");
	}
	
	
if ($lc !== "krakow" || $lc !== "" )
	// if not krakow or empty, perform system registration
 {
   
// pass register data to globaltalents server
$cookie_file = 'cookie.txt';
$c = curl_init();
curl_setopt($c, CURLOPT_COOKIEJAR, $cookie_file);
curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($c, CURLOPT_URL, 'http://globaltalents.pl/c/apply/create/');
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_REFERER, 'http://globaltalents.pl/apply-lp');
curl_setopt($c, CURLOPT_POSTFIELDS,
'&name='.$name.'&surname='.$surname.'&email='.$email.'&pass='.$password.'&pass2='.$password.'&committee_id=13');
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_getinfo($c);
curl_exec($c);
curl_close($c);

} 
else {
// if krakow, create new CV item in Podio

// include Podio API
require_once 'podio/PodioAPI.php';

// configure app tokens - moved to config.php
// $app_id, $app_token, $client_id, $client_secret

// authenticate client to Podio
Podio::setup($client_id, $client_secret);
// authenticate client to app
Podio::authenticate_with_app($app_id, $app_token);

// PHP upload file script
if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
} 
else {
  /* 
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br>";
  */
  $file_name = $_FILES["file"]["name"];
  $file_path = $_FILES["file"]["tmp_name"];
}

// upload CV to Podio
$file = PodioFile::upload($file_path, $file_name);

// print 'File uploaded. The file id is: '.$file->id . "<br>";
/////////////////////////////////////
 

// create new Podio item (app_id, array('fields' => array()), array('file_ids' => array())); 
PodioItem::create($app_id, array('fields' => array(
	"title" => ($name . " " . $surname),
  "adres-e-mail-2" => $email2,
  ), 
  array("file_ids" => $file->id)  ));

?>