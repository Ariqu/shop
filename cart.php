<?php
session_start();
require 'database/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT p.*, kp.ilosc FROM koszyk_produkty kp 
        JOIN artykuly p ON kp.produkt_id = p.id 
        JOIN koszyk k ON kp.koszyk_id = k.id 
        WHERE k.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$produkty = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
foreach ($produkty as $produkt) {
    $total += $produkt['cena'] * $produkt['ilosc'];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <?php include 'style/required_style.php'; ?>
</head>
<body class="bg-gray-100">
<?php include 'components/navbar.php'; ?>

<div class="container mx-auto mt-20">
    <main class="pt-24">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Twój koszyk</h1>
            <?php if (count($produkty) > 0): ?>
                <ul>
                    <?php foreach ($produkty as $produkt): ?>
                        <li class="mb-4">
                            <span class="font-bold"><?php echo htmlspecialchars($produkt['nazwa']); ?></span>
                            <span class="ml-2"> x <b><?php echo htmlspecialchars($produkt['ilosc']); ?></b></span>
                            <span class="ml-2 text-red font-bold mb-4"><?php echo number_format($produkt['cena'] * $produkt['ilosc'], 2); ?> PLN</span>
                            
                            <form action="website_controllers/delete_item.php" method="post" class="inline">
                                <input type="hidden" name="produkt_id" value="<?php echo $produkt['id']; ?>">
                                <button type="submit" class="text-red-500 hover:text-red-700">Usuń produkt</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <h3 class="text-3xl font-bold mb-4">Do zapłaty: <?php echo number_format($total, 2); ?> PLN</h3>
                <a href="platnosci-2/choose_payment.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Przejdź do płatności</a>
            <?php else: ?>
                <p>Twój koszyk jest pusty.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php include 'components/footer.php'; ?>
<?php include 'components/required_scripts.php'; ?>
</body>
</html>
