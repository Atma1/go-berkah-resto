<?php
include_once '../go-berkah-resto/config.php';

header('Content-Type: application/json');

$conn;

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}

// Get the route from the URL
$route = isset($_GET['route']) ? $_GET['route'] : '';

// Validate the route
$validRoutes = array('makanan', 'sidedish', 'minuman');
if (!in_array($route, $validRoutes)) {
    echo json_encode(array("error" => "Invalid route"));
    $conn->close();
    exit();
}

// Fetch data from the corresponding table
$sql = "SELECT * FROM $route";
$result = $conn->query($sql);

// Check if the table is empty
if ($result->num_rows > 0) {
    // Fetch all data
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array());
}

// Close connection
$conn->close();
?>
