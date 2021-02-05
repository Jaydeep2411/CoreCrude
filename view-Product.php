<?php
include("Navigationbar.php");
include("login/db.php");




?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
<table  border: 1px solid black;>
    <div class="container">
        <h2>VIEW PRODUCT</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" class=" col-md-4" placeholder="Search.." name="search" id="search"><br><br>

            <a  href="Add-Product.php" type="button" class="btn btn-success">Add-Product</a><br><br>

        </form>
        <br>

    </div>
    <div id="result"></div>
    <!-- <div id="table"></div> -->
</body>

</html>

<script>
$(document).ready(function(){

 load_data();

 $('#search').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
 function load_data(query)   //multiple function ececuted same time
 {

  $.ajax({
   url:"search.php",
   method:"POST",
   data:{data:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
});



function myfunction(pdelid) {

let id = pdelid;
 // alert('id');
 // exit();

 swal({
         title: "Are you sure?",
         text: "Once deleted, you will not be able to recover this imaginary file!",
         icon: "warning",
         buttons: true,
         dangerMode: true,
     })
     .then((willDelete) => {
         if (willDelete) {
             $.ajax({
                 type: "POST",
                 url: "p_delete.php",
                 data: {
                     id: id
                 },

                 success: function(value) {


                     //$("#table").html(value);
                     location.reload();
                 }


             });


         }
     });
}
</script>