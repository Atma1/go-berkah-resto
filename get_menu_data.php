<?php
// Koneksi ke database
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
    
    // Query SQL dengan parameterized query untuk menghindari SQL injection
    $sql = $conn->prepare("SELECT * FROM makanan WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Tampilkan data dalam format HTML
        echo "<span class='close' onclick='closeModal()'>&times;</span>";
        echo "<h2>" . $row['nama'] . "</h2>";
        echo '<img src="data:img/png;base64,'.base64_encode($row['img']).'"/>';
        echo "<p>" . $row['keterangan'] . "</p>";
        echo "<p style='font-weight: bold; font-size: 20px;'>" . $row['harga'] . "</p>";
        echo "<button onclick='pesan()'>Pesan</button>";
    } else {
        echo "Data tidak ditemukan";
    }
} else {
    echo "Parameter id tidak tersedia";
}

$conn->close();
?>