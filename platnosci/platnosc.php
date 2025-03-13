<?php
require 'vendor/autoload.php';
require '/database/db.php';
session_start();

use OpenPayU_Configuration;
use OpenPayU_Order;

OpenPayU_Configuration::setEnvironment('sandbox'); // lub 'secure' dla produkcji
OpenPayU_Configuration::setMerchantPosId('YOUR_POS_ID');
OpenPayU_Configuration::setSignatureKey('YOUR_SECOND_KEY');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $zamowienie_id = $_POST['zamowienie_id'];
    
    $sql = "SELECT z.*, u.email FROM zamowienia z JOIN uzytkownicy u ON z.uzytkownik_id = u.id WHERE z.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$zamowienie_id]);
    $zamowienie = $stmt->fetch();

    $order = [
        'notifyUrl' => 'http://localhost/sklep/notify.php',
        'continueUrl' => 'http://localhost/sklep/thank_you.php',
        'customerIp' => $_SERVER['REMOTE_ADDR'],
        'merchantPosId' => OpenPayU_Configuration::getMerchantPosId(),
        'description' => 'Zakupy w sklepie',
        'currencyCode' => 'PLN',
        'totalAmount' => $zamowienie['calkowita_cena'] * 100,
        'extOrderId' => uniqid(),
        'buyer' => [
            'email' => $zamowienie['email'],
        ],
        'products' => [],
    ];

    $sql = "SELECT zs.*, a.nazwa FROM zamowienia_szczegoly zs JOIN artykuly a ON zs.artykul_id = a.id WHERE zs.zamowienie_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$zamowienie_id]);
    $produkty = $stmt->fetchAll();

    foreach ($produkty as $produkt) {
        $order['products'][] = [
            'name' => $produkt['nazwa'],
            'unitPrice' => $produkt['cena'] * 100,
            'quantity' => $produkt['ilosc']
        ];
    }

    $response = OpenPayU_Order::create($order);
    if ($response->getStatus() == 'SUCCESS') {
        $redirectUri = $response->getResponse()->redirectUri;
        header("Location: $redirectUri");
    } else {
        echo "Błąd podczas tworzenia zamówienia.";
    }
}
?>
