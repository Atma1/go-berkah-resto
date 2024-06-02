<?php
include('layout/header.php');
?>
<div id="content" class="content">


        <div id="carouselExampleAutoplaying" class="carousel slide carousel-container" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-crl" src="img/PromoA1.png" alt="Image 1" data-id="24" onclick="openModalIndex(this)"/>
                </div>
                <div class="carousel-item">
                    <img class="img-crl" src="img/PromoA2.png" alt="Image 2" data-id="25" onclick="openModalIndex(this)"/>
                </div>
                <div class="carousel-item">
                    <img class="img-crl" src="img/PromoA3.png" alt="Image 3" data-id="26" onclick="openModalIndex(this)"/>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <h2 style="text-align: center; margin-top: 50px; margin-bottom: -30px;">Mau Pesan Apa Hari Ini?</h2>

        <div class="card-container">
            <div class="card-index" onclick="goToPage('Paket Hemat')">
                <img src="img/paket_hemat.jpeg" alt="Paket Hemat">
                <h3>Paket Hemat</h3>
            </div>
            <div class="card-index" onclick="goToPage('Rice Bowl')">
                <img src="img/rice_bowl.png" alt="Rice Bowl">
                <h3>Rice Bowl</h3>
            </div>
            <div class="card-index" onclick="goToPage('Makanan')">
                <img src="img/makanan.jpeg" alt="Makanan">
                <h3>Makanan</h3>
            </div>
            <div class="card-index" onclick="goToPage('Minuman')">
                <img src="img/minuman.jpeg" alt="Minuman">
                <h3>Minuman</h3>
            </div>
            <div class="card-index" onclick="goToPage('Juice')">
                <img src="img/juice.jpeg" alt="Juice">
                <h3>Juice</h3>
            </div>
            <div class="card-index" onclick="goToPage('Side Dish')">
                <img src="img/side_dish.jpeg" alt="Side Dish">
                <h3>Side Dish</h3>
            </div>
        </div>

        <div class="modal fade" id="modalIndex" tabindex="-1" aria-labelledby="modalIndexLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div id="modalContent" class="modal-content">
                </div>
            </div>
        </div>

    </div>

<?php include('layout/footer.php'); ?>