<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: -250px;
            background-color: #6B705C;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #FFE8D6;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            color: #ffffff;
        }
        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        .openbtn {
            font-size: 20px;
            cursor: pointer;
            color: white;
            padding: 10px 15px;
            border: none;
        }
        .openbtn:hover {
            background-color: #565A4B;
            border-radius: 0.5rem;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f8f9fa;
            box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
            background-color: #6B705C;
        }
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }
        .profile-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #CB997E;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .profile-dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .profile-dropdown-content a:hover {
            background-color: #B3856D;
        }
        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .card-coba {
        width: 190px;
        height: 254px;
        position: relative;
        border-radius: 16px;
        background: #f5f5f5;
        transition: box-shadow .3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        cursor: pointer;
        }

        .card-coba-img {
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: #6eee87;
        }

        .card-coba-info {
        position: absolute;
        width: 100%;
        bottom: 0;
        padding: 1rem;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        }

        .card-coba-icon {
        opacity: 0;
        transform: translateX(-20%);
        width: 2em;
        height: 2em;
        transition: all .3s ease-in-out;
        }

        .icon {
        --size: 20px;
        width: var(--size);
        height: var(--size);
        }

        /*Text*/
        .card-coba-text p {
        line-height: 140%;
        }

        .text-title {
        font-weight: 900;
        font-size: 1.2rem;
        color: #222;
        }

        .text-subtitle {
        color: #333;
        font-weight: 500;
        font-size: 1rem;
        }

        /*Hover*/
        .card-coba:hover {
        box-shadow: 0 10px 20px 4px rgba(35, 35, 35, .1);
        }

        .card-coba:hover .card-coba-icon {
        opacity: 1;
        transform: translateX(20%);
        }
    </style>
</head>
<body>

<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php">Beranda</a>
    <a href="editmenu.php">Edit Menu</a>
</div>  

<div class="navbar">
    <button class="openbtn" onclick="openNav()">&#9776;</button>
    <div class="mid-navbar">
        <h1 style="margin-right: 10px;">Semoga</h1>
        <img src="../img/berkah_logos.png" alt="Berkah">
    </div>
    <div class="profile-dropdown">
        <img src="path/to/profile.jpg" alt="Profile" class="profile-img">
        <div class="profile-dropdown-content">
            <a href="#">Profile</a>
            <a href="#">Logout</a>
        </div>
    </div>
</div>

