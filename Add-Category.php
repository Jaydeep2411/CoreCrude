<?php
include("Navigationbar.php");

include("login/db.php");

if (isset($_POST['insert-btn'])) {

  $category_name = $_POST['category_name'];
  $category_order = $_POST['category_order'];
  $category_status = $_POST['category_status'];
  $category_image = $_FILES['c_image'];
  $filename = $category_image['name'];
  $new_name = trim(time() . "," . rand(100, 999) . "," .  $filename);

  // print_r( $category_image);


  $filepath = $category_image['tmp_name'];
  $filerror = $category_image['error'];

  if ($filerror == 0) {

    $destfile = 'images/' . $new_name;

    move_uploaded_file($filepath, $destfile);

    $insert_category = "INSERT INTO  category(`name`,	`order`,	`status`,	`image`) VALUES ('$category_name','$category_order','$category_status','$new_name')";

    $res = mysqli_query($conn, $insert_category);

    if ($res) {
      header("location:view-Category.php");
    } else {
      echo "not done";
    }
  }
}

?>

<!DOCTYPE html>

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>




  <div class="container">
    <center>
      <h2>AddCategory</h2>
    </center>

    <form action=" " method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>Name:</label>
        <input type="text" name="category_name" class="form-control" id="name" required="">
      </div>
      <br>

      <div class="form-group">
        <label>order:</label>
        <input type="number" name="category_order" class="form-control" id="number" value="<?php echo (mt_rand(10000, 9000000)); ?>" required="">
      </div>
      <br>

      <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="category_status" required="">
          <option value="">----Select----</option>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      <br>

      <div class="form-group">
        <label class="form-label" for="customFile">Image</label>
        <br>
        <input type="file" name="c_image" id="customFile" /><br>

        <button type="submit" class="btn btn-success" name="insert-btn">Submit</button>

    </form>
  </div>

</body>

</html>