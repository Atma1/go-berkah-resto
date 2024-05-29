<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Terima Kasih</title>
<style>
    .thank-you-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: center;
    }
    .thank-you-message {
        font-size: 24px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="thank-you-container">
    <div class="thank-you-message">
        Terima kasih telah memesan, mohon ditunggu pesanannya :)
    </div>
</div>

<script>
    setTimeout(function() {
        window.location.href = 'home.php';
    }, 10000); // 10 detik
</script>
</body>
</html>