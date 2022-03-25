<?php

function dobaviNatjecanja(){
    if(isset($_GET["naziv_kategorije"]))
         {
            $nazivKategorije = $_GET["naziv_kategorije"];
            require './baza.class.php';
            $veza = new Baza();
            $veza->spojiDB();
            $upitNatjecanja="SELECT natjecanja.naziv FROM natjecanja JOIN kategorija ON kategorija.kategorija_id=natjecanja.kategorija_kategorija_id WHERE '$nazivKategorije'=kategorija.naziv AND natjecanja.status='aktivan' ORDER BY natjecanja.datum_kraja";
            echo $upitNatjecanja;
            $rezultatNatjecanja=$veza->selectDB($upitNatjecanja);
             while(list($nazivNatjecanja)= $rezultatNatjecanja->fetch_array())
                {
                    $natjecanja[$nazivNatjecanja] = $nazivNatjecanja;
                }
             $veza->zatvoriDB();
            return $natjecanja;
           
           
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
                    <form class="obrazac" id="natjecanja" method="get"  action="pitanjaNatjecanje.php">
                    <label>Odaberite natjecanje iz koje zelite odgovarat na pitanja   </label>
                    <select name="naziv_natjecanja">
                    <option selected="selected">Izaberite natjecanje</option>
                        <?php
                                $natjecanjaa = dobaviNatjecanja();
                                foreach($natjecanjaa as $key => $value) 
                                { ?>
                                  <option value="<?php echo $key ?>"><?= $value ?></option>
                        <?php
                                } ?>
                    </select>

                    <br>                    
                    <br>
                    
                    <input type="submit" id="submit" value="Odaberi">   
                              
                    </form>
                
                  
                    <br><br><br>                    
                    <br>
                    <form class="obrazac" id="natjecanja1" method="get"  action="rezultatiNatjecanja.php">
                    <label>Odaberite natjecanje za koje zelite prikazat rezultate  </label>
                    <select name="naziv_natjecanja1">
                    <option selected="selected">Izaberite natjecanje</option>
                        <?php
                               
                                foreach($natjecanjaa as $key => $value) 
                                { ?>
                                  <option value="<?php echo $key ?>"><?= $value ?></option>
                        <?php
                                } ?>
                    </select>
                    <br><br>
                    <input type="submit" id="submit1" value="Odaberi">   
                              
                    </form>

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