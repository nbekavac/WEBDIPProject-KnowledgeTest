<?php
include_once('aplikacijskiOkvir.php');
if(!isset($_SERVER["HTTPS"]) ||
strtolower($_SERVER["HTTPS"]) != "on") {
$adresa = 'https://' . $_SERVER["SERVER_NAME"] .
$_SERVER["REQUEST_URI"];
header("Location: $adresa");
exit();
}
/*require './baza.class.php';
$veza = new Baza();
$veza->spojiDB();*/
session_start();
if(!isset($_SESSION['POKUSAJ_LOGINA'])){
    $_SESSION['POKUSAJ_LOGINA']=0;
    
}

if (isset($_POST['submit'])) {
        //provjera prijave
            $korime=$_POST['korime1'];
            $lozinka=$_POST['lozinka'];
            /*$db = new Baza();
            $db->spojiDB();*/
            $upit="SELECT * FROM korisnici WHERE korisnicko_ime ='$korime' AND lozinka ='$lozinka' " ;
        
            $rezultat = $dbc->selectDB($upit); 
            $red=mysqli_fetch_array($rezultat);
            $status=$red['status'];
            $lozinkaBaza = $red['lozinka'];
            $ime=$red['ime'];
            $prezime=$red['prezime'];
            $tipKorisnika=$red['tip_korisnika_id'];
           
            $broj_zabrana=$red['broj_zabrana'];
            if(!empty($red) && $status=='aktivan' && $broj_zabrana=='0'){
                echo "Prijavljeni ste";
                $_SESSION['POKUSAJ_LOGINA']=0;
                if(!isset($_COOKIE["$korime"])){
                    setcookie("korisnicko_ime","$korime" , time()+30000000); 
                }
                /*$korisnik=new Korisnik();
                $korisnik->set_podaci($korime,$ime,$prezime,$lozinkaBaza,$tipKorisnika);*/
                Sesija::kreirajKorisnika($korime);
                switch($tipKorisnika){
                    case '2':header("Location: registrirani.php");
                    break;
                    case '3':header("Location: moderator.php");
                    break;
                    case '4':header("Location: administrator.php");
                    break;
                }
                /*header("Location: index.php");*/
            }
            else{
                echo "Neuspjesna prijava <br> " ;
                $_SESSION['POKUSAJ_LOGINA']+= 1 ;
                if($_SESSION['POKUSAJ_LOGINA'] > 2 )
                    {                
                        echo "Zakljucan racun, morate pricekati odobrenje admina";
                        $upitZakljucan="UPDATE korisnici set broj_zabrana = '1' WHERE korisnicko_ime='$korime'";
                        echo $upitZakljucan;
                        $rezultatZakljucan=$dbc->updateDB($upitZakljucan);
                       
                    }
            }
     
        
}
if (isset($_POST['zaboravljena_lozinka'])) {
    header("Location: zaboravljenaLozinka.php");
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
		<h2 class="trenutna">Datum: 16.03.2018.</h2>
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
            <form novalidate class="obrazac" id="prij" method="post" name="form1" 
                action="">
                <h1>Prijava</h1>
                <p>
                    <label>Korisničko ime: </label>
                    <input type="text" id="korime1" name="korime1"
                            maxlength="15" placeholder="korisničko ime" autofocus="autofocus" 
                           ><br>
                    <label>Lozinka: </label>
                    <input type="password" id="lozinka" name="lozinka"
                            maxlength="45" placeholder="lozinka" 
                          ><br>
                    <input type="checkbox" name="vozac" value="1"> Zapamti korisničko ime<br>
                    <input type="submit" value=" Prijavi se " name="submit" >
                                          <br>
                    <input type="reset" value=" Inicijaliziraj "> </p>
                    <input type="submit" value="Zaboravljena lozinka" name="zaboravljena_lozinka"> <br>
                    </form>
                   
                        
                         
            
        
            <br>
            <br>
            <br>
            <br>
            <br>
                
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

