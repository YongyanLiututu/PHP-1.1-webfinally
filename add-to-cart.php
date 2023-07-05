<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 从客户端接收添加到购物车的商品信息
    $addedtoshoppingcartItem = json_decode(file_get_contents('php://input'), true);

    // 将商品信息添加到购物车中
    $_SESSION['cart'][] = $addedtoshoppingcartItem;

    // 将购物车内容保存为JSON格式的数据
    saveCartToFile($_SESSION['cart']);

    // 返回成功的响应
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // 从文件中读取购物车内容
    $cartItems = loadCartFromFile();

    // 返回购物车内容
    header('Content-Type: application/json');
    echo json_encode($cartItems);
}

function saveCartToFile($cart) {
    // 将购物车内容保存为JSON格式的数据
    $filename = 'cart_data.json';
    file_put_contents($filename, json_encode($cart));
}

function loadCartFromFile() {
    // 从文件中读取购物车内容
    $filename = 'cart_data.json';
    if (file_exists($filename)) {
        $cart = file_get_contents($filename);
        return json_decode($cart, true);
    } else {
        return [];
    }
}




//session_start();
//
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    // 从客户端接收添加到购物车的商品信息
//    $addedtoshoppingcartItem = json_decode(file_get_contents('php://input'), true);
////    $_SESSION['cart']=array();
//    // 将商品信息添加到购物车中
//    $_SESSION['cart'][] = $addedtoshoppingcartItem;
//
////    error_log('Added item to cart: ' . var_export($addedtoshoppingcartItem, true));
////
////    echo 1;
//    // A successful response is returned
//    header('Content-Type: application/json');
//
//    echo json_encode(['status' => 'success']);
//
//} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//// Get all item information from the shopping cart
//    $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
//
//    // Returns the JSON format of all product information
//    header('Content-Type: application/json');
//    echo json_encode($cartItems);
//}
//
?>


