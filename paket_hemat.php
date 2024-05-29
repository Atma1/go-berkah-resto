<?php
include('layout/header.php');

$sql = "SELECT id, nama, harga, img, keterangan FROM makanan WHERE kategori = 1";
$result = $conn->query($sql);
?>

<div class="card-container">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='card' data-index='" . $row['id'] . "' onclick='openModal(\"" . $row["nama"] . "\", \"data:img/png;base64," . base64_encode($row["img"]) . "\", \"" . $row["keterangan"] . "\", \"" . $row["harga"] . "\")'>";
            echo "<h3>" . $row["nama"] . "</h3>";
            echo '<img src="data:img/png;base64,'.base64_encode($row['img']).'" width="250" height="250"/>';
            echo "</div>";
        }
    } else {
        echo "Tidak ada data.";
    }
    $conn->close();
    ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalNama" style="font-size: 32px; font-weight: 900;"></h2>
        <img id="modalImg" style="margin-top: -15px;" src="">
        <p id="modalKeterangan" style="font-weight: 500; font-size: 18px;"></p>
        <p id="modalHarga" style="font-weight: bold; font-size: 24px;"></p>
        <div class="quantity-container">
            <button class="quantity-button" onclick="decreaseQuantity(this)">-</button>
            <input type="number" class="quantity-input" name="jumlah" value="1" min="1">
            <button class="quantity-button" onclick="increaseQuantity(this)">+</button>
        </div>

        <!-- button order -->
        <div class="order-button" onclick="pesan()">
            <div class="order-button-wrapper">
            <div class="order-text">Order</div>
                <span class="icon">
                    <svg viewBox="0 0 16 16" class="bi bi-cart2" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                    </svg>
                </span>
            </div>
        </div>
    </div>
</div>

<?php include('layout/footer.php');?>