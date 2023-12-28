<?php
include_once 'connection.php';

$name = $_POST['type'];
$price = $_POST['price'];
$max_kilo = $_POST['max_kilo'];

$sql = "SELECT * FROM prices WHERE name = :name";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../profile.php?type=error&message='.$type.' is already exist');
    exit;
}

$sql = "INSERT INTO prices (name, price, max_kilo) VALUES (:name, :price, :max_kilo)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':max_kilo', $max_kilo);
$stmt->execute();

generate_logs('Adding Price', $name.'| New Price was added');
header('Location: ../profile.php?type=success&message=The price was added successfully');

?>