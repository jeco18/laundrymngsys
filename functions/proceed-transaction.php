<?php
include_once 'connection.php';
session_start();

$sql = "SELECT * FROM transactions WHERE user_id = :user_id AND status = 0 ORDER BY id DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->execute();
$results = $stmt->fetchAll();

$transaction_id = $results[0]['id'];
if (count($results) == 0){
    header('location: ../transaction.php?type=error&message=No transaction found!');
    exit();
}

$id = $_POST['id'];
$kilo = $_POST['kilo'];
$type = $_POST['type'];

// Get laundry type details from the database (including base price and max kilo)
$sql = "SELECT * FROM prices WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $type);
$stmt->execute();
$type_info = $stmt->fetch();

$price_name = $type_info['name'];
$base_price = $type_info['price'];
$max_kilo = $type_info['max_kilo'];

// Calculate the price based on base price per max kilo and add an additional fee if kilo exceeds max kilo
if ($kilo <= $max_kilo) {
    $price = $base_price;
} else {
    $additional_fee = $base_price / $max_kilo;
    $price = $base_price + (($kilo - $max_kilo) * $additional_fee);
}

// Calculate the item total
$sql = "SELECT expenditures.id, expenditures.qty, items.name, items.price, (expenditures.qty * items.price) AS total
        FROM expenditures
        JOIN items ON expenditures.item_id = items.id
        WHERE expenditures.transaction_id = :transaction_id AND user_id = :user_id";

$stmt = $db->prepare($sql);
$stmt->bindParam(':transaction_id', $transaction_id);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->execute();
$results = $stmt->fetchAll();

$item_total = 0;
foreach ($results as $result){
    $item_total += $result['total'];
}

// Update the transaction with the calculated price
$total = $item_total + $price;
$sql = "UPDATE transactions SET kilo = :kilo, total = :total, type = :type WHERE id = :id AND status = 0";
$stmt = $db->prepare($sql);
$stmt->bindParam(':kilo', $kilo);
$stmt->bindParam(':total', $total);
$stmt->bindParam(':type', $type);
$stmt->bindParam(':id', $transaction_id);
$stmt->execute();

// Output for testing purposes
echo $id;
echo "<br>";
echo $price;
echo "<br>";
echo $item_total;
echo "<br>";
echo $kilo;
echo "<br>";
echo $total;

generate_logs('New Pending Transaction', $_SESSION['id'].' added a new pending transaction');
header('location: ../reciept.php?id='.$transaction_id.'&kilo='.$kilo.'&type='.$price_name.'&type_price='.$price.'&products='.$item_total.'&total='.$total);
