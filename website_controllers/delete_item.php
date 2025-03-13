<?php
session_start();
require '../database/db.php';

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    $_SESSION['alert'] = 'Musisz być zalogowany, aby usunąć produkt.';
    exit();
}

// Sprawdź, czy ID produktu zostało przesłane
if (!isset($_POST['produkt_id'])) {
    die("Błąd: brak ID produktu.");
}

$id = $_POST['produkt_id'];
$user_id = $_SESSION['user_id'];

// Usuń produkt z koszyka użytkownika
$sql = "DELETE FROM koszyk_produkty 
        WHERE produkt_id = ? 
        AND koszyk_id = (SELECT id FROM koszyk WHERE user_id = ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id, $user_id]);

header("Location: ../cart.php");
exit();
?>
