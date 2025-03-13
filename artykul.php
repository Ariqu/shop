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

//Sekcje --> components/..

$sections = array(
    'navbar' =>                         'components/navbar.php',                
    'hero' =>                           'components/hero.php',
    'promotions' =>                     'components/promotions.php',
    'products' =>                       'components/products.php',
    'gallery' =>                        'components/gallery.php',
    'section_1x2' =>                    'components/section_1x2.php',
    'product' =>                        'components/product.php',
    'produkty_promocyjne' =>            'components/produkty_promocyjne.php',
    'all_products' =>                   'components/all_products.php',
    'customer_reviews' =>               'components/customer_reviews.php',
    'featured_brands' =>                'components/featured_brands.php',
    'footer' =>                         'components/footer.php',
    'required_style' =>                 'style/required_style.php',
    'required_scripts' =>               'components/required_scripts.php'
);

//Sekcje --> components/article/...

$sections_additional = array(
    'product' =>                        'components_subpages/article/product.php',
    'services' =>                       'components_subpages/article/services.php',
    'comments' =>                       'components_subpages/article/comments.php',
)
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($artykul['nazwa']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@merakiui/merakiui@latest/dist/merakiui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
    <?php include 'style/required_style.php'; ?>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
        }
        .product-card {
            transition: transform 0.1s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .comment-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .comment-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<?php include 'components/navbar.php'; ?>
<main class="pt-24"><main class="pt-24"></main>
<!-- Main Container -->
<div class="container mx-auto p-4">

    <?php 
     include $sections_additional['product']; 
     include $sections_additional['services'];
     include $sections_additional['comments']; 
     ?>
</div>
<?php include 'components/footer.php'; ?>
<?php include 'components/required_scripts.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        gsap.from(".product-card", { duration: 0.6, y: 20, opacity: 0, ease: "power4.out", stagger: 0.2 });
    });
</script>
</body>
</html>