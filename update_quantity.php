<?php
    session_start();
    if (isset($_GET['index']) && isset($_GET['quantity'])) {
        $index = $_GET['index'];
        $quantity = $_GET['quantity'];
        if (isset($_SESSION['cart'][$index])) {
            $_SESSION['cart'][$index]['jumlah'] = $quantity;
            echo "Jumlah item berhasil diperbarui.";
        } else {
            echo "Item tidak ditemukan.";
        }
    } else {
        echo "Permintaan tidak valid.";
    }
    ?>