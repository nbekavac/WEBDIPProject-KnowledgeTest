<?php
    require "./baza.class.php";
    $veza = new Baza();
    $veza->spojiDB();
    $upit="SELECT * FROM oglasi" ;
    $rezultat=$veza->selectDB($upit);
    $tablica = "<table><thead><tr><td>Naziv oglasa</td><td>Opis</td></tr></thead><tbody>";
     while($red=mysqli_fetch_array($rezultat)){
        $tablica .= "<tr><td>" . $red["naziv"] . "</td><td>" . $red["opis"] . "</td></tr>";
    }
                
     $tablica .= "</tbody></table>";
     $veza->zatvoriDB();

     if (isset($_GET['submit'])) {
        $oglas=$_GET["oglas"];
        $razlog=$_GET["razlog"];
        $vrijeme=date("Y/m/d");
        $veza->spojiDB();
        $upit="SELECT oglasi_id FROM oglasi WHERE naziv='$oglas'";
        $rezultat=$veza->selectDB($upit);
        while($red=mysqli_fetch_array($rezultat)){
            $oglas_id=$red["oglasi_id"];
        
        }
        $veza->zatvoriDB();
        $veza->spojiDB();
        $upit2="INSERT INTO zahtjevi_za_blokiranje VALUES (default,2,'$oglas_id','$razlog','$vrijeme')";
        $rezultat2=$veza->updateDB($upit2);
        $veza->zatvoriDB();
        echo "Vas zahtjev je poslan";
        /*header("Location: kreirajKategoriju.php");*/
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
                             <li><a href="registrirani.php">Pocetna</a></li>
                            <li><a href="zahtjeviBlokiranje.php">Posalji zahtjev za blokiranje oglasa</a></li>
                            <li><a href="zahtjevNovi.php">Posalji zahtjev za kreiranje oglasa</a></li>
                            <li><a href="popisNepotvrdenih.php">Popis nepotvrdenih oglasa</a></li>

                        </ul>
            </nav>
           <h2 style="text-align:center;">Prikaz aktivnih oglasa</h2>
            <section style = "padding-bottom: 100px; padding-left: 50px ; "> 
                <br>
                <br>
                <?php
                    echo $tablica;
                ?>
                <form  id="zahtjevBlokiranje" method="get" name="zahtjevBlokiranje" action="">
                 <label>Posalji zahtjev za blokiranje nekog od aktivnih oglasa </label><br><br><br>
                 <label>Naziv oglasa</label>
                 <input type="text" id="oglas" name="oglas"
                        maxlength="50" placeholder="naziv oglasa" 
                         ><br>
                <label>Razlog blokiranja</label>
                 <input type="text" id="razlog" name="razlog"
                        maxlength="50" placeholder="razlog blokiranja" 
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