<?php
// Połączenie z bazą danych
require 'database/db.php';

// Pobranie wartości wyszukiwania
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Zapytanie do bazy danych z warunkiem wyszukiwania
$sql = "SELECT * FROM artykuly";
if ($search) {
    $sql .= " WHERE nazwa LIKE :search OR opis LIKE :search";
}
$stmt = $pdo->prepare($sql);

// Jeśli istnieje wyszukiwanie, dodajemy parametr
if ($search) {
    $stmt->execute(['search' => "%$search%"]);
} else {
    $stmt->execute();
}

// Pobranie wyników
$results = $stmt->fetchAll();
?>