<?php
require 'database/db.php'; // Plik do połączenia z bazą danych

$query = isset($_GET['query']) ? $_GET['query'] : '';

if ($query) {
    $stmt = $pdo->prepare("SELECT * FROM artykuly WHERE nazwa LIKE ?");
    $stmt->execute(["%$query%"]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//

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
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki wyszukiwania</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
.item {
    position: relative;
    overflow: hidden; /* Aby ukryć efekty poza granicami elementu */
    padding: 10px 20px;
    border-bottom: 1px solid #ddd;
    transition: color 1.2s; /* Płynne przejście dla koloru tekstu */
}

.item:last-child {
    border-bottom: none;
}

.item::before,
.item::after {
    content: "";
    position: absolute;
    width: 0;
    height: 100%;
    background-color: black;
    transition: all 1.2s;
    top: 0;
    left: 0;
    z-index: -1;
}

.item::after {
    background-color: white; /* Kolor tła */
    border-bottom: 11px solid white;
    right: 12;
    left: auto;
}

.item:hover::before {
    width: 50%;
}

.item:hover::after {
    width: 50%;
    left: 50%;
}

.item:hover {
    color: white;
}
    </style>
</head>
<body>
    <?php include $sections['navbar'];  ?>
    <div class="container mx-auto p-4">
    <main class="pt-24"><main class="pt-24"></main>
        <h1 class="text-2xl font-bold mb-4">Wyniki wyszukiwania dla: "<?php echo htmlspecialchars($query); ?>"</h1>
        <div>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <div class="item">
                    <a href="<?php echo "artykul.php?slug=" . htmlspecialchars($item['slug']); ?>"> <?php echo htmlspecialchars($item['nazwa']); ?>
                        <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($item['nazwa']); ?></h2>
                    </a>

                        <p><?php echo htmlspecialchars($item['opis']); ?></p>
                        <p class="text-gray-600">Cena: <?php echo htmlspecialchars($item['cena']); ?> PLN</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Brak wyników dla podanego zapytania.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include $sections['footer'];  ?>
</body>
</html>
