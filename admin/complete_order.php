<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    $sql = "UPDATE orders SET status = 1 WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>