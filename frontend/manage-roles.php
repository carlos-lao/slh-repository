<?php 

require 'config.php';

/*if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
    header("Location: signin.php");
}*/

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if( $mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}

$sql = "SELECT * FROM user WHERE idUser = 1 OR idUser = 2";


$user = $mysqli->query($sql);
if (!$user) {
    echo $mysqli->error;
    exit();
}

$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Substances and Lived History Repository</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href = "style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Additional Scripts -->
    <script src="https://kit.fontawesome.com/10681d46e7.js" crossorigin="anonymous"></script>

	<style>


    </style>


</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark flex-column" style="background-color:#840000;">
    <div class="container-fluid">
        <div class="d-flex">
            <a href="dashboard.php" class="navbar-brand">Substances and Lived History Repository</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="manage-roles.php" class="nav-link active">Manage Roles</a>
                </li>
                <li class="nav-item">
                    <a href="upload.php" class="nav-link">Upload</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container">
    <div id="add-users" class="heading">
    <h1>Add Users</h1>
    <form>
        <div class="row">
            <div class="col-3">
                <input type="email" class="form-control" placeholder="ttrojan@usc.edu">
            </div>
            <div class="col-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected>--Select Permissions--</option>
                    <option value="1">Moderator</option>
                    <option value="2">Administrator</option>
                </select>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary">Invite</button>
            </div>
        </div>
    </form>
    </div>
    <div id="user-perms">
        <!-- list of users -->
        <h1>Advanced User Permissions</h1>
        <?php while($row = $user->fetch_assoc()):?>
        
        <div class="row submission" id="user-<?php echo $row['idUser'];?>">
        <div class="col-3">
            <?php echo $row['name'];?>
            </div>
            <div class="col-3">
            <?php echo $row['email'];?>
            </div>
            <div class="col-3">
            <?php 
                if($row['accessLevel'] == 1) {
                    echo 'Moderator';
                } 
                else if($row['accessLevel'] == 2) {
                    echo 'Administrator';

                };?>
            </div>
            <div class="col-3">
                <a href="">
                    X 
                </a>
            </div>
        </div>
        <?php endwhile;?>
    </div>
</div>

        
<!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>