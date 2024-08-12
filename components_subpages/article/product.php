<div class="bg-white shadow-xl rounded-xl p-8 mb-12 product-card">
        <div class="flex flex-col lg:flex-row items-center gap-6">
            <div class="lg:w-1/2">
                <?php if ($artykul['glowny_obraz']): ?>
                    <img src="zdjecia/<?php echo htmlspecialchars($artykul['glowny_obraz']); ?>" class="w-full h-auto rounded-xl" alt="<?php echo htmlspecialchars($artykul['nazwa']); ?>">
                <?php else: ?>
                    <img src="zdjecia/domyslny-obraz.jpg" class="w-full h-auto rounded-xl" alt="<?php echo htmlspecialchars($artykul['nazwa']); ?>">
                <?php endif; ?>
            </div>
            <div class="lg:w-1/2 lg:pl-8 mt-4 lg:mt-0">
                <h1 class="text-4xl font-extrabold mb-4 text-gray-900"><?php echo htmlspecialchars($artykul['nazwa']); ?></h1>
                <p class="text-gray-700 mb-6 text-lg leading-relaxed"><?php echo nl2br(htmlspecialchars($artykul['opis'])); ?></p>
                <p class="text-gray-900 font-bold text-3xl mb-6"><?php echo number_format($artykul['cena'], 2); ?> PLN</p>
                <a href="./cart/add_to_cart.php?dodaj=<?php echo $artykul['id']; ?>&slug=<?php echo urlencode($artykul['slug']); ?>" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-full transition-colors duration-300">Dodaj do koszyka</a>
            </div>
        </div>
    </div>