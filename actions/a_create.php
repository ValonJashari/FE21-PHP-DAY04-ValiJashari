<?php
require_once 'db_connect.php';
require_once 'file_upload.php';

if ($_POST) {  
   $roomname = $_POST['roomname'];
   $price = $_POST['price'];
   $weekeffort = $_POST['weekeffort'];
   $all_inclusive = $_POST['all_inclusive'];
   $uploadError = '';
   //this function exists in the service file upload.
   $picture = file_upload($_FILES['picture']);  
 
   $sql = "INSERT INTO booking (roomname,price,weekeffort,all_inclusive,picture) VALUES ('$roomname', $price,'$weekeffort','$all_inclusive', '$picture->fileName')";

   if ($connect->query($sql) === true ) {
       $class = "success";
       $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $roomname </td>
            <td> $price </td>
            <td> $weekeffort </td>
            <td> $all_inclusive </td>
            </tr></table><hr>";
       $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
   } else {
       $class = "danger";
       $message = "Error while creating record. Try again: <br>" . $connect->error;
       $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
   }
   $connect->close();
} else {
   header("location: ../error.php");
}
?>


<!DOCTYPE html>
<html lang= "en">
   <head>
       <meta charset="UTF-8">
       <title>Update</title>
       <?php require_once '../components/boot.php' ?>
   </head>
   <body>
       <div class="container">
           <div class="mt-3 mb-3" >
               <h1>Create request response</h1>
           </div>
            <div class="alert alert-<?=$class;?>" role="alert">
               <p><?php echo ($message) ?? ''; ?></p>
             <!-- ?? '' null collection operator -->
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../index.php'><button class="btn btn-primary"  type='button'>Home</button ></a>
           </div >
       </div>
   </body>
</html>