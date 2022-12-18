<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location: login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Welcome -
        <?php echo $_SESSION['user']; ?>
    </title>
</head>

<body>
    <?php include 'other/_nav.php'; ?>

    <div class="container">
        <h1 class="text-center alert-primary my-2 py-2">Welcome -
            <a href="todo.php"><?php echo $_SESSION['user']; ?></a>
        </h1>
<?php

include 'connection/dbcon.php';

$sql="SELECT * FROM `todo`  WHERE setdata='public' ORDER BY `sl` DESC";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);

for($i=0;$i<$num;$i++){
    $row=mysqli_fetch_assoc($result);
    echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
            <h1 class="display-7">'.$row['username'].'</h1>
            <h5>'.$row['title'].'</h5>
            <p class="lead">'.$row['des'].'
            </p>
            <hr/>
            <p>'.$row['datetime'].'</p>
        </div>
    </div>';
}

?>

    </div>



    <?php include 'other/_foo.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>