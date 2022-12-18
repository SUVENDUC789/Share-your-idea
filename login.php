<?php
session_start();

if(isset($_SESSION['user'])){
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

    <title>Login Now</title>
</head>

<body>
    <?php include 'other/_nav.php'; ?>

    <div class="container">
        <h1 class="text-center alert-primary my-2 py-2">Log in</h1>

<?php

include 'connection/dbcon.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['uname'];
        $pass=$_POST['p'];

        $sql="SELECT * FROM `users` WHERE uname='$username' AND pass='$pass'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);

        if($num==1){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong>Log in successfully .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

          $_SESSION['user']=$username;
          header("location: index.php");


        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong>Please enter correct username and password.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

}

?>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label"><b>Username</b></label>
                <input type="text" name="uname" class="form-control" id="username" aria-describedby="emailHelp"
                    required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
                <input type="password" name="p" class="form-control" id="exampleInputPassword1" required>
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>

    <?php include 'other/_foo.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>