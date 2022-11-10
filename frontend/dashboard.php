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

$sql = "SELECT * FROM Post
JOIN User 
	on User.idUser = Post.User_idUser";


$posts = $mysqli->query($sql);
if (!$posts) {
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
   <!--  <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script> -->
    <script src="https://kit.fontawesome.com/10681d46e7.js" crossorigin="anonymous"></script>


    <script>
</script>

    <style>

        #repository-header{
            font-size:30px;

        }

        .submission-link{
            text-decoration:none;
            color:black;
        }

        .pad{
            padding: 0px 5px;
        }

        .center{
            font-size: 20px;
            margin-left:auto;
            margin-right:auto;
            width: 300px;
        }
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
                    <a href="dashboard.php" class="nav-link active">Dashboard</a>
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
    <div id="search" class="heading">
        <h2>Search Repository</h2>
        <form id="search-form" action="search.php" method="GET">
            <div class="row">
            <div class="mb-3 col">
                <label for="title" class="form-label">Title</label>
                <input type="title" class="form-control" id="title" name="title" aria-describedby="title">
            </div>
                <div class="mb-3 col">
                    <label for="uploader" class="form-label">Uploader</label>
                    <input type="email" class="form-control" id="uploader" name="uploader" aria-describedby="uploader" placeholder="ttrojan@usc.edu">
                </div>
                <div class="mb-3 col">
                    <label for="content-tags" class="form-label">Content Tags</label>
                    <textarea class="form-control" id="content-tags" name="tags" aria-describedby="content-tags"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label">File Types</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="file-pdf" name="media[]" value="0">
                        <label class="form-check-label" for="file-pdf">PDF <i class="media-icon fa-solid fa-file-pdf"></i></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="file-image" name="media[]" value="1">
                        <label class="form-check-label" for="file-image">Image <i class="media-icon fa-solid fa-file-image"></i></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="file-video" name="media[]" value="2">
                        <label class="form-check-label" for="file-video">Video <i class="media-icon fa-solid fa-file-video"></i></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="file-audio" name="media[]" value="3">
                        <label class="form-check-label" for="file-audio">Audio <i class="media-icon fa-solid fa-file-audio"></i></label>
                    </div>
                </div>

                <div class="mb-3 col input-group">
                        <span class="input-group-text">Date Range</span>
                        <input type="date" id="start" aria-label="Start Range" name="start" class="form-control">
                        <input type="date" id="end" aria-label="End Range" name="end" class="form-control">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary" id="search-btn">Search</button>
                </div>

            </div>

        </form>
    </div>
<hr>

<p class="center">Click search to view submissions</p>

</div>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>