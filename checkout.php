<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
<?php
session_start();
// 检查购物车是否为空



if (count($_SESSION['cart']) == 0) {
    echo '<script>alert("No car has been reserved. please select again");window.location.href = "index.php";</script>';
    exit;
}
$amount=0;

$servername = "localhost"; // 数据库主机名
$username = "root"; // 数据库用户名
$password = "123456"; // 数据库密码
$dbname = "assignment2"; // 数据库名称
$port = "3306"; // 数据库端口号

// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// 检查连接是否成功
if (!$conn) {
    die("Fail: " . mysqli_connect_error());
}
echo "连接成功";

// 获取用户的电子邮件地址
$email = $_POST['email'];

// 查询用户在过去三个月内的租赁记录
$sql = "SELECT count(*) AS rental_count 
        FROM Renting_History 
        WHERE user_email = '$email' 
        AND rent_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 用户在过去三个月内有租车记录
    $row = $result->fetch_assoc();
    $rental_count = $row['rental_count'];
} else {
    // 用户在过去三个月内没有租车记录
    $rental_count = 0;
}

// 如果租赁费用为 0，则需要添加 200 美元的保证金
if ($rental_count == 0) {

    echo "you need to pay the bond because you have not already hired before" ;
} else{
    echo "congratulations There is no need to pay the bond because you have already hired before" ;
}

// 在结账页面显示租赁费用



//if ()
?>

<h1>Checkout</h1>
<li><a href="#" id="searchBtn" onclick="function jumpToCartPage2() {
    window.location.href = './list_carrt.php';} jumpToCartPage2()">Home</a></li>

<!--checkout- purchase- submit - thankyou -->
<form method="post" action="purchase.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Your Email:</label>
    <label for="email"><?php echo $email; ?></label>
    <input type="hidden" name="email" value="<?php echo $email; ?>">
<!--    $email-->
<!--    <input type="email" name="email" required>-->
    <br><br>

    <label for="address1">Address line 1:</label>
    <input type="text" id="address1" name="address1" required><br><br>

    <label for="address2">Address line 2:</label>
    <input type="text" id="address2" name="address2" required><br><br>

    <label for="address">phone:</label>
    <input type="tel" name="phone" pattern="^[0-9]{10}$" required>
    <br><br>

    <label for="country">country:</label>
    <input type="text" id="country" name="country" required><br><br>

    <label for="state">state:</label>
    <input type="text" id="state" name="state" required><br><br>

    <label for="suburb">suburb:</label>
    <input type="text" id="suburb" name="suburb" required><br><br>

    <label for="postCode">postCode:</label>
    <input type="text" id="postCode" name="postCode" required><br><br>

    <label for="payment_type">Payment Type:</label>
    <select id="payment_type" name="payment_type" required>
        <option value="credit_card">Credit Card</option>
        <option value="paypal">PayPal</option>
        <option value="cash_on_delivery">Cash on Delivery</option>
    </select><br><br>

    <?php
//    session_start();
//    foreach ($_SESSION['cart'] as &$itemextracted) {
//        $id = $itemextracted['id'];
//        echo $itemextracted['price'];
//
//    }
//    echo "1111111112";
//
//    foreach ($cartItems as $item) {
//        $itemId= $item['id'];
//        $brand = $item['brand'];
//        echo "1111111111";
//        echo $brand;
//    }

    if ($rental_count > 0) {
        // $rental_count += 200; // 如果需要执行这行代码，去除注释符号 //
//        echo $rental_count;

        echo "congratulations There is no need to pay the bond because you have already hired before." ;
    } else {

        echo "<label>you need to pay the bond because you have not already hired before.  </label>";
        echo '<label>You are required to pay $200</label>';
    }
    ?>




    <button type="submit" name="submit" value="booking" onclick="return validateForm();">Booking</button>
</form>
<button onclick="window.location.href='list_carrt.php';">Continue Selection</button>
</form>
<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var address = document.getElementById("address").value;
        var paymentType = document.getElementById("paymentType").value;

        if (name == "" || email == "" || address == "" || paymentType == "") {
            alert("All fields must be completed for the order to go ahead.");
            return false;
        }

        return true;
    }
//    检查表单
</script>

<script>
    // 获取所有“租赁天数”输入字段
    var daysFields = document.querySelectorAll('input[name^="days-"]');
    // 验证每个“租赁天数”输入字段的值
    for (var i = 0; i < daysFields.length; i++) {
        var days = parseInt(daysFields[i].value);
        if (isNaN(days) || days <= 0) {
            alert("Rental days must be an integer greater than zero.");
            daysFields[i].focus();
            break;
        }
    }
</script>
</body>
</html>
