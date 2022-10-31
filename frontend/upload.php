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
        #tagEntryDisplay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0.5px solid black;
            border-radius: 5px;
            padding-left: 5px;
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
        <p>Drag Files Here</p>
    </div>
    <form action="upload_confirmation.php" method="POST">
        <div class="form-group mb-3">
            <input name="title" class="form-control border-secondary" placeholder="Title">
        </div>
        <div class="form-group my-3">
            <textarea name="description" class="form-control border-secondary" rows="5" placeholder="Description"></textarea>
        </div>
        <div class="row mb-3">
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
            <div class="form-group col-sm mb-3">
                <label for="tags">Content Tags</label>
                <div style="position: relative;" onclick="focusEntry();">
                    <div id="tagEntryDisplay" class="tags"><p id="incompleteTag"></p></div>
                    <textarea name="tags" id="tagEntry" class="form-control border-secondary" rows="3" onkeyup="check(this);"  style="opacity: 0;"></textarea>
                </div>
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

<script type="text/javascript">
    var input = document.getElementById('tagEntry');

    input.onkeydown = () => {
        let key = event.keyCode || event.charCode;
        let tagDiv = document.getElementById("tagEntryDisplay");

        if( key === 8 && input.value.length === 0 && tagDiv.children.length > 1 ) {
            tagDiv.children[tagDiv.children.length - 2].remove();
        }
    };

    document.getElementById('tagEntry').addEventListener("change", (e) => {
        if (e.target.value.includes(',')) {
            // create span for new tag
            let newSpan = document.createElement('span');
            newSpan.classList.add('tag');
            newSpan.textContent = e.target.value.slice(0, e.target.value.length-1);
            
            // add it to the div
            let tagDiv = document.getElementById("tagEntryDisplay");
            let incompleteTag = document.getElementById("incompleteTag");
            incompleteTag.textContent = "";
            tagDiv.insertBefore(newSpan, incompleteTag);

            // clear the textarea
            e.target.value = "";
        } else {
            document.getElementById("incompleteTag").textContent = e.target.value;
        }
    });

    function focusEntry() {
        document.getElementById("tagEntry").focus();
    }

    function check(element) {
        let event = new Event('change');
        element.dispatchEvent(event);
    };
</script>

<!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>