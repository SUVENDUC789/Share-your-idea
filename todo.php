<?php

session_start();
if(isset($_SESSION['user'])){
        $username=$_SESSION['user'];
        // echo "Ok user";

}else if(!isset($_SESSION['user'])){
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
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>


    <title>Personal Todo - <?php echo $_SESSION['user']; ?> </title>

</head>

<body>
<?php include 'other/_nav.php'; ?>
    <div class="container my-2">
        <h4 class="text-center alert alert-info">Add note here - <?php echo $_SESSION['user']; ?></h4>

<?php
include 'connection/dbcon.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST['title'];
    $note=$_POST['note'];
    $set=$_POST['set'];

    $sql="INSERT INTO `todo` (`sl`, `username`, `title`, `des`, `setdata`, `datetime`) VALUES (NULL, '$username', '$title', '$note', '$set', current_timestamp())";

    $result=mysqli_query($conn,$sql);

    if($result){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success !</strong> Add data successfully .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}
?>

        <form action="todo.php" method="post">
            <div class="mb-3">
                <label for="tile" class="form-label"><b>Title</b></label>
                <input type="text" name="title" class="form-control" id="tile">
            </div>
            <div class="mb-3">
                <label for="Note" class="form-label"><b>Short Note</b></label>
                <input type="text" name="note" class="form-control" id="Note">
            </div>
            <div class="mb-3">
                <b>Set :</b>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="set" id="flexRadioDefault1" value="Private">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Private
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="set" id="flexRadioDefault2" checked
                        value="Public">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Public
                    </label>
                </div>

            </div>
            <input type="submit" class="btn btn-success" value="Add">
        </form>
    </div>

    <div class="container">
        <h5 class="text-center alert alert-danger">Notes</h5>
        <table class="table table-striped table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

<?php

$sql="SELECT * FROM `todo` WHERE username='$username'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);

for($i=0;$i<$num;$i++){
    $row=mysqli_fetch_assoc($result);
    if($row['setdata']=='Public'){
        echo '<tr>
        <th scope="row">'.($i+1).'</th>
        <td>'.$row['title'].'</td>
        <td>'.$row['des'].'</td>
        <td>No Action neesded</td>
      </tr>';
    }elseif($row['setdata']=='Private') {
        echo '<tr>
        <th scope="row">'.($i+1).'</th>
        <td>'.$row['title'].'</td>
        <td>'.$row['des'].'</td>
        <td>
        <a href="edit.php?sl='.$row['sl'].'" class="btn btn-primary mx-2 mb-2">Edit</a>
        <a href="delete.php?sl='.$row['sl'].'" class="btn btn-danger mx-2 mb-2">Delete</a>
        </td>
      </tr>';
    }
}

?>

            </tbody>
        </table>
    </div>


    <?php include 'other/_foo.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>