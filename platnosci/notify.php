<?php
require 'vendor/autoload.php';
require 'db.php';

use OpenPayU_Order;

$body = file_get_contents('php://input');
$json = json_decode($body, true);

if ($json['order']['orderId']) {
    $response = OpenPayU_Order::retrieve($json['order']['orderId']);
    if ($response->getStatus() == 'SUCCESS') {
        $extOrderId = $response->getResponse()->orders[0]->extOrderId;
        $sql = "UPDATE zamowienia SET status = 'Zrealizowane' WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$extOrderId]);
    }
}
?>
