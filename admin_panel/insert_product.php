<?php 
    include('../includes/connect.php');

    if (isset($_POST['insert_product'])) {
        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $product_keywords = $_POST['product_keywords'];
        $product_categories = $_POST['product_categories'];
        $product_brands = $_POST['product_brands'];
        $product_price = $_POST['product_price'];
        $product_status = 'true';

        // images
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image1_tmp = $_FILES['product_image1']['tmp_name'];

        $product_image2 = $_FILES['product_image2']['name'];
        $product_image2_tmp = $_FILES['product_image2']['tmp_name'];

        $product_image3 = $_FILES['product_image3']['name'];
        $product_image3_tmp = $_FILES['product_image3']['tmp_name'];

        // check if all fields are filled
        if ($product_title == "" || $product_description == "" || $product_keywords == "" || $product_categories == "" || $product_brands == "" || $product_image1 == "" || $product_image2 == "" || $product_image3 == "" || $product_price == "") {
            echo "<script>alert('Please fill all the fields'); window.open('insert_product.php')</script>";
            exit();
        } else {
            // move images
            move_uploaded_file($product_image1_tmp, "../product_images/$product_image1");
            move_uploaded_file($product_image2_tmp, "../product_images/$product_image2");
            move_uploaded_file($product_image3_tmp, "../product_images/$product_image3");

            // insert products into database
            $insert_products = "INSERT INTO `products` (product_title, product_description, product_keywords, category_title, brand_title, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title', '$product_description', '$product_keywords', '$product_categories', '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), $product_status)";
            $result = mysqli_query($conn, $insert_products);
            if ($result) {
                echo "<script>alert('Product has been inserted successfully'); window.open('insert_product.php')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center mb-5">Insert Products</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" required>
            </div>  

            <!-- description -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter Product Description" autocomplete="off" required>
            </div>
            
            <!-- keywords -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter Product Keywords" autocomplete="off" required>
            </div>

            
            <!-- categories -->
            <div class="form-outline w-50 mb-3 m-auto">
                <select name="product_categories" class="form-select">
                    <option value="">Select a Category</option>
                    <?php
                        $categories = "SELECT * FROM `categories`";
                        $result = mysqli_query($conn, $categories);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $category_title = $row['category_title'];
                            echo "<option value='$category_title'>$category_title</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- brands -->
            <div class="form-outline w-50 mb-3 m-auto">
                <select name="product_brands" class="form-select">
                    <option value="">Select a Brand</option>
                    <?php
                        $brands = "SELECT * FROM `brands`";
                        $result = mysqli_query($conn, $brands);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $brand_title = $row['brand_title'];
                            echo "<option value='$brand_title'>$brand_title</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- image 1 -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required>
            </div>

            <!-- image 2 -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required>
            </div>

            <!-- image 3 -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required>
            </div>

            <!-- price -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" required>
            </div>

            <!-- submit -->
            <div class="form-outline w-50 mb-3 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
            </div>
        </form>
    </div>
</body>
</html>