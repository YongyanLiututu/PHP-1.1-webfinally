<!DOCTYPE html>
<html>
<head>
    <title>Car Rental System</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- 引入自定义的 JavaScript 文件 -->
<!--    <script src="search.js"></script>-->
    <!--    <script src="script.js"></script>-->

</head>
<body>
<!--头部文件-->
<header class="header">
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <div class="header1">
        <h1>Hertz-UTS</h1>
    </div>
    <ul class="ul1">
        <li><a href="#" id="searchBtn">Search</a
            ></li>
        <li><a href="#" id="searchBtn" onclick="function jumpToCartPage2() {
    window.location.href = './list_carrt.php';} jumpToCartPage2()">Home</a></li>

        <li>
            <a href="#" onclick="function jumpToCartPage() {
    window.location.href = 'shopping-cart.php';
  }
  jumpToCartPage()">Reserve
            </a>
        </li>


    </ul>
</header>
<boby>
    <!--    searchModal弹框-->
    <div id="searchModal" style="display:none;">
        <div class="pop-up">
            <span class="close">&times;</span>
            <h3>Search Products</h3>
            <form action="./search.php" method="get">
                <table class="table">
                    <tr class="tr1">
                    <td class="label1"> <label for="min">Min price_per_day :</label></td>

                    <td class="td1"><input type="number" id="min" name="min"  placeholder="Minimum..."  required step="0.1"  min="0"></td>
                    </tr>

                    <tr class="tr1">
                    <td class="label1"><label for="max">Max price_per_day :</label></td>
                    <td class="td1"><input type="number" id="max" name="max" placeholder="Maximum..."  required step="0.1"  min="0"></td>
                    </tr>
<!--                    年限-->
                    <tr class="tr1">
                        <td class="label1"> <label for="min">Min years :</label></td>

                        <td class="td1"><input type="number" id="min" name="minyears"  placeholder="Minimum..."  required step="0.1"  min="0"></td>
                    </tr>

                    <tr class="tr1">
                        <td class="label1"><label for="max">Max years :</label></td>
                        <td class="td1"><input type="number" id="max" name="maxyears" placeholder="Maximum..."  required step="0.1"  min="0"></td>
                    </tr>

                    <tr class="tr1">
                    <td class="label1""> <label for="name">Fuel_type :</label>

                    <td class="td1"> <input type="text" id="name" name="fuel_type" list="fuel-options" placeholder="fuel_type" multiple  required>
                        <datalist id="fuel-options">
                            <option value="Gasoline">
                            <option value="Diesel">
                            <option value="Electric">

                        </datalist>
                    </td>
                    </tr>

                    <button type="submit" value="Search">Submit</button>
<!--                <h6 class="h6">You can enter multiple product names to make fuzzy queries!! </h6>-->
                    </table>
            </form>
        </div>
    </div>
<!--    主体-->
    <div class="main-content" id="mainContent">
        <div id="content">
