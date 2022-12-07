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

if (isset($_GET['edit'])) {
    $idPost= $_GET["edit"];

    $sql= "SELECT * FROM Post WHERE idPost = $idPost;";

    $results= $mysqli->query($sql);
    if(!$results){
        ECHO $mysqli->error;
        exit();
    }

    $row = $results->fetch_assoc();
    $mysqli->set_charset("utf8");    
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
    <link rel="stylesheet" href="./style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Additional Scripts -->
    <script src="https://kit.fontawesome.com/10681d46e7.js" crossorigin="anonymous"></script>

	<style>
        #upload {
            height: 30vh;
            border: 2pt dashed #e9ecef;
            border-radius: 0.375rem;
        }
        .hover {
            background-color: lightyellow;
        }
        .file-indicator {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .filename-text {
            margin-bottom: 0;
        }
        .delete-btn {
            color: #6c757d;
        }
        .delete-btn:hover {
            color: #5c636a;
        }
        #tag-display {
            height: 100px;
        }
        #tag-display:empty:before {
            content: attr(placeholder);
            color: #777;
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
        <form id="upload-form" 
            action="<?php echo isset($row) ? 'edit' : 'upload'?>-confirmation.php<?php echo isset($row) ? '?pid=' . $idPost : ''?>" 
            method="POST" enctype="multipart/form-data"
        >
            <!-- File Upload Area -->
            <input type="file" id="file-browser" multiple hidden>
            <input name="files" id="hidden-file-input" hidden
            <?php
                if (isset($row['content']) && !empty($row['content']) ) {
                    echo "value='" . $row['content'] . "'";
                };
            ?>>
            <div 
                class="d-flex flex-column justify-content-center align-items-center" id="upload"
                ondrop="dropHandler(event);"
                ondragover="dragOverHandler(event);"
                ondragleave="dragLeaveHandler(event);"
            >
                <p style="font-size: 20pt" class="m-0 text-center">Drag files in to upload</p>
                <p style="font-size: 15pt" class="m-0 text-center">or</p>
                <button type="button" class="btn btn-secondary" onclick="browseFiles(event);">Browse files</button>
            </div>
            <div id="file-indicators-container" class="mt-2" hidden>
            </div>
            <!-- Title Entry -->
            <div class="form-group mb-3 mt-4">
                <input name="title" class="form-control border-secondary" placeholder="Title" 
                <?php
                    if (isset($row['title']) && !empty($row['title']) ) {
                        echo "value=\"" . $row['title'] . "\"";
                    };
                ?>>
            </div>
            <!-- Description Entry -->
            <div class="form-group my-3">
                <textarea name="description" class="form-control border-secondary" rows="5" placeholder="Description"><?php echo (isset($row['description']) && !empty($row['description']) ) ? trim($row['description']) : ''; ?></textarea>
            </div>
            <div class="row mb-3">
                <!-- Tag Entry -->
                <div class="form-group col-sm mb-3">
                    <label for="tags">Content Tags</label>
                    <textarea name="tags" id="tag-input" hidden><?php echo (isset($row['tags']) && !empty($row['tags']) ) ? implode(',', json_decode($row['tags'], true)['tags']) : ''; ?></textarea>
                    <div class="form-control border-secondary tags" id="tag-display" contenteditable placeholder="Separate individual tags using commas">
                        <?php
                            if (isset($row['tags']) && !empty($row['tags']) ) {
                                $tags = json_decode($row['tags'], true)['tags'];
                                for ($i = 0; $i < count($tags); $i++) {
                                    echo '<span>' . $tags[$i] . '</span><b style="opacity: 0">,</b>';
                                }
                            };
                        ?>
                    </div>
                </div>
                <!-- Media Tag Entry -->
                <div class="form-group col-sm">
                    <label>Media Tags</label>
                    <div class="border border-secondary rounded p-2">
                    <div class="form-check form-check-inline">
                            <input name="pdf" class="form-check-input" type="checkbox" id="pdfCheckbox" value="1"
                                <?php
                                    if (isset($row['mediaType']) && !empty($row['mediaType']) && str_contains($row['mediaType'], '1')) {
                                        echo "checked";
                                    };
                                ?>
                            >
                            <label class="form-check-label" for="pdfCheckbox">
                                PDF
                                <i class="media-icon fa-solid fa-file-pdf"></i>
                            </label>
                        </div>    
                    <div class="form-check form-check-inline">
                            <input name="image" class="form-check-input" type="checkbox" id="imageCheckbox" value="2"
                                <?php
                                    if (isset($row['mediaType']) && !empty($row['mediaType']) && str_contains($row['mediaType'], '2')) {
                                        echo "checked";
                                    };
                                ?>
                            >
                            <label class="form-check-label" for="imageCheckbox">
                                Image
                                <i class="media-icon fa-solid fa-file-image"></i>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="video" class="form-check-input" type="checkbox" id="videoCheckbox" value="3"
                                <?php
                                    if (isset($row['mediaType']) && !empty($row['mediaType']) && str_contains($row['mediaType'], '3')) {
                                        echo "checked";
                                    };
                                ?>
                            >
                            <label class="form-check-label" for="videoCheckbox" >
                                Video
                                <i class="media-icon fa-solid fa-file-video"></i>
                            </label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <input name="audio" class="form-check-input" type="checkbox" id="audioCheckbox" value="4"
                                <?php
                                    if (isset($row['mediaType']) && !empty($row['mediaType']) && str_contains($row['mediaType'], '4')) {
                                        echo "checked";
                                    };
                                ?>
                            >
                            <label class="form-check-label" for="audioCheckbox">
                                Audio
                                <i class="media-icon fa-solid fa-file-audio"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <button type="submit" class="btn btn-lg btn-outline-dark">Submit</button>
                <?php
                    if (isset($row)) {
                        echo '<a class="btn btn-lg btn-outline-danger" style="margin-right: 10px" href="edit-confirmation.php?pid=' . $idPost . '&delete=1">Delete</a>';
                    };
                ?>
            </div>
        </form>
    </div>

    <script src="../scripts/file-upload.js"></script>
    <script src="../scripts/tag-entry.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>