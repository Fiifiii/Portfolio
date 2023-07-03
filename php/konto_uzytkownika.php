<?php
session_start();
if(!isset($_SESSION['zalogowany'])){
    header('location: ../logowanie.php');
    exit();
}
?>
    <!doctype html>
    <html lang="pl">

    <head>
        <link rel="shortcut icon" type="image/jpg" sizes="16x16" href="../../img/korona.jpg">
        <link rel="canonical" href="/">
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../Looks/look_of_admin_page.css">
        <title>Document</title>
    </head>
    <body>
    <h1>Bank F&J</h1>
    <table>
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Stan Konta</th>
            <th>Nr_konta</th>
            <a href=./wyloguj.php>wyloguj</a><br/>
            <a href="./konto_uzytkownika.php?przelew=1">Wykonaj przelew</a><br>
        </tr>

    <table/>

<?php
require_once "./Connect.php";
    echo "<tr>"."<th>".$_SESSION['name'];
    echo "<th>".$_SESSION['surname'];
    echo "<th>".$_SESSION['balance']." Zł";
    echo "<th>"."twój nr konta: ".$_SESSION['nrkonta'];

$sql1 = "SELECT * FROM `historia_przelewow` WHERE `nr_klienta_wysyla` = '$_SESSION[nrkonta]' OR `nr_klienta_odbiera` = '$_SESSION[nrkonta]'";

$result1 = $conn->query($sql1);
echo <<< TABLE1
      <table>
        <tr>
          <th>Nr_konta nadawcy</th>
          <th>Nr_konta odbiorcy</th>
          <th>kwota wysłana</th>
          <th>kwota odebrana</th>
          <th>Data przelewu</th>
          
          
        </tr>
      
TABLE1;

if($result1->num_rows == 0){
    echo "<tr><td colspan='4'>Historia przelewow</td></tr>";
}else {
    while ($user1 = $result1->fetch_assoc()) {
        echo <<< USERS1
            <tr>
              <td>$user1[nr_klienta_wysyla]</td>
              <td>$user1[nr_klienta_odbiera]</td>
              <td>$user1[kwota_wysyla]</td>
              <td>$user1[kwota_odbiera]</td>
              <td>$user1[Data_przelewu]</td>
                     
            </tr>
USERS1;
    }
}



if (isset($_GET["przelew"])) {

    echo <<< ADDUSERFORM
      <h4>Przelew</h4>   
        <form action="./przelew.php?przelew=18" method="post">  
        <input type="text" name="ilosc" placeholder="kwota"><br>
        <input type="number" name="ID1" placeholder="Nr konta odbioru">
  
ADDUSERFORM;
    echo <<< ADDUSERFORM
        </select><br><br>
       
        <input type="submit" value="Przelej">
      </form>
ADDUSERFORM;
}
else {


}
?>