<?php

?>
<form style="visibility:hidden"  action="popisBlokiranje2.php" method="get">
    <input type="text" name="naziv" value="">
    <br>
    <button type="submit">Pretrazi</button>
</form>


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
           
            <section style = "padding-bottom: 100px; padding-left: 50px ; "> 
            <table id="tablica">
            <thead>
                    <tr>
                        <th>Odaberi me</a></th>
                        <th>Naziv</a></th>
                        <th>Prezime</a></th>
                        <th>Vrijeme zahtjeva</a></th>
                    </tr>
            </thead>
            <tbody>
                <td>
                  <?php
                    require '././baza.class.php';
                    $veza = new Baza();
                    $veza->spojiDB();
                    $upit="SELECT  zahtjevi_za_blokiranje.razlog, oglasi.naziv,zahtjevi_za_blokiranje.vrijeme_zahtjeva FROM zahtjevi_za_blokiranje JOIN oglasi ON oglasi.oglasi_id=zahtjevi_za_blokiranje.oglasi_oglasi_id ORDER BY zahtjevi_za_blokiranje.vrijeme_zahtjeva";
                    $rezultat=$veza->selectDB($upit);

                    while($row = mysqli_fetch_array($rezultat)){
                        $naziv = $row["naziv"];
                        echo "<tr><td>"?><a href="popisBlokiranje2.php?naziv=<?php echo $naziv." ";?>"><?php echo "Blokiraj"."</td><td>".$row["naziv"]."</td><td>" . $row["razlog"]. "</td><td>" . $row["vrijeme_zahtjeva"]. "</td></tr>";
                      
                    }
                    $veza->zatvoriDB();
                  ?>
                  </td>
            </tbody>
</table>

                <br>
                <br>
               
        
            </section>
    
           
        </body>
    </html>