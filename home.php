<?php
include('layout/header.php');
?>
<div id="content" class="content">

        <div class="carousel-container">
            <div class="carousel">
                <div class="item active">
                    <img class="img-crl" src="img/PromoA1.png" alt="Image 1" onclick="openModalIndex(24)"/>
                </div>
                <div class="item">
                    <img class="img-crl" src="img/PromoA2.png" alt="Image 2" />
                </div>
                <div class="item">
                    <img class="img-crl" src="img/PromoA3.png" alt="Image 3" />
                </div>
            </div>

            <button class="btn-index prev"><</button>
            <button class="btn-index next">></button>
        </div>

        <h2 style="text-align: center; margin-top: 50px; margin-bottom: -30px;">Mau Pesan Apa Hari Ini?</h2>

        <div class="card-container">
            <div class="card-index" onclick="goToPage('Paket Hemat')">
                <img src="paket-hemat.jpg" alt="Paket Hemat">
                <h3>Paket Hemat</h3>
            </div>
            <div class="card-index" onclick="goToPage('Rice Bowl')">
                <img src="rice-bowl.jpg" alt="Rice Bowl">
                <h3>Rice Bowl</h3>
            </div>
            <div class="card-index" onclick="goToPage('Makanan')">
                <img src="makanan.jpg" alt="Makanan">
                <h3>Makanan</h3>
            </div>
            <div class="card-index" onclick="goToPage('Minuman')">
                <img src="minuman.jpg" alt="Minuman">
                <h3>Minuman</h3>
            </div>
            <div class="card-index" onclick="goToPage('Juice')">
                <img src="juice.jpg" alt="Juice">
                <h3>Juice</h3>
            </div>
            <div class="card-index" onclick="goToPage('Side Dish')">
                <img src="side-dish.jpg" alt="Side Dish">
                <h3>Side Dish</h3>
            </div>
        </div>



        <!-- Modal -->
        <div id="myModal" class="modal">
            <div id="modalContent" class="modal-content">
            </div>
        </div>

    </div>

<?php include('layout/footer.php'); ?>