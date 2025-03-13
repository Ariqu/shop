<?php
session_start();
require 'database/db.php';

// Przygotuj zapytanie SQL, aby uniknąć SQL Injection
$sql = "SELECT * FROM artykuly ORDER BY data_dodania DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$artykuly = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Podziel artykuły na nowe i pozostałe
$noweProdukty = array_slice($artykuly, 0, 4); // Załóżmy, że nowe produkty to pierwsze 4
$pozostaleProdukty = array_slice($artykuly, 14);

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
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfum.pl - Sklep z Perfumami</title>
    <?php include $sections['required_style']; ?>
</head>
<body class="bg-gray-100">

<!--- SEKCJA TOP -->
<?php include $sections['navbar']; ?>
<?php include $sections['hero']; ?>

<div class="main_content">

<!--- SEKCJA MIDDLE -->
<?php include $sections['promotions']; ?>
<?php include $sections['products']; ?>
<?php include $sections['gallery']; ?>
<?php // DO POPRAWY // ---------- include $sections['marquee']; ?>
<?php include $sections['section_1x2']; ?>
<?php include $sections['product']; ?>
<?php include $sections['produkty_promocyjne']; ?>
<?php include $sections['all_products']; ?>

<!--- SEKCJA BOTTOM -->
<?php include $sections['customer_reviews']; ?>
<?php include $sections['featured_brands']; ?>
<?php include $sections['footer']; ?>

</div>

<!--- Framework -->
<?php include $sections['required_scripts']; ?>
<script src="scripts/search.js"></script>
<script src="scripts/marquee.js"></script>
</body>
</html>
