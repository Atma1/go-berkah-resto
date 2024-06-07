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
                $harga = intval(preg_replace("/[^0-9]/", "", $item['harga']));
                $jumlah = (int)$item['jumlah'];

                // Hitung subtotal untuk item saat ini
                $subtotal = $harga * $jumlah;
                $total += $subtotal; // Tambahkan subtotal ke total

                // Tampilkan detail item dengan harga yang sesuai
                echo "<div class='checkout-item'>";
                echo "<h3 style='margin-left: 20px; font-weight: 700; font-size: 24px;'>" . htmlspecialchars($item['nama']) . "</h3>";
                echo "<div style='margin-top: 10px; margin-bottom: 10px;'>Rp " . number_format($harga, 0, ',', '.') . " x " . $jumlah . " = Rp " . number_format($subtotal, 0, ',', '.') . "</div>";
                echo "</div>";
            }

            // Tampilkan total dengan harga yang sesuai
            echo "<div class='ppn'>*Total Harga sudah termasuk PPN.</div>";
            echo "<div class='checkout-total'>Total: Rp " . number_format($total, 0, ',', '.') . "</div>";
        } else {
            echo "<p>Keranjang kosong.</p>";
        }
        ?>

        <div class="data-diri" style="margin-top: 50px;">
            <h2 style="text-align: center; margin-top: 50px; border-top: 1px solid black; padding-top: 20px;">Data Diri</h2>
            <h3 style="margin-bottom: 5px; margin-left: 30px; font-size: 18px;">Nama : </h3>
            <input class="form-control" type="text" name="customer-name" id="costumer-name" style="margin-left: 10px">
            <h3 style="margin-top: 30px; margin-bottom: 5px; margin-left: 30px; font-size: 18px;">Nomor HP : </h3>
            <input class="form-control" type="text" name="customer-number" id="costumer-number" style="margin-left: 10px">
        </div>

        <h2 style="text-align: center; margin-top: 50px; border-top: 1px solid black; padding-top: 20px;">Pilih Tipe Pesanan Anda</h2>
        <div class="tipe-pesanan">
            <div class="card-co" onclick="openOrderTypeModal('dine-in')">
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

<?php
include('layout/footer.php');
?>