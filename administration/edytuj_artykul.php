<?php
session_start();
require '../database/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$id = $_GET['id'];
$sql = "SELECT a.*, p.czy_promocja, p.promocyjna_cena 
        FROM artykuly a
        LEFT JOIN promocje p ON a.id = p.artykul_id
        WHERE a.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$artykul = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST['nazwa'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nazwa)));
    $glowny_obraz = $artykul['glowny_obraz'];

    if ($_FILES['glowny_obraz']['name']) {
        $glowny_obraz = $_FILES['glowny_obraz']['name'];
        $target_dir = "zdjecia/";
        $target_file = $target_dir . basename($glowny_obraz);
        move_uploaded_file($_FILES['glowny_obraz']['tmp_name'], $target_file);
    }

    $czy_promocja = isset($_POST['czy_promocja']) ? 1 : 0;
    $promocyjna_cena = $_POST['promocyjna_cena'] ? $_POST['promocyjna_cena'] : NULL;

    $sql = "UPDATE artykuly SET nazwa = ?, opis = ?, cena = ?, slug = ?, glowny_obraz = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nazwa, $opis, $cena, $slug, $glowny_obraz, $id]);

    if ($czy_promocja) {
        $sql = "INSERT INTO promocje (artykul_id, czy_promocja, promocyjna_cena)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE czy_promocja = VALUES(czy_promocja), promocyjna_cena = VALUES(promocyjna_cena)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id, $czy_promocja, $promocyjna_cena]);
    } else {
        $sql = "DELETE FROM promocje WHERE artykul_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    if (isset($_FILES['zdjecia']['name'])) {
        foreach ($_FILES['zdjecia']['name'] as $key => $image) {
            if ($image) {
                $imageTmpName = $_FILES['zdjecia']['tmp_name'][$key];
                $imageName = basename($image);
                $imagePath = "zdjecia/" . $imageName;
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    $sql = "INSERT INTO zdjecia_artykulow (artykul_id, sciezka) VALUES (?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id, $imageName]);
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
    <title>Edytuj Artykuł</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edytuj Artykuł</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nazwa" class="form-label">Nazwa:</label>
                <input type="text" class="form-control" id="nazwa" name="nazwa" value="<?php echo htmlspecialchars($artykul['nazwa']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="opis" class="form-label">Opis:</label>
                <textarea class="form-control" id="opis" name="opis" required><?php echo htmlspecialchars($artykul['opis']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="cena" class="form-label">Cena:</label>
                <input type="text" class="form-control" id="cena" name="cena" value="<?php echo htmlspecialchars($artykul['cena']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="glowny_obraz" class="form-label">Główny obraz:</label>
                <input type="file" class="form-control" id="glowny_obraz" name="glowny_obraz">
                <?php if ($artykul['glowny_obraz']): ?>
                    <img src="zdjecia/<?php echo htmlspecialchars($artykul['glowny_obraz']); ?>" class="img-fluid mt-2" alt="Główny obraz">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="zdjecia" class="form-label">Dodatkowe zdjęcia:</label>
                <input type="file" class="form-control" id="zdjecia" name="zdjecia[]" multiple>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="czy_promocja" name="czy_promocja" <?php echo $artykul['czy_promocja'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="czy_promocja">Czy promocja</label>
            </div>
            <div class="mb-3">
                <label for="promocyjna_cena" class="form-label">Promocyjna Cena:</label>
                <input type="text" class="form-control" id="promocyjna_cena" name="promocyjna_cena" value="<?php echo htmlspecialchars($artykul['promocyjna_cena']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Zaktualizuj artykuł</button>
        </form>
    </div>
</body>
</html>
