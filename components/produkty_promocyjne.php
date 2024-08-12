<?php
// Pobierz artykuły na promocji
$sql = "SELECT a.*, p.promocyjna_cena 
        FROM artykuly a
        JOIN promocje p ON a.id = p.artykul_id
        WHERE p.czy_promocja = 1";
$stmt = $pdo->query($sql);
$promocyjneProdukty = $stmt->fetchAll();
?>

<div class="text-center mb-8">
            <h2 class="text-3xl font-bold">Produkty na promocji</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($promocyjneProdukty as $produkt): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <a href="artykul.php?slug=<?php echo htmlspecialchars($produkt['slug']); ?>">
                        <?php if ($produkt['glowny_obraz']): ?>
                            <img class="w-full h-48 object-cover" src="zdjecia/<?php echo htmlspecialchars($produkt['glowny_obraz']); ?>" alt="<?php echo htmlspecialchars($produkt['nazwa']); ?>">
                        <?php else: ?>
                            <img class="w-full h-48 object-cover" src="zdjecia/domyslny-obraz.jpg" alt="<?php echo htmlspecialchars($produkt['nazwa']); ?>">
                        <?php endif; ?>
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-bold">
                            <a href="artykul.php?slug=<?php echo htmlspecialchars($produkt['slug']); ?>"><?php echo htmlspecialchars($produkt['nazwa']); ?></a>
                        </h3>
                        <div class="text-gray-500">
                            <?php if ($produkt['promocyjna_cena']): ?>
                                <span class="przekreslone"><?php echo number_format($produkt['cena'], 2); ?> PLN</span>
                                <span class="promocja"><?php echo number_format($produkt['promocyjna_cena'], 2); ?> PLN</span>
                            <?php else: ?>
                                <?php echo number_format($produkt['cena'], 2); ?> PLN
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center mt-2">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <i class="fas fa-star text-yellow-500"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="mt-4">
                            <a class="text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded-full" href="#">DODAJ DO KOSZYKA</a>
                            <a class="text-gray-500 hover:text-gray-700 ml-4" href="#"><i class="far fa-heart"></i></a>
                            <a class="text-gray-500 hover:text-gray-700 ml-4" href="#"><i class="fas fa-chart-pie"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>