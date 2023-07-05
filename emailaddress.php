<!DOCTYPE html>
<html>
<head>
    <title>Text Box Example</title>
</head>
<body>
<form action="checkout.php" method="POST">
    <label for="name">Please enter your email here to check whether you have booked before</label>

    <br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();


?>