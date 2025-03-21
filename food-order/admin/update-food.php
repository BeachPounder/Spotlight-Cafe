<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "food-order";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include('partials/menu.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch current food details
    $sql = "SELECT * FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $current_image = $row['image_name'];
            $current_category = $row['category_id'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {
            $_SESSION['no-food-found'] = "<div class='error'>Food not found.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit();
        }
    }
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // Handle image upload
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);

            // Check for file upload errors
            if ($_FILES['image']['error'] != 0) {
                echo "<div class='error'>Error during file upload: " . $_FILES['image']['error'] . "</div>";
                die();
            }

            $allowed_extensions = array("jpg", "jpeg", "png", "gif");
            if (in_array($ext, $allowed_extensions)) {
                $image_name = "Food_" . rand(000, 999) . '.' . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/" . $image_name;

                // Ensure directory exists
                if (!is_dir("../images/food/")) {
                    mkdir("../images/food/", 0777, true);
                }

                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    die();
                }

                if ($current_image != "") {
                    $remove_path = "../images/food/" . $current_image;
                    $remove = unlink($remove_path);

                    if ($remove == false) {
                        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        die();
                    }
                }
            } else {
                $_SESSION['upload'] = "<div class='error'>Invalid file format. Only jpg, jpeg, png, and gif are allowed.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                die();
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    // Update food
    $update_sql = "UPDATE tbl_food SET
        title = '$title',
        description = '$description',
        price = $price,
        image_name = '$image_name',
        category_id = $category,
        featured = '$featured',
        active = '$active'
        WHERE id=$id";

    $res3 = mysqli_query($conn, $update_sql);

    if ($res3 == true) {
        // Record changes in history
        $fields = ['title', 'description', 'price', 'image_name', 'category_id', 'featured', 'active'];
        $old_values = [$row['title'], $row['description'], $row['price'], $row['image_name'], $row['category_id'], $row['featured'], $row['active']];
        $new_values = [$title, $description, $price, $image_name, $category, $featured, $active];

        foreach ($fields as $index => $field) {
            if ($old_values[$index] != $new_values[$index]) {
                $sql_history = "INSERT INTO tbl_history_food (food_id, field_updated, old_value, new_value, update_date, updated_by) VALUES (
                    $id,
                    '$field',
                    '" . mysqli_real_escape_string($conn, $old_values[$index]) . "',
                    '" . mysqli_real_escape_string($conn, $new_values[$index]) . "',
                    NOW(),
                    '" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'
                )";
                $history_res = mysqli_query($conn, $sql_history);

                if (!$history_res) {
                    echo "Failed to record history: " . mysqli_error($conn) . "<br>";
                }
            }
        }

        $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Food: " . mysqli_error($conn) . "</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo htmlspecialchars($description); ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo htmlspecialchars($current_image); ?>" width="100px">
                            <?php
                        } else {
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res2 = mysqli_query($conn, $sql2);
                            $count2 = mysqli_num_rows($res2);

                            if ($count2 > 0) {
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    $category_id = $row2['id'];
                                    $category_title = $row2['title'];
                                    ?>
                                    <option <?php if ($current_category == $category_id) {
                                        echo "selected";
                                    } ?> value="<?php echo htmlspecialchars($category_id); ?>"><?php echo htmlspecialchars($category_title); ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($current_image); ?>">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
