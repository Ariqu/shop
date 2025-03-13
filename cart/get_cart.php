<?php
session_start();
require '../database/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Musisz być zalogowany']);
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT a.nazwa, kp.ilosc FROM koszyk_produkty kp JOIN artykuly a ON kp.produkt_id = a.id WHERE kp.koszyk_id = (SELECT id FROM koszyk WHERE user_id = ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$produkty = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['status' => 'success', 'produkty' => $produkty]);
?>
