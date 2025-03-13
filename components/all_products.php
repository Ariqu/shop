<div class="container mx-auto">

        <!-- Pozostałe produkty w mniejszej wersji -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-12">
            <?php foreach ($pozostaleProdukty as $artykul): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <a href="artykul.php?slug=<?php echo htmlspecialchars($artykul['slug']); ?>">
                        <?php if ($artykul['glowny_obraz']): ?>
                            <img class="w-full h-32 object-cover" src="zdjecia/<?php echo htmlspecialchars($artykul['glowny_obraz']); ?>" alt="<?php echo htmlspecialchars($artykul['nazwa']); ?>">
                        <?php else: ?>
                            <img class="w-full h-32 object-cover" src="zdjecia/domyslny-obraz.jpg" alt="<?php echo htmlspecialchars($artykul['nazwa']); ?>">
                        <?php endif; ?>
                    </a>
                    <div class="p-2">
                        <h3 class="text-sm font-bold">
                            <a href="artykul.php?slug=<?php echo htmlspecialchars($artykul['slug']); ?>"><?php echo htmlspecialchars($artykul['nazwa']); ?></a>
                        </h3>
                        <div class="text-gray-500 text-sm"><?php echo number_format($artykul['cena'], 2); ?> PLN</div>
                        <div class="flex items-center mt-1">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <i class="fas fa-star text-yellow-500 text-sm"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="mt-2">
                            <a class="text-white bg-blue-500 hover:bg-blue-700 px-2 py-1 text-xs rounded-full" href="#">DODAJ DO KOSZYKA</a>
                            <a class="text-gray-500 hover:text-gray-700 ml-2" href="#"><i class="far fa-heart text-sm"></i></a>
                            <a class="text-gray-500 hover:text-gray-700 ml-2" href="#"><i class="fas fa-chart-pie text-sm"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>