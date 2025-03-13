<section class="py-12">
    <div class="container mx-auto">
        <div class="text-center mb-8">
            <h2 class=" font-bold">Najnowsze produkty</h2>
            <div>
                <a class="text-blue-500 hover:underline" href="#">BEST SELLER</a> | <a class="text-blue-500 hover:underline" href="#">NEW ARRIVAL</a> | <a class="text-blue-500 hover:underline" href="#">MOST WANTED</a>
            </div>
        </div>
        
        <!-- Nowe produkty -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($noweProdukty as $artykul): ?>
                <div class="bg-white shadow-lg overflow-hidden">
                    <a href="artykul.php?slug=<?php echo htmlspecialchars($artykul['slug']); ?>">
                        <?php if ($artykul['glowny_obraz']): ?>
                            <img class="w-full h-48 object-cover" src="zdjecia/<?php echo htmlspecialchars($artykul['glowny_obraz']); ?>" alt="<?php echo htmlspecialchars($artykul['nazwa']); ?>">
                        <?php else: ?>
                            <img class="w-full h-48 object-cover" src="zdjecia/domyslny-obraz.jpg" alt="<?php echo htmlspecialchars($artykul['nazwa']); ?>">
                        <?php endif; ?>
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-bold">
                            <a href="artykul.php?slug=<?php echo htmlspecialchars($artykul['slug']); ?>"><?php echo htmlspecialchars($artykul['nazwa']); ?></a>
                        </h3>
                        <div class="text-gray-500"><?php echo number_format($artykul['cena'], 2); ?> PLN</div>
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

        <br>
        
        <div class="flex items-center justify-center mt-5">
            <h2 class="text-1xl">An incandescent odyssey between two symbolic eras, the Dior autumn-winter 2024-2025 ready-to-wear line, conceived by Maria Grazia Chiuri, reveals models that shine with the strength of a bold femininity.</h2>
        </div>
    </div>
                     

    
