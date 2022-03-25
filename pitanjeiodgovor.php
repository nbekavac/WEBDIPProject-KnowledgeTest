<?php 
    if(isset($_GET["naziv_kategorije"]))
         {
            $nazivKategorije = $_GET["naziv_kategorije"];
            require './baza.class.php';
            $veza = new Baza();
            $veza->spojiDB();
            $upit="SELECT kategorija.kategorija_id FROM kategorija WHERE kategorija.naziv='$nazivKategorije'";
            $rezultat=$veza->selectDB($upit);
            $red=mysqli_fetch_array($rezultat);
            $id=$red["kategorija_id"];
            $veza->zatvoriDB();
            $veza->spojiDB();
            $upit1="SELECT * FROM pitanja JOIN kategorija on pitanja.kategorija_kategorija_id= kategorija.kategorija_id where pitanja.kategorija_kategorija_id='$id'";
            $rezultat1=$veza->selectDB($upit1);
            $tablica = "<table><thead><tr><td>ID pitanja</td><td>Tekst pitanja</td></tr></thead><tbody>";
            while($red1=mysqli_fetch_array($rezultat1)){
                $tablica .= "<tr><td>" . $red1["pitanja_id"] . "</td><td>" . $red1["tekst"] . "</td></tr>";
            }
         }
        if(isset($_POST["submit"])){
                $pitanje=$_POST["pitanje"];
                $odgovor= $_POST["odgovor"];
                $veza->spojiDB();
                $upitNatjecanja="INSERT INTO pitanja VALUES(default,'$pitanje','$odgovor','$id')";
                $rezultatNatjecanja=$veza->updateDB($upitNatjecanja);
                $veza->zatvoriDB();
                echo "Unos izvrsen";
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
                            <li><a href="popisBlokiranje.php">Popis zahtjeva za blokiranjem</a></li>                          
                            <li><a href="popisKategorija.php">Definiraj pitanje i tocan odgovor za kategoriju</a></li>
                            <li><a href="popisKategorija2.php">Kreiraj natjecanje</a></li>
                        </ul>
            </nav>
            <h3>Unesi pitanje </h3>
            <form  id="pitanjaodgovor" name="pitanjaodgovor" action="" method="post">
            <label>Unesi pitanje</label>
            <input type="text" name="pitanje" placeholder="Unesi pitanje">
            <br>
            <label>Unesi tocan odgovor</label>
            <input type="text" name="odgovor" placeholder="Unesi tocan odgovor"><br>
            <input type="submit" name="submit" value="Unesi">
            </form>
            <h2 style="text-align:center">Pitanja koja se vec koriste u toj kategoriji</h2>
            <?php
                echo $tablica;
            ?>
        
            </section>
    
            
        </body>
    </html>