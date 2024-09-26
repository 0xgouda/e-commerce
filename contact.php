<?php
    include('includes/body_template_header.php');
    session_start();
?>

    <div class="container my-3">
        <h2 class="text-center mb-4">Contact Us</h2>
        <?php
        if (!empty($successMessage)) {
            echo "<div class='alert alert-success'>$successMessage</div>";
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                <span class="text-danger"><?php echo $nameErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                <span class="text-danger"><?php echo $emailErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5"><?php echo $message; ?></textarea>
                <span class="text-danger"><?php echo $messageErr; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php include('includes/body_template_footer.php'); ?>