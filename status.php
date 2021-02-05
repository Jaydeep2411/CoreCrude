<?php
include("login/db.php");
if (isset($_GET['id'])) {
    $status1 = $_GET['id'];
    $select = mysqli_query($conn, "select * from category where id='$status1'");
    while ($row = mysqli_fetch_object($select)) {
        $status_var = $row->status;
        if ($status_var == 'inactive') {
            $status_state = 'active';
        } else {
            $status_state = 'inactive';
        }
        $update = mysqli_query($conn, "update category set status='$status_state' where id='$status1' ");
        if ($update) {
            header("Location:view-Category.php");
        } else {
            echo mysqli_error($conn);
        }
    }
?>
<?php
}
?>