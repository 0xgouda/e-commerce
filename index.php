<?php
    include('includes/body_template_header.php')
?>
        <!-- third child -->
        <div>
            <h3 class="text-center">
                Gouda Store
            </h3>
            <p class="text-center">
                Communications is at the heart of e-commerce and community
            </p>
        </div>
        <!-- fourth child-->
        <div class="row px-1">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                    <?php 
                        cart();
                        getProducts();
                    ?>  
                    <!-- row end -->
                </div>
                <!-- col end -->
            </div>
            <!-- sidenav -->
            <div class="col-md-2 bg-secondary p-0 ">
                <!-- brands to be displayed -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Delivery Brands</h4>
                        </a>
                    </li>
                    <?php
                        getBrands();
                    ?>
                </ul>

                <!-- categories to be displayed -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php 
                      getCategories(); 
                    ?>
                </ul>
            </div>
        </div>
<?php include('includes/body_template_footer.php') ?>