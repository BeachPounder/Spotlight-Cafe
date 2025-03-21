<?php include('partials-front/menu.php'); ?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <style>
            .fixed-size {
                width: 300px;  /* Set your desired width */
                height: 305px; /* Set your desired height */
                object-fit: cover; /* This ensures the image covers the area without distortion */
            }
            .box-3 {
                text-align: center; /* Center align the content inside the box */
                padding: 10px;
            }
            .float-text {
                position: relative;
                top:    -50px; /* Adjust this value to position the text as needed */
                left: 20px;
            }
        </style>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php if ($image_name == "") {
                            echo "<div class='error'>Image not Found.</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve fixed-size">
                        <?php } ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error'>Category not Found.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
