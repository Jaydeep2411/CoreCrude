<?php

include("login/db.php");
include("Navigationbar.php");
$pid = $_GET['id'];

$res = $conn->query("SELECT * FROM category where status='active'");

$showquery = "SELECT * FROM product where id={$pid}";

$showdata = mysqli_query($conn, $showquery);

$arrdata = mysqli_fetch_array($showdata);

if (isset($_POST['updatedata'])) {


    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_saleprice = $_POST['product_saleprice'];
    $product_status = $_POST['product_status'];
    $product_quantity = $_POST['product_quantity'];
    $date = date('Y-m-d h:i:sa');
    $product_image = $_FILES['update_image']['name'];

    if ($product_image != '') {
        $update = "UPDATE `product` SET `name`='$product_name',`category`='$product_category',`Price`='$product_price',`SalePrice`='$product_saleprice',`quantity`='$product_quantity',`updatedate`='$date',`status`='$product_status' WHERE `id` = '$pid'";
        $result = mysqli_query($conn, $update) or die(mysqli_error($conn));


        for ($i = 0; $i < count($product_image); $i++) {

            $filename = $_FILES['update_image']['name'][$i];
            if (move_uploaded_file($_FILES['update_image']['tmp_name'][$i], 'proimage/' . $filename)) {
                $insert_image = "INSERT INTO `p_images`(`productid`, `img`, `istatus`) VALUES ('$pid','$filename','inactive')";
                $r = mysqli_query($conn, $insert_image) or die(mysqli_error($conn));
            }
        }
    } else {
        $update = "UPDATE `product` SET `name`='$product_name',`category`='$product_category',`Price`='$product_price',`SalePrice`='$product_saleprice',`quantity`='$product_quantity',`updatedate`='$date',`status`='$product_status' WHERE `id` = '$pid'";
        $result = mysqli_query($conn, $update) or die(mysqli_error($conn));
    }


    header("Location: view-Product.php");
}


?>
<!DOCTYPE html>
<html>

<head>

</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2 class="text-center">UpdateProduct</h2>

                <form actinon="#" method="POST" enctype="multipart/form-data">
                    <div class=" form-group">
                        <label>Name:</label>
                        <input type="text" name="product_name" class="form-control" placeholder="Enter Name" value="<?php echo $arrdata['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control" name="product_category" value="<?php echo $arrdata['category']; ?>">
                            <?php
                            while ($row = $res->fetch_object()) {
                            ?>
                                <option value="<?php echo $row->id ?>">
                                    <?php echo $row->name; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Price:</label>
                        <input type="text" name="product_price" class="form-control" value="<?php echo $arrdata['Price']; ?>">
                    </div>
                    <div class="form-group">
                        <label>SalePrice:</label>
                        <input type="text" name="product_saleprice" class="form-control" value="<?php echo $arrdata['SalePrice']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <select class="form-control" name="product_status" value="<?php echo $arrdata['status']; ?>">
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="text" name="product_quantity" class="form-control" value="<?php echo $arrdata['quantity']; ?>">
                    </div>
                    <div>
                        <label class="form-label" for="customFile">Image:</label>
                        <?php
                        $sql2 = "SELECT * FROM p_images WHERE productid={$pid}";

                        $result2 = mysqli_query($conn, $sql2);
                        // print_r($result2);
                        // exit;
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                if ($row2['istatus'] == 'active') {
                                    $image[] = $row2['img'];
                                } elseif ($row2['istatus'] == 'inactive') {
                                    $in_image[] = $row2['img'];
                                    $new_id[] = $row2['id'];
                                }
                            }

                        ?>

                            <input type="file" name="update_image[]" class="form-control" multiple value="<?php echo $row2['image']; ?>">

                            <?php for ($i = 0; $i < count($image); $i++) { ?>
                                <img src="proimage/<?php echo $image[$i]; ?>" width="100px" height="100px" style="border:5px solid green"><br><br>
                            <?php } ?>
                            <?php for ($i = 0; $i < count($in_image); $i++) { ?>
                                <img src="proimage/<?php echo $in_image[$i]; ?>" width="100px" height="100px" style="border:5px  solid red">
                                <a href='image_delete.php?pid=<?php echo $pid ?>&img_id=<?php echo $new_id[$i]; ?>' class='btn btn-danger'>Delete</a>
                                <a href='img_update.php?pid=<?php echo $pid ?>&img_status=<?php echo $new_id[$i]; ?>' class='btn btn-primary'>Active</a>
                        <?php }
                        } ?>

                        <center>
                            <button class="btn btn-success" class="form-control" class="center" name="updatedata">submit</button>
                        </center>
                    </div>

                    <div>

                    </div>

                </form>
            </div>
        </div>

    </div>


</body>

</html>