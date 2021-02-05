<?php

include("Navigationbar.php");

include("login/db.php");


$res = $conn->query("SELECT * FROM category where status='active'");


if (isset($_POST['insertData'])) {

    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_saleprice = $_POST['product_saleprice'];
    $product_status = $_POST['product_status'];
    $product_quantity = $_POST['product_quantity'];
    $product_image = $_FILES['product_image'];
    $filename = $product_image['name'];
   // $new_name =[time().",".rand(100,999).",".  $filename];
    $new_name=(mt_rand(1000,9999));

    //print_r("$product_image");



    $filepath = $product_image['tmp_name'];
    $path = 'proimage/';

    $query = "INSERT INTO product(`name`,`category`,`Price`,`SalePrice`,`status`,`quantity`) VALUES ('$product_name','$product_category','$product_price','$product_saleprice','$product_status','$product_quantity')";
    // echo $query;
    // exit();
    $result = mysqli_query($conn, $query);


    // if ($result == 1) {
    //     $lastid = mysqli_insert_id($conn);
    // }
    $error = array();

    if (empty($_FILES['product_image']['name'][0])) {
        $error[] = "please select image";
    } else {


        foreach ($_FILES['product_image']['name'] as $val) {
            $ext = strtoupper(substr($val, -4));
            if (!($ext == ".JPG" || $ext == ".PNG" || $ext == "JPEG" || $ext == "JFIF")) {
                $error[] = "wrong image type";
        }
        }
    }
    if (!empty($error)) {
        foreach ($error as $er) {
            echo "$er";
        }
    } else {

        if ($result == 1) {
            $lastid = mysqli_insert_id($conn);
        }

        foreach ($filepath as $key => $value) {
            $imagename = $filename[$key];
            $imagetemp = $filepath[$key];
            //$rendom =(mt_rand(100, 500));
            $nm= $new_name.'-'. $imagename;

            if (move_uploaded_file($imagetemp, $path .$new_name.'-'. $imagename)) {
                if ($key == 0) {
                    $status = 'active';
                } else {
                    $status = 'inactive';
                }
                $img_insert = "INSERT INTO p_images(`productid`,`img`,`istatus`) VALUES('$lastid','$nm','$status')";
                $result1 = mysqli_query($conn, $img_insert);
            }
        }
    }
}

?>



<!DOCTYPE html>
<html>

<head>
<!-- <script src="https://parsleyjs.org/dist/parsley.js"></script>
<style type="text/css">.req {margin:2px;color:#dc3545;}.serif {font-family: "Times New Roman", Times, serif;}li.parsley-required {
    color: red;
	}</style> -->

</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2 class="text-center">AddProduct</h2>

                <form actinon="#" method="POST" enctype="multipart/form-data" data-parsley-validate="">
                    <div class=" form-group">
                        <label>Name:</label>
                        <input type="text" name="product_name" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control" name="product_category">
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
                        <input type="number" name="product_price" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>SalePrice:</label>
                        <input type="number" name="product_saleprice" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <select  class="form-control" name="product_status" required="">
                        <option value="">--Select--</option>
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="number" name="product_quantity" class="form-control"  required="">
                    </div>
                    <div>
                        <label class="form-label" for="customFile">Image:</label>
                        <input type="file"  id="customFile" name="product_image[]" multiple />

                    </div>
                    <div>
                        <br>

                        <button class="btn btn-success" class="form-control" class="center" name="insertData">submit</button>

                    </div>

                </form>
            </div>
        </div>

    </div>


</body>

</html>