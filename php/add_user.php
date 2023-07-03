<?php
session_start();

foreach ($_POST as $key => $value){
    if (empty($value)){
        $_SESSION["error"] = "Wypełnij wszystkie dane!";
        echo "<script>history.back();</script>";
        exit();
    }
}

require_once "./Connect.php";
$sql = "INSERT INTO `users` (`Name`, `Surname`, `Birthday`, `email`, `haslo`) VALUES ('$_POST[Name]', '$_POST[Surname]', '$_POST[Birthday]', '$_POST[email]', '$_POST[haslo]');";

$conn->query($sql);

//echo $conn->affected_rows;

if ($conn->affected_rows == 1){
    $_SESSION["success"] = "Prawidłowo dodano użytkownika $_POST[firstName] $_POST[lastName]";
}else{
    $_SESSION["success"] = "Nie dodano użytkownika!";
    echo "<script>history.back();</script>";
    exit();
}

header("location: ../Admin.php");
