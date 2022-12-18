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

    <title>Create Account</title>
</head>

<body>
    <?php include 'other/_nav.php'; ?>

    <div class="container">
        <h1 class="text-center alert-info my-2 py-2">Create your Account</h1>

<?php

include 'connection/dbcon.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['uname'];
        $pass1=$_POST['p1'];
        $pass2=$_POST['p2'];
        $gender=$_POST['gender'];

        $sql="SELECT * FROM `users` WHERE uname='$username'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);

        if($num==0){
        if($pass1==$pass2){
            $sql="INSERT INTO `users` (`sl`, `uname`, `pass`, `datetime`, `gender`) VALUES (NULL, '$username', '$pass1', current_timestamp(), '$gender')";

            $result=mysqli_query($conn,$sql);

            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success !</strong>Your account created successfully .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error !</strong>Password and retype password are not match.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }}
        else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning !</strong>Username already exits. please enter another username.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
}

?>
        <form action="signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label"><b>Username</b></label>
                <input type="text" name="uname" class="form-control" id="username" aria-describedby="emailHelp"
                    required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
                <input type="password" name="p1" class="form-control" id="exampleInputPassword1" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label"><b>Retype Password</b></label>
                <input type="password" name="p2" class="form-control" id="exampleInputPassword2" required>
                <div id="emailHelp" class="form-text">We'll never share your Password with anyone else.</div>
            </div>
            <div class="mb-3">
                <b>Gender</b>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="female">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" checked
                        value="male">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault3" value="other">
                    <label class="form-check-label" for="flexRadioDefault3">
                        Other
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>

    <?php include 'other/_foo.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>