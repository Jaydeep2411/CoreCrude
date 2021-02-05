<?php
include("login/db.php");

$del_id=$_GET['img_id'];

$pid =$_GET['pid'];

$imgselect="SELECT * FROM p_images WHERE id='$del_id'";

$con =mysqli_query($conn,$imgselect);

while ($row=mysqli_fetch_array($con)){

    $image=$row['img'];
    $file='proimage/'.$image;
    unlink($file);
}

$del_img="DELETE FROM p_images WHERE id='$del_id'";
$con1=mysqli_query($conn,$del_img);

header('location:p_update.php?id='.$pid.'');


?>