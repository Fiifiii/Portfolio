<?php
session_start();
if(isset($_POST['imie2'])){
    $wypelnienie = true;
    $imie=$_POST['imie2'];
    if(strlen($imie)<2 || strlen($imie)>15){
        $wypelnienie = false;
        $_SESSION['e_imie']="imie musi miec od 2 do 15 liter";

    }
    if (!preg_match("#^[a-zA-ZęĘóÓąĄśŚłŁżŻźŹćĆńŃ]+$#", $imie)) {
        $wypelnienie = false;
        $_SESSION['e_imie'] = "Imię nie może zawierać cyfr";
    }

    $nazwisko=$_POST['nazwisko2'];
    if(strlen($nazwisko)<2 || strlen($nazwisko)>30){
        $wypelnienie = false;
        $_SESSION['e_nazwisko']="nazwisko musi miec od 2 do 30 liter";
    }
    if (!preg_match("#^[a-zA-ZęĘóÓąĄśŚłŁżŻźŹćĆńŃ]+$#", $nazwisko)) {
        $wypelnienie = false;
        $_SESSION['e_nazwisko']="nazwisko nie moze zawierać cyfr";
    }
    $email=$_POST['email2'];
    $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
    if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email)){
        $wypelnienie = false;
        $_SESSION['e_email']= "podaj poprawny adres e-mail";
    }
    $haslo1 = $_POST['haslo2'];
    $haslo2 = $_POST['haslo3'];
    if(strlen($haslo1)<8||strlen($haslo1)>20){
        $wypelnienie = false;
        $_SESSION['e_haslo']= "hasło musi miec od 8 do 20 znaków";
    }if($haslo1!=$haslo2){
        $wypelnienie = false;
        $_SESSION['e_haslo1']= "hasła muszą byc te same";
    }
    $haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);

    if(!isset($_POST['regulamin'])){
        $wypelnienie = false;
        $_SESSION['e_regulamin']= "musisz potwierdzic zapoznanie sie z regulaminem";
    }
    require_once "./Connect.php";

    $sql = "SELECT id FROM `users` WHERE email='$email'";
    $result = $conn->query($sql);
    $maile = $result->num_rows;
    if($maile>0){
        $wypelnienie = false;
        $_SESSION['e_email']= "na podanym e-mailu jest juz załozone konto";
    }

    if($wypelnienie==true){
        $licznik = RAND();
        $sql1 = "INSERT INTO `users` VALUES (NULL,'$imie','$nazwisko', '$licznik','$haslo_hash','$emailB','0','0','0',NULL)";
        $conn->query($sql1);
        $to = $emailB;

        header('location: ./udana_rejestracja.php');
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>rejestracja</title>
    <!--    <link rel="stylesheet" type="text/css" href="./Looks/style.css">-->
    <style>
        .error{
            color: #c31616;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<form method="post">
    Imie: <br> <input type="text"name="imie2"><br>
    <?php
    if(isset($_SESSION['e_imie'])){
        echo'<div class="error">'.$_SESSION['e_imie'].'</div>';
        unset($_SESSION['e_imie']);
    }
    ?>
    Nazwisko: <br><input type="text"name="nazwisko2"><br>
    <?php
    if(isset($_SESSION['e_nazwisko'])){
        echo'<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
        unset($_SESSION['e_nazwisko']);
    }
    ?>
    email: <br><input type="text"name="email2"><br>
    <?php
    if(isset($_SESSION['e_email'])){
        echo'<div class="error">'.$_SESSION['e_email'].'</div>';
        unset($_SESSION['e_email']);
    }
    ?>
    Hasło: <br><input type="text"name="haslo2"><br>
    <?php
    if(isset($_SESSION['e_haslo'])){
        echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
        unset($_SESSION['e_haslo']);
    }
    ?>
    Powtórz Hasło: <br><input type="text"name="haslo3"><br><?php
    if(isset($_SESSION['e_haslo1'])){
        echo'<div class="error">'.$_SESSION['e_haslo1'].'</div>';
        unset($_SESSION['e_haslo1']);
    }
    ?><br>

    <label><input type="checkbox"name="regulamin">Akceptuję regulamin</label><br><br>
    <?php
    if(isset($_SESSION['e_regulamin'])){
        echo'<div class="error">'.$_SESSION['e_regulamin'].'</div>';
        unset($_SESSION['e_regulamin']);
    }
    ?>
    <input type="submit"value="zarejestruj sie">

</form>
</body>
</html>