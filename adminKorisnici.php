<form action="adminKorisnici.php" method="get">
    <label for="pretragaIme">Unesite korisnicko ime</label>
    <input type="text" name="korime" value="">
    <br>
    <button type="submit">Pretrazi</button>
</form>

        <table id="tablica">
                <thead >
                    <tr>
                        <th>Odaberi me</a></th>
                        <th><a href="adminKorisnici.php?sort=korime">Korisnicko ime</a></th>
                        <th><a href="adminKorisnici.php?sort=prezime">Prezime</a></th>
                        <th>Ime</th>
                        <th>Lozinka</th>
                    </tr>
                </thead>
            <tbody>
                <tr>
                <?php

                        require '././baza.class.php';

                        $veza = new Baza();
                        $veza->spojiDB();
                        $stranica1=0;
                        if(isset($_GET["stranica"]))
                        {
                            $stranica = $_GET["stranica"];
                            if($stranica ==""|| $stranica=='1')
                            {
                                $stranica1=0;
                            }
                            else
                            {
                                $stranica1 = ($stranica*4)-4;
                            }
                        }
                        if(isset($_GET["korime"]))
                        {
                            $korime = $_GET["korime"];
                            $sql = "SELECT * FROM korisnici where korisnicko_ime = '$korime' and broj_zabrana=0 and korisnicko_ime like '%$korime%' limit $stranica1,4";
                            
                        }
                        else
                        {                            
                                    if(isset($_GET["sort"]))
                                    {
                                        $provje = $_GET["sort"];
                                        if($provje==='korime')
                                        $sql = "SELECT * FROM korisnici where broj_zabrana=0 ORDER BY korisnicko_ime limit $stranica1,4";
                                    }
                                    if(isset($_GET["sort"]))
                                    {   
                                        $provje = $_GET["sort"];
                                        if($provje==='prezime')
                                        $sql = "SELECT * FROM korisnici where broj_zabrana=0 ORDER BY prezime limit $stranica1,4";
                                    }
                                    else
                                    {
                                    $sql = "SELECT * FROM korisnici where broj_zabrana=0 limit $stranica1,4";
                                    }
                            }
                            $rezultat = $veza->selectDB($sql);
                          
                            while($row = mysqli_fetch_array($rezultat))
                            {
                                $korime = $row["korisnicko_ime"];
                                echo "<tr><td>"?><a href="blokirajKorisnika.php?korime=<?php echo $korime." ";?>"><?php echo "Zakljucaj me"."</td><td>".$row["korisnicko_ime"]."</td><td>" . $row["prezime"]. "</td><td> " . $row["ime"]. "</td><td>" . $row["lozinka"]."</td></tr>";
                            }
                            
                            if(isset($_GET["korime"]))
                            {
                                $korime = $_GET["korime"];
                                $sql = "SELECT * FROM korisnici where korisnicko_ime like '%$korime%'";
                            }
                            else
                            {
                            $sql = "SELECT * FROM korisnici";
                            }
                            $rezultatBrojanja = $veza->selectDB($sql);
                            $brojRedaka = mysqli_num_rows($rezultatBrojanja);
                            $poStranici = $brojRedaka/4;
                            $uzmiVisi = ceil($poStranici);
                            for($i=1;$i<=$uzmiVisi;$i++)
                            {
                            if(isset($_GET["korime"]))
                            {
                            $korime = $_GET["korime"];
                            ?><a href="adminKorisnici.php?stranica=<?php echo $i."&korime=$korime"; ?>"><?php echo $i." "; ?></a> <?php                           
                            }
                            else
                            {
                                if(isset($_GET["sort"]))
                                {
                                    $provje = $_GET["sort"];
                                    if($provje==='korime')
                                    {
                                    ?><a href="adminKorisnici.php?stranica=<?php echo $i."&sort=korime"; ?>"><?php echo $i." "; ?></a> <?php
                                    }
                                }
                                if(isset($_GET["sort"]))
                                {
                                    $provje = $_GET["sort"];
                                    if($provje==='prezime')
                                    {
                                    ?><a href="adminKorisnici.php?stranica=<?php echo $i."&sort=prezime"; ?>"><?php echo $i." "; ?></a> <?php
                                    }
                                }
                                else
                                {
                                    ?><a href="adminKorisnici.php?stranica=<?php echo $i." "; ?>"><?php echo $i." "; ?></a> <?php
                                }

                            }

                        }

                        ?>
                </tr>
            </tbody>
        </table>

        <h1>Popis blokiranih</h1>
        <table id="tablica">
                <thead >
                    <tr>
                        <th>Odaberi me</a></th>
                        <th><a href="adminKorisnici.php?sort=korime">Korisnicko ime</a></th>
                        <th><a href="adminKorisnici.php?sort=prezime">Prezime</a></th>
                        <th>Ime</th>
                        <th>Lozinka</th>
                    </tr>
                </thead>
            <tbody>
                <tr>
                <?php


                        $veza = new Baza();
                        $veza->spojiDB();
                        $stranica1=0;
                        if(isset($_GET["stranica"]))
                        {
                            $stranica = $_GET["stranica"];
                            if($stranica ==""|| $stranica=='1')
                            {
                                $stranica1=0;
                            }
                            else
                            {
                                $stranica1 = ($stranica*4)-4;
                            }
                        }
                        if(isset($_GET["korime"]))
                        {
                            $korime = $_GET["korime"];
                            $sql = "SELECT * FROM korisnici where korisnicko_ime = '$korime' and broj_zabrana=1 and korisnicko_ime like '%$korime%' limit $stranica1,4";
                            
                        }
                        else
                        {                            
                                    if(isset($_GET["sort"]))
                                    {
                                        $provje = $_GET["sort"];
                                        if($provje==='korime')
                                        $sql = "SELECT * FROM korisnici where broj_zabrana=1 ORDER BY korisnicko_ime limit $stranica1,4";
                                    }
                                    if(isset($_GET["sort"]))
                                    {   
                                        $provje = $_GET["sort"];
                                        if($provje==='prezime')
                                        $sql = "SELECT * FROM korisnici where broj_zabrana=1 ORDER BY prezime limit $stranica1,4";
                                    }
                                    else
                                    {
                                    $sql = "SELECT * FROM korisnici where broj_zabrana=1 limit $stranica1,4";
                                    }
                            }
                            $rezultat = $veza->selectDB($sql);
                            $increment = 1;
                            while($row = mysqli_fetch_array($rezultat))
                            {
                                $korime = $row["korisnicko_ime"];
                                echo "<tr><td>"?><a href="otkljucaj.php?korime=<?php echo $korime." ";?>"><?php echo "Otkljucaj me"."</td><td>".$row["korisnicko_ime"]."</td><td>" . $row["prezime"]. "</td><td> " . $row["ime"]. "</td><td>" . $row["lozinka"]."</td></tr>";
                                
                                $increment++;
                            }
                        
                        
                            if(isset($_GET["korime"]))
                            {
                                $korime = $_GET["korime"];
                                $sql = "SELECT * FROM korisnici where korisnicko_ime like '%$korime%'";
                            }
                            else
                            {
                            $sql = "SELECT * FROM korisnici";
                            }
                            $rezultatBrojanja = $veza->selectDB($sql);
                            $brojRedaka = mysqli_num_rows($rezultatBrojanja);
                            $poStranici = $brojRedaka/4;
                            $uzmiVisi = ceil($poStranici);
                            for($i=1;$i<=$uzmiVisi;$i++)
                            {
                            if(isset($_GET["korime"]))
                            {
                            $korime = $_GET["korime"];
                            ?><a href="adminKorisnici.php?stranica=<?php echo $i."&korime=$korime"; ?>"><?php echo $i." "; ?></a> <?php                           
                            }
                            else
                            {
                                if(isset($_GET["sort"]))
                                {
                                    $provje = $_GET["sort"];
                                    if($provje==='korime')
                                    {
                                    ?><a href="adminKorisnici.php?stranica=<?php echo $i."&sort=korime"; ?>"><?php echo $i." "; ?></a> <?php
                                    }
                                }
                                if(isset($_GET["sort"]))
                                {
                                    $provje = $_GET["sort"];
                                    if($provje==='prezime')
                                    {
                                    ?><a href="adminKorisnici.php?stranica=<?php echo $i."&sort=prezime"; ?>"><?php echo $i." "; ?></a> <?php
                                    }
                                }
                                else
                                {
                                    ?><a href="adminKorisnici.php?stranica=<?php echo $i." "; ?>"><?php echo $i." "; ?></a> <?php
                                }

                            }

                        }

                        ?>
                </tr>
            </tbody>
        </table>


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
        <nav >
                        <ul>
                            <li><a href="adminKorisnici.php">Korisnici</a></li>
                            <li><a href="dodjelaModeratora.php">Dodjeli moderatora kategoriji</a></li>
                            <li><a href="kreirajKategoriju.php">Kreiraj kategoriju</a></li>

                        </ul>
     </nav>
        <body>
  
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