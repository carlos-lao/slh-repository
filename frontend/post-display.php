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
JOIN User 
	on User.idUser = Post.User_idUser
AND idPost = $idPost;";

if (isset($_GET['lock'])) {
    $mysqli->query("UPDATE Post SET locked = " . $_GET['lock'] . " WHERE idPost = " . $idPost);
    echo '<script>window.location.href = "post-display.php?idPost=' . $idPost . '";</script>';
}

$results= $mysqli->query($sql);
if(!$results){
    ECHO $mysqli->error;
    exit();
}

$row= $results->fetch_assoc();
// 	var_dump($row);

$mysqli->set_charset("utf8");

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

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
            <h1><?php ECHO $row["title"]; ?></h1>
            <h1>
                <?php 
                    $mediaTypes = $row['mediaType'];
                    $length = strlen($mediaTypes);
                    for($i=0; $i<$length; $i++) {
                        if($mediaTypes[$i]=='1'){
                            echo '<i class="media-icon pad fa-solid fa-file-pdf"></i> ';
                        }
                        if($mediaTypes[$i]=='2'){
                            echo '<i class="media-icon pad fa-solid fa-file-image"></i> ';
                        }
                        if($mediaTypes[$i]=='3'){
                            echo '<i class="media-icon pad fa-solid fa-file-video"></i> ';
                        }
                        if($mediaTypes[$i]=='4'){
                            echo '<i class="media-icon pad fa-solid fa-file-audio"></i> ';
                        }
                    }
                ?> 
            </h1>
        </div>
        <div><p><b>Submitted by:</b> <?php echo $row["name"] . " (<a href='mailto:" . $row['email'] . "'>"  . $row['email'] . "</a>)"; ?></p></div>
        <div class="subTags d-flex justify-content-space-between">
            <div class="tags container-fluid" style="padding-left: 0;">
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
            <div class="d-flex">
                <a class="btn btn-light" style="margin-right: 5px; border: 2px solid gray; box-sizing: border-box;"
                    href="post-display.php?idPost=<?php echo $idPost; ?>&lock=<?php echo ($row['locked'] != 0) ? '0' : '1'; ?>"
                >
                    <i class="fa-solid <?php echo ($row['locked'] != 0) ? 'fa-lock' : 'fa-unlock'; ?>"></i>
                </a>
                <?php 
                    if ($row['locked'] != 0) { 
                        echo "<div data-toggle=\"tooltip\" data-placement=\"top\" title=\"This post has been locked and therefore cannot be edited.\">";
                    }; 
                ?>
                    <a class="btn btn-secondary<?php echo ($row['locked'] != 0) ? ' disabled' : ''; ?>" 
                        style="white-space: nowrap; text-align: center;"
                        href="upload.php?edit=<?php echo $row['idPost']?>"
                    > 
                        Edit Submission
                        <i class="bi bi-pencil-fill" style="margin-left: 5px"></i>
                    </a>
                <?php echo ($row['locked'] != 0) ? '</div>' : ''; ?>
            </div>
        </div>
        <div class="subDesc">
            <p>
                <?php ECHO $row["description"]; ?>
            </p>
        </div>

        <embed  
            <?php $srcUrl= "../backend/storage/dummyFile.pdf"; ?>
            src=<?php ECHO $srcUrl; ?>
            width="100%" 
            height="800"/>
    </div>
</div>


<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

</body>