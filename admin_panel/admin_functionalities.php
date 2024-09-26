<?php
    function listUsers() {
        if (isset($_GET['list_users']) && isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
            global $conn;
            $select_query = 'SELECT * FROM `users`';
            $result = mysqli_query($conn, $select_query);

            echo "<table class='table table-bordered cart-table'>
                <thead class='bg-info'>
                    <tr>
                        <th>User Id</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Remove User</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['user_id'];
                $email = $row['email'];
                $username = $row['username'];
                $password = $row['password'];
                echo "<tr>
                        <td>$id</td>
                        <td>$email</td>
                        <td>$username</td>
                        <td>$password</td>
                        <td><a href='index.php?delete_user=$id' class='btn btn-sm btn-danger'>Remove</a></td>
                    </tr>";
            }
            echo "</tbody></table>";
            
        }
    }

    function viewCategories() {
        if (isset($_GET['view_categories']) && isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
            global $conn;
            $select_query = 'SELECT * FROM `categories`';
            $result = mysqli_query($conn, $select_query);

            echo "<table class='table table-bordered cart-table'>
                <thead class='bg-info'>
                    <tr>
                        <th>Category Id</th>
                        <th>Category Title</th>
                        <th>Remove Category</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['category_id'];
                $title = $row['category_title'];
                echo "<tr>
                        <td>$id</td>
                        <td>$title</td>
                        <td><a href='index.php?delete_category=$id' class='btn btn-sm btn-danger'>Remove</a></td>
                    </tr>";
            }
            echo "</tbody></table>";
            
        }
    }

    function viewBrands() {
        if (isset($_GET['view_brands']) && isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
            global $conn;
            $select_query = 'SELECT * FROM `brands`';
            $result = mysqli_query($conn, $select_query);

            echo "<table class='table table-bordered cart-table'>
                <thead class='bg-info'>
                    <tr>
                        <th>Brand Id</th>
                        <th>Brand Title</th>
                        <th>Remove Brand</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['brand_id'];
                $title = $row['brand_title'];
                echo "<tr>
                        <td>$id</td>
                        <td>$title</td>
                        <td><a href='index.php?delete_brand=$id' class='btn btn-sm btn-danger'>Remove</a></td>
                    </tr>";
            }
            echo "</tbody></table>";
            
        }
    }

    function viewProducts() {
        if (isset($_GET['view_products']) && isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
            global $conn;
            $select_query = 'SELECT * FROM `products`';
            $result = mysqli_query($conn, $select_query);

            echo "<table class='table table-bordered cart-table'>
                <thead class='bg-info'>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Description</th>
                        <th>Product Keywords</th>
                        <th>Category Id</th>
                        <th>Brand Id</th>
                        <th>Remove Product</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['product_id'];
                $title = $row['product_title'];
                $image = $row['product_image1'];
                $price = $row['product_price'];
                $description = $row['product_description'];
                $keywords = $row['product_keywords'];
                $category_title = $row['category_title'];
                $brand_title = $row['brand_title'];

                echo "<tr>
                        <td>$id</td>
                        <td>$title</td>
                        <td><img src='../product_images/$image' width='100' height='100'></td>
                        <td>$price</td>
                        <td>$description</td>
                        <td>$keywords</td>
                        <td>$category_title</td>
                        <td>$brand_title</td>
                        <td><a href='index.php?delete_product=$id' class='btn btn-sm btn-danger'>Remove</a></td>
                    </tr>";
            }
            echo "</tbody></table>";
            
        }
    }

    function deleteItem($table, $id, $column_name) {
        global $conn;
        $delete_query = "DELETE FROM `$table` WHERE `$column_name` = $id";
    
        $result = mysqli_query($conn, $delete_query);

        if ($result && $result2) {
            echo "<p class='text-success'>Removed successfully</p>";
        } else {
            echo "<p class='text-danger'>Error: Remove failed</p>";
        }
    }
?>