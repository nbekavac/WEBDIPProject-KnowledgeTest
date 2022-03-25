<?php
require './baza.class.php';
function dobaviPitanja(){
    if(isset($_GET["naziv_natjecanja"]))
         {

            $nazivNatjecanja = $_GET["naziv_natjecanja"];
            $veza = new Baza();
            $veza->spojiDB();
            $upitPitanja="SELECT pitanja.pitanja_id, pitanja.tekst FROM pitanja JOIN pitanja_na_natjecanju ON pitanja.pitanja_id=pitanja_na_natjecanju.pitanja_pitanja_id JOIN natjecanja ON pitanja_na_natjecanju.natjecanja_natjecanja_id=natjecanja.natjecanja_id WHERE '$nazivNatjecanja'=natjecanja.naziv";
            $upitTocanOdgovor="SELECT tocan_odgovor FROM pitanja JOIN pitanja_na_natjecanju ON pitanja.pitanja_id=pitanja_na_natjecanju.pitanja_pitanja_id JOIN natjecanja ON pitanja_na_natjecanju.natjecanja_natjecanja_id=natjecanja.natjecanja_id WHERE '$nazivNatjecanja'=natjecanja.naziv";
            $rezultatPitanja=$veza->selectDB($upitPitanja);
            $veza->zatvoriDB();                
            return $rezultatPitanja;
    }
   
}
/*function dobaviOdgovore(){
        if(isset($_GET["naziv_natjecanja"]))
             {
                $nazivNatjecanja = $_GET["naziv_natjecanja"];
                $veza = new Baza();
                $veza->spojiDB();
                $upitTocanOdgovor="SELECT tocan_odgovor FROM pitanja JOIN pitanja_na_natjecanju ON pitanja.pitanja_id=pitanja_na_natjecanju.pitanja_pitanja_id JOIN natjecanja ON pitanja_na_natjecanju.natjecanja_natjecanja_id=natjecanja.natjecanja_id WHERE '$nazivNatjecanja'=natjecanja.naziv";
                $rezultatTocanOdgovor=$veza->selectDB($upitTocanOdgovor);
                $veza->zatvoriDB();
                while(list($nazivOdgovor)= $rezultatTocanOdgovor->fetch_array())
                    {
                        $pitanja[$nazivOdgovor] = $nazivOdgovor;
                    }
                return $pitanja;
        }
        
}*/

if (isset($_POST['potvrdiOdgovor'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $nadimak=$_POST["nadimak"];
    $vrijeme_pocetka=$_POST["vrijeme_pocetka"];
    $vrijeme_zavrsetka=date("H:i:s");
    $vrijeme_pocetka_totime = strtotime($vrijeme_pocetka);
    $vrijeme_zavrsetka_totime = strtotime($vrijeme_zavrsetka);
    $vrijeme_rjesavanja_sekunde = $vrijeme_zavrsetka_totime - $vrijeme_pocetka_totime;
    $brojTocnih=0;
    foreach($_POST as $k=>$v){
        if(strpos($k, 'pitanje')!==false){
            $idPitanja = substr($k, 7, strlen($k));
            $provjeraPitanja = $veza->selectDB("select * from pitanja where pitanja_id=$idPitanja and tocan_odgovor='$v'");
            if(mysqli_num_rows($provjeraPitanja)>0){
                $brojTocnih++ ;          
            }   
        }
    }
    $nazivNatjecanjaa=$_GET["naziv_natjecanja"];
    $upitID="SELECT natjecanja_id FROM natjecanja WHERE natjecanja.naziv='$nazivNatjecanjaa'";
    $rezultatID=$veza->selectDB($upitID);
    $red=mysqli_fetch_array($rezultatID);
    $id=$red["natjecanja_id"];
    $upit="INSERT INTO sudjelovanja_na_natjecanjima VALUES (default, '$nadimak','$vrijeme_rjesavanja_sekunde','$id','$brojTocnih','$id')";
    $rezultat = $veza->updateDB($upit);
    
    $veza->zatvoriDB();    
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> 
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
                    <h2 class="trenutna">Datum: 12.06.2018.</h2>
                    <p style="padding-top:30px">
                   
                    </p>

            </header>
            <nav >
                        <ul>
                            <li><a href="index.php">Početna</a></li>
                            <li><a href="prijava.php">Prijava</a></li>
                            <li><a href="registracija.php">Registracija</a></li>
                            <li><a href="oAutoru.html">o Autoru</a></li>
                            
                        </ul>
            </nav>
            <div id="google_translate_element"></div>
            <section style = "padding-bottom: 100px; padding-left: 50px ; "> 
            <p> 
                <form class="obrazac" id="pitanja" method="post"  action="#">
                    <label>Odgovori na pitanja </label><br><br>
                    <?php 
                        
                        $vrijeme_pocetka=date("H:i:s");
                        $pitanjaa = dobaviPitanja();
                        
                        ?>
                        <label>Nadimak</label>
                        <input type="text" id="nadimak" name="nadimak" onblur="provjeraNadimka(this.value)"> 
                        <div id="nadimak1" name="nadimak1"></div><br>
                        <label>Vrijeme pocetka</label>
                        <input type="text" name="vrijeme_pocetka" value="<?php echo htmlspecialchars($vrijeme_pocetka); ?>"><br>
                        
                        <?php
                        $pitanja2 = dobaviPitanja();
                        while($red=mysqli_fetch_array($pitanja2)){
                            echo "<label for='pitanje".$red["pitanja_id"]."'>".$red["tekst"]."</label><input id='pitanje".$red["pitanja_id"]."' name='pitanje".$red["pitanja_id"]."' type='text'>";
                        }
                        ?>
                    <br>                    
                    <br>
                    
                    <input type="submit" id="potvrdiOdgovor" name="potvrdiOdgovor" value="Posalji svoj odgovor">               
                    </form>
                  
                    <br>                    
                    <br>
                      
               </p>
               
            </section>
    
            <footer>
                <figure style="float:left">
                    <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/index.html">
                    <img src="multimedija/HTML5.png"  width="70" height="50" />
                    </a>
                    <figcaption>HTML</figcaption>
                </figure>
                <figure style="float:left">
                    <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/index.html" >
                    <img src="multimedija/CSS3.png"  width="70" height="50"  />
                    </a>
                    <figcaption>CSS3</figcaption>
                </figure>
                <h3 class="footer" > Vrijeme rjesavanja: 8 sati </h3>
            </footer>          
        </body>
    </html>

<script>
    function provjeraNadimka(val){
    
        $.ajax({
            method:"POST",
            type:"text",
            url:"provjeraNadimka.php",
            data:'nadimak='+val,
            success:function(data){
                $("#nadimak1").html(data);
            }
        });
    }
</script>