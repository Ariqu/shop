<?php
session_start();
require 'database/db.php';


// Pobierz wszystkie artykuły z bazy danych
$sql = "SELECT * FROM artykuly ORDER BY data_dodania DESC";
$stmt = $pdo->query($sql);
$artykuly = $stmt->fetchAll();

// Podziel artykuły na nowe i pozostałe
$noweProdukty = array_slice($artykuly, 0, 4); // Załóżmy, że nowe produkty to pierwsze 4
$pozostaleProdukty = array_slice($artykuly, 14);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfum.pl - Sklep z Perfumami</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@merakiui/core@1.0.0/dist/meraki-ui.min.css" rel="stylesheet">
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
        #suggestions {
            max-height: 150px; /* Maksymalna wysokość kontenera z sugestiami */
            overflow-y: auto;  /* Dodaj pasek przewijania w razie potrzeby */
            width: calc(100% - 2rem); /* Szerokość dostosowana do inputa */
            border-radius: 0.375rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            border: 1px solid #d1d5db;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }

            #suggestions.hidden {
                display: none;
            }

            .suggestion-item {
                padding: 0.5rem;
                cursor: pointer;
            }

            .suggestion-item:hover {
                background-color: #f3f4f6;
            }
            @font-face {
            font-family: 'myfont';
            src: url('font.woff2');
        }
        .promocja {
            color: red;
            font-weight: bold;
        }
        .przekreslone {
            text-decoration: line-through;
        }
    </style>
</head>
<body class="bg-gray-100">

<!--- SEKCJA TOP -->
<?php include 'components/navbar.php'; ?>

<!--- SEKCJA MIDDLE -->
<main class="pt-24"></main><main class="pt-24"></main>
<?php include 'components/produkty_promocyjne.php'; ?>


<!--- SEKCJA BOTTOM -->

<?php include 'components/footer.php'; ?>



<!--- Framework -->
<?php include 'components/required_scripts.php'; ?>
<script src="scripts/search.js"></script>
</body>
</html>
