<?php
include("db.php");

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT email, password FROM user WHERE email = '{$email}' AND password = '{$password}' ";
    $result = mysqli_query($conn, $sql) or die("failed");

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            header("location:../view-Category.php");

        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Email and Password are not match</div>';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #con {
            position: absolute;
            top: 20%;
            left: 10%;
        }
    </style>
</head>

<body>


    <div class="container" id="con">

        <div class="row justify-content-center">




            <div class="col-lg-3">
            <div style="width:400px;height:280px;border:3px solid #000;">
                <h2 class="text-center">Login Here</h2>


                <form action="" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <br><br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <br><br>
                    <center>
                    <button type="submit" name="login" class="btn btn-primary  btn-block ">login</button>
                    </center>
                </form>

            </div>
        </div>
    </div>
    </div>




</body>

</html>