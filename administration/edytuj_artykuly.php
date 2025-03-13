<?php
require '../database/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM artykuly ORDER BY data_utworzenia DESC";
$stmt = $pdo->query($sql);
$artykuly = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Artykuły</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edytuj Artykuły</h1>
        <div class="row">
            <?php foreach ($artykuly as $artykul): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <?php if ($artykul['glowny_obraz']): ?>
                            <img src="uploads/<?php echo $artykul['glowny_obraz']; ?>" class="card-img-top" alt="<?php echo $artykul['nazwa']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $artykul['nazwa']; ?></h5>
                            <p class="card-text"><?php echo substr($artykul['opis'], 0, 100); ?>...</p>
                            <p class="card-text"><strong>Cena: </strong><?php echo $artykul['cena']; ?> PLN</p>
                            <a href="edytuj_artykul.php?id=<?php echo $artykul['id']; ?>" class="btn btn-primary">Edytuj</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
