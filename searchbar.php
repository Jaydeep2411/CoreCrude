
<!-- <!DOCTYPE html>
<html> -->

<!-- <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container" >
        <h2>VIEW CATEGORY</h2>
        <br>
        <form action="" method="POST">
        <input  type="text" class="col-md-4" placeholder="Search.." name="search" >
        <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      <br><br><br> -->
  
<?php
                include("login/db.php");

                if(isset($_POST['submit'])){
                    $sname =$_POST['search'];

                    $ser_query = mysqli_query($conn, "SELECT * FROM category WHERE name='$sname' or id='$sname' or status='$sname'");

                    while ($result = mysqli_fetch_array($ser_query)){
                       
                        $name =$result['name'];
                        $id = $result['id'];
                        $status =$result['status'];
                    }


                }
?>
    

        <div  style="background-color: #E7EAF0;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                        <td><?php echo $name;?></td>
                        <td><?php echo $id;?></td>
                        <td><?php echo $status;?></td>
                </tr>
                </tbody>
            </table>
        </div>