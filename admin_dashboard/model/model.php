<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restoran";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}

// Get the route from the URL
$route = isset($_GET['route']) ? $_GET['route'] : '';
$productRoute = isset($_GET['product']) ? $_GET['product'] : '';

// Validate the route
$product = array('makanan', 'sidedish', 'minuman');
$crudRoute = array('add', 'delete', 'update', 'get');

if (!in_array($route, $crudRoute)) {
    echo json_encode(array("error" => "Invalid route"));
    $conn->close();
    exit();
} elseif (!in_array($productRoute, $product)) {
    echo json_encode(array("error" => "No product specified!"));
    $conn->close();
    exit();
}

if ($route == "get") {
    $sql = "SELECT id, nama, harga, img, keterangan FROM $productRoute";
    $result = $conn->query($sql);

    // Check if the table is empty
    if ($result->num_rows > 0 || $result->num_rows == null) {
        // Fetch all data
        $data = array();
        while($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                if (is_null($value)) {
                    continue;
                }

                $fieldType = $result->fetch_field_direct(array_search($key, array_keys($row)))->type;
                if ($fieldType == MYSQLI_TYPE_BLOB) {
                    $row[$key] = base64_encode($value);
                }
            }
            $data[] = $row;
        }
        echo json_encode(["status" => "success", "data"=>$data]);
    } else {
        echo json_encode(["status" => "success", "data"=>"No data found"]);
    }

}

// Close connection
$conn->close();
