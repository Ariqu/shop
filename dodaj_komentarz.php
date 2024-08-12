<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uzytkownik_id = $_SESSION['user_id'];
    $artykul_id = $_POST['artykul_id'];
    $komentarz = $_POST['komentarz'];
    $ocena = $_POST['ocena'];

    $sql = "INSERT INTO komentarze (uzytkownik_id, artykul_id, komentarz, ocena) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$uzytkownik_id, $artykul_id, $komentarz, $ocena]);

    $slug_sql = "SELECT slug FROM artykuly WHERE id = ?";
    $stmt = $pdo->prepare($slug_sql);
    $stmt->execute([$artykul_id]);
    $artykul = $stmt->fetch();

    header("Location: artykul.php?slug=" . $artykul['slug']);
}
?>
