<?php

include('login/db.php');

if(isset($_GET['pid']) && isset($_GET['img_status']) ){

    $img_id = $_GET['img_status'];
    $pid = $_GET['pid'];

   $query= "UPDATE p_images SET `istatus` = 'active' WHERE `id`= $img_id";
   $con1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

   $query2="SELECT `id` FROM p_images WHERE `productid` = $pid AND `id` != $img_id";
   $con2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

   $iid = mysqli_fetch_all($con2);
  
   for($i = 0; $i<count ($iid); $i++)
   {
      $update_id = $iid[$i][0];

      $query3= "UPDATE p_images SET `istatus` = 'inactive' WHERE `id`= $update_id ";

       $con3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
     }

   header('location:p_update.php?id='.$pid.'');

}
?>