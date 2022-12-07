<?php

require 'config.php';

/*if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
    header("Location: signin.php");
}*/

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

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
                    <a href="dashboard.php" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="manage-roles.php" class="nav-link">Manage Roles</a>
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
    <div class="submissionDisplay">
        <div class="subTitle">
            <h1><i class="fa-solid fa-lock"></i><?php ECHO $row["title"]; ?></h1>
            <h1>
                <?php 
                $mediaTypes = $row['mediaType'];
                $length = strlen($mediaTypes);

                for($i=0; $i<$length; $i++) {
                    if($mediaTypes[$i]=='0'){
                        echo '<i class="media-icon pad fa-solid fa-file-pdf"></i> ';
                    }
                    if($mediaTypes[$i]=='1'){
                        echo '<i class="media-icon pad fa-solid fa-file-image"></i> ';
                    }
                    if($mediaTypes[$i]=='2'){
                        echo '<i class="media-icon pad fa-solid fa-file-video"></i> ';
                    }
                    if($mediaTypes[$i]=='3'){
                        echo '<i class="media-icon pad fa-solid fa-file-audio"></i> ';
                    }

                }
                ?> 
            </h1>
        </div>
        <div><p>Submitted by: <?php ECHO $row["User_idUser"]; ?></p></div>
        <div class="subTags">
            <div class="col-4 tags">
                <?php
                    if ( isset($row['tags']) ) {
                        $json = json_decode($row['tags'], true);
                        //var_dump($json['Tags']);
                        for($i = 0; $i < count($json['tags']); $i++){
                            echo '<span>';
                            echo $json['tags'][$i];
                            echo'</span>';
                        }
                    }
                ?>
            </div>
            <span class="editSubButt">Edit Submission</span>
        </div>
        <div class="subDesc">
            <p>
                <?php ECHO $row["description"]; ?>
            </p>
        </div>

        <embed  
            <?php $srcUrl= "prototypes/testFiles/pdfTest.pdf"; ?>
            src=<?php ECHO $srcUrl; ?>
            width="100%" 
            height="800"/>
    </div>
</div>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>