<!--            --><?php
//
//                $json_data = file_get_contents("./cars.json");
//                $cars_array = json_decode($json_data, true);
//
//
//            ?>
            <?php
            if (!empty($cars_array)) {
            foreach ($cars_array['cars'] as $item): ?>
                    <div id="<?php echo $item['id']; ?>" class="goods-box">
                        <img src="<?php echo $item['image_url']; ?>" alt="Item 1"  onclick="details('<?php echo "./photo/".$item['photo']; ?>', '<?php echo $item['product_name']; ?>', '<?php echo $item['unit_price']; ?>', '<?php echo $item['unit_quantity']; ?>', '<?php echo $item['in_stock']; ?>', '<?php echo $item['description']; ?>', this.nextElementSibling)">

                        <p1 class="goods-name" onclick="details('<?php echo "./photo/".$item['image_url']; ?>', '<?php echo $item['product_name']; ?>', '<?php echo $item['unit_price']; ?>', '<?php echo $item['unit_quantity']; ?>', '<?php echo $item['in_stock']; ?>', '<?php echo $item['description']; ?>',document.getElementById('quantity-Input'))"> <?php echo $item['product_name']; ?>
                        </p1>


                        <p class="goods-price"><?php echo $item['brand'] . '-' . $item['model']. '-' .$item['year']; ?>
                        </p>
                        <p class="goods-quantity"><span class="title">Mileage : </span><?php echo $item['mileage']; ?>
                        </p>
                        <p class="goods-in_stock"><span class="title">Fuel_type : </span> <?php echo $item['fuel_type']; ?>
                        </p>
                        <td>
                            <p class="goods-detail"><span class="title">Seats : </span><?php echo $item['year']; ?>

                            <p class="goods-detail"><span class="title">Years : </span> <?php echo $item['seats']; ?>
                        </td>
                        </p>
                        <p class="goods-detail1"><span class="title">Price_per_day : </span><?php echo $item['price_per_day']; ?>
                        </p>
                        <p class="goods-detail1"><span class="title">Availability : </span> <?php echo  ($item['availability'] ? "true" : "false");
                            ?>
                        </p>
                        <p class="goods-detail2"><span class="title">Description : </span><?php echo $item['description']; ?>
                        </p>

                        <hr class="divider">

                        <button class="addcart <?php echo ($item['availability'] ? "true" : "false"); ?>"
                                onclick="addToShoppingCart('<?php echo $item['image_url']; ?>','<?php echo $item['brand']; ?>',
                                        '<?php echo $item['model']; ?>',
                                        '<?php echo $item['year']; ?>',
                                '<?php echo  ($item['availability'] ? "true" : "false"); ?>',
                                '<?php echo $item['price_per_day']; ?>',
                                        '<?php echo $item['id']; ?>',
                                        'type');location.reload();">
                            Add to cart
                        </button>


                    </div>
            <?php endforeach; ?>
            <?php

            } else {
                ?>
                <div class="no-goods-box">
<!--                    There is no such item, you can modify the screening criteria!!-->
                </div>
                <?php
            }
            ?>
        </div>
        <!-- 显示购物车内容的 HTML 元素 -->
        <!--        <button onclick="update1()"> test</button>-->
        <p class="goods-price" id="cart-content1" ></p>
    </div>
    </div>


    <img src="icon.png" alt="Cart" class="icon" id="cartBtn1" onclick="function jumpToCartPage1() {
    function extracted(){
     window.location.href = 'shopping-cart.php';

} extracted();
  }
 jumpToCartPage1()">

</boby>
</body>
</html>
<script>
    $(document).ready(function () {
        // Listen for the search button click event
        $("#searchBtn").click(function () {
            // Display search popover

            $("#searchModal").fadeIn();
        });

        // Listen for popover close button click event
        $(".close").click(function () {
            // Hide the search popover
            $("#searchModal").fadeOut();
        });
    });
    
 <?php   
    
    $cartItems = json_decode(file_get_contents('cart_data.json'), true);
    $jsonData = json_encode($cartItems);
    ?>
    var cartData = <?php echo $jsonData; ?>;
    function addToShoppingCart(img, brand, model, year, availability, price, id) {
        // console.log($cartItems);
        console.log("img");
        console.log(availability);
        var days = 0;
        if (availability == "false") {
            console.log("false");
            alert("This car is not available for rental.");
            return;
        }

        var cartData = JSON.parse('<?php echo $jsonData; ?>');
        console.log("111111111111111");
        console.log(cartData);
        console.log(id);
        for (var i = 0; i < cartData.length; i++) {
            // console.log(c);
            if (cartData[i].id === id) {
                console.log(cartData[i].id);
                alert("This vehicle information has been added to the shopping cart, and you can change the scheduled time in the shopping cart!!");
                return;
            }
        }


        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // 更新购物车页面的内容
                updateShoppingCartContent();
            }
        };
        xhttp.open("POST", "add-to-cart.php", true);
        xhttp.setRequestHeader("Content-type", "application/json");
        xhttp.send(JSON.stringify({ img: img, brand: brand, model: model, year: year, price: price, id: id, days: "1" }));
    }

    function updateShoppingCartContent() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // 更新购物车页面的内容
                var cartContent = document.getElementById("cart-content");
                cartContent.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "shopping-cart.php", true);
        xhttp.send();
    }


</script>

