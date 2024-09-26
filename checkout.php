<?php
    include('includes/body_template_header.php');

    if (!isset($_SESSION['username'])) {
        header('location: login.php');
        exit();
    }

    $username = $_SESSION['username'];
    $total_price = total_price_of_cart_items();
?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Checkout Page</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Order Summary</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $cart_query = "SELECT * FROM `cart` WHERE username = '$username'";
                            $cart_result = mysqli_query($conn, $cart_query);
                            
                            while ($cart_row = mysqli_fetch_assoc($cart_result)) {
                                $product_id = $cart_row['product_id'];
                                $quantity = $cart_row['quantity'];
                            
                                $product_query = "SELECT product_title, product_price FROM `products` WHERE product_id = '$product_id'";
                                $product_result = mysqli_query($conn, $product_query);
                                $product_row = mysqli_fetch_assoc($product_result);
                            
                                $product_title = $product_row['product_title'];
                                $product_price = $product_row['product_price'];
                                $price = $product_price * $quantity;
                            
                                echo "<tr>
                                        <td>$product_title</td>
                                        <td>$quantity</td>
                                        <td>$$price</td>
                                    </tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total:</th>
                            <th>$<?php echo $total_price; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-6">
                <h3>Payment Details</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="card_number" name="card_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="card_holder" class="form-label">Card Holder Name</label>
                        <input type="text" class="form-control" id="card_holder" name="card_holder" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="expiry_date" class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </form>
            </div>
        </div>
    </div>

<?php
    include('includes/body_template_footer.php');
?>