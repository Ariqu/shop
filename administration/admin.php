<?php
require '../database/db.php';

// Pobierz wszystkie artykuły z bazy danych
$sql = "SELECT * FROM artykuly";
$stmt = $pdo->query($sql);
$artykuly = $stmt->fetchAll();
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
    <link href="https://cdn.jsdelivr.net/npm/merakiui@1.1.0/dist/css/meraki.min.css" rel="stylesheet">
    <style>
        /* Dostosowanie stylu bocznego panelu */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }
        .sidebar a {
            display: block;
            padding: 16px;
            color: #333;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar .active {
            background-color: #e9ecef;
            color: #007bff;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <nav class="sidebar shadow-md">
        <div class="p-4">
            <h2 class="text-lg font-semibold text-gray-800">Panel Administracyjny</h2>
        </div>
        <a href="dodaj_artykul.php" class="active">Dodaj Artykuł</a>
        <a href="edytuj_artykul.php">Edytuj Artykuł</a>
        <a href="usun_artykul.php">Usuń Artykuł</a>
        <a href="zarzadzaj_komentarzami.php">Komentarze</a>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Hero Section -->
        <section class="relative bg-purple-600 text-white py-20">
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-bold">Witamy w Panelu Administratora</h1>
                <p class="mt-4 text-lg">Zarządzaj artykułami i komentarzami w Twoim sklepie z perfumami.</p>
            </div>
        </section>

        <!-- Dashboard Section -->
        <section class="py-12">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Statystyki -->
                    <div class="bg-white shadow-lg rounded-lg p-6 card">
                        <div class="flex items-center">
                            <div class="text-purple-600 text-3xl mr-4">
                                <i class="fas fa-box"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Łączna Liczba Artykułów</h3>
                                <p class="text-gray-600 mt-1"><?php echo count($artykuly); ?> szt.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 card">
                        <div class="flex items-center">
                            <div class="text-green-600 text-3xl mr-4">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Dziś Dodano Artykułów</h3>
                                <p class="text-gray-600 mt-1">5 szt.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 card">
                        <div class="flex items-center">
                            <div class="text-blue-600 text-3xl mr-4">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Łączna Liczba Komentarzy</h3>
                                <p class="text-gray-600 mt-1">120 szt.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 card">
                        <div class="flex items-center">
                            <div class="text-red-600 text-3xl mr-4">
                                <i class="fas fa-trash"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Usuń Artykuł</h3>
                                <p class="text-gray-600 mt-1">4 szt.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Table Section -->
        <section class="py-12">
            <div class="container mx-auto">
                <!-- Formularz wyszukiwania -->
                <div class="mb-6">
                    <form method="GET" action="">
                        <div class="flex items-center">
                            <input type="text" name="search" placeholder="Wyszukaj artykuł..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                class="form-input block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                            <button type="submit" class="ml-3 px-4 py-2 bg-purple-500 text-white font-semibold rounded-md shadow-sm hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                Szukaj
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tabela -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nazwa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cena</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Utworzenia</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Główny Obraz</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akcje</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            // Połączenie z bazą danych
                            require '../database/db.php';

                            // Pobranie wartości wyszukiwania
                            $search = isset($_GET['search']) ? $_GET['search'] : '';

                            // Zapytanie do bazy danych z warunkiem wyszukiwania
                            $sql = "SELECT * FROM artykuly";
                            if ($search) {
                                $sql .= " WHERE nazwa LIKE :search OR opis LIKE :search";
                            }
                            $stmt = $pdo->prepare($sql);

                            // Jeśli istnieje wyszukiwanie, dodajemy parametr
                            if ($search) {
                                $stmt->execute(['search' => "%$search%"]);
                            } else {
                                $stmt->execute();
                            }

                            // Sprawdzenie, czy są wyniki
                            if ($stmt->rowCount() > 0) {
                                // Wyświetlanie danych każdego wiersza
                                while ($row = $stmt->fetch()) {
                                    echo "<tr>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>" . htmlspecialchars($row['id']) . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . htmlspecialchars($row['nazwa']) . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . htmlspecialchars($row['opis']) . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>$" . htmlspecialchars($row['cena']) . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . htmlspecialchars($row['slug']) . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . htmlspecialchars($row['data_utworzenia']) . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'><img src='../zdjecia/" . htmlspecialchars($row['glowny_obraz']) . "' alt='Główny obraz' class='w-24 h-24 object-cover'></td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>";
                                    echo "<a href='edytuj_artykul.php?id=" . htmlspecialchars($row['id']) . "' class='text-blue-500 hover:text-blue-700'>Edytuj</a> | ";
                                    echo "<a href='usun_artykul.php?id=" . htmlspecialchars($row['id']) . "' class='text-red-500 hover:text-red-700'>Usuń</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='px-6 py-4 text-center text-sm text-gray-500'>Brak danych</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer bg-gray-200 py-6 mt-8">
<h1>ADMIN</h1>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

</body>
</html>