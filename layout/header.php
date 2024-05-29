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
    transition: all 0.3s;
}
.menu a:hover {
    border-radius: 0.8rem;
    background-color: #3B9CD1;
    transform: scale(1.05);
}
.menu a:active {
    transform: scale(1.05);
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
            animation: fadeIn 0.5s;
        }
        
        .modal-content {
            background-color: #92A2E0;
            margin: 0 auto;
            padding: 20px;
            width: 30%;
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
            cursor: pointer;
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

        @keyframes fadeOutModal {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
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
        .checkout-title {
            margin-top: -0.5%;
            margin-bottom: -30px;
            text-align: center;
            font-weight: 900;
            border-bottom: 1px solid black;
            padding-bottom: 15px;
        }
        .checkout-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid black;
        }
        .checkout-item h3 {
            margin: 0;
        }
        .checkout-total {
            text-align: right;
            margin-right: 10px;
            margin-top: -10px;
            margin-bottom: -30px;
            font-size: 24px;
            font-weight: 900;
        }
        .ppn{
            text-align: left;
            margin-left: 10px;
            font-weight: 100;
            font-size: 13px;
            font-style: italic;
        }
        .tipe-pesanan {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        input[type=text]{
            width: 90%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            font-size: 16px;
        }

        .co-container {
            flex: 1;
        }

        .cancel-button-co {
            position: fixed;
            background-color: rgb(230, 34, 77);
            cursor: pointer;
            box-sizing: border-box;
            width: 100%;
            height: 6%;
            color: #fff;
            border: none;
            font-size: 20px;
            transition: all 0.3s ease-in-out;
            z-index: 1;
            overflow: hidden;
            bottom: 0px;
        }

        .cancel-button-co::before{
            content: "";
            background-color: rgb(190, 30, 62);
            width: 0;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            transition: width 700ms ease-in-out;
            display: inline-block;
        }

        .cancel-button-co:hover::before {
            width: 100%;
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
                font-size: 15px;
                font-weight: 900;
                color: #ffffff;
                background-color: rgba(0, 0, 0, 0.5);
                border-radius: 0.3rem;
                padding: 10px 15px;
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

        /* keranjang */
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

        /* delete */
        .delete {
        position: relative;
        width: 100px;
        height: 40px;
        cursor: pointer;
        border: 1px solid #cc0000;
        background-color: #e50000;
        overflow: hidden;
        border-radius: 0.3rem;
        margin-left: 10px;
        }

        .delete, .delete__icon, .delete__text {
        transition: all 0.3s;
        }

        .delete .delete__text {
        margin-left: -45%;
        color: #fff;
        font-weight: 600;
        }

        .delete .delete__icon {
        position: absolute;
        transform: translate(53px, -27px);
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
        transform: translate(-20%, -70%);
        }

        .delete:active .delete__icon {
        background-color: #b20000;
        }

        .delete:active {
        border: 1px solid #b20000;
        }

        /* card pesanan */
        .card-co {
        cursor: pointer;
        position: relative;
        margin : 10px;
        width: 200px;
        height: 120px;
        background-color: #34C2C2;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        perspective: 1000px;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.9);
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-co img {
        width: 85px;
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-co:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.9);
        }

        .card-co__content {
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 20px;
        box-sizing: border-box;
        background-color: #3289B8;
        transform: rotateX(-90deg);
        transform-origin: bottom;
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-co:hover .card-co__content {
        transform: rotateX(0deg);
        }

        .card-co__title {
        font-size: 24px;
        color: white;
        text-align: center;
        font-weight: 900;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .card-co:hover svg {
        scale: 0;
        }

        /* input co */
        #seatNumber {
        border: none;
        outline: none;
        border-radius: 15px;
        padding: 1em;
        background-color: #C1C9E8;
        box-shadow: inset 2px 5px 10px rgba(0,0,0,0.3);
        transition: 300ms ease-in-out;
        text-align: center;
        }

        #seatNumber:focus {
        background-color: #EFEFEF;
        transform: scale(1.05);
        box-shadow: 13px 13px 100px #969696,
                    -13px -13px 100px #ffffff;
        }

        /* Button selesaikan pesanan */
        .confirm-button {
        position: relative;
        overflow: hidden;
        height: 3rem;
        padding: 0 2rem;
        border-radius: 0.5rem;
        background: #2C77A0;
        background-size: 400%;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 16px;
        }

        .confirm-button:hover::before {
        transform: scaleX(1);
        }

        .confirm-button-content {
        position: relative;
        z-index: 1;
        }

        .confirm-button::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        transform: scaleX(0);
        transform-origin: 0 50%;
        width: 100%;
        height: inherit;
        border-radius: inherit;
        background: linear-gradient(
            82.3deg,
            rgba(150, 93, 233, 1) 10.8%,
            rgba(99, 88, 238, 1) 94.3%
        );
        transition: all 0.475s;
        }

        /* tes */
        .alert-modal {
            display: none;
            position: fixed;
            width: 300px;
            background-color: #92A2E0;
            border-radius: 1.2rem;
            overflow: hidden;
            box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.062);
            z-index: 3;
            left: 40%;
            top: 30%;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .alert-modal-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px;
        }

        #alert-icon {
            width: 75px;
            margin-bottom: -15%;
        }

        .alert-title {
            font-size: 40px;
            font-weight: 800;
            color: #ff0000;
        }

        .alert-desc {
        text-align: center;
        font-size: 16px;
        font-weight: 500;
        color: #242424;
        margin-top: -10%;
        }

        .alert-button-container {
        display: flex;
        gap: 20px;
        flex-direction: row;
        margin-top: 5%;
        }

        .true {
        height: 3rem;
        padding: 0 2rem;
        background-color: #7b57ff;
        transition-duration: .2s;
        border: none;
        color: rgb(241, 241, 241);
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        border-radius: 20px;
        box-shadow: 0 4px 6px -1px #977ef3, 0 2px 4px -1px #977ef3;
        transition: all .6s ease;
        }

        .false {
        height: 3rem;
        padding: 0 2rem;
        background-color: #6d7dc0;
        transition-duration: .2s;
        color: rgb(241, 241, 241);
        border: none;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        border-radius: 20px;
        box-shadow: 0 4px 6px -1px #6575b3, 0 2px 4px -1px #bebdbd;
        transition: all .6s ease;
        }

        .false:hover {
        background-color: #8193df;
        box-shadow: 0 10px 15px -3px #6575b3, 0 4px 6px -2px #bebdbd;
        transition-duration: .2s;
        }

        .true:hover {
        background-color: #9173ff;
        box-shadow: 0 10px 15px -3px #977ef3, 0 4px 6px -2px #977ef3;
        transition-duration: .2s;
        }

        /* Tampilan mobile android*/
        @media only screen and (max-width: 360px) {
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
                padding-top: 30px;
            }

            .modal-content {
                width: 80%;
                margin: -15px auto;
            }
            .ppn {
                text-align: right;
                margin-right: 10px;
            }
            .alert-modal {
                left: 8%;
                top: 25%;
            }
        }

        /* Tampilan mobile iphone*/
        @media only screen and (min-width: 370px) and (max-width: 600px) {
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
                padding-top: 40px;
            }

            .modal-content {
                width: 80%;
                margin: -15px auto;
            }
            .ppn {
                text-align: right;
                margin-right: 10px;
            }
            .alert-modal {
                left: 15%;
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
            <h2 style="font-weight: 900;">Keranjang</h2>
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