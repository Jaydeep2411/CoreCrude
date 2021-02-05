    <?php
    session_start();

    if(!isset($_SESSION['email'])){

      header('location:login/login.php');
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <title></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


    </head>

    <body>

      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSite</a>
          </div>
          <ul class="nav navbar-nav">

            <li><a href="view-Category.php">View-Catogery</a></li>
            <li><a href="view-Product.php">View-producut</a></li>
          </ul>


          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"> Logout</a></li>
          </ul>
        </div>
      </nav>
    </body>

    </html>