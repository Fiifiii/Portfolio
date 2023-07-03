<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST["email"];
    $subject = "Potwierdzenie konta";
    $verificationLink = generateVerificationLink();
    saveVerificationLink($to, $verificationLink);
    $message = "Witaj!\n\nKliknij poniższy link, aby potwierdzić swoje konto:\n\n";
    $message .= "https://julek.unka.pl/projekt_php_studia/Bank%20F_J/potwierdz.php?link=" . urlencode($verificationLink);
    $headers = "From: twojadomena.com \r\n";
    if (mail($to, $subject, $message, $headers)) {
        echo "Wiadomość została wysłana na adres: " . $to;
    } else {
        echo "Wystąpił błąd podczas wysyłania wiadomości.";
    }
}

function generateVerificationLink() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $verificationLink = '';
    for ($i = 0; $i < 10; $i++) {
        $verificationLink .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $verificationLink;
}

function saveVerificationLink($email, $link) {
    $host = "localhost";
    $uzytkownik = "v55582550_julek";
    $haslo = "Hr4!6_h7P2MPTo";
    $baza_danych = "v55582550_julek";

    $conn = new mysqli($host, $uzytkownik, $haslo, $baza_danych);
    if ($conn->connect_error) {
        die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET link_weryfikacyjny = '$link' WHERE email = '$email'";
    if ($conn->query($sql) !== TRUE) {
        echo "Wystąpił błąd podczas zapisywania linku w bazie danych: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formularz wysyłania e-maila</title>
</head>
<body>
<h2>Formularz wysyłania e-maila</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email">Adres e-mail:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <input type="submit" value="Wyślij">
</form>
</body>
</html>
