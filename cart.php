<?php 
    include('includes/body_template_header.php');    
?>
        <div class="container">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                update_cart_item();
                delete_cart_item();
                get_cart_items();
            }
            else {
                echo "<script>alert('You have to log in in order to Add have a Cart.')</script>";
                echo "<script>window.location.href = 'login.php'</script>";
            }
            ?>
        </div>
<?php
    include('includes/body_template_footer.php');
?>