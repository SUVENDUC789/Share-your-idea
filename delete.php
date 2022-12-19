<?php
include 'connection/dbcon.php';

try {
    //code...
    $sl=$_GET['sl'];
    $sql="DELETE FROM `todo` WHERE `todo`.`sl` =  $sl";
    $res1=mysqli_query($conn,$sql);
} catch (\Throwable $th) {
    //throw $th;
}


    header("location: todo.php");


?>