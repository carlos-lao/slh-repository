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

    <!-- Additional Scripts -->
    <script src="https://kit.fontawesome.com/10681d46e7.js" crossorigin="anonymous"></script>

	<style>
        #upload {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30vh;
            border: 2pt dashed lightGray;
            border-radius: 0.375rem;
        }
        .hover {
            background-color: azure;
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
        <div 
            class="mb-3 p-5" id="upload"
            ondrop="dropHandler(event);"
            ondragover="dragOverHandler(event);"
            ondragleave="dragLeaveHandler(event);"
        >
            <p style="color: lightGray; font-size: 20pt">Drag Files Here</p>
        </div>
        <form action="upload-confirmation.php" method="POST">
            <div class="form-group mb-3">
                <input name="title" class="form-control border-secondary" placeholder="Title">
            </div>
            <div class="form-group my-3">
                <textarea name="description" class="form-control border-secondary" rows="5" placeholder="Description"></textarea>
            </div>
            <div class="row mb-3">
                <div class="form-group col-sm mb-3">
                    <label for="tags">Content Tags</label>
                    <textarea name="tags" id="tag-input" hidden></textarea>
                    <div class="form-control border-secondary tags" id="tag-display" contenteditable
                        placeholder="Separate individual tags using commas"
                    ></div>
                </div>
                <div class="form-group col-sm">
                    <label>Media Tags</label>
                    <div class="border border-secondary rounded p-2">
                    <div class="form-check form-check-inline">
                            <input name="pdf" class="form-check-input" type="checkbox" id="pdfCheckbox" value="0">
                            <label class="form-check-label" for="pdfCheckbox">
                                PDF
                                <i class="media-icon fa-solid fa-file-pdf"></i>
                            </label>
                        </div>    
                    <div class="form-check form-check-inline">
                            <input name="image" class="form-check-input" type="checkbox" id="imageCheckbox" value="1">
                            <label class="form-check-label" for="imageCheckbox">
                                Image
                                <i class="media-icon fa-solid fa-file-image"></i>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="video" class="form-check-input" type="checkbox" id="videoCheckbox" value="2">
                            <label class="form-check-label" for="videoCheckbox">
                                Video
                                <i class="media-icon fa-solid fa-file-video"></i>
                            </label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <input name="audio" class="form-check-input" type="checkbox" id="audioCheckbox" value="3">
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
            </div>
        </form>
    </div>

    <script src="../scripts/file-upload.js"></script>
    <script src="../scripts/tag-entry.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>