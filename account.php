<?php
session_start();
require 'database/db.php';


// Pobierz wszystkie artykuły z bazy danych
$sql = "SELECT * FROM artykuly ORDER BY data_dodania DESC";
$stmt = $pdo->query($sql);
$artykuly = $stmt->fetchAll();

// Podziel artykuły na nowe i pozostałe
$noweProdukty = array_slice($artykuly, 0, 4); // Załóżmy, że nowe produkty to pierwsze 4
$pozostaleProdukty = array_slice($artykuly, 4);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfum.pl - Sklep z Perfumami</title>
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

<!--- SEKCJA TOP -->
<?php include 'components/navbar.php'; ?>

<main class="pt-24"></main><main class="pt-24"></main>


<!--- SEKCJA MIDDLE USER ?user_components -->

<?php include 'account_components/account_main.php'; ?>

<!--- SEKCJA BOTTOM -->

<?php include 'components/footer.php'; ?>



<!--- Framework -->
<?php include 'components/required_scripts.php'; ?>

</body>
</html>
