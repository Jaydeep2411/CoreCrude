<?php
// include("Navigationbar.php");

include("login/db.php");

$id = $_POST['id'];

$sel = ("SELECT * FROM p_images WHERE productid=$id");
$cc = mysqli_query($conn, $sel);


while ($result = mysqli_fetch_array($cc)) {

   $image = $result['img'];
   $file = 'proimage/' . $image;
   unlink($file);
}



$delete_query = "DELETE  product,p_images FROM product INNER JOIN p_images WHERE product.id = p_images.productid AND product.id='$id'";
$res = mysqli_query($conn, $delete_query) or die(mysqli_error($conn));

?>

<tr>
      <td> <a href="p_update.php?id=<?php echo $row['id']; ?>" <i style="font-size:25px;color:blue" class="fa fa-edit"></i> </a></td>
      <td><button onclick="myfunction(<?php echo $row['id']; ?>)" href="p_delete.php?id=<?php echo $row['id']; ?>" <i style="font-size:25px;color:red" class="fa fa-trash"></i></button></td>
   </tr>

?>