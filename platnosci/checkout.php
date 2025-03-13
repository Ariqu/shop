<?php
require '../database/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $total = $_POST['total'];

    $sql = "INSERT INTO zamowienia (uzytkownik_id, calkowita_cena, status) VALUES (?, ?, 'Oczekujące')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $total]);
    $zamowienie_id = $pdo->lastInsertId();

    foreach ($_SESSION['cart'] as $item) {
        $sql = "INSERT INTO zamowienia_szczegoly (zamowienie_id, artykul_id, ilosc, cena) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$zamowienie_id, $item['id'], $item['quantity'], $item['price']]);
    }

    header("Location: platnosc.php?zamowienie_id=" . $zamowienie_id);
}
?>
