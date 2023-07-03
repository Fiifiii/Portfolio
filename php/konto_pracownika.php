<?php
session_start();

//if(!isset($_SESSION['zalogowany1'])){
//    header('location: ./logowanie.php');
//    exit();
//}
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
    <title>Pracownik</title>
</head>
<body>
<h1>Bank F&J Konto pracownika</h1>
<?php
if (isset($_SESSION["error"])){
    echo "<h4>".$_SESSION["error"]."</h4>";
    unset($_SESSION["error"]);
}
if (isset($_SESSION["success"])){
    echo "<h4>".$_SESSION["success"]."</h4>";
    unset($_SESSION["success"]);
}
require_once "./Connect.php";

$sql ="SELECT * FROM `users`";
$result = $conn->query($sql);

echo <<< TABLE
      <table>
        <tr>
          <th>ID</th>
          <th>Imię</th>
          <th>Nazwisko</th>
          <th>E-mail</th>               
          <th>Stan Konta</th>
          <th>Nr_konta</th>
        </tr>
      
TABLE;
if($result->num_rows == 0){
    echo "<tr><td colspan='4'>Brak rekordów do wyświetlenia!</td></tr>";
}else{
    while ($user = $result->fetch_assoc()){
        echo <<< USERS
            <tr>
              <td>$user[ID]</td>
              <td>$user[Name]</td>
              <td>$user[Surname]</td>
              <td>$user[email]</td>
              <td>$user[AccountBalance]</td>
              <td>$user[Nr_konta]</td>
              
              
              
              
                     
            </tr>
USERS;
    }
}
$sql1 ="SELECT * FROM `historia_przelewow`";
$result1 = $conn->query($sql1);
echo <<< TABLE1
      <table>
        <tr>
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
          
          
        </tr>
      
TABLE1;

if($result1->num_rows == 0){
    echo "<tr><td colspan='4'>Brak rekordów do wyświetlenia!</td></tr>";
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

if (isset($_GET["showAddUserForm"])) {
    echo <<< ADDUSERFORM
      <h4>Dodawanie użytkownika</h4>
      <form action="./add_user.php" method="post">
        <input type="text" name="Name" placeholder="Podaj imię"><br><br>
        <input type="text" name="Surname" placeholder="Podaj nazwisko"><br><br>
        <input type="text" name="email" placeholder="Podaj email"><br><br>
        <input type="text" name="haslo" placeholder="Podaj haslo">
        
ADDUSERFORM;

    echo <<< ADDUSERFORM
        </select><br><br>
        <input type="date" name="Birthday"> Data urodzenia<br><br>
        <input type="submit" value="Dodaj użytkownika">
      </form>
ADDUSERFORM;
}else{
    echo '<br><a href="../Admin.php?showAddUserForm=1">Dodaj użytkownika</a><br>';
    echo '<br><a href=./wyloguj.php>wyloguj</a><br/>';
}
if (isset($_GET["show"])) {

    echo <<< ADDUSERFORM
      <h4>Edycja Salda</h4>   
        <form action="./siano.php?userId=userId" method="post">  
        <input type="text" name="Name" placeholder="Dodaj lub odejmij srodki"><br>
        <input type="number" name="ID" placeholder="ID klienta">
  
ADDUSERFORM;
    echo <<< ADDUSERFORM
        </select><br><br>
       
        <input type="submit" value="Aktualizuj">
      </form>
ADDUSERFORM;
}
else {

    echo '<br><a href="../Admin.php?show=1">Zmien stan konta</a><br>';
}

if (isset($_GET["wyszukaj"])) {

    echo <<< ADDUSERFORM
      <h4>Edycja Salda</h4>   
        <form action="./wyszukiwarka.php?search" method="post">  
        <input type="number" name="search" placeholder="Podaj ID klienta ">
  
ADDUSERFORM;
    echo <<< ADDUSERFORM
        </select><br><br>
       
        <input type="submit" value="Szukaj">
      </form>
ADDUSERFORM;
}
else {

    echo '<br><a href="../Admin.php?wyszukaj=1">Wyszukaj</a><br>';
}




?>
</body>
</html>