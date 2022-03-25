<?php
    if(isset($_COOKIE["korisnicko_ime"])){
            $korime=$_COOKIE["korisnicko_ime"];
            
        }
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
                
            $tablica .= "</tbody></table>";
            $veza->zatvoriDB();
         }

        if(isset($_POST["submit"])){
                 $natjecanje=$_POST["natjecanje"];
                $datum_pocetka= $_POST["datum_pocetka"];
                 $datum_kraja= $_POST["datum_zavrsetka"];
                 $maks= $_POST["maks"];
               
                $id1=$_POST["id1"];
                /*$id2=$_POST["id2"];
                $id3= $_POST["id3"];
                $id4= $_POST["id4"];
                $id5= $_POST["id5"];*/
                $veza->spojiDB();
                $upitNatjecanja="INSERT INTO natjecanja VALUES (default,'$natjecanje' ,'$datum_pocetka','$datum_kraja','$maks','aktivan','3','$id')";
                $rezultatNatjecanja=$veza->updateDB($upitNatjecanja);
                $veza->zatvoriDB();
                
                $veza->spojiDB();
                $upitNatjecanja2="SELECT natjecanja_id FROM natjecanja WHERE natjecanja.naziv='$natjecanje'";
                $rezultatNatjecanja2=$veza->selectDB($upitNatjecanja2);
                $red2=mysqli_fetch_array($rezultatNatjecanja2);
                $idNatjecanja=$red2["natjecanja_id"];
                $veza->zatvoriDB();

                $veza->spojiDB();
                $upitPitanja1="INSERT INTO pitanja_na_natjecanju VALUES (default,'13','10','25')";
                echo $upitPitanja1;
                $rezultatPitanja1=$veza->updateDB($upitPitanja1);
                echo $rezultatPitanja1;
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
            <script src="js/nbekavac.js"></script>
            
        
        </head>
        <body>
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
            <h2 style="text-align:center">Odaberi pitanja koja ce se koristiti u natjecanju</h2>
            <?php
                    echo $tablica;
            ?>
           
        <h3>Kreiraj natjecanje</h3>  
            <form  id="kreirajNatjecanje" name="kreirajNatjecanje" action="" method="post">
            <label>Unesi ime natjecanja</label>
            <input type="text" name="natjecanje" placeholder="Unesi ime natjecanja">
            <br>
            <label>Unesi datum pocetka</label>
            <input type="date" name="datum_pocetka" placeholder="Unesi datum pocetka"><br>
            <label>Unesi datum kraja</label>
            <input type="date" name="datum_zavrsetka" placeholder="Unesi datum zavrsetka"><br>
            <label>Unesi maksimalni broj korisnika</label>
            <input type="text" name="maks" placeholder="Maksimalni broj korisnika"><br><br>
            <label>Unesite ID pitanja koje zelite koristiti u natjecanju</label><br><br>
            <label>Unesi id prvog pitanja</label>
            <input type="text" name="id1"><br>
            <label>Unesi id drugog pitanja</label>
            <input type="text" name="id2"><br>
            <label>Unesi id treceg pitanja</label>
            <input type="text" name="id3"><br>
            <label>Unesi id cetvrtog pitanja</label>
            <input type="text" name="id4"><br>
            <label>Unesi id petog pitanja</label>
            <input type="text" name="id5"><br>
            <input type="submit" id="submit" name="submit" value="Odaberi">
            </form>
               
        </body>
    </html>