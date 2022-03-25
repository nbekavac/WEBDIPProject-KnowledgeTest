<?php
    require "./baza.class.php";
    $veza = new Baza();
    $veza->spojiDB();
    $upit="SELECT kategorija.naziv FROM kategorija" ;
    $rezultat=$veza->selectDB($upit);
    $tablica = "<table><thead><tr><td>Naziv</td></tr></thead><tbody>";
     while($red=mysqli_fetch_array($rezultat)){
        $tablica .= "<tr><td>" . $red["naziv"] . "</td></tr>";
    }
                
     $tablica .= "</tbody></table>";
     $veza->zatvoriDB();
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
            
        
        </head>
            <header>
                    <h1 class="zaglavlje">Projekt </h1>	
                    <h2 class="trenutna"><form method="post" action="logout.php"><input type="submit" name="odjava" id="odjava" value="Odjavi se"></form></h2>
                    <p style="padding-top:30px">
                    </p>

            </header>
            <nav >
                        <ul>
                            <li><a href="adminKorisnici.php">Korisnici</a></li>
                            <li><a href="dodjelaModeratora.php">Dodjeli moderatora kategoriji</a></li>
                            <li><a href="kreirajKategoriju.php">Kreiraj kategoriju</a></li>

                        </ul>
            </nav>
            <section style = "padding-bottom: 100px; padding-left: 50px ; "> 
                <br>
                <br>
                <?php
                    echo $tablica;
                ?>
                <form  id="dodjeliModeratora" method="get" name="dodjeliModeratora" action="kreirajKategoriju2.php">
                 <label>Kreiraj kategoriju </label><br><br><br>
                 <label>Kategorija </label>
                 <input type="text" id="kategorija" name="kategorija"
                        maxlength="50" placeholder="ime kategorije" 
                         ><br>
                <input type="submit" value="Dodaj" name="submit"> <br>
                </form>
                
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