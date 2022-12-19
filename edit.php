<?php

session_start();
if(isset($_SESSION['user'])){
        $username=$_SESSION['user'];
        // echo "Ok user";

}else if(!isset($_SESSION['user'])){
    header("location: index.php");
}

?>
<?php
include 'connection/dbcon.php';
try {
    $sl=$_GET['sl'];
    $sql="SELECT * FROM `todo` WHERE sl=$sl";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    //code...
} catch (\Throwable $th) {
    //throw $th;
    header("location: index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <title>update here</title>

</head>

<body>
<?php include 'other/_nav.php'; ?>

    <div class="container my-2">
        <h4 class="text-center alert alert-success">Update note here</h4>

        <form action="per.php" method="post">
            <div class="mb-3">
                <label for="tile" class="form-label"><b>Title</b></label>
                <input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control" id="tile">
            </div>
            <div class="mb-3">
                <label for="Note" class="form-label"><b>Short Note</b></label>
                <input type="text" name="note" value="<?php echo $row['des']; ?>" class="form-control" id="Note">
            </div>
            <input type="hidden" name="sl" value="<?php echo $row['sl']; ?>">
            <input type="submit" class="btn btn-primary" value="Update Now">
        </form>
    </div>




    <?php include 'other/_foo.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>