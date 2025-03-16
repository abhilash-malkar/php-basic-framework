<?php
    require 'services/Config.php';
    header('Content-Type: application/json');
    $config = new Config();
    $conn = $config->connection();

    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if($products){
        echo json_encode(['status' => 'success', 'products' => $products]);
    }else{
        echo json_encode(['status' => 'error', 'message' => 'No products found']);
    }
?>