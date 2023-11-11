<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a07d588d75.js" crossorigin="anonymous"></script>
    <link href="http://localhost/Myproj/assets/css/style.css" rel="stylesheet">
    <link
      href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <title><?php if(isset($title)){echo $title;} ?></title>
</head>

<body>
    <header class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg color-white">
                <div class="container-fluid">
                    <a class="navbar-brand text-light" href="http://localhost/Myproj/home.php">Heavenly Homes</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="text-light nav-link active" aria-current="page" href="http://localhost/Myproj/home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="text-light nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item dropdown text-white">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php if (!isset($_SESSION['authenticated'])) : ?>
                                        Login/Register
                                    <?php endif ?>
                                    <?php if (isset($_SESSION['authenticated'])) : ?>
                                        Dashboard
                                    <?php endif ?>
                                </a>
                                <ul class="dropdown-menu bg-dark">
                                    <?php if (!isset($_SESSION['authenticated'])) : ?>
                                        <li><a class="dropdown-item text-white" href="http://localhost/Myproj/authentication/login.php">Login</a></li>
                                        <li><a class="dropdown-item text-white" href="http://localhost/Myproj/authentication/register.php">Register</a></li>
                                    <?php endif ?>

                                    <?php if (isset($_SESSION['authenticated'])) : ?>
                                        <li><a class="dropdown-item text-white" href="http://localhost/Myproj/authentication/logout.php">Logout</a></li>
                                        <li><a class="dropdown-item text-white" href="http://localhost/Myproj/dashboard.php">Dashboard</a></li>
                                        <li><a class="dropdown-item text-white" href="http://localhost/Myproj/list.php">List Property</a></li>
                                    <?php endif ?>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>