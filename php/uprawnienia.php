<?php
session_start();

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        $_SESSION["error"] = "Błąd";
        echo "<script>history.back();</script>";
        exit();
    }
}

require_once "./Connect.php";
$sql = "UPDATE  users SET Admin = ('$_POST[Name21]') WHERE ID = $_POST[ID];";

$conn->query($sql);

if ($conn->affected_rows != 0){
    header("location: ../Admin.php?infoUserDelete=1");
}else{
    header("location: ../Admin.php?infoUserDelete=0");
}
