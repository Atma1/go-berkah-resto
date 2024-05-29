<?php
include 'config/app.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nama Restoran</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #EFEFEF;
    }
    .container {
        display: flex;
    }
    .content {
        flex: 1;
    }
    .navbar {
        background-color: #2C77A0;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
    }
    .navbar img {
        height: 50px;
        margin-right: 10px;
    }
    .navbar h1 {
        margin: 0;
        font-size: 24px;
    }

/* menu */
.menu {
    background-color: #3289B8;
    display: flex;
    justify-content: space-around;
}
.menu a {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
}
.menu a:hover {
    border-radius: 0.8rem;
    background-color: #3B9CD1;
}

/* card */
.card {
  box-sizing: border-box;
  width: 300px;
  padding: 15px;
  background: #92A2E0;
  box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
  backdrop-filter: blur(6px);
  border-radius: 17px;
  text-align: center;
  cursor: pointer;
  transition: all 0.5s;
  user-select: none;
  font-weight: bolder;
  color: black;
  margin: 10px;
}

.card:hover {
  transform: scale(1.05);
}

.card:active {
  transform: scale(0.95) rotateZ(1.7deg);
}

.card-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    justify-content: center;
    margin: 20px;
    padding: 20px;
}
.card h3 {
    margin: 0;
    font-size: 18px;
}
.card p {
    margin: 5px 0;
    font-size: 16px;
}
.card-index {
    background-color: #f4f4f4;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 185px;
    margin: 10px;
    padding: 15px;
    text-align: center;
    cursor: pointer;
}
.card-index img {
    width: 100%;
    border-radius: 5px;
}
.card-index h3 {
    margin-top: 10px;
}

        /* modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 3;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
            padding-top: 50px;
            animation: fadeIn 0.5s;
        }
        
        .modal-content {
            background-color: #92A2E0;
            margin: 0 auto; /* Menengahkan modal */
            padding: 20px;
            width: 30%; /* Mengatur lebar konten modal */
            text-align: center;
            border-radius: 1.2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .modal-content button {
            margin: 10px auto;
        }
        .modal-content h2, p {
            color: #1D1D1D;
        }
        .close {
            color: #EFEFEF;
            float: right;
            font-size: 35px;
            font-weight: 100;
            margin-right: 2%;
        }
        .close:hover,
        .close:focus {
            color: #111827;
            text-decoration: none;
            cursor: pointer;
        }

        /* Order Button */
        .order-button {
        --width: 30%;
        --height: 35px;
        --button-color: #3454D1;
        width: var(--width);
        height: var(--height);
        background: var(--button-color);
        position: relative;
        text-align: center;
        border-radius: 0.45em;
        font-family: "Arial";
        transition: background 0.5s;
        margin: 0 auto;
        cursor: pointer;
        }

        .order-button::before {
        position: absolute;
        background-color: #3454D1;
        font-size: 0.9rem;
        color: #fff;
        border-radius: .25em;
        }

        .order-button::after {
        position: absolute;
        width: 0;
        height: 0;
        border: 10px solid transparent;
        border-top-color: #5A78F0;
        }

        .order-button::after,.order-button::before {
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s;
        }

        .order-text {
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .order-button-wrapper,.order-text,.icon {
        overflow: hidden;
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        color: #fff;
        }

        .order-text {
        top: 0
        }

        .order-text,.icon {
        transition: top 0.5s;
        }

        .icon {
        color: #fff;
        top: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .icon svg {
        width: 24px;
        height: 24px;
        }

        .order-button:hover {
        background: #5A78F0;
        }

        .order-button:hover .order-text {
        top: -100%;
        }

        .order-button:hover .icon {
        top: 0;
        }
        /* Modal End */

        button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        #welcomeMessage {
            font-size: 24px;
            color: #333;
            animation: fadeIn 2s ease-in-out forwards;
            text-align: center;
        }

        #mainContent {
            display: none; /* Konten utama disembunyikan saat preloading */
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .quantity-container {
            align-items: center;
        }

        .quantity-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            margin: 0;
        }

        .quantity-input {
            width: 50px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        /* checkout */
        .checkout-container {
            padding: 20px;
        }
        .checkout-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .checkout-item h3 {
            margin: 0;
        }
        .checkout-total {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .confirm-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .tipe-pesanan {
            display: flex;
            justify-content: center;
        }
        input[type=text]{
            width: 90%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            font-size: 16px;
        }
        .card-co {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            font-size: 24px;
            margin-bottom: 3%;
        }
        .cancel-button-co {
            background-color: red;
            bottom: 0px;
            display: block;
            position: fixed;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            height: 6%;
            border-radius: 0px;
            font-size: 20px;
        }

        .cancel-button-co:hover {
            background-color: maroon;
            bottom: 0px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            height: 6%;
        }


        /* Pahe */
        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .quantity-input {
            font-size: 18px;
        }

        /* Carousel */
        .carousel-container {
            width: 100%;
            max-height: 250px;
            margin: auto;
            position: relative;
            display: flex;
            flex-direction: column;
            gap: var(--lx-gap);

            .carousel {
                width: 100%;
                position: relative;
                overflow: hidden;

                .item {
                opacity: 0;
                width: 100%;
                height: 100%;
                display: none;
                transition: opacity 0.5s ease-in-out;

                    .img-crl {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        object-position: center;
                    }

                    &.active {
                        opacity: 1;
                        display: block;
                    }
                }
            }

            .btn-index {
                position: absolute;
                transform: translateY(-50%);
                top: 50%;
                outline: none;
                border: none;
                cursor: pointer;
                text-transform: uppercase;
                font-size: 10px;
                font-weight: 900;
                color: #ffffff;
                background-color: rgba(0, 0, 0, 0.5);
                transition: transform 0.2s ease-in-out;

                &:hover {
                transform: translateY(-50%) scale(0.8);
                }
            }

            .prev {
                left: 5%;
            }

            .next {
                right: 5%;
            }
        }

        /* tes */
        .keranjang-container{
            position: fixed;
            bottom: 30px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .keranjang {
        font-family: inherit;
        font-size: 18px;
        background: #2C77A0;
        color: white;
        fill: rgb(155, 153, 153);
        padding: 0.7em 1em;
        padding-left: 0.9em;
        display: flex;
        align-items: center;
        cursor: pointer;
        border: none;
        border-radius: 0.7rem;
        font-weight: 1000;
        }

        .keranjang span {
        display: block;
        margin-left: 0.3em;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
        }

        .keranjang img {
        display: block;
        transform-origin: center center;
        transition: transform 0.3s ease-in-out;
        }

        .keranjang:hover {
        background: #3B9CD1;
        }

        .keranjang:hover .svg-wrapper {
        transform: scale(1.25);
        transition: 0.5s linear;
        }

        .keranjang:hover img {
        transform: translateX(150%) scale(1.1);
        fill: #fff;
        }

        .keranjang:hover span {
        opacity: 0;
        transition: 0.5s linear;
        }

        .keranjang:active {
        transform: scale(0.95);
        }

        /* tes */
        .delete {
        position: relative;
        width: 150px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border: 1px solid #cc0000;
        background-color: #e50000;
        overflow: hidden;
        }

        .delete, .delete__icon, .delete__text {
        transition: all 0.3s;
        }

        .delete .delete__text {
        transform: translateX(35px);
        color: #fff;
        font-weight: 600;
        }

        .delete .delete__icon {
        position: absolute;
        transform: translateX(109px);
        height: 100%;
        width: 39px;
        background-color: #cc0000;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .delete .svg {
        width: 20px;
        }

        .delete:hover {
        background: #cc0000;
        }

        .delete:hover .delete__text {
        color: transparent;
        }

        .delete:hover .delete__icon {
        width: 148px;
        transform: translateX(0);
        }

        .delete:active .delete__icon {
        background-color: #b20000;
        }

        .delete:active {
        border: 1px solid #b20000;
        }

        /* Tampilan mobile */
        @media only screen and (max-width: 600px) {
            .container {
                flex-direction: column;
            }

            .menu {
                overflow-y: auto; /* Mengatur menu dapat digulir secara vertikal */
                justify-content: flex-start;
            }

            .modal {
                width: 100%; /* Mengatur lebar modal untuk layar kecil */
                height: 100%; /* Mengatur tinggi modal untuk layar kecil */
            }

            .modal-content {
                width: 80%;
                margin: -15px auto;
            }
        }
</style>
</head>
<body>
<div class="navbar">
    <img src="img/HONDA.png" alt="Semoga Berkah">
    <h1>Semoga Berkah</h1>
</div>

<div class="menu">
    <a href="home.php">Home</a>
    <a href="paket_hemat.php">Paket Hemat</a>
    <a href="#rice-bowl">Rice Bowl</a>
    <a href="#makanan">Makanan</a>
    <a href="#minuman">Minuman</a>
    <a href="#juice">Juice</a>
    <a href="#side-dish">Side Dish</a>
</div>

<button class="delete">
  <span class="delete__text">Delete</span>
  <span class="delete__icon"><svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><title></title><path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line><path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line><line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line></svg></span>
</button>

<?php
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page !== 'checkout.php') {
    echo "<div class='keranjang-container'>";
    echo "<button class='keranjang' onclick='openCartModal()'>";
    echo "<div class='svg-wrapper'>";
    echo "<img src='img/cart-4-svgrepo-com.svg'style='width: 30px; height: 30px;''>";
    echo "</div>";
    echo "<span>Keranjangku</span>";
    echo "</button>";
    echo "</div>";
}
?>

    <!-- Modal Keranjang -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCartModal()">&times;</span>
            <h2>Keranjang</h2>
            <div id="cartModalContent"></div>
        </div>
    </div>

    <!-- Modal Notifikasi -->
   <div id="notificationModal" class="modal">
       <div class="modal-content">
           <span class="close" onclick="closeNotificationModal()">&times;</span>
           <h2>NOTIFIKASI</h2>
           <p id="notificationMessage" style="margin-top: 10%; font-weight: 500; font-size: 20px;"></p>
       </div>
   </div>