<?php
session_start();
require '../database/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['alert'] = 'Musisz być zalogowany aby dodać produkt do koszyka';
    header("Location: login.php");
    exit();
}

if (!isset($_GET['dodaj']) || !isset($_GET['slug'])) {
    die("Błąd: brak parametru 'dodaj' lub 'slug'.");
}

$user_id = $_SESSION['user_id'];
$produkt_id = $_GET['dodaj'];
$slug = $_GET['slug'];

try {
    // Check if the user already has a cart
    $sql = "SELECT * FROM koszyk WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $koszyk = $stmt->fetch();

    if (!$koszyk) {
        // Create a new cart
        $sql = "INSERT INTO koszyk (user_id) VALUES (?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $koszyk_id = $pdo->lastInsertId();
    } else {
        $koszyk_id = $koszyk['id'];
    }

    // Check if the product is already in the cart
    $sql = "SELECT * FROM koszyk_produkty WHERE koszyk_id = ? AND produkt_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$koszyk_id, $produkt_id]);
    $produkt = $stmt->fetch();

    if ($produkt) {
        // Update the quantity if the product is already in the cart
        $sql = "UPDATE koszyk_produkty SET ilosc = ilosc + 1 WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$produkt['id']]);
    } else {
        // Add the product to the cart
        $sql = "INSERT INTO koszyk_produkty (koszyk_id, produkt_id, ilosc) VALUES (?, ?, 1)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$koszyk_id, $produkt_id]);
    }

    header("Location: ../artykul.php?slug=" . urlencode($slug));
    exit();
} catch (Exception $e) {
    echo "Wystąpił błąd: " . $e->getMessage();
}
?>
