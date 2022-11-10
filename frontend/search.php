<?php 

//var_dump($_GET);

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

if( isset($_GET["title"]) && !empty($_GET["title"])) {
	$sql = $sql . " AND title LIKE '%" . addslashes($_GET["title"]) . "%'";
}

if( isset($_GET["uploader"]) && !empty($_GET["uploader"])) {
	$sql = $sql . " AND User.email = '" . $_GET["uploader"] ."'";
}




if( isset($_GET["media"]) && !empty($_GET["media"])) {
	$mediaTypeList = "";
	foreach($_GET["media"] as $mediaType){
		$mediaTypeList = $mediaTypeList . $mediaType;
	}

	$sql = $sql . " AND mediaType LIKE '%" . $mediaTypeList ."%'";
}

if( isset($_GET["start"]) && !empty($_GET["start"])) {
	$sql = $sql . " AND dateCreated >= '" . $_GET["start"] . "'";
}

if( isset($_GET["end"]) && !empty($_GET["end"])) {
	$sql = $sql . " AND dateCreated <= '" . $_GET["end"]. "'";
}

// fix this json search
/*
if( isset($_GET["tags"]) && !empty($_GET["tags"])) {
	$sql = $sql . " AND tags = " . $_GET["tags"];
}*/

$sql = $sql . ";";

//echo $sql;


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


<!-- dashboard complete --> 
    <div class="container">

		<div class="row ">
			<div class="col-10">
				<h2 class="heading">Search Results</h2>
			</div>
			<div class="col-2">
				<a href="dashboard.php" class="btn btn-primary heading">Return to Search</a>
			</div>
		</div>

        <div class="row" id="repository-header">
            <div class="col-1 lock-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="col">
                Date
            </div>
            <div class="col">
                Title
            </div>
            <div class="col">
                Uploader
            </div>
            <div class="col">
                Media Tags
            </div>
            <div class="col-4">
                Content Tags
            </div>
        </div>


        <!-- PHP STARTS HERE -->
        <?php 
		if($posts->num_rows == 0) {
			echo '<p>No Results Found</p>';
		} 

		while($row = $posts->fetch_assoc()):?>

        
        <a class="submission-link" href="viewSubmission.php?idPost=<?php echo $row['idPost'];?> ">

        <div class="row submission" id="<?php echo $row['idPost'];?>">
            <div class="col-1">
                <?php 
                if($row['locked'] == 0) {
                    echo '<i class="fa-solid fa-lock"></i>';
                } 
                else {
                    echo '<i class="fa-solid fa-unlock"></i>';

                };?>
            </div>

            <div class="col">
                <?php echo $row['dateCreated'];?>
            </div>
            
            <div class="col">
            <?php echo $row['title'];?>
            </div>
            
            <div class="col">
            <?php echo $row['email'];?>
            </div>
            
            <div class="col">
            <?php 
            $mediaTypes = $row['mediaType'];
            $length = strlen($mediaTypes);

            for($i=0; $i<$length; $i++) {
                if($mediaTypes[$i]=='0'){
                    echo '<i class="media-icon pad fa-solid fa-file-pdf"></i>';
                }
                if($mediaTypes[$i]=='1'){
                    echo '<i class="media-icon pad fa-solid fa-file-image"></i>';
                }
                if($mediaTypes[$i]=='2'){
                    echo '<i class="media-icon pad fa-solid fa-file-video"></i>';
                }
                if($mediaTypes[$i]=='3'){
                    echo '<i class="media-icon pad fa-solid fa-file-audio"></i>';
                }

            }
            ?> 
            </div>
            <div class="col-4 tags">
                <?php
                if ( isset($row['tags']) ) {
                    $json = json_decode($row['tags'], true);
                    //var_dump($json['Tags']);
                    for($i = 0; $i < count($json['Tags']); $i++){
                        echo '<span>';
                        echo $json['Tags'][$i];
                        echo'</span>';
                    }
                }

                ?>
            </div>
        </div>
        </a>
        <?php endwhile;?>

		
        <!-- 
            <div class="row submission" id="submission-id">
            <div class="col-1">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="col">
                9/24/2022
            </div>
            <div class="col">
                Title Placeholder
            </div>
            <div class="col">
                ttrojan@usc.edu
            </div>
            <div class="col">
                <i class="media-icon fa-solid fa-file-word"></i>
            </div>
            <div class="col-4 tags">
                <span>Alcohol</span>
                <span>Drugs</span>
                <span>Los Angeles</span>
                <span>Drunk</span>
                <span>Over 21</span>
                <span>Testing</span>
            </div>
        </div>
        -->

    </div>
</div>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>