<?php

include("login/db.php");
include("Navigationbar.php");
$ids = $_GET['id'];

$showquery = "SELECT * FROM category where id={$ids}";

$showdata = mysqli_query($conn, $showquery);

$arrdata = mysqli_fetch_array($showdata);


if (isset($_POST['update-btn'])) {
    $idupdate = $_GET['id'];

    $category_name = $_POST['category_name'];
    $category_order = $_POST['category_order'];
    $category_status = $_POST['category_status'];
    $category_image = $_FILES['category_image'];
    $date = date('Y-m-d h:i:sa');
    $file_name= $category_image['name'];
    $tmp_name = $category_image['tmp_name'];
    $fileerror = $category_image['error'];

    if($category_image['size']>1)
    {
        if (file_exists("images/".$arrdata['image']) && !empty($arrdata['image'])) {
            unlink("images/". $arrdata['image']);
        }
        move_uploaded_file($tmp_name,"images/". $file_name);
        $update_sql = "UPDATE category SET `name`='$category_name',`order`='$category_order',`status`='$category_status',`image`='$file_name',`updatedate`='$date' WHERE `id`='" . $idupdate . "' ";
    }
    else{
        $update_sql = "UPDATE category SET `name`='$category_name',`order`='$category_order',`status`='$category_status',`updatedate`='$date' WHERE `id`='" . $idupdate . "' ";
       }
       $update_result=mysqli_query($conn, $update_sql);
      // print_r($update_sql);exit;
    if ($update_result) {
        header('location:view-Category.php');
    } else {
        echo "data not insert";
    }
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
                <h2 class="text-center">UpdateCategory</h2>

                <form actinon="#" method="POST"  enctype="multipart/form-data">
                    <div class="form-group">

                        <label>Name:</label>
                        <input type="text" name="category_name" class="form-control" value="<?php echo $arrdata['name']; ?>" placeholder="Enter Name">
                    </div>

                    <div class="form-group">
                        <label>Order:</label>
                        <input type="number" name="category_order" class="form-control" value="<?php echo $arrdata['order']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <select class="form-control" name="category_status" value="<?php echo $arrdata['status']; ?>"><?php echo $arrdata['status']; ?>

                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>

                    </div>
                    <div>
                        <label class="form-label" for="customFile">Image:</label>
                        <input type="file" class="form-control" id="customFile" name="category_image" value="<?php echo $arrdata['image']; ?>" />
                        <br>
                        <img src="images/<?php echo $arrdata['image']; ?>" height="100px" width="100px">
                        <br>
                        <br>

                        <button class="btn btn-success" class="form-control" class="center" name="update-btn">update</button>

                    </div>
                </form>
            </div>
        </div>

    </div>


</body>

</html>