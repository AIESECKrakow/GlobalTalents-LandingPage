<!DOCTYPE html>
<html>
	<head>
	<!-- DESIGN: PATRYK KALINOWSKI, AIESEC KRAKÓW | PATRYK.KALINOWSKI@GMAIL.COM 
						TOMASZ JAŚKIEWICZ, AIESEC KRAKÓW | JASKIEWICZTOMASZ@GMAIL.COM -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Gratulacje! | Global Talents - praktyki zagraniczne</title>
		<meta name="description" content="Global Talents to międzynarodowy program wymiany praktyk zawodowych prowadzony przez AIESEC na całym świecie. W bazie Global Talents znajdują się tysiące ofert praktyk i staży zarówno w lokalnych firmach, jak i najbardziej znanych globalnych korporacjach. ">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- for Apple devices -->
		
		<link rel="stylesheet" href="style.css" type="text/css" />				
		<!-- <link rel="stylesheet" media="screen and (min-height: 900px) and (max-width: 1280px)" href="style1280.css" />		-->
		
			
		<script type="text/javascript">	
						$(document).ready(function() {
						
							mixpanel.track("Rejestracja w systemie (manual code)");
						

						}); 
				
					</script>	
	</head>
	
	<body>

	
							<!-- Google Tag Manager -->
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

if (!empty($_POST["name"])) {


  $email = $_POST["email"];


$name = $_POST["name"];
$surname = $_POST["surname"];
$email2 = $_POST["email"];
$email = str_replace("@", "%40", $email);
$password = $_POST["password"];




   $ $wpcpost2 = mysql_query("SELECT * FROM `mp_landing_gt` WHERE mail='$email'")
or die('Strona nie istnieje');
if(mysql_num_rows($wpcpost2) > 0) { } else {
mysql_query("INSERT INTO mp_landing_gt (name, surname, mail, date) VALUES ('$name', '$surname', '$email2' , '$date')");

}




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

} else {}

?>