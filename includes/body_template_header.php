<?php
    include('includes/connect.php');
    include('functions/common_functions.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website using PHP and MySQL</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="content-wrapper min-100-vh d-flex flex-column">
    <!-- navbar -->
    <div class="container-fluid p-0 w-100 flex-grow-1">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="Logo" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?list_products">All Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <sup><?php echo num_of_cart_entities(); ?></sup>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Total Price:<?php echo total_price_of_cart_items(); ?>$</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="GET">
                    <input class="form-control me-2" name="search_term" type="search" placeholder="Search" aria-label="Search">
                    <input type="submit" value="search" name="search" class="btn btn-outline-light">
                    <?php
                        if (isset($_GET['brand'])) {
                            echo "<input value=\"" . htmlspecialchars($_GET['brand']) . "\" name='brand' hidden>";
                        }
                        elseif (isset($_GET['category'])) {
                            echo "<input value=\"" . htmlspecialchars($_GET['category']) . "\" name='category' hidden>";
                        }
                    ?>
                </form>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                    $username = $_SESSION['username'];
                    if (isset($_SESSION['loggedin'])) {
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='#'>Welcome $username</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='logout.php'>Logout</a>
                            </li>";
                        if ($username == 'admin') {
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='admin_panel/index.php'>Admin Panel</a>
                                </li>";
                        }
                    } else {
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='#'>Welcome Guest</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='login.php'>Login</a>
                            </li>";
                    }
                ?>
            </ul>
        </nav>