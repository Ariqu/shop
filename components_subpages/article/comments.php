<div class="bg-white shadow-xl rounded-xl p-8 comment-card">
            <h2 class="text-3xl font-extrabold mb-6">Komentarze</h2>
            <?php if (isset($error)): ?>
                <p class="text-red-500 mb-6"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="artykul.php?slug=<?php echo htmlspecialchars($slug); ?>" method="post" class="mb-6">
                    <textarea name="komentarz" rows="4" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" placeholder="Dodaj komentarz"></textarea>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-full mt-4 transition-colors duration-300">Dodaj komentarz</button>
                </form>
            <?php else: ?>
                <p class="text-gray-700">Musisz być zalogowany, aby dodać komentarz.</p>
            <?php endif; ?>

            <?php if ($komentarze): ?>
                <ul class="space-y-6">
                    <?php foreach ($komentarze as $komentarz): ?>
                        <li class="bg-gray-200 p-6 rounded-lg shadow-lg comment-card">
                            <p class="text-gray-700 font-semibold"><strong><?php echo htmlspecialchars($komentarz['nazwa_uzytkownika']); ?>:</strong></p>
                            <p><?php echo nl2br(htmlspecialchars($komentarz['komentarz'])); ?></p>
                            <p class="text-xs text-gray-500 mt-2"><?php echo htmlspecialchars($komentarz['data_utworzenia']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-700">Brak komentarzy.</p>
            <?php endif; ?>
        </div>