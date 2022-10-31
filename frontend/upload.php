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
    <div 
        class="mt-5 mb-3 p-5" id="upload"
        ondrop="dropHandler(event);"
        ondragover="dragOverHandler(event);"
        ondragleave="dragLeaveHandler(event);"
    >
        <p>Upload</p>
    </div>
    <form>
        <div class="form-group mb-3">
            <input class="form-control border-secondary" placeholder="Title">
        </div>
        <div class="form-group my-3">
            <textarea class="form-control border-secondary" rows="5" placeholder="Description"></textarea>
        </div>
        <div class="row mb-3">
            <div class="form-group col-sm">
                <label>Media Tags</label>
                <div class="border border-secondary rounded p-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="imageCheckbox" value="image">
                        <label class="form-check-label" for="imageCheckbox">
                            Image
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                            </svg>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="videoCheckbox" value="video">
                        <label class="form-check-label" for="videoCheckbox">
                            Video
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-reels-fill" viewBox="0 0 16 16">
                                <path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path d="M9 6a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                <path d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h7z"/>
                            </svg>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="textCheckbox" value="text">
                        <label class="form-check-label" for="textCheckbox">
                            Text
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-word-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.485 6.879l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 9.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 1 1 .97-.242z"/>
                            </svg>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="audioCheckbox" value="audio">
                        <label class="form-check-label" for="audioCheckbox">
                            Audio
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-volume-up-fill" viewBox="0 0 16 16">
                                <path d="M11.536 14.01A8.473 8.473 0 0 0 14.026 8a8.473 8.473 0 0 0-2.49-6.01l-.708.707A7.476 7.476 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303l.708.707z"/>
                                <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.483 5.483 0 0 1 11.025 8a5.483 5.483 0 0 1-1.61 3.89l.706.706z"/>
                                <path d="M8.707 11.182A4.486 4.486 0 0 0 10.025 8a4.486 4.486 0 0 0-1.318-3.182L8 5.525A3.489 3.489 0 0 1 9.025 8 3.49 3.49 0 0 1 8 10.475l.707.707zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06z"/>
                            </svg>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm mb-3">
                <label for="tags">Content Tags</label>
                <textarea id="tags" class="form-control border-secondary" rows="3"></textarea>
            </div>
        </div>
        <div class="d-flex flex-row-reverse">
            <button type="submit" class="btn btn-lg btn-outline-dark">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    let element = document.getElementById('upload')

    function dropHandler(ev) {
        console.log('File(s) dropped');
    
        // Prevent default behavior (Prevent file from being opened)
        ev.preventDefault();
    
        if (ev.dataTransfer.items) {
            // Use DataTransferItemList interface to access the file(s)
            [...ev.dataTransfer.items].forEach((item, i) => {
            // If dropped items aren't files, reject them
            if (item.kind === 'file') {
                const file = item.getAsFile();
                console.log(`… file[${i}].name = ${file.name}`);
            }
        });
        } else {
            // Use DataTransfer interface to access the file(s)
            [...ev.dataTransfer.files].forEach((file, i) => {
                console.log(`… file[${i}].name = ${file.name}`);
            });
        }
        element.classList.remove('over');
    }

    function dragOverHandler(ev) {

        console.log('File(s) in drop zone');
    
        // Prevent default behavior (Prevent file from being opened)
        ev.preventDefault();
        
        if (!element.classList.contains('over')) {
            element.classList.add('over');
        }
    }

    function dragLeaveHandler(ev) {
        element.classList.remove('over');
    }
</script>

        
<!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>