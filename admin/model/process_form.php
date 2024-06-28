<?php
$pdo = new PDO('mysql:host=localhost;dbname=restoran', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$modal_used = isset($_POST['modal_used']) ? $_POST['modal_used'] : null;

$name = isset($_POST['name']) ? $_POST['name'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;
$category = null; // Default category, hanya relevan untuk modal 'makanan'
$operation = isset($_POST['operation']) ? $_POST['operation'] : null;
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;

if ($modal_used === 'makanan') {
    $category = isset($_POST['category']) ? $_POST['category'] : null;
}

$img = isset($_FILES['img']) ? $_FILES['img'] : null;

try {
    if (!$modal_used || !$name || !$price || !$description || !$img) {
        throw new Exception("Data form tidak lengkap atau tidak valid");
    }

    if ($img['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Gagal mengunggah gambar atau gambar tidak dipilih");
    }

    $imgData = file_get_contents($img['tmp_name']);

    switch ($modal_used) {
        case 'makanan':
            if (!$operation) {
                $stmt = $pdo->prepare("INSERT INTO makanan (nama, harga, img, keterangan, kategori) VALUES (:name, :price, :imgData, :description, :category)");
                $stmt->bindParam(':category', $category);
            } else {
                $stmt = $pdo->prepare("UPDATE $modal_used SET nama= :name, harga= :price, img= :imgData, keterangan= :description, kategori= :category WHERE id=$product_id");
                $stmt->bindParam(':category', $category);
            }
            break;
        case 'minuman':
            if (!$operation) {
                $stmt = $pdo->prepare("INSERT INTO minuman (nama, harga, img, keterangan) VALUES (:name, :price, :imgData, :description)");
            } else {
                $stmt = $pdo->prepare("UPDATE $modal_used SET nama= :name, harga= :price, img= :imgData, keterangan= :description WHERE id=$product_id");
            }
            break;
        case 'sidedish':
            if (!$operation) {
                $stmt = $pdo->prepare("INSERT INTO sidedish (nama, harga, keterangan, img) VALUES (:name, :price, :description, :imgData)");
            } else {
                $stmt = $pdo->prepare("UPDATE $modal_used SET nama=:name, harga=:price, img=:imgData, keterangan=:description WHERE id=$product_id");
            }
            break;
        default:
            throw new Exception("Modal yang dipilih tidak valid");
    }

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':imgData', $imgData, PDO::PARAM_LOB); // Parameter untuk tipe LOB (Large Object)
    $stmt->bindParam(':description', $description);

    $stmt->execute();

    echo "Data berhasil disimpan";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>