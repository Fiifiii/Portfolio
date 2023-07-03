<?php
session_start();

require_once "./Connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ilosc = $_POST["ilosc"];
    if ($ilosc < 0) {
        header("Refresh:0; url=./konto_uzytkownika.php");
    } else {
        $sql333= "UPDATE users SET AccountBalance = (AccountBalance + $ilosc  ) WHERE Nr_konta = $_POST[ID1];";
        $conn->query($sql333);

        $sql1 = "UPDATE users SET AccountBalance = (AccountBalance - $ilosc) WHERE Nr_konta = $_SESSION[nrkonta];";
        $conn->query($sql1);

        $sql2 = "INSERT INTO `historia_przelewow` (`id_przelewu`, `nr_klienta_wysyla`, `nr_klienta_odbiera`, `kwota_wysyla`, `kwota_odbiera`) VALUES (NULL, '$_SESSION[nrkonta]', '$_POST[ID1]', '$_POST[ilosc]', '$_POST[ilosc]');";
        $conn->query($sql2);

        if ($conn->affected_rows != 0) {
            header("Refresh:0; url=./konto_uzytkownika.php");
        } else {
            header("Refresh:0; url=./konto_uzytkownika.php");
        }
    }
}


