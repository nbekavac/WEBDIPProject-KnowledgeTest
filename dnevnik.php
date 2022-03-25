<?php

function dnevnik_zapis($tekst) {
    global $dbc;
        
    $korisnik = Sesija::dajKorisnika() ? Sesija::dajKorisnika()->get_kor_ime() : "";
    $adresa = $_SERVER["REMOTE_ADDR"];
    $skripta = $_SERVER["REQUEST_URI"];
    $preglednik = $_SERVER["HTTP_USER_AGENT"];

    $sql = "insert into DNEVNIK (korisnik, adresa, skripta, tekst, preglednik) values " .
            "('$korisnik', '$adresa', '$skripta', '$tekst', '$preglednik')";

    $rs = $dbc->selectDB($sql);
    if (!$rs) {
        trigger_error("Problem kod upisa u bazu podataka!" . $dbc->error, E_USER_ERROR);
    }
}
?>
