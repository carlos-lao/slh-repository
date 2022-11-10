<?php

$host= "303.itpwebdev.com";
$user= "root";
$password= "root";
$db= "skawaguc_dvd_db";

$mysqli= new mysqli($host, $user, $password, $db);

if ($mysqli->connect_errno){
	ECHO $mysqli->connect_errno;
	exit();
}

$idPost= $_GET["idPost"];

$sql= "SELECT * FROM Post
WHERE idPost=$idPost ;";



$results= $mysqli->query($sql);
	if(!$results){
		ECHO $mysqli->error;
		exit();
	}

$row= $results->fetch_assoc();
// 	var_dump($row);

$mysqli->set_charset("utf8");


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
   <!--  <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script> -->
    <script src="https://kit.fontawesome.com/10681d46e7.js" crossorigin="anonymous"></script>

    <style>

        #repository-header{
            font-size:30px;

        }
    </style>


</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark flex-column" style="background-color:#840000;">
    <div class="container-fluid">
        <div class="d-flex">
            <a href="dashboard.html" class="navbar-brand">Substances and Lived History Repository</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a href="dashboard.html" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="manage-roles.html" class="nav-link">Manage Roles</a>
                </li>
                <li class="nav-item">
                    <a href="upload.html" class="nav-link active">Upload</a>
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
    <div class="submissionDisplay">
    <div class="subTitle">
            <h1><i class="fa-solid fa-lock"></i><?php ECHO $row["title"]; ?></h1>
            <h1><i class="fa-solid fa-file-word titleIcon"></i></h1>
        </div>
        <div><p>Submitted by: <?php ECHO $row["User_idUser"]; ?></p></div>
        <div class="subTags">
            <div class="col-4 tags">
                <!-- figure out toags -->
                <span>Alcohol</span><span>Drugs</span><span>Los Angeles</span><span>Drunk</span>
            </div>
            <span class="editSubButt">Edit Submission</span>
        </div>
        <div class="subDesc">
            <p>
                <?php ECHO $row["description"]; ?>
            </p>
        </div>

        <?php 
        
            if(mysqli_num_rows($row["pictureArray"]) > 0){
                while($pos = $row["pictureArray"]->fetch_assoc()){
                    $imageURL = $pos["file_name"];
            ?>
                <img src="<?php echo $imageURL; ?>" alt="" />
            <?php }
            }else{ ?>
                <p>No image(s) found...</p>
        <?php } ?> 

    </div>
</div>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>