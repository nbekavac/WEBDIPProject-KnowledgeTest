<?php
if (isset($_POST['odjava'])) {
    header("Location: logout.php");
}
function dobaviKategorije(){
   require './baza.class.php';
   $veza = new Baza();
   $veza->spojiDB();
   $upitKategorija="SELECT naziv FROM kategorija ";
   $rezultatKategorija=$veza->selectDB($upitKategorija);
   while(list($naziv)= $rezultatKategorija->fetch_array())
   {
       $kategorije[$naziv] = $naziv;
   }
   return $kategorije;
}

/*if (isset($_POST['submit'])) {
     require './baza.class.php';
     $veza = new Baza();
     $veza->spojiDB();
     $nazivKategorije=$_POST['naziv_kategorije'];
     $upitNatjecanja="SELECT natjecanja.naziv FROM natjecanja JOIN kategorija ON kategorija.kategorija_id=natjecanja.kategorija_kategorija_id WHERE '$nazivKategorije'=kategorija.naziv ORDER BY natjecanja.datum_kraja";
     echo $upitNatjecanja;
     echo "<br>";
     $rezultatNatjecanja=$veza->selectDB($upitNatjecanja);
     while(list($nazivNatjecanja)= $rezultatNatjecanja->fetch_array())
    {
       $natjecanja[$nazivNatjecanja] = $nazivNatjecanja;
    }
    foreach($natjecanja as $key => $value){
        echo $value;
    }
    
}*/
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
            <script src="js/nbekavac.js"></script>
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
                    <p style="padding-top:30px">
                    </p>

            </header>
            <nav >
                        <ul>
                            <li><a href="prijava.php">Prijava</a></li>
                            <li><a href="registracija.php">Registracija</a></li>        
                            <li><a href="index.php">Početna</a></li>
                            <li><a href="oAutoru.html">o Autoru</a></li>
                            <li><a href="dokumentacija.html">Dokumentacija</a></li>

                        </ul>
            </nav>
            <div id="google_translate_element"></div>

            <section style = "padding-bottom: 100px; padding-left: 50px ; "> 
            <p> 
                <form class="obrazac" id="kategorije" method="get"  action="prikazNatjecanja.php">
                    <label>Odaberi kategoriju za koju zelis prikazat rezultate natjecanja ili odgovarat na pitanja</label>
                    <select name="naziv_kategorije">
                    <option selected="selected">Izaberite kategoriju</option>
                        <?php
                                $korisnici = dobaviKategorije();
                                foreach($korisnici as $key => $value) 
                                { ?>
                                  <option value="<?php echo $key ?>"><?= $value ?></option>
                        <?php
                                } ?>
                    </select>
                    <br>                    
                    <br>
                    
                    <input type="submit" id="submit" value="Odaberi">               
                    </form>
                  
                    <br>                    
                    <br>
                      
               </p>
               
            </section>
    
            <footer>
                <figure style="float:left">
                    <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/index.html">
                    <img src="slike/HTML5.png"  width="70" height="50" />
                    </a>
                    <figcaption>HTML</figcaption>
                </figure>
                <figure style="float:left">
                    <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2017/zadaca_01/nbekavac/index.html" >
                    <img src="slike/CSS3.png"  width="70" height="50"  />
                    </a>
                    <figcaption>CSS3</figcaption>
                </figure>
                <h3 class="footer" > Vrijeme rjesavanja: 8 sati </h3>
            </footer>          
        </body>
    </html>