<?php
// include("Navigationbar.php");

include("login/db.php");

$id = $_POST["id"];

$sel = $conn->query("SELECT * FROM category WHERE id=$id");
$result = $sel->fetch_object();

if ($result) {
    unlink("images/" . $result->image);
} else {
    echo "not done";
}


$delete_query = "DELETE FROM category WHERE id = $id";
$res = mysqli_query($conn, $delete_query) or die(mysqli_error($conn));
if ($res)
?>
{
<?php
// header("Location:View-Category.php");
$sql = "SELECT * FROM category";
$res1 =  mysqli_query($conn, $sql) or die( mysqli_error($conn));
$path = "images/";
?>

<?php
while ($res = mysqli_fetch_array($res1)) {
?>

    <tr>
        <td><?php echo $res['id']; ?></td>
        <td><?php echo $res['name']; ?></td>
        <td><?php echo $res['order']; ?></td>
        <td><a class="<?php echo $res['status'] == 'active' ? " btn btn-success" : " btn btn-danger" ?>" href="status.php?id=<?php echo $res['id']; ?>" name="change"><?php echo $res['status']; ?></a></td>
        <td>
            <img src="images/<?php echo $res['image']; ?>" height="50px" width="50px">
        </td>
        <td> <a href="c_update.php?id=<?php echo $res['id']; ?>" <i style="font-size:25px;color:blue" class="fa fa-edit"></i> </a></td>
        <td><button onclick="myfun(<?php echo $res['id']; ?>)" href="c_delete.php?id=<?php echo $res['id']; ?>" <i style="font-size:25px;color:red" class="fa fa-trash"></i></button></td>
    </tr>

<?php } ?>

}
?>