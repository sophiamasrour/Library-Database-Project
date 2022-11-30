<?php
require_once 'connect-db.php';
session_start();

if(!isset($_SESSION['user'])){
    header('location:landing-page.php');
}

?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<title>Welcome</title>
</head>
<body>

<div>
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand">ABC Library</a>
            <form class="form-inline" action='search.php' method="POST">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name='searchButton'>Search</button>
            </form>
          </nav>
    </div>
	<div class="container">
        <?php
        echo "<h1> Welcome, ".$_SESSION['user']['name']." </h1>";
        print_r($_SESSION);
        ?>

        <a class='btn btn-primary' href="logout.php">Logout</a>
	</div>
</body>
</html>