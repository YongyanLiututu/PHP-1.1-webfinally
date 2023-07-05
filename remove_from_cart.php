<?php
session_start();

if (isset($_POST['itemId'])) {
    $itemId = $_POST['itemId'];
    // 从购物车中移除对应的商品
    if (isset($_SESSION['cart'][$itemId])) {
        unset($_SESSION['cart'][$itemId]);
    }
}
echo 'Success';
header('Location: shopping-cart.php');
exit();
?>



