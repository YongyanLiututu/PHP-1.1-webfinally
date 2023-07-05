<!DOCTYPE html>
<html>
<head>
    <title>Online Grocery Store</title>
    <link rel="stylesheet" href="style(3)(1).css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--    <! -- Introduce custom JavaScript files -->-->
    <script src="search.js"></script>
    <!--    <script src="script.js"></script>-->

</head>
<body>
<header class="header">
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <div class="header1">
        <h1 class="logo">UTS Grocery Store</h1>
    </div>
    <ul class="ul1">
        <li><a href="#" id="searchBtn">Search</a></li>
        <li><a href="./list_item.php" >Home</a></li>
        <li><a href="#" id="cartBtn">Cart</a></li>
    </ul>

    <! -- Search popovers -->
    <div id="searchModal" style="display:none;">
        <div class="pop-up">
            <span class="close">&times;</span>
            <h3>Search Products</h3>
            <form action="./search.php" method="get">
                <label for="min">Min Price:</label>
                <input type="number" id="min" name="min"  placeholder="Minimum..."  required step="0.1"  min="0">
                <p>
                <label for="max">Max Price:</label>
                <input type="number" id="max" name="max" placeholder="Maximum..."  required step="0.1"  min="0">
                <p>
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name"  placeholder="Enter name..." multiple  required>
                <p>

                <button type="submit" value="Search">Submit</button>
                <h6 class="h6">You can enter multiple product names to make fuzzy queries!! </h6>
            </form>
        </div>
    </div>
    <!--    购物车弹框-->
    <div id="cartModal" style="display:none;">
        <div class="pop-up">
            <span class="close">&times;</span>
            <h3>Shopping Cart</h3>
            <!-- A table showing shopping cart item information -->
            <table>
                <thead>
                <tr>
                    <th>Name</th> <th>Quantity</th> <th>Price</th><th>Total</th>
                </tr>
                </thead>
                <tbody id="cart-items">
                <!-- JavaScript is used here to dynamically generate rows of shopping cart item information -->
                </tbody>
            </table>

            <!-- An element that displays the total shopping cart price -->
            <p class="goods-price" id="cart-content1"></p>

            <!-- 表单用于清空购物车 -->
            <form  method="post" action="clear_cart.php">
                <input type="hidden" name="session_id" value="<?php echo session_id(); ?>">
                <button type="submit">Empty the cart</button>
            </form>

            <!-- 操作按钮 -->
            <button type="button" onclick="editCart()">Edit the cart</button>
            <?php session_start() ?>
            <button type="button" onclick="submitOrder()" <?php if(empty($_SESSION['cart'])) { echo 'disabled'; } ?>>Check out</button>

        </div>
    </div>

    <!--            // TODO: [Order pop-up]-->
    <div id="orderModal" style="display:none;">
        <div class="pop-up4">
            <span class="close">&times;</span>
            <h3>Order</h3>
            <form id="order-form" method="post" action="submit_order.php">
                <ul>
                    <li><label class="order-label">Delivery name: </label> <span class="red">*</span></li>
                    <li>  <input class="order-input" type="text" name="name" placeholder="name" required></li>
                    <p>
                    <li><label class="order-label">Email address: </label><span class="red">*</span> </li>
                    <li>  <input  class="order-input" type="email" name="email" placeholder="email address" required></li>
                    <p>
                    <li> <label class="order-label">Phone number: </label><span class="red">*</span></li>
                    <li> <input class="order-input" type="tel" name="phone" placeholder="phone number" required> </li>
                    <p>
                    <li> <label class="order-label">Suburb : </label><span class="red">*</span></li>
                    <li> <input class="order-input" type="suburb" name="suburb" placeholder="suburb" required> </li>
                    <p>
                    <li> <label class="order-label">State : </label><span class="red">*</span></li>
                    <li> <input class="order-input" type="state" name="state" placeholder="state" required> </li>
                    <p>
                    <li> <label class="order-label">Country : </label><span class="red">*</span></li>
                    <li> <input class="order-input" type="country" name="country" placeholder="country" required> </li>
                    <p>
                    <li><label class="order-label">Delivery address: </label> <span class="red">*</span></li>
                    <li> <textarea class="order-address" name="address" placeholder="local address" required></textarea> </li>
                    <p>
                </ul>
                <button class="order-button" type="submit" onclick="return validateDelivery()">Submit the order and send an email</button>
