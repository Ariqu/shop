<?php
require '../database/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST['nazwa'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nazwa)));
    $glowny_obraz = null;

    if ($_FILES['glowny_obraz']['name']) {
        $glowny_obraz = $_FILES['glowny_obraz']['name'];
        $target_dir = "zdjecia/";
        $target_file = $target_dir . basename($glowny_obraz);
        move_uploaded_file($_FILES['glowny_obraz']['tmp_name'], $target_file);
    }

    $sql = "INSERT INTO artykuly (nazwa, opis, cena, slug, glowny_obraz) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nazwa, $opis, $cena, $slug, $glowny_obraz]);
    $artykul_id = $pdo->lastInsertId();

    if (isset($_FILES['zdjecia']['name'])) {
        foreach ($_FILES['zdjecia']['name'] as $key => $image) {
            if ($image) {
                $imageTmpName = $_FILES['zdjecia']['tmp_name'][$key];
                $imageName = basename($image);
                $imagePath = "zdjecia/" . $imageName;
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    $sql = "INSERT INTO zdjecia_artykulow (artykul_id, sciezka) VALUES (?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$artykul_id, $imageName]);
                }
            }
        }
    }

    header("Location: edytuj_artykuly.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Artykuł</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Dodaj Artykuł</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nazwa" class="form-label">Nazwa:</label>
                <input type="text" class="form-control" id="nazwa" name="nazwa" required>
            </div>
            <div class="mb-3">
                <label for="opis" class="form-label">Opis:</label>
                <textarea class="form-control" id="opis" name="opis" required></textarea>
            </div>
            <div class="mb-3">
                <label for="cena" class="form-label">Cena:</label>
                <input type="text" class="form-control" id="cena" name="cena" required>
            </div>
            <div class="mb-3">
                <label for="glowny_obraz" class="form-label">Główny obraz:</label>
                <input type="file" class="form-control" id="glowny_obraz" name="glowny_obraz">
            </div>
            <div class="mb-3">
                <label for="zdjecia" class="form-label">Dodatkowe zdjęcia:</label>
                <input type="file" class="form-control" id="zdjecia" name="zdjecia[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj artykuł</button>
        </form>
    </div>
</body>
</html>
