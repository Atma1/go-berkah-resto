<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restoran";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Periksa apakah parameter id tersedia
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = $conn->prepare("SELECT * FROM makanan WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imgData = base64_encode($row["img"]);
        $imgSrc = "data:image/png;base64," . $imgData;
        
        // Tampilkan data dalam format HTML
        echo "<div class='modal-header'>
            <h2 id='modalNama' style='font-weight: bold; text-align: center; width: 100%;'>{$row['nama']}</h2>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body' style='text-align: center;'>
            <img id='modalImg' style='margin-top: -15px; margin-bottom: 15px; width: 250px; height: 250px;' src='{$imgSrc}' alt='{$row['nama']}'>
            <p id='modalKeterangan' style='font-weight: 500; font-size: 18px;'>{$row['keterangan']}</p>
            <p id='modalHarga' style='font-weight: bold; font-size: 24px;'>{$row['harga']}</p>
            <div class='quantity'>
                <div class='quantity-container'>
                    <button class='quantity-button' id='spinner' onclick='decreaseQuantity(this)'>&minus;</button>
                    <input type='text' class='quantity-input' name='jumlah' value='1' min='1'>
                    <button class='quantity-button' id='spinner' onclick='increaseQuantity(this)'>&plus;</button>
                </div>
            </div>
        </div>
        <div class='modal-footer' style='text-align: center;'>
            <!-- button order -->
            <div class='order-button' onclick='pesan()'>
                <div class='order-button-wrapper'>
                    <div class='order-text'>Order</div>
                    <span class='icon'>
                        <svg viewBox='0 0 16 16' class='bi bi-cart2' fill='currentColor' height='16' width='16' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z'></path>
                        </svg>
                    </span>
                </div>
            </div>
        </div>";
    } else {
        echo "Data tidak ditemukan";
    }
} else {
    echo "Parameter id tidak tersedia";
}

$conn->close();
?>
