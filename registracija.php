<?php
require './baza.class.php';
$greska=false;


if (isset($_POST['submit'])) {
        
        //provjera nedozvoljenih znakova    
             $unosImena =  $_POST['ime'];
             for($i=0; $i<strlen($unosImena) ;$i++){
                if ($unosImena[$i] == '!' || $unosImena[$i]=='?' || $unosImena[$i]=='#' || $unosImena[$i]=="'")
                    {
				         echo "Nedozvoljen znak u imenu.<br/>";
                         $greska=true;
                    }
                }
             if ($unosImena=="")
                {
			         echo "Morate unijeti vrijednost za ime.<br/>";
                     $greska=true;
			
                }		
            $unosPrezimena =  $_POST['prez'];
             for($i=0; $i<strlen($unosPrezimena) ;$i++){
			     if ($unosPrezimena[$i] === "!"  || $unosPrezimena[$i]==="?" || $unosPrezimena[$i]==="#" || $unosPrezimena[$i]==="'")
				    {
					    echo "Nedozvoljen znak za prezime.<br/>";
					    $greska=true;
				    }
			 }
			if ($unosPrezimena==="")
			{
				echo "Morate unijeti vrijednost za prezime.<br/>";
				$greska=true;
			}	
            $unosKorisnickoImena = $_POST['korime2'];
			for($i=0; $i<strlen($unosKorisnickoImena) ;$i++){
			if ($unosKorisnickoImena[$i] === "!"  || $unosKorisnickoImena[$i]==="?" || $unosKorisnickoImena[$i]==="#" || $unosKorisnickoImena[$i]==="'")
				{
					echo "Nedozvoljen znak kod korisnickog imena.<br/>";
                    $greska=true;
				}
			}
			if ($unosKorisnickoImena==="")
			{
				echo "Morate unijeti vrijednost za korisnicko ime.<br/>";
                                $greska=true;
			}
	        $unosLozinke = $_POST['lozinka2'];
			for($i=0; $i<strlen($unosLozinke) ;$i++){
			if ($unosLozinke[$i] === "!"  || $unosLozinke[$i]==="?" || $unosLozinke[$i]==="#" || $unosLozinke[$i]==="'")
				{
                     echo "Nedozvoljen znak za lozinku.<br/>";	
                     $greska=true;
				}
			}
			if ($unosLozinke==="")
			{
                 echo "Morate unijeti vrijednost za lozinku.<br/>";
                 $greska=true;
            }
        //provjera broja znakova
        if(strlen($unosKorisnickoImena)< 5)
        {
            echo "Nedovoljan broj znakova u korisnickom imenu. <br/>";
        }
        if(strlen($unosLozinke)<5)
        {
            echo "Nedovoljan broj znakova u lozinci. <br/>";
        }
        //provjera emaila
        $nazivEmaila= $_POST['email'];
        $reg="/^(([^<>()\[\]\\.,;:\s@']+(\.[^<>()\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
        if(!preg_match($reg , $nazivEmaila)){
           echo "Naziv emaila nije pravilnog oblika. <br/>";
           $greska=true;
        }
        //provjera lozinke
        $ponovljenaLozinka= $_POST['lozinkaaPonovi'];
        if ($unosLozinke!=$ponovljenaLozinka) {
            echo "Unesena i ponovljena lozinka nisu jednake. <br/>";
            $greska=true;
        }
        //kriptiranje lozinke
        $salt = sha1(time()); 
        $lozinka="";
        $kriptirano = sha1($salt."--".$unosLozinke);
        
        //provjera captche
        $secret = "6Ldr310UAAAAAKTP6roeRnm2SSgh5i3d2CKheMP_";
        $ip = $_SERVER['REMOTE_ADDR'];
        $captcha = $_POST['g-recaptcha-response'];
        $rsp  = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip$ip");
        $arr = json_decode($rsp,TRUE);
        if($arr['success']){
            
        }else{
            echo "CAPTHA provjera neuspjesna.";
            $greska=true;
        }
        $trenutniDatum=date("Y-m-d H:i:s");
        $broj_zabrana=0;
        $tip_korisnika=2;
        $status="neaktivan";
        
        if($greska==false){
            if(!isset($message)) {
                 $veza = new Baza();
                 $veza->spojiDB();
                 $upit="INSERT INTO korisnici VALUES (default, '$unosKorisnickoImena ','$unosLozinke ','$kriptirano  ','$unosImena  ','$unosPrezimena  ','$nazivEmaila  ','$trenutniDatum  ','$trenutniDatum  ', '$broj_zabrana ', '$tip_korisnika' , '$status')";
                 $rezultat = $veza->updateDB($upit);
                
            
                $actual_link = "http://barka.foi.hr/WebDiP/2017_projekti/WebDiP2017x010/aktivacijaEmaila.php";
                $toEmail = $nazivEmaila;
                $subject = "Aktivacijski Mail";
                $content = "Kliknite ovaj link kako bi aktivirali Vas račun. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
                $mailHeaders = "From: Admin\r\n";
                if(mail($toEmail, $subject, $content, $mailHeaders)) {
                 echo $message = "Registrirali ste se i aktivacijski kod je poslan na Vas email.";	
                }
                unset($_POST);
			        
            /*header("Location: prijava.php");*/
                 
            }
        }
}
?>
<!DOCTYPE html>
<html>
	<head>
        <title>FOI - Web dizajn i programiranje : HTML - Primjer broj 03</title>
        <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Početna stranica">
        <meta name="datum promjene" content="06.03.2018.">
        <meta name="autor" content="Nikola Bekavac">
	    <link href="css/nbekavac.css" rel="stylesheet" type="text/css">
        <link href="css/nbekavac_prilagodbe.css" rel="stylesheet" type="text/css">
        <script src="js/nbekavac.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> 
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'hr'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


    </head>

    <body>
       
        <header>
		<h1 class="zaglavlje">Projekt </h1>	
		<p style="padding-top:30px" >
		<a  href="prijava.php" class="prijava">Prijava</a><br></p>				
	</header>
        <nav >
            <ul>
                            <li><a href="index.php">Pocetna</a></li>
                            <li><a href="prijava.php">Prijava</a></li>
                            <li>
                            <a href="registracija.php">Registracija</a>
                            </li>
                            <li><a href="oAutoru.html">o Autoru</a></li>
                            
			</ul>
    </nav>
     <div id="google_translate_element"></div>
    <section style= "padding-top:30px;">       
                        
    <form  novalidate class="obrazac" id="registracija" method="post" name="form1" 
                  action="">
		<h1>Registracija</h1>
		<p> 
                   
                    <label> Unesite ime: </label>
                    <input type="text" id="ime" name="ime"
                           maxlength="30" placeholder="ime"  
                           ><br>
                    <label >Unesite prezime: </label>
                    <input type="text" id="prez" name="prez"
                           maxlength="50" placeholder="prezime"  
                           ><br>
                    <label>	Korisničko ime: </label>
                    <input type="text" id="korime2" name="korime2"
                           maxlength="20" placeholder="korisničko ime"  
                            onblur="provjeraKorisnika(this.value)">
                    <div id="dostupnost"></div><br>
		            <label >Email adresa: </label>
		            <input type="email" id="email" maxlength="35" name="email" placeholder="ime.prezime@posluzitelj.xxx" required="required"><br>
                    <label> Lozinka: </label>
                    <input type="password" id="lozinka2" name="lozinka2"
                            maxlength="15" placeholder="lozinka" 
                           required="required"><br>
                    <label>Ponovi lozinku: </label>
                    <input type="password" id="lozinkaPonovi" name="lozinkaaPonovi" maxlength="15" pattern=".{6}" placeholder="lozinka" required="required"><br>
                    <div class="g-recaptcha" data-sitekey="6Ldr310UAAAAAFY0nYcjB14k8FIBw7KiTtHAJqmY"></div>
                    <input type="submit" id="submit" value=" Registracija " name="submit">
					<br>
                    <input type="reset" value=" Inicijaliziraj "> </p>
                    <a id="linkPrijava" href="prijava.php" >Prijava</a>
            </form>
                        
                        
                     
                
                
            </section>
            <footer>
            <figure style="float:left">
                <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/prijavaRegistracija.html">
                <img src="slike/HTML5.png"  width="70" height="50" />
                </a>
                <figcaption>HTML</figcaption>
            </figure>
        <figure style="float:left">
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/prijavaRegistracija.html">
                <img src="slike/CSS3.png"  width="70" height="50"  />
                </a>
                <figcaption>CSS3</figcaption>
            </figure>
                <h3 class="footer" > Vrijeme rjesavanja: 6 sati </h3>
        </footer>          
        
   
</body>
</html>
           


<script>
    function provjeraKorisnika(val){
    
        $.ajax({
            method:"POST",
            type:"text",
            url:"provjeraKorisnickogImena.php",
            data:'korime2='+val,
            success:function(data){
                $("#dostupnost").html(data);
            }
        });
 }
</script>
