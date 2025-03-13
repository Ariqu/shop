<?php
session_start();
require 'database/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    $_SESSION['alert'] = 'Musisz być zalogowany aby zobaczyć ten produkt';
    exit();
}

// Check if 'slug' parameter is set
if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    die("Błąd: brak parametru 'slug'.");
}

$slug = $_GET['slug'];

// Fetch article based on slug
$sql = "SELECT * FROM artykuly WHERE slug = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$slug]);
$artykul = $stmt->fetch();

if (!$artykul) {
    die("Błąd: artykuł nie został znaleziony.");
}

// Fetch comments for the article
$sql = "SELECT k.komentarz, k.data_utworzenia, u.nazwa_uzytkownika FROM komentarze k JOIN uzytkownicy u ON k.uzytkownik_id = u.id WHERE k.artykul_id = ? ORDER BY k.data_utworzenia DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$artykul['id']]);
$komentarze = $stmt->fetchAll();

// Handle comment form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['komentarz'])) {
    if (!isset($_SESSION['user_id'])) {
        die("Musisz być zalogowany, aby dodać komentarz.");
    }

    $komentarz = trim($_POST['komentarz']);
    if (empty($komentarz)) {
        $error = "Komentarz nie może być pusty.";
    } else {
        $sql = "INSERT INTO komentarze (uzytkownik_id, artykul_id, komentarz, ocena) VALUES (?, ?, ?, 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id'], $artykul['id'], $komentarz]);
        header("Location: artykul.php?slug=" . urlencode($slug));
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($artykul['nazwa']); ?></title>
    <?php include 'style/required_style.php'; ?>
    <style>
        @font-face {
            font-family: 'myfont';
            src: url('font.woff2');
        }
        * {
            font-family: myfont;
        }
        .navbar-transparent {
            background-color: white;
            backdrop-filter: blur(5px);
            color: black;
            font-size: 13px;
            z-index: 2;
        }
        .image-container {
            position: relative;
            overflow: hidden;
            padding: 40px;
            margin: 10px;
        }
        .image-container img {
            transition: transform 0.3s ease;
            width: calc(100% + 20px); /* Lekko powiększone */
            height: 100%;
            object-fit: cover;
        }
        .image-container-left:hover img {
            transform: scale(1.1) translateX(40px);
            background-color: red;
        }
        .image-container-right:hover img {
            transform: scale(1.1) translateX(-40px);
        }
    </style>
</head>
<body class="bg-gray-100">
<?php include 'components/navbar.php'; ?>

<div class="container mx-auto mt-20">
    <div class="bg-white p-6 rounded-lg shadow-lg">

    </div>

    <!-- Sekcja komentarzy -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Komentarze</h2>
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="artykul.php?slug=<?php echo htmlspecialchars($slug); ?>" method="post" class="mb-4">
                <textarea name="komentarz" rows="4" class="w-full p-2 border rounded" placeholder="Dodaj komentarz"></textarea>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Dodaj komentarz</button>
            </form>
        <?php else: ?>
            <p class="text-gray-700">Musisz być zalogowany, aby dodać komentarz.</p>
        <?php endif; ?>

        <?php if ($komentarze): ?>
            <ul>
                <?php foreach ($komentarze as $komentarz): ?>
                    <li class="mb-4">
                        <div class="bg-gray-200 p-4 rounded">
                            <p class="text-gray-700"><strong><?php echo htmlspecialchars($komentarz['nazwa_uzytkownika']); ?>:</strong></p>
                            <p><?php echo nl2br(htmlspecialchars($komentarz['komentarz'])); ?></p>
                            <p class="text-xs text-gray-500"><?php echo htmlspecialchars($komentarz['data_utworzenia']); ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-700">Brak komentarzy.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
