<?php

require 'D:\31748Assignment2\Assignment5.3\PHPMailer.php';
require 'D:\31748Assignment2\Assignment5.3\SMTP.php';
require 'D:\31748Assignment2\Assignment5.3\Exception.php';
$servername = "localhost"; // 数据库主机名
$username = "root"; // 数据库用户名
$password = "123456"; // 数据库密码
$dbname = "assignment2"; // 数据库名称
$port = "3306"; // 数据库端口号

// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// 检查连接是否成功
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
echo "连接成功";
$current_time = date('Y-m-d H:i:s');

$data = '';
file_put_contents('cart_data.json', json_encode($data));

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    echo $email;


    $sql = "INSERT INTO Renting_History (user_email, rent_date, bond_amount) 
        VALUES ('$email', '$current_time', 200)";
    if ($conn->query($sql) === TRUE) {
        session_start();
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        } else {

            header('Location: ./index.php');
        }

        if (isset($_POST['address'])) {
            $address = $_POST['address'];
        } else {

            header('Location: ./index.php');
        }
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
        } else {

            header('Location: ./index.php');
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } else {

            header('Location: ./index.php');
        }

        if (isset($_POST['suburb'])) {
            $suburb = $_POST['suburb'];
        } else {

            header('Location: ./index.php');
        }
        if (isset($_POST['state'])) {
            $state = $_POST['state'];
        } else {

            header('Location: ./index.php');
        }
        if (isset($_POST['country'])) {
            $country = $_POST['country'];
        } else {

            header('Location: ./index.php');
        }
//use PHPMailer\PHPMailer\PHPMailer();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
// 创建一个 PHPMailer 实例
        if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {

            echo 'PHPMailer class is not loaded';
            exit;
        }
        $mail->isSMTP();
        $mail->Host = 'smtp.qq.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = '1109552635@qq.com';
        $mail->Password = 'qbkvkzuvamiyjjfe';
        $mail->setFrom('1109552635@qq.com', 'yongyan liu');
        $mail->addAddress("$email", "$name");
        function cost($cart)
        {
            $total_cost = 0;
            foreach ($cart as $item) {

                $item_cost = $item['price_per_day'] * $item['days'];
                $total_cost += $item_cost;
            }
            return $total_cost;
        }

        $cartItems = isset($_SESSION['cars']) ? $_SESSION['cars'] : [];


        $mail->Subject = 'Order Confirmation';
        $mail->Body = 'Hi! Dear ' . $name . "\r\n" .
            'Thank you for placing an order in our uts online store!!!' . "\r\n" .
            'Our store pursues 100% high-quality products and hopes to get your satisfactory feedback!!' . "\r\n" .
            $mail->Body .= '-----------------------------' . "\r\n" .
                'Phone: ' . $phone . "\r\n" .
                'Email: ' . $email . "\r\n" .
                'Suburb: ' . $suburb . "\r\n" .
                'State: ' . $state . "\r\n" .
                'Country: ' . $country . "\r\n" .
                'Address: ' . $address . "\r\n" .
                '-----------------------------------' . "\r\n";
        '-----------------------------------' . "\r\n";
        echo 'qqqqqqqqqqqqqqqqqqqqqqqq';

        foreach ($cartItems as $item) {
            $category = $item['category'];
            $brand = $item['brand'];
            $model = $item['model'];
            $year = $item['year'];
            $itemId= $item['id'];
            $price_per_day = $item['price_per_day'];
            $days = 1;
            $itemCost = $price_per_day * $days;
            $mail->Body .= 'category: ' . category . "\r\n" .
                'brand: ' . $brand . "\r\n" .
                'model: ' . $model . "\r\n" .
                'year: ' . $year . "\r\n" .
                'price_per_day: ' . $price_per_day . "\r\n" .
                'Item Cost: $' . $itemCost . "\r\n" .
                '-----------------------------------' . "\r\n";
        }
        $total_cost = cost($_SESSION['cart']);
        echo 'Total Cost: ' . $total_cost;
        $mail->Body .= 'Total Cost: $' . $total_cost . "\r\n";
        if (!$mail->send()) {
            echo 'Fail!';
            echo 'Error message：' . $mail->ErrorInfo;
//    header('Location: ./thankyouPage.php');
        } else {
            echo 'success!';

            // 更新 cars.json 文件中的预订项目为不可用
            $carsData = file_get_contents('cars1.json');
            $cars = json_decode($carsData, true);

            foreach ($_SESSION['cart'] as &$itemextracted) {
                foreach ($cars['cars'] as &$car) {
                    if ($car['category'] == (string)$itemextracted['category']) {
                        $car['availability'] = false;

                    }
                }
 }

           


//            // 将更新后的数据保存回 cars.json 文件
//            $updatedCarsData = json_encode($cars, JSON_PRETTY_PRINT);
//            file_put_contents('cars.json', $updatedCarsData);
            // 清空会话中的所有数据
            session_unset();
// 销毁会话
            session_destroy();

            // 将更新后的数据保存回 cars.json 文件
            header('Location: thankyouPage.php');



        }
    }
//    插入失败操作
    else {
        echo "insert failed";
    }
}

?>

