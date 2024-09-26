<?php
    include('../includes/connect.php');

    // getting products
    function getProducts() {
        global $conn;

        if (isset($_GET['product_details']) && !empty($_GET['product_details'])) {
            $product_details = $_GET['product_details'];
            $select_query = "SELECT * FROM `products` WHERE `product_title` = '$product_details'";
            $result = mysqli_query($conn, $select_query);
            $row = mysqli_fetch_assoc($result);
            $product_id = $row['product_id'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_image2 = $row['product_image2'];
            $product_image3 = $row['product_image3'];
            $product_status = $row['status']? "Available" : "<del>Not Available</del>";
            $product_price = $row['product_price'];

            echo "<div class='container'>
                    <div class='row justify-content-center'>
                        <div class='col-md-8 mb-4'>
                            <div class='card'>
                                <div id='productCarousel$product_id' class='carousel slide' data-bs-ride='carousel'>
                                    <div class='carousel-inner'>
                                        <div class='carousel-item active'>
                                            <img src='product_images/$product_image1' class='d-block w-100' alt='$product_title'>
                                        </div>
                                        <div class='carousel-item'>
                                            <img src='product_images/$product_image2' class='d-block w-100' alt='$product_title'>
                                        </div>
                                        <div class='carousel-item'>
                                            <img src='product_images/$product_image3' class='d-block w-100' alt='$product_title'>
                                        </div>
                                    </div>
                                    <button class='carousel-control-prev' type='button' data-bs-target='#productCarousel$product_id' data-bs-slide='prev'>
                                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                        <span class='visually-hidden'>Previous</span>
                                    </button>
                                    <button class='carousel-control-next' type='button' data-bs-target='#productCarousel$product_id' data-bs-slide='next'>
                                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                        <span class='visually-hidden'>Next</span>
                                    </button>
                                </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'><strong>Status:</strong> $product_status</p>
                                    <p class='card-text'><strong>Price:</strong> $product_price$</p>
                                    <div class='text-center'>
                                        <a href='index.php?product_id=$product_id' class='btn btn-info'>Add to Cart</a>
                                        <a href='index.php' class='btn btn-secondary'>Go Home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            return 0;
        }


        $search_term = null;
        if (isset($_GET['search_term']) && isset($_GET['search']) && $_GET['search'] === 'search') {
            $search_term = mysqli_real_escape_string($conn, $_GET['search_term']);
        }

        if (isset($_GET['brand'])) {
            $brand_title = mysqli_real_escape_string($conn, $_GET['brand']);  
            $select_query = "SELECT * FROM `products` WHERE `brand_title` = '$brand_title'";
            if ($search_term) {
                $select_query .= " AND `product_keywords` LIKE '%$search_term%'";
            }
        }
        elseif (isset($_GET['category'])) {
            $category_title = mysqli_real_escape_string($conn, $_GET['category']);
            $select_query = "SELECT * FROM `products` WHERE `category_title` = '$category_title'";
            if ($search_term) {
                $select_query .= " AND `product_keywords` LIKE '%$search_term%'";
            }
        }
        else {
            $select_query = "SELECT * FROM `products`";
            if ($search_term) {
                $select_query .= " WHERE `product_keywords` LIKE '%$search_term%'";
            }
            $select_query .= " ORDER BY RAND()";
            if (!$search_term) {
                if (!isset($_GET['list_products'])) {
                    $select_query .= " LIMIT 0,9";
                }
            }
        }

        $result = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result);

        if ($num_of_rows == 0) {
            if (isset($_GET['brand'])) {
                echo "<h1 class='text-center text-danger'>No items in stock for $brand_title</h1>";
            }
            elseif (isset($_GET['category'])) {
                echo "<h1 class='text-center text-danger'>No items in stock for $category_title</h1>";
            }
            elseif ($search_term) {
                echo "<h1 class='text-center text-danger'>No matches found for '$search_term'</h1>";
            }
            else {
                echo "<h1 class='text-center text-danger'>No items available in Market</h1>";
            }
        }
        else {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_description = $row['product_description'];
                $product_title = $row['product_title'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];

                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'><strong>Price:</strong> $product_price$</p>    
                                <a href='index.php?product_id=$product_id' class='btn btn-info'>Add to Cart</a>
                                <a href='index.php?product_details=$product_title' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
            }
        }  
    }

    // Cart Function
    function cart() {
        if (!isset($_GET['product_id'])) return;

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            global $conn;
            $product_id = $_GET['product_id'];
            $username = $_SESSION['username'];
            $select_query = "SELECT * FROM `cart` WHERE `username` = '$username' AND `product_id` = '$product_id'";
            $result = mysqli_query($conn, $select_query);
            $num_of_rows = mysqli_num_rows($result);
            if ($num_of_rows == 0) {
                $insert_query = "INSERT INTO `cart` (`product_id`, `username`, `quantity`) VALUES ('$product_id', '$username', 1)";
                mysqli_query($conn, $insert_query);
                echo "<script>alert('Item added to your Cart Successfully'); window.open('index.php', '_self')</script>";
            } else {
                echo "<script>alert('This item is already present in your Cart'); window.open('index.php', '_self')</script>";
            }
        }
        else {
            echo "<script>alert('You have to log in in order to Add have a Cart.')</script>";
            echo "<script>window.location.href = 'login.php'</script>";
        }
    }

    // Update Cart Item
    function update_cart_item() {
        if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['update_cart']) && $_POST['update_cart'] == 'Update') {
            $product_id = htmlspecialchars($_POST['product_id']);
            $quantity = htmlspecialchars($_POST['quantity']);

            global $conn;
            $username = $_SESSION['username'];
            $update_query = "UPDATE `cart` SET `quantity` = '$quantity' WHERE product_id = $product_id AND username = '$username'";
            $result = mysqli_query($conn, $update_query);
            echo "<script>alert('Item Quantity Updated Successfully'); window.open('cart.php', '_self')</script>";
        }
    }

    // Delete Cart Item
    function delete_cart_item() {
        if (isset($_POST['product_id']) && isset($_POST['remove_item']) && $_POST['remove_item'] == 'Remove') {
            $product_id = htmlspecialchars($_POST['product_id']);

            global $conn;
            $username = $_SESSION['username'];
            $delete_query = "DELETE FROM `cart` WHERE product_id = $product_id AND username = '$username'";
            $result = mysqli_query($conn, $delete_query);
            echo "<script>alert('Item Deleted Successfully'); window.open('cart.php', '_self')</script>";
        }
    }

    // fetch number of entities user has in his cart
    function num_of_cart_entities() {
        global $conn;
        $username = $_SESSION['username'];
        $select_query = "SELECT * FROM `cart` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result);
        return $num_of_rows;
    }

    // fetch total price of items in cart
    function total_price_of_cart_items() {
        global $conn;
        $username = $_SESSION['username'];
        $select_query = "SELECT c.quantity, p.product_price FROM `cart` c 
                        JOIN `products` p ON c.product_id = p.product_id 
                        WHERE c.username = '$username'";
        $result = mysqli_query($conn, $select_query);
        $total_price = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $product_price = (int) $row['product_price'];
            $quantity = $row['quantity'];
            $total_price += $product_price * $quantity;
        }
        return $total_price;
    }

    // displaying cart items
    function get_cart_items() {
        global $conn;
        $username = $_SESSION['username'];
        $select_query = "SELECT * FROM `cart` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $select_query);
    
        $num_of_rows = mysqli_num_rows($result);
        if ($num_of_rows == 0) {
            echo "<h4 class='text-center text-danger'>Your Cart is Empty</h4>";
            echo "<a href='index.php' class='btn btn-info mx-auto d-block w-25'>Continue Shopping</a>";
            return 0;
        }
        
        echo "<table class='table table-bordered cart-table'>
                <thead class='bg-info'>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>";
    
        $total_price = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
    
            $product_query = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
            $product_result = mysqli_query($conn, $product_query);
            $product_row = mysqli_fetch_assoc($product_result);
    
            $product_title = $product_row['product_title'];
            $product_image1 = $product_row['product_image1'];
            $product_price = $product_row['product_price'];
    
            $item_total = $product_price * $quantity;
            $total_price += $item_total;
    
            echo "<tr>
                    <td>$product_title</td>
                    <td><img src='product_images/$product_image1' class='img-fluid' alt='$product_title' style='width: 50px;'></td>
                    <td>
                        <form id='update$product_id' method='POST' class='d-inline me-2'>
                            <input type='hidden' name='product_id' value='$product_id'>
                            <input type='number' name='quantity' value='$quantity' class='form-control' min='1'>
                        </form>
                    </td>
                    <td>$product_price$</td>
                    <td>$item_total$</td>
                    <td>
                        <div class='d-flex align-items-center'>
                            <input type='submit' form='update$product_id' name='update_cart' value='Update' class='btn btn-sm btn-info my-10'>
                            <form method='POST' class='ms-2'>
                                <input type='hidden' name='product_id' value='$product_id'>
                                <input type='submit' class='btn btn-sm btn-danger' name='remove_item' value='Remove'>
                            </form>
                        </div>
                    </td>
                </tr>";
        }
    
        echo "</tbody>
            </table>
            <div class='d-flex justify-content-between'>
                <h4>Total: $total_price$</h4>
                <div>
                    <a href='index.php' class='btn btn-info'>Continue Shopping</a>
                    <a href='checkout.php' class='btn btn-success'>Proceed to Checkout</a>
                </div>
            </div>";
    }  

    // displaying brands
    function getBrands() { 
        global $conn;
        $select_query = "SELECT * FROM `brands`";
        $result = mysqli_query($conn, $select_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $brand_title = $row['brand_title'];
            echo "<li class='nav-item'>
                    <a href='index.php?brand=$brand_title' class='nav-link text-light'>$brand_title</a>
                </li>";
        }
    }




    // displaying categories
    function getCategories() {
        global $conn;
        $select_query = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $select_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $category_title = $row['category_title'];
            echo "<li class='nav-item'>
                    <a href='index.php?category=$category_title' class='nav-link text-light'>$category_title</a>
                </li>";
        }
    }
?>