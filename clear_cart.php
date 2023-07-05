<?php
// 启动session
session_start();

// 清空购物车数据
$_SESSION['cart'] = array();

// Redirect back to shopping cart page

header('Location: shopping-cart.php');


?>
