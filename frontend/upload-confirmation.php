<?php 

require 'config.php';

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

if ( !isset($_POST['title']) || empty($_POST['title'])
    || !isset($_POST['description']) || empty($_POST['description']) ) {
	// Missing required fields.
	$error = "Please fill out all required fields.";

} else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

    $mediaTags = "";

	if ( isset($_POST['pdf']) && !empty($_POST['pdf']) ) {
		$mediaTags .= $_POST['pdf'];
	}

    if ( isset($_POST['image']) && !empty($_POST['image']) ) {
		$mediaTags .= $_POST['image'];
	}

    if ( isset($_POST['video']) && !empty($_POST['video']) ) {
		$mediaTags .= $_POST['video'];
	}

    if ( isset($_POST['audio']) && !empty($_POST['audio']) ) {
		$mediaTags .= $_POST['audio'];
	}

    if ( empty($mediaTags) ) {
        $mediaTags = null;
    }

	if ( isset($_POST['tags']) && !empty($_POST['tags']) ) {
		$tags = json_encode(['tags' => explode(',', $_POST['tags'])]);
	} else {
		$tags = null;
	}

    echo $mediaTags;

    $pid = randomNumber(6);
    $uid = 2837508;
    $unlocked = 0;
    $today = date("Y-m-d H:i:s");

	$statement = $mysqli->prepare("INSERT INTO Post(idPost, User_idUser, title, locked, dateCreated, lastEdited, mediaType, tags, description) VALUES (?,?,?,?,?,?,?,?,?)");
	$statement->bind_param("iisisssss", $pid, $uid, $_POST['title'], $unlocked, $today, $today, $mediaTags, $tags, $_POST['description']);

	$results = $statement->execute();
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$statement->close();
}

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
        #upload{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30vh;
            border: 2pt dashed black;
            border-radius: 0.375rem;
        }
        .over{
            background-color: azure;
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
                    <a href="upload.php" class="nav-link active">Upload</a>
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
    <h2 class="mt-4 mb-3">Upload Post</h2>
    <div class="row mt-4">
			<div class="col-12">

			<?php if ( isset($error) && !empty($error) ) : ?>
				<div class="text-danger">
					<?php echo $error; ?>
				</div>
			<?php else :?>
				<div class="text-success">
					<span class="font-italic"><?php echo $_POST['title']; ?></span> was successfully added.
				</div>

			<?php endif; ?>


			</div>
		</div>
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="dashboard.php" role="button" class="btn btn-lg btn-outline-dark">Return to Dashboard</a>
			</div>
		</div>
</div>

        
<!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>