<!--                Text field input-->
            </form>
            </form>
        </div>
    </div>
    <script>

        function validateDelivery() {
            var name = document.forms["order-form"]["name"].value;
            var email = document.forms["order-form"]["email"].value;
            var phone = document.forms["order-form"]["phone"].value;
            var address = document.forms["order-form"]["address"].value;

            // Check whether required fields are empty
            if (name == "" || email == "" || phone == "" || address == "") {
                alert("Please fill in all required fields");
                return false;
            }

            // Check that the email format is correct
            if (!validateEmail(email)) {
                alert("Please enter a valid email address");
                return false;
            }

          // return name,email,phone,address;
            return true;
        }

        function validateEmail(email) {
            // Simple email format validation
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function redirectToOrderConfirmation() {
// submit the form using the JavaScript submit() method
            document.getElementById('order-form').submit();

        }

        function submitOrder() {
            // First close the shopping cart popup
            var cartModal = document.getElementById("cartModal");
            cartModal.style.display = "none";
            var orderModal = document.getElementById("orderModal");
            orderModal.style.display = "block";
//             // Get the pop-up element
//             var modal = document.getElementById("cartModal");
// // Look for the close button element in the pop-up box
//             var closeBtn = modal.querySelector(".close");
//             closeBtn.addEventListener("click", function() {
//     modal.style.display = "none";
//             });
            // 在当前窗口中显示在线订单表单
            // window.location.href = "checkout.php";

            // 或者在新窗口中打开订单表单
            // window.open("checkout.php");
        }
        // Listen for the submit button click event
        cartForm.addEventListener('submit', e => {
            e.preventDefault();
            submitCartForm();
        });

        // 初始化
        updateCart();
    </script>
    <?php
    // Suppose you have an array named $categories that contains all the category information in the store.
    // 格式为 array("top-level-1" => array("sub-level-1", "sub-level-2", ...), "top-level-2" => array("sub-level-1", "sub-level-2", ...), ...)
    $categories = array(

        "Meat & Poultry" => array("Steak (1)", "Pork (0)", "Chicken (0)"),
        "Seafood" => array("Fish (2)", "Shellfish (0)", "Prawn (1)"),
        "Fruit" => array("Bananas (1)", "Oranges (1)", "Peaches (1)", "Grapes (1)", "Apples (1)"),
        "Snacks " => array("Chocolate (1)", "Patties (1)", "Ice Cream (2)", "Cheese (2)"),
        "Beverages" => array("Tea (3)", "Coffee (2)", "Beer (0)"),
        "Home-Health" => array("Medicine (2)", "Soap (1)", "Garbage Bags (1)", "Powder (1)", "Bleach (1)"),
        "Pet-Food" => array("Dog Food (2)", "Bird Food (1)", "Cat Food (1)", "Aquatic animal feed (1)")
    );
    ?>
</header>
<div class="container">
    <div id="sidebar">
        <nav>
            <ul>
                <?php
                //  through the top-level category
                foreach ($categories as $topLevel => $subLevels) {
                    // 1
                    echo "<li><a href='#'>" . $topLevel . "</a>";
                    // Create a drop-down menu
                    echo "<ul class='categropies'>";
//                    var select = document.getElementById($categories);
                    // 2
                    foreach ($subLevels as $subLevel) {

                        $pattern = "/([A-Za-z]+)/";  // 大写字母
//                        var pattern = /[A-Z]/g; 
//                        var matches = str.match(pattern);
                        preg_match($pattern, $subLevel, $matches);
                        if (count($matches) > 1) {
                            $result = $matches[1]; // The matched letter is stored in the second element of the array $matches
                        }
                        
                        
                        
                        
                        // 2!!

//                        $string = "Shellfish (0) is a delicious seafood.";
                        preg_match('/\((\d+)\)/', $subLevel, $matches);
                        $number = $matches[1];
//                        echo $number; // 输出 0
                        if ($number==0){
echo "<li><a href='./categoriesDBsearch.php?category=" . urlencode($result) . "' class='disabled'>" . $subLevel . "</a></li>";

                        }else{
                            echo "<li><a href='./categoriesDBsearch.php?category=" . urlencode($result) . "'>" . $subLevel . "</a></li>";

                        }
                    }
//                    menu.classList.toggle("show");
//                    menu.classList.remove("show");
//                    menu.classList.remove("ul");
//                    menu.classList.remove("li");
                    echo "</ul>";
                    echo "</li>";
                }
                ?>
            </ul>
        </nav>
    </div>
    <div class="main-content" id="mainContent">
        <div id="content">
            <?php
            //if (!defined('APP')) die('You must error out');
            if (!empty($itemList)) {
                foreach ($itemList as $item) {
//                    echo "$item[product_name]";
                    $itemID = 'goods-' . $item['product_id'];
                    ?>
                    <div id="<?php echo $itemID; ?>" class="goods-box">
                        <img src="./photo/<?php echo $item['photo']; ?>.png" alt="Item 1"  onclick="details('<?php echo "/photo/".$item['photo']; ?>', '<?php echo $item['product_name']; ?>', '<?php echo $item['unit_price']; ?>', '<?php echo $item['unit_quantity']; ?>', '<?php echo $item['in_stock']; ?>', '<?php echo $item['description']; ?>', this.nextElementSibling)">
                        
                        <p1 class="goods-name" onclick="details('<?php echo "/photo/".$item['photo']; ?>', '<?php echo $item['product_name']; ?>', '<?php echo $item['unit_price']; ?>', '<?php echo $item['unit_quantity']; ?>', '<?php echo $item['in_stock']; ?>', '<?php echo $item['description']; ?>',document.getElementById('quantity-Input'))"> <?php echo $item['product_name']; ?>
                        </p1>

                        <p class="goods-price">Price: <?php echo $item['unit_price']; ?>
                        </p>
                        <p class="goods-quantity">Quantity: <?php echo $item['unit_quantity']; ?>
                        </p>
                        <p class="goods-in_stock">In_stock: <?php echo $item['in_stock']; ?>
                        </p>

                        <p class="goods-detail">Description: <?php echo $item['description']; ?>
                        </p>
                        <button class="quantity-btn" onclick="decreaseQuantity('<?php echo $item['product_id']; ?>')">
                            -
                        </button>
                        <input type="number" min="1" max="99" class="quantity-input" value="1"
                               id="quantity-<?php echo $item['product_id']; ?>" required>
                        <button class="quantity-btn" onclick="increaseQuantity('<?php echo $item['product_id']; ?>')">
                            +
                        </button>
                        <button class="addcart"
                                onclick="addToCart('<?php echo $item['unit_price']; ?>', document.querySelector('#quantity-<?php echo $item['product_id']; ?>').value, '<?php echo $item['product_name']; ?>', 'type')">
                            Add to cart
                        </button>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="no-goods-box">
                    There is no such item, you can modify the screening criteria!!
<!--                    <img src="item1.png" alt="Item 1" onclick="details()">-->
<!--                    <p1 class="goods-name" onclick="details()">no item here</p1>-->
<!--                    <p class="goods-price"></p>-->
<!--                    <p class="goods-price"></p>-->
<!--                    <p class="goods-detail"></p>-->
                </div>
                <?php
            }
            ?>
        </div>
        <!-- 显示购物车内容的 HTML 元素 -->
<!--        <button onclick="update1()"> test</button>-->
        <p class="goods-price" id="cart-content1"></p>
    </div>
</div>

<img src="icon.png" alt="Cart" class="icon" id="cartBtn1">
<! -- Add shopping cart tubiao -->
</div>




<div id="itemDetailsModal" class="modal">
    <div class="pop-up3">

        <span class="close" onclick="closeModal()">&times;</span>
<!--        <p>So here's what the popover is...</p>-->
        <img  class="goods-img"  src="./photo/<?php echo $item['photo'].png; ?>.png" alt="Item 1">
        <p1 class="goods-name1" ><?php echo $item['product_name']; ?></p1>
        <p class="goods-price">Price: <?php echo $item['unit_price']; ?></p>
        <p class="goods-quantity">Quantity: <?php echo $item['unit_quantity']; ?></p>
        <p class="goods-in_stock">Stock: <?php echo $item['in_stock']; ?></p>
        <p class="goods-detail">Description: <?php echo $item['description']; ?></p>
        <button class="quantity-btn" onclick="decreaseQuantity('Input')">
            -
        </button>
        <input type="number" min="1" max="99" class="quantity-input1" value="1"
               id="quantity-Input">

        <button class="quantity-btn" onclick="increaseQuantity('Input')">
            +
        </button>

        <button class="addcart" onclick="addToCart('<?php echo $item['unit_price']; ?>', document.querySelector('quantity-Input').value, '<?php echo $item['product_name']; ?>', 'type')">
            Add to cart
        </button>
        <img src="icon.png" alt="Cart" class="icon" id="cartBtn1">
    </div>
</div>

<script>
    // 获取所有的导航栏列表项
    var menuItems = document.querySelector(".sidebar li");
    // 循环遍历每个列表项
    // const navItems = document.querySelectorAll('.nav-item')
    // const subMenus = document.querySelectorAll('.nav-item .sub-menu');
    // subMenus.forEach(subMenu => {
    //     subMenu.style.display = 'none';
    // });
    menuItems.forEach(function (menuItem) {
        // 获取子菜单
        var subMenu = menuItem.querySelector('.categropies');
        // 如果子菜单存在，则将其隐藏
        if (subMenu) {
            subMenu.style.display = 'none';


            // Add a click event listener to show/hide the submenu
            menuItem.addEventListener('click', function (event) {
                // Disable default behavior
                // event.preventDefault();
               // Walk through all the navigation bar list items
                menuItems.forEach(function (item) {
                    // 获取其子菜单
                    var submenu = item.querySelector('.categropies');
                    // navItems.forEach(navItem => {
                    //     const subMenu = navItem.querySelector('.sub-menu');
                    //     if (subMenu) {
                    //         subMenu.style.display = 'none';
                    //     }
                    // });
                    if (submenu) {
                        submenu.style.display = 'none';
                    }
                });
                // Displays a submenu for the current list item
                subMenu.style.display = 'block';
            });
        }
    });
</script>
<script>
    var deleteButton = document.querySelector(".add-to-cart-btn");
    // Add a click event listener for the Delete button
    deleteButton.addEventListener("click", function () {
        // A confirm deletion dialog box is displayed
        var confirm = confirm("Are you sure you want to delete this item?");
        if (confirm) {
            // If the user confirms the deletion, perform the deletion operation
            console.log("ok")
        }
    });

    function increaseQuantity(productId) {
        const input = document.querySelector('#quantity-' + productId);
        const currentValue = parseInt(input.value);
        if (currentValue < parseInt(input.max)) {
            input.value = currentValue + 1;
        }
    }

    function decreaseQuantity(productId) {
        const input = document.querySelector('#quantity-' + productId);
        const currentValue = parseInt(input.value);
        if (currentValue > parseInt(input.min)) {
            input.value = currentValue - 1;
        }
    }



        function addToCart(unitprice, quantity, name) {
            console.log(quantity);
            if (quantity > 20) {
                alert("The quantity of each order cannot exceed 20. Please reduce the quantity of your order.");
                // var inputBox = document.getElementById("quantity-"+label);
                var inputBoxes = document.getElementsByClassName("quantity-input");

                for (var i = 0; i < inputBoxes.length; i++) {
                    inputBoxes[i].value = "1";
                }

                // Sets the value of the input box to an empty string
                // inputBox.value = "1";
                return;
            }

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Gets the latest shopping cart content and displays it in the shopping cart content element
                    updateshoppcart(this.responseText);
                    var input = document.getElementById("cart-content1");
                    // var_dump($itemList);
                }
            };
            xhttp.open("POST", "add-to-cart.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(JSON.stringify({unitPrice: unitprice, quantity: quantity, name: name}));
        }




    // A function to update the contents of the shopping cart
    function updateshoppcart(cartData) {

        // var element = document.getElementById("cart-content1");
        // // while (element.firstChild) {
        // //     element.removeChild(element.firstChild);
        // // }
        var shoppcart = document.getElementById("cart-content1");
        shoppcart.innerHTML = '';


        if (cartData.length > 0) {
            console.log("updateshoppcart");
            // console.log(cartData1);
            var total = 0;
            var cartItems = JSON.parse(cartData);
            // console.log(cartItems[1].id);
            for (var i = 0; i < cartItems.length; i++) {
                // 创建每个购物车项的 HTML 元素并添加到购物车内容元素中
                var cartItem = document.createElement("div");
                // cartItem.style.display = "flex";
                // cartItem.style.flexDirection = "row";
                // cartItem.style.justifyContent = "space-between";
                // cartItem.style.alignItems = "center";
                // cartItem.style.padding = "5px";
                // cartItem.style.borderBottom = "1px solid #ccc";
                var subtotal = cartItems[i].quantity * cartItems[i].unitPrice;
                cartItem.textContent = cartItems[i].name + "      " + cartItems[i].quantity + "       " + cartItems[i].unitPrice + "      " + subtotal;

                shoppcart.appendChild(cartItem);
                var total = total + subtotal;
            }
        } else {
            // If the cart is empty, the corresponding message is displayed
            var emptyCartMsg = document.createElement("div");
            emptyCartMsg.textContent = "Shopping cart is empty";
            shoppcart.appendChild(emptyCartMsg);
        }
        var totaldiv = document.createElement("div");
        totaldiv.textContent = "Total price           $" + total;
        shoppcart.appendChild(totaldiv);
        // Add a scroll bar to allow the user to scroll through the cart contents
        shoppcart.style.overflowY = "scroll";
        shoppcart.style.maxHeight = "300px"; // Adjust the maximum height of the shopping cart content element
        header('Location: ./list_item.php');
        exit;
    }

    // Gets the latest shopping cart content when the page loads and displays it in the shopping cart content element
    function update1() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                updateshoppcart(this.responseText);
            }
        };
        xhttp.open("GET", "get-cart.php", true);
        xhttp.send();
    };


