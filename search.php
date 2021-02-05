<?php
include("login/db.php");


// $output = '';
if (isset($_POST["data"])) {

   $search = mysqli_real_escape_string($conn, $_POST["data"]);

   $query =  "SELECT *,category.name as cid,product.id as proid,product.name as pname FROM product LEFT JOIN category ON category.id  =  product.category LEFT JOIN p_images ON product.id = p_images.productid WHERE product.name LIKE '%$search%' OR  `Price` LIKE '%$search%' OR  `quantity` LIKE '%$search%' WHERE p_images.istatus = 'active' GROUP BY product.id ";

} else {
   $query =  "SELECT *,category.name as cid,product.status as pstatus,product.id as proid,product.name as pname FROM product LEFT JOIN category ON (category.id  =  product.category) LEFT JOIN p_images ON (product.id = p_images.productid)  WHERE p_images.istatus = 'active' GROUP BY product.id";
// echo $query;
// exit();
}
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));


if (mysqli_num_rows($result) > 0) {
?>

   <div class="container">
      <table class="table table-bordered" style="background-color: #E7EAF0;">
         <tr>
            <th>id</th>
            <th>name</th>
            <th>category</th>
            <th>Price</th>
            <th>Saleprice</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>image</th>
            <th colspan="2">Action</th>

         </tr>

         <?php
         while ($row = mysqli_fetch_array($result)) {
         ?>

            <tr>
               <td><?php echo $row['proid']; ?></td>
               <td><?php echo $row['pname']; ?></td>
               <td><?php echo $row['cid']; ?></td>
               <td><?php echo $row['Price']; ?></td>
               <td><?php echo $row['SalePrice']; ?></td>
               <td><?php echo $row['pstatus']; ?></td>
               <td><?php echo $row['quantity']; ?></td>
               <td>
                  <img src="proimage/<?php echo $row['img']; ?>" height="50px" width="50px">
               </td>
               <td> <a href="p_update.php?id=<?php echo $row['proid']; ?>" <i style="font-size:25px;color:blue" class="fa fa-edit"></i> </a></td>
               <td><button onclick="myfunction(<?php echo $row['proid']; ?>)" href="p_delete.php?id=<?php echo $row['id']; ?>" <i style="font-size:25px;color:red" class="fa fa-trash"></i></button></td>
            </tr>



      <?php
         }
        }else{echo
         '<div class="alert alert-danger" role="alert"><h3><center>data are not match</center></h3></div>';
        }
      ?>
      </table>

   </div>