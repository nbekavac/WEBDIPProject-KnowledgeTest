<?php
   require './baza.class.php';
   $greska=false;
   //kolacic
    if(!isset($_COOKIE["prvi_dolazak"])){
        setcookie("prvi_dolazak", "prvi_dolazak" , time()+300);
        echo "Ova stranica sprema kolacice. <br/>";
    }
          
   //na submit
   if (isset($_GET['submit'])) { 
       //provjera tekstualnog elementa
       $tekstualno = $_GET['igrac1'];
       if(strlen($tekstualno)< 5){
           echo "Tekstualni element mora imati više od 5 znakova.<br/>";
           $greska=true;
       }
       if($tekstualno!=""){
       if($tekstualno[0] == strtolower($tekstualno[0])){
		echo "Prvo slovo u tekstualnog elementu mora biti veliko. <br/>";
                $greska=true;
	}
        }
        //provjera nedozvoljenih znakova    
        $unosImena =  $_GET['ime'];
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
        $unosIgraca =  $_GET['igrac'];
                        for($i=0; $i<strlen($unosIgraca) ;$i++){
			if ($unosIgraca[$i] === "!"  || $unosIgraca[$i]==="?" || $unosIgraca[$i]==="#" || $unosIgraca[$i]==="'")
				{
					echo "Nedozvoljen znak kod odabira igraca.<br/>";
					$greska=true;
				}
			}
			if ($unosIgraca==="")
			{
				echo "Morate unijeti vrijednost za igraca.<br/>";
				$greska=true;
			}	
        $unosTeksta = $_GET['igrac1'];
			for($i=0; $i<strlen($unosTeksta) ;$i++){
			if ($unosTeksta[$i] === "!"  || $unosTeksta[$i]==="?" || $unosTeksta[$i]==="#" || $unosTeksta[$i]==="'")
				{
					echo "Nedozvoljen znak u textboxu.<br/>";
                                        $greska=true;
				}
			}
			if ($unosTeksta==="")
			{
				echo "Morate unijeti vrijednost u textboxu.<br/>";
                                $greska=true;
			}
	$unosBrojaNaDresu = $_GET['number'];
			for($i=0; $i<strlen($unosBrojaNaDresu) ;$i++){
			if ($unosBrojaNaDresu[$i] === "!"  || $unosBrojaNaDresu[$i]==="?" || $unosBrojaNaDresu[$i]==="#" || $unosBrojaNaDresu[$i]==="'")
				{
                                    echo "Nedozvoljen znak u odabiru broja na dresu.<br/>";
                                    $greska=true;
				}
			}
			if ($unosBrojaNaDresu==="")
			{
                                    echo "Morate unijeti vrijednost broja na dresu.<br/>";
                                    $greska=true;
			}			
        //provjeravanje liste podataka u datoteci
        $file ="datalist.txt"; 
        if($handle = fopen($file, 'r')){
            $content= fread($handle, filesize($file));
            $listaPodataka = $_GET['igrac'];
            $rijeci= explode("  ", $content);
            $provjera=true;
            for($i=0; $i<count($rijeci); $i++){                
                if ($rijeci[$i] == $listaPodataka) {
                   $provjera=false;
                }                
            }
            if ($provjera == true) {
                echo "Uneseni igrac nije jednak igracu u listi. <br/>";
                $greska=true;
            }
            fclose($handle);
        }
        else{
            echo "Datoteka se nije otvorila";
        }
        //provjera datuma i vremena
        $datumivrijeme= $_GET['datumivrijeme'];
        if (strlen($datumivrijeme)==16) {
           if($datumivrijeme[2] != "." || $datumivrijeme[5] != "." || $datumivrijeme[10]!= ' ' || $datumivrijeme[13] != ':'){
            echo "Krivi format datum i vremena. <br/>"; 
            $greska=true;
        }
        }
        else{
            echo "Krivi format datuma i vremena. <br/>";
            $greska=true;
        }
        //provjera slike pomocu regularnih izraza
        $nazivSlike= $_GET['slika'];
        $reg="/^.*\.(jpg|jpeg|png)$/i";
        if(!preg_match($reg , $nazivSlike)){
           echo "Naziv slike mora biti .jpg, .jpeg ili .png <br/>"; 
           $greska=true;
        }  
        //unos u bazu
        $klub=$_GET['klub'];
        $liga=$_GET['liga'];
        $visina=$_GET['visina'];
        if($greska==false){
        $veza = new Baza();
        $veza->spojiDB();
        $upit="INSERT INTO obrazac VALUES ('" . $unosImena . "','" . $unosIgraca . "','" . $klub . "','" . $liga . "','" . $tekstualno . "','" . $datumivrijeme . "'," . $unosBrojaNaDresu . "," .$visina . ",'" .$nazivSlike. "')";
        echo $upit;
        $rezultat = $veza->updateDB($upit);
        $veza->zatvoriDB();
        header("Location: tablica.php");
        exit();
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
		
		
    </head>

    <body>
       
        <header>
            <h1 class="zaglavlje">Zadaća 4 </h1>	
            <h2 class="trenutna">Datum: 16.03.2018.</h2>
            <p style="padding-top:30px" >
            <a  href="prijavaRegistracija.php?mod=prijava" class="prijava">Prijava</a><br></p>			
	</header>
        <nav>
            <ul>
                            <li><a href="index.html">Početna</a></li>
                            <li><a href="galerija.php">Galerija</a></li>
                            <li><a href="prijavaRegistracija.php?mod=prijava">Prijava</a></li>
                            <li>
                            <a href="prijavaRegistracija.php?mod=registracija">Registracija</a>
                            </li>
                            <li><a href="obrazac.php">Obrazac</a></li>
                            <li><a href="tablica.php">Tablica</a>
                           
			</ul>
	</nav>           
                   
            <section id="sadrzaj">
               <form novalidate id="obrazac1" class="obrazac" method="get" name="obrazac" action="">
                <fieldset>
                    <legend>Prvi dio</legend>
                    <input class="klasa" type="text" id="ime" name="ime" size="2" 
                           maxlength="30" placeholder="ime">					
                    <label for="ime" >:Unesite svoje ime </label> <br><br>
                    <input class="klasa" list="igrac" id="igraci" name="igrac" placeholder="Odaberi igraca">
                    <datalist class="klasa" id="igrac" >
                        <option value="Wayne Rooney">
                        <option value="Mohammed Salah">
                        <option value="Eden Hazard">
                        <option value="Sergio Aguero">
                        <option value="Mesut Ozil">
                    </datalist>			
                    <label>:Odaberite igraca </label> <br><br>
                    <select id="klub" name="klub">
			<optgroup label="Premier League">
				<option value="1000007" selected="selected"> Tottenham</option>
				<option value="1000006" >ManUtd</option>
				<option value="1000002" >ManCity</option>
				<option value="1000020" >Arsenal</option>
				<option value="1000005" >Liverpool</option>
			</optgroup>
			<optgroup label="La Liga">
				<option value="1000022" >Barcelona</option>
				<option value="1000004" >Real Madrid</option>
				<option value="1000003" >Valencia</option>
				<option value="1000001" >Atletico Madrid</option>
			</optgroup>				
                    </select>
                    <label for="klub">:Odaberite klub iz lige </label><br><br>
                    <select id="liga" name="liga" multiple="multiple" size="3">
                        <option value="-1" selected="selected">== Odaberi ligu ==</option>
                        <option value="0">Premier League</option>
                        <option value="1">La liga</option>
                        <option value="2">1 HNL</option>
                        <option value="3">Bundesliga</option>
                        <option value="4">Ligue 1</option>
                    </select>
                    <label for="liga">:Liga</label><br>
                    
                </fieldset>

                <fieldset>
                    <legend>Drugi dio</legend>

                    <br>
                    <textarea id="igrac1" name="igrac1" rows="40" cols="60" maxlength="580" placeholder="Opisite ga ovdje"></textarea>
                    <label for="igrac1">:Opis igraca</label><br>                   
                    <input type="file" id="unesi" name="unesi" >
                    <label for="unesi">:Odaberite dokument </label><br>                   
                    <input type="text" id="datumivrijeme" name="datumivrijeme" required="required" placeholder="dd.mm.gggg hh:mm">
                    <label for="datumivrijeme">:Datum i vrijeme </label><br>                    					
                    <input type="number" id="number" name="number" min="1" max="99">
                    <label for="number">:Unesi broj na dresu </label><br>					
                    <input type="range" id="visina" name="visina" min="80" max="240" value="180">
                    <label for="visina">:Visina igraca </label><br>
                    <input type="text" id="slika" name="slika" required="required" placeholder="Unesi naziv slike">
                    <label for="slika">:Naziv slike </label><br>
                </fieldset>
                    <input id="posaljiObrazac" type="submit" name="submit" value=" Pošalji ">
            </form>
                
        </section>
        <footer>
            <figure style="float:left">
		<a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/obrazac.html">
                <img src="multimedija/HTML5.png"  width="70" height="50" />
                </a>
                <figcaption>HTML</figcaption>
            </figure>
            <figure style="float:left">
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/obrazac.html">
                <img src="multimedija/CSS3.png"  width="70" height="50"  />
		</a>
                <figcaption>CSS3</figcaption>
            </figure>
            <h3 class="footer" > Vrijeme rjesavanja: 4 sati </h3>
        </footer>
            
       
    </body>
</html>

