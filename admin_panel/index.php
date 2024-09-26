<?php   
    session_start();
    if (!$_SESSION['loggedin'] || $_SESSION['username'] != 'admin') {
        header("location: ../index.php");
        exit();
    }
    
    include('../includes/connect.php');
    include('admin_functionalities.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="content-wrapper min-100-vh d-flex flex-column">
    <!-- navbar -->
    <div class="container-fluid p-0 w-100 flex-grow-1">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="logo" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class='nav-item'>
                            <a class='nav-link' href='../index.php'>Home</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='#'>Welcome Admin</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='../logout.php'>Logout</a>
                     </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!-- thrid child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3 col-md-2">
                    <a href="#"><img src="../images/logo.png" alt="logo" class="admin_image"></a>
                </div>
                
                <div class="button text-center">
                    <button><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">View Products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light bg-info my-1">View Categories</a></button>
                    <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brands</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-light bg-info my-1">View Brands</a></button>
                    <button><a href="#" class="nav-link text-light bg-info my-1">All Orders</a></button>
                    <button><a href="#" class="nav-link text-light bg-info my-1">All Payments</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-light bg-info my-1">List Users</a></button>
                    <button><a href="../logout.php" class="nav-link text-light bg-info my-1">Logout</a></button>
                </div>
            </div>
        </div>

        <!-- fourth child -->
         <div class="container my-3">
            <?php
                if (isset($_GET['insert_category'])) {
                    include('insert_categories.php');
                }
                elseif (isset($_GET['insert_brand'])) {
                    include('insert_brands.php');
                }
                elseif (isset($_GET['list_users'])) {
                    listUsers();
                }
                elseif (isset($_GET['view_categories'])) {
                    viewCategories();
                }
                elseif (isset($_GET['view_brands'])) {
                    viewBrands();
                }
                elseif (isset($_GET['delete_category'])) {
                    deleteItem('categories', $_GET['delete_category'], 'category_id');
                }
                elseif (isset($_GET['delete_brand'])) {
                    deleteItem('brands', $_GET['delete_brand'], 'brand_id');
                }   
                elseif (isset($_GET['delete_user'])) {
                    deleteItem('users', $_GET['delete_user'], 'username');
                }
                elseif (isset($_GET['view_products'])) {
                    viewProducts();
                }
                elseif (isset($_GET['delete_product'])) {
                    deleteItem('products', $_GET['delete_product'], 'product_id');
                }
            ?>
         </div>
    </div>
        <!-- Footer -->
        <footer class="footer mt-auto py-3 bg-info w-100">
            <div class="container text-center">
                <p class="mb-0">All rights reserved &copy; Designed by 0xgouda</p>
            </div>
        </footer>
    </div>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>