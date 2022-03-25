<?php
function autentikacija($user, $pass) {
    global $dbc;
    
    $result = -1;

    $sql = "select prezime, ime, lozinka, vrsta FROM POLAZNICI where maticni_broj = '$user'";
    
    $rs = $dbc->selectDB($sql);
    if (!$rs) {
        trigger_error("Problem kod upita na bazu podataka!", $dbc->error);
    }

    $broj = $rs->num_rows;

    $korisnik = new Korisnik();

    if ($broj == 1) {
        list($prezime, $ime, $lozinka, $vrsta) = $rs->fetch_array();

        if ($lozinka == $pass) {
            $korisnik->set_podaci($user, $ime, $prezime, $lozinka, $vrsta);

            $result = 1;
        } else {
            $result = 0;
        }
    } else {
        $result = -1;
    }

    $korisnik->set_status($result);

    return $korisnik;
}
?>
