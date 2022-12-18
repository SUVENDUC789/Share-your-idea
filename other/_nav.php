<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Suv-Todo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
<?php
// session_start();
if(isset($_SESSION['user'])){
   echo '<a class="nav-link active" aria-current="page" href="index.php">Home</a>
   <a class="nav-link active" aria-current="page" href="logout.php">log out</a>';
}
else{
  echo '<a class="nav-link active" aria-current="page" href="login.php">login</a>
  <a class="nav-link active" aria-current="page" href="signup.php">Sign up</a>';
}
?>     
      </div>
    </div>
  </div>
</nav>