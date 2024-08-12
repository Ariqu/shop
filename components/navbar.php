<nav id="navbar" class="fixed top-0 left-0 w-full py-8 shadow-lg bg-white text-black transition-colors duration-300 z-50">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
        <form id="search-form" action="search_item.php" method="GET" class="relative flex-grow flex-shrink-1 ml-1">
            <input type="text" id="search-input" name="query" placeholder="Szukaj produktów..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="off" required>
            <button type="submit" class="absolute top-0 right-0 mt-2 mr-2 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M15.65 15.65A6.5 6.5 0 1118 12a6.5 6.5 0 01-2.35 3.65z" />
                </svg>
            </button>
            <div id="suggestions" class="absolute left-0 right-0 bg-white border border-gray-300 rounded-lg mt-2 hidden"></div>
        </form>
        <div class="flex-1 text-center">
            <span class="text-xl font-bold">pefunre.com</span>
        </div>
        <div class="flex-2 flex items-center"></div>
        <div class="flex-1 flex justify-end space-x-6">
            <a href="index.php" class="nav-link">Strona główna</a>
            <a href="#" class="nav-link">Perfumy damskie</a>
            <a href="#" class="nav-link">Perfumy męskie</a>
            <a href="promocje.php" class="nav-link">Promocje</a>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="login.php" class="nav-link">Zaloguj się</a>
                <a href="register.php" class="nav-link">Zarejestruj się</a>
            <?php else: ?>
                <a href="account.php" class="nav-link">Twoje konto</a>
                <div class="relative group">
                    <a href="#" class="nav-link group-hover:text-blue-500">Moje produkty</a>
                    <div id="koszyk" class="absolute right-0 mt-2 w-64 bg-white border border-gray-300 rounded-lg shadow-lg hidden group-hover:block">
                        <ul id="koszyk-items" class="p-8">
                            <!-- Cart items will be dynamically added here -->
                        </ul>
                    </div>
                </div>
                <a href="cart.php" class="nav-link">Koszyk</a>
                <a href="logout.php" class="nav-link">Wyloguj się</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
