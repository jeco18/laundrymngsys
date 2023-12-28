<?php
session_start();
include_once 'connection.php';
$id = $_POST['id'];
if (!isset($_SESSION['id'])) {
    header('location: ../login.php');
    exit();
}

// Check if the user exists in the users table
$user_id = $_SESSION['id'];
$sqlCheckUser = "SELECT id FROM users WHERE id = :user_id";
$stmtCheckUser = $db->prepare($sqlCheckUser);
$stmtCheckUser->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmtCheckUser->execute();

if ($stmtCheckUser->rowCount() === 0) {
    // User doesn't exist, handle the error as needed
    header('location: ../login.php?type=error&message=Invalid user!');
    exit();
}
// Check if there are existing transactions with the same user ID and status 0
$sqlCheckTransaction = "SELECT * FROM transactions WHERE user_id = :user_id AND status = 0 ORDER BY id DESC LIMIT 1";
$stmtCheckTransaction = $db->prepare($sqlCheckTransaction);
$stmtCheckTransaction->bindParam(':user_id', $_SESSION['id']);
$stmtCheckTransaction->execute();
$results = $stmtCheckTransaction->fetchAll(); // Fetch the results

// Now, you can use $results to check if there are existing transactions
if (count($results) > 0) {
    header('location: ../transaction.php?type=error&message=You have an existing transaction!');
    exit();
}

if (empty($id)){
    header('location: ../transaction.php?type=error&message=Please select a customer!');
    exit();
}


$sql = "INSERT INTO transactions (user_id, customer_id, status) VALUES (:user_id, :customer_id, 0)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->bindParam(':customer_id', $id);
$stmt->execute();

generate_logs('Adding Transaction', 'New Transaction was added');
header('location: ../transaction.php?type=success&message=Transaction added successfully!');