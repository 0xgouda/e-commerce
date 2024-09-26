<?php
    include('../includes/connect.php');
    if (isset($_POST['insert_cat'])) {
        $category_title = $_POST['cat_title'];
        $category_title = mysqli_real_escape_string($conn, $category_title);
        // check if category already exists
        $select_query = "SELECT * FROM categories WHERE category_title = '$category_title'";
        $select_result = mysqli_query($conn, $select_query);
        $number = mysqli_num_rows($select_result);
        if ($number > 0) {
            echo "<script>alert('Failure: Category already exists')</script>";
        } else {
            // insert category 
            $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
            $result = mysqli_query($conn, $insert_query);
            if ($result) {
                echo "<script>alert('Category has been inserted successfully')</script>";
            }
        }
    }
?>

<h2 class="text-center">Insert Categories</h2>

<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert cateogries" aria-label="Categories" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="border-0 p-2 my-3 bg-info" name="insert_cat" value="Insert Categories">
    </div>
</form>