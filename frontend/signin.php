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
            <a href="#" class="navbar-brand">Substances and Lived History Repository</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        
    </div>
</nav>

<!-- Content -->
<div class="container">
    <div class="signinBox">
        <form action="add_confirmation.php" method="GET">

            <h2>Login<h2>

            <div class="form-group row">
                <label for="title-id" class="col-sm-3 col-form-label text-sm-right">Email (username@usc.edu): <span class="text-danger">*</span></label>
                <span></span>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title-id" name="title">
                </div>
            </div> <!-- .form-group -->

            <div class="form-group row">
                <label for="title-id" class="col-sm-3 col-form-label text-sm-right txtBox">Password: <span class="text-danger">*</span></label>
                <span></span>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title-id" name="title">
                </div>
            </div> <!-- .form-group -->


            <div class="form-group row">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </div> <!-- .form-group -->

        </form>
    </div>
</div>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>