<?php
session_start();
include('layout/header.php');
?>

    <div class="checkout-container">
        <h1 class="checkout-title">Checkout</h1>
        <h3 style="margin-top: 50px; margin-bottom: 5px; margin-left: 10px;">Menu yang Anda pesan: </h3>
        <?php
        $total = 0; // Inisialisasi total
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $item) {
                // Ambil harga dan jumlah dari item
                $harga = intval(preg_replace("/[^0-9]/", "", $item['harga'])); // Menghapus karakter non-digit dan mengonversi ke integer
                $jumlah = (int)$item['jumlah'];

                // Hitung subtotal untuk item saat ini
                $subtotal = $harga * $jumlah;
                $total += $subtotal; // Tambahkan subtotal ke total

                // Tampilkan detail item dengan harga yang sesuai
                echo "<div class='checkout-item'>";
                echo "<h3>" . htmlspecialchars($item['nama']) . "</h3>";
                echo "<p>Rp " . number_format($harga, 0, ',', '.') . " x " . $jumlah . " = Rp " . number_format($subtotal, 0, ',', '.') . "</p>";
                echo "</div>";
            }

            // Tampilkan total dengan harga yang sesuai
            echo "<p class='ppn'>*Total Harga sudah termasuk PPN.</p>";
            echo "<div class='checkout-total'>Total: Rp " . number_format($total, 0, ',', '.') . "</div>";
        } else {
            echo "<p>Keranjang kosong.</p>";
        }
        ?>

        <h2 style="text-align: center; margin-top: 50px; border-top: 1px solid black; padding-top: 20px;">Pilih Tipe Pesanan Anda</h2>
        <div class="tipe-pesanan">
            <div class="card-co" onclick="selectOrderType('dine-in')">
            <img src="img/dine-svgrepo-com.svg">
                <div class="card-co__content">
                    <p class="card-co__title">Dine In</p>
                </div>
            </div>
            <div class="card-co" onclick="openOrderTypeModal('take-away')">
            <img src="img/take-away-svgrepo-com.svg">
                <div class="card-co__content">
                    <p class="card-co__title">Take Away</p>
                </div>
            </div>
        </div>
    </div>

    <div class="co-container"></div>

    <button class="cancel-button-co" onclick="cancelCheckout()">Batalkan Pesanan</button>

    <!-- Modal -->
    <div id="orderTypeModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalCO('orderTypeModal')">&times;</span>
        </div>
    </div>

    <!-- Modal untuk Dine In -->
    <div id="dineInModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalCO('dineInModal')">&times;</span>
            <div>
                <h2>Masukkan Tempat Duduk</h2>
                <input type="text" id="seatNumber" placeholder="Nomor Tempat Duduk" style="margin-bottom: 10px;">
            </div>
            <button class="confirm-button" onclick="confirmDineInOrder()">
                <span class="confirm-button-content">Selesaikan Pesanan</span>
            </button>
        </div>
    </div>

    <!-- Modal konfirmasi untuk Dine In -->
    <div id="overlay" class="overlay"></div>
    <div id="dineInConfirmationModal" class="alert-modal">
        <div class="alert-modal-content">
            <img id="alert-icon" src="img/alert-svgrepo-com.svg">
            <p class="alert-title">ALERT!</p>
            <p class="alert-desc">Apakah pesanan Anda<br>sudah benar?</p>
            <div class="alert-button-container">
                <button class="true" onclick="accDineInOrder()">Benar</button>
                <button class="false" onclick="closeModalCO('dineInConfirmationModal')">Salah</button>
            </div>
        </div>
    </div>

    <!-- Modal konfirmasi untuk Take Away -->
    <div id="overlay" class="overlay"></div>
    <div id="takeAwayConfirmationModal" class="alert-modal">
        <div class="alert-modal-content">
            <img id="alert-icon" src="img/alert-svgrepo-com.svg">
            <p class="alert-title">ALERT!</p>
            <p class="alert-desc">Apakah pesanan Anda<br>sudah benar?</p>
            <div class="alert-button-container">
                <button class="true" onclick="confirmTakeAwayOrder()">Benar</button>
                <button class="false" onclick="closeModalCO('takeAwayConfirmationModal')">Salah</button>
            </div>
        </div>
    </div>

<?php
include('layout/footer.php');
?>