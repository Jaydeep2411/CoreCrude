<?php

include("Navigationbar.php");
include("login/db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





</head>

</head>


<body>

    <div class="container">
        <h2>viewCategory</h2><br>

        <form action="" method="POST">
            <input class="col-md-4" type="text" placeholder="Search.." name="search">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button><br><br>

            <a type="button" class="btn btn-warning" href="Add-Category.php">Add-category</a><br><br>


        </form>

        <div class="container">
            <?php
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];

                $select = "SELECT * FROM category WHERE name LIKE '%$search%' OR   `order` LIKE '%$search%' OR `status` LIKE '%$search%'";
            } else {
                $select = "SELECT * FROM category";
            }
            $query = mysqli_query($conn, $select) or die(mysqli_error($conn));

            if (mysqli_num_rows($query) > 0) {
                ?>

        </div>

        <table class="table table-bordered"  id="tab">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>order</th>
                    <th>status</th>
                    <th>image</th>
                    <th colspan="2">action</th>
                </tr>
            </thead>
            <tbody id="data_table">
                <?php
                    while ($res = mysqli_fetch_array($query)) {
                        //  echo $res['name']."<br>";
                        ?>

                    <tr>
                        <td><?php echo $res['id']; ?></td>
                        <td><?php echo $res['name']; ?></td>
                        <td><?php echo $res['order']; ?></td>
                        <td><a class="<?php echo $res['status'] == 'active' ? " btn btn-success" : " btn btn-danger" ?>" href="status.php?id=<?php echo $res['id']; ?>" name="change"><?php echo $res['status']; ?></a></td>
                        <td>
                            <img src=" images/<?php echo $res['image']; ?>" height="50px" width="50px"></td>
                        <td><a href="c_update.php?id=<?php echo $res['id']; ?>" <i style="font-size:25px;color:blue" class="fa fa-edit"></i></a></td>
                        <td><button onclick="myfunction(<?php echo $res['id']; ?>)"><i style="font-size:25px;color:red" class="fa fa-trash"></i> </button></td>

                    </tr>

                <?php } ?>

            </tbody>
        </table>
    <?php
    }
    ?>
    </div>
</body>

<script>
    function myfunction(delid) {
        // alert("hii" + delid);
        let id = delid;
        // console.log(id);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "c_delete.php",
                        data: {
                            id: id
                        },

                        success: function(value) {
                            swal({
                                title: "Data Deleted Successfully!",

                                icon: "success",
                                button: "Ok",
                            });
                            $("#data_table").html(value);
                        }
                    });
                }
            });

    }

    // $(document).ready(function() {
    //         $('#tab').DataTable({
    //             "aoColumnDefs": [{
    //                 "bSortable": false,
    //                 //"aTargets": []
    //             }]
    //         });
    //     });
</script>

</html>