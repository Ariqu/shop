<?php
session_start();
require '../database/db.php';


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
    <link rel="stylesheet" href="style.css">
    <style>
        @font-face {
            font-family: 'myfont';
            src: url('../font.woff2');
        }
        * {
            font-family: myfont;
        }

    </style>
</head>
<body class="bg-gray-100">

<!--- SEKCJA TOP -->
<?php include '../components/navbar.php'; ?>
<main class="pt-24">

<header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-gray-800">Twoja Firma</h1>
        </div>
    </header>

    <main class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-6">Dostawa Produktów</h2>
            
            <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold mb-4">Opcje Dostawy</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-lg font-medium mb-2">Kurier Standardowy</h4>
                        <p class="text-gray-700 mb-2">Dostawa do 3 dni roboczych. Koszt: <span class="font-semibold">19,99 PLN</span></p>
                        <p class="text-gray-500">Śledzenie przesyłki dostępne na naszej stronie.</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-lg font-medium mb-2">Kurier Ekspresowy</h4>
                        <p class="text-gray-700 mb-2">Dostawa w ciągu 1-2 dni roboczych. Koszt: <span class="font-semibold">29,99 PLN</span></p>
                        <p class="text-gray-500">Szybka dostawa z priorytetem. Śledzenie przesyłki dostępne na naszej stronie.</p>
                    </div>
                </div>
            </section>
            
            <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold mb-4">Koszty i Czas Dostawy</h3>
                <div class="highlight">
                    <h4 class="text-lg font-medium mb-2">Koszt Dostawy</h4>
                    <p>Bez względu na wybór opcji dostawy, wszystkie zamówienia powyżej 200 PLN są dostarczane bezpłatnie.</p>
                </div>
                <div class="highlight mt-4">
                    <h4 class="text-lg font-medium mb-2">Czas Realizacji</h4>
                    <p>Wszystkie zamówienia realizujemy w ciągu 24 godzin od momentu zakupu. W przypadku zamówień z personalizacją czas realizacji może się wydłużyć.</p>
                </div>
            </section>

            <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold mb-4">Śledzenie Przesyłki</h3>
                <p>Po wysłaniu zamówienia otrzymasz e-mail z numerem śledzenia przesyłki. Możesz śledzić status dostawy na naszej stronie w sekcji "Śledź Przesyłkę".</p>
            </section>

            <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold mb-4">Kontakt w Sprawie Dostawy</h3>
                <p>Jeśli masz jakiekolwiek pytania dotyczące dostawy lub potrzebujesz pomocy, skontaktuj się z naszym działem obsługi klienta pod adresem e-mail: <a href="mailto:kontakt@twojafirma.pl" class="text-blue-600 hover:underline">kontakt@twojafirma.pl</a> lub telefonicznie: <span class="font-semibold">+48 123 456 789</span>.</p>
            </section>
        </div>
    </main>

<?php include '../components/footer.php'; ?>



<!--- Framework -->
<?php include '../components/required_scripts.php'; ?>
<script src="scripts/search.js"></script>
</body>
</html>
