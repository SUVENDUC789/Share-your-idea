<?php
include 'connection/dbcon.php';
try {
    //code...
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $sl=$_POST['sl'];
        $title=$_POST['title'];
        $note=$_POST['note'];
    
        $sql="UPDATE `todo` SET `title` = '$title' WHERE `todo`.`sl` = $sl";
        $res1=mysqli_query($conn,$sql);
        $sql="UPDATE `todo` SET `des` = '$note' WHERE `todo`.`sl` = $sl";
        $res1=mysqli_query($conn,$sql);
    
    }
} catch (\Throwable $th) {
    //throw $th;
}
header("location: todo.php");

?>