</script>
<script>

    $(document).ready(function () {
        $("#cartBtn").click(function () {
            $("#cartModal").fadeIn();
            update1();
        });
        $("#cartBtn1").click(function () {
            $("#cartModal").fadeIn();
            update1();
        });
        $("#orderBtn").click(function () {
            $("#orderModal").fadeIn();
        });

        $(".close").click(function () {
            $("#cartModal").fadeOut();
            $("#orderModal").fadeOut();
        });
    });


    function details(photo, name, unitPrice, unitQuantity, inStock, description,input) {
        // var modal = document.getElementById('itemDetailsModal');
        console.log(inStock);

        var modal = document.getElementById('itemDetailsModal');
        // var img = modal.querySelector(".goods-img");
        // img.onload=function () {
        //
        // }
        console.log(photo);
        modal.querySelector(".goods-img").src="." +photo+".png";
        //modal.querySelector(".goods-img").src="./photo/<?php //echo $item['photo']; ?>//.png";
        modal.querySelector(".goods-name1").textContent=name;
        modal.querySelector(".goods-price").textContent="Price: " + unitPrice;
        modal.querySelector(".goods-quantity").textContent="Quantity: " + unitQuantity;
        modal.querySelector(".goods-in_stock").textContent="In_stock: " + inStock;
        modal.querySelector(".goods-detail").textContent="Description: " + description;

        // The passed quantityInput element is passed as an argument to the addToCart() function
        var addCartBtn = modal.querySelector('.addcart');
        addCartBtn.setAttribute('onclick', "addToCart('" + unitPrice + "', " + input.value+ ", '" + name + "', 'type')");

        var modalContent = modal.querySelector('.pop-up3');
        modalContent.style.display = 'block';
        modal.style.display = 'block';
        console.log("Popover is displaye");
    }



  
    function closeModal() {
        var modal = document.getElementById('itemDetailsModal');
        modal.style.display = 'none';
    }
    // function details1() {
    //     var modal = document.createElement('div');  // 创建div元素
    //     modal.classList.add('pop-up3');  // 为div元素添加样式
    //     document.body.appendChild(modal);  // 将div元素添加到body中
    //     modal.style.display = 'block';  // 显示弹窗
    // }
    // Hide the popover
    function closeModal1() {
        var modal = document.getElementById('itemDetailsModal');
        modal.style.display = 'none';
    }
    // Close the popover when the user clicks on an area other than the popover
    window.onclick = function(event) {
        var modal = document.getElementById('itemDetailsModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }



    document.getElementById("max").addEventListener("input", function () {
        var max = parseFloat(this.value); 
        var minInput = document.getElementById("min"); 
        var min = parseFloat(minInput.value); 
        if (max <= min) {
            minInput.setCustomValidity("Please fill in a number greater than the minimum value");
        } else {
            minInput.setCustomValidity("");
        }
    });

    document.getElementById("min").addEventListener("invalid", function (event) {
        var minInput = document.getElementById("min");
        minInput.setCustomValidity("Please enter the lowest price");
    });


    const icon = document.querySelector('.icon');
    let isMouseDown = false;
    let offsetX = 0;
    let offsetY = 0;

    icon.addEventListener('mousedown', (event) => {
        isMouseDown = true;
        offsetX = event.clientX - icon.offsetLeft;
        offsetY = event.clientY - icon.offsetTop;
    });

    document.addEventListener('mousemove', (event) => {
        if (isMouseDown) {
            icon.style.left = (event.clientX - offsetX) + 'px';
            icon.style.top = (event.clientY - offsetY) + 'px';
        }
    });

    document.addEventListener('mouseup', (event) => {
        isMouseDown = false;
    });


</script>

</body>
</html>

