<?php
/*
        $veza = new Baza();
        if(isset($_GET["naziv_natjecanja1"]))
             {
                $nazivNatjecanja = $_GET["naziv_natjecanja1"];
                $veza->spojiDB();
                $upitRezultatiNatjecanja="SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja'";
                $rezultatRezultatiNatjecanja=$veza->selectDB($upitRezultatiNatjecanja);
                $tablica = "<table><thead><tr><td>Nadimak</td><td>Vrijeme rjesavanja</td><td>Rezultat</td></tr></thead><tbody>";
                while($red=mysqli_fetch_array($rezultatRezultatiNatjecanja)){
                    $tablica .= "<tr><td>" . $red["nadimak"] . "</td><td>" . $red["vrijeme_rjesavanja"] . "</td><td>" . $red["rezultat"] . "</td></tr>";
                }
                
                $tablica .= "</tbody></table>";
                $veza->zatvoriDB();
                
        }
        */
        /*if(isset($_POST["submit"])){
            $veza->spojiDB();
            $nadimak=($_POST["name"]);
            $upitPretraziNadimke="SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja' and s.nadimak=$nadimak";
            $rezultatPretraziNadimke=$veza->selectDB($upitPretraziNadimke);
            $tablica = "<table><thead><tr><td>Nadimak</td><td>Vrijeme rjesavanja</td><td>Rezultat</td></tr></thead><tbody>";
            while($red=mysqli_fetch_array($rezultatPretraziNadimke)){
                $tablica .= "<tr><td>" . $red["nadimak"] . "</td><td>" . $red["vrijeme_rjesavanja"] . "</td><td>" . $red["rezultat"] . "</td></tr>";
            }
            
            $tablica .= "</tbody></table>";
            $veza->zatvoriDB();
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
                            <li><a href="index.php">Početna</a></li>
                            <li><a href="prijava.php">Prijava</a></li>
                            <li><a href="registracija.php">Registracija</a></li>
                            <li><a href="oAutoru.html">o Autoru</a></li>
                        </ul>
            </nav>
            <div id="google_translate_element"></div><br><br><br>
            <?php
            if(isset($_GET["naziv_natjecanja1"]))
        {
            $nazivNatjecanja = $_GET["naziv_natjecanja1"];
        
        
            ?>
        <table>
                <thead>
                    <tr>

                        <th><a href="rezultatiNatjecanja.php?sort=korime&naziv_natjecanja1=<?php echo $nazivNatjecanja?>">Nadimak</a></th>
                        <th>Vrijeme rjesavanja(u sekundama)</a></th>
                        <th>Rezultat</th>
                    </tr>
                </thead>
            <tbody>
                <tr>
                <?php

                        require "./baza.class.php";

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
                        if(isset($_GET["naziv_natjecanja1"]))
                        {
                            $nazivNatjecanja = $_GET["naziv_natjecanja1"];
                            $sql = "SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja' limit $stranica1,4";
                            
                        }
                        if(isset($_GET["naziv_natjecanja1"]))
                        {  
                            if(isset($_GET["nadimak"]))         
                            {
                                $korime = $_GET["nadimak"];
                                $sql = "SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja' and s.nadimak like '%$korime%' limit $stranica1,4";

                            }                 
                                    if(isset($_GET["sort"]))
                                    {
                                        $provje = $_GET["sort"];
                                        if($provje==='korime')
                                        $sql = "SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja' GROUP BY s.nadimak limit $stranica1,4";
                                    }
           
                                    else
                                    {
                                        $sql = "SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja' limit $stranica1,4";
                                        if(isset($_GET["nadimak"]))
                                        {
                                        $korime = $_GET["nadimak"];
                                        $sql = "SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja' and s.nadimak like '%$korime%' limit $stranica1,4";
                                        }
                                    }
                            }
                            $rezultat = $veza->selectDB($sql);
                            $increment = 1;
                            while($row = mysqli_fetch_array($rezultat))
                            {

                                echo "<tr><td>".$row["nadimak"]."</td><td>" . $row["vrijeme_rjesavanja"]. "</td><td> " . $row["rezultat"]. "</td><tr>";
                                
                                $increment++;
                            }
                        
                        
                            if(isset($_GET["nadimak"]))
                            {
                                if(isset($_GET["naziv_natjecanja1"]))
                                {
                                    $nazivNatjecanja = $_GET["naziv_natjecanja1"];
                                }
                                $korime = $_GET["nadimak"];
                                $sql = "SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja' and s.nadimak like '%$korime%'";
                            }
                            else
                            {
                                $sql = "SELECT s.nadimak, s.vrijeme_rjesavanja, s.rezultat FROM sudjelovanja_na_natjecanjima s, natjecanja n where n.natjecanja_id=s.natjecanja_natjecanja_id and n.naziv='$nazivNatjecanja'";
                            }
                            $rezultatBrojanja = $veza->selectDB($sql);
                            $brojRedaka = mysqli_num_rows($rezultatBrojanja);
                            //koliko po stranici
                            $poStranici = $brojRedaka/4;
                            $uzmiVisi = ceil($poStranici);
                            for($i=1;$i<=$uzmiVisi;$i++)
                            {
                            if(isset($_GET["naziv_natjecanja1"]))
                            {
                                if(isset($_GET["nadimak"]))
                                {
                                    $nadimak = $_GET["nadimak"];
                                    ?><a href="rezultatiNatjecanja.php?stranica=<?php echo $i."&naziv_natjecanja1=$nazivNatjecanja&nadimak=$nadimak"; ?>"><?php echo $i." "; ?></a> <?php                           
                                }
                                else if(!isset($_GET["nadimak"]))
                                {
                                        ?><a href="rezultatiNatjecanja.php?stranica=<?php echo $i."&sort=korime&naziv_natjecanja1=$nazivNatjecanja"; ?>"><?php echo $i." "; ?></a> <?php                          
                                
                                }
                                else if(isset($_GET["sort"]))
                                {
                                    $provje = $_GET["sort"];
                                    if($provje==='korime')
                                    {
                                    //provjeravam jeli korisnik zazelio sort te mu ga moram proslijediti kako bi mogao stranicno pretrazivati
                                    ?><a href="rezultatiNatjecanja.php?stranica=<?php echo $i."&sort=korime&naziv_natjecanja1=$nazivNatjecanja"; ?>"><?php echo $i." "; ?></a> <?php
                                    }
                                }
                        

                            }

                        }

                        ?>
                </tr>
            </tbody>
        </table>

</div>
<?php
        }
        ?>
            <section style = "padding-bottom: 100px; padding-left: 50px ; "> 
                
            <form action="rezultatiNatjecanja.php" method="get">
        <label for="nadimak">Pretrazite po nadimku</label>
        <input type="text" placeholder="Unesite nadimak" name="nadimak" value="">
        <input type="hidden" name="naziv_natjecanja1" value="<?php echo $nazivNatjecanja ?>">
        
        <br>
        <button type="submit">Pretrazi</button>
        </form>
        
                <?php
                /*
                    echo $tablica;
                    */
                ?>
                <?php
                /*<form  id="nadimak" method="post" name="nadimak" 
                 action="">
                 <label>Unesi nadimak: </label>
                 <input type="text" id="id" name="name"
                        maxlength="50" placeholder="nadimak" 
                         ><br>
                <input type="submit" value="Pretrazi" name="submit"> <br>
                </form>*/
                ?>
            </section>
    
        </body>
    </html>