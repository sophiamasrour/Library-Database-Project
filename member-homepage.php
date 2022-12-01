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
	<title>ABC Library</title>
	<style>

		.navbar {
            padding: 10px;
            height: min-content;
        }
        .navbar-brand {
            font-size: xx-large;
        }

	</style>

</head>
<body>

<div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">ABC Library</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="member-homepage.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Checked Out</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Wishlist</a>
      </li>
	  <li>
	  <form class="form-inline" action="member-homepage.php" method="POST">
    <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
  </form>
	  </li>
	  <li>
	  <a class='btn btn-danger' href="employee-logout.php">Logout</a>
	  </li>
    </ul>
  </div>
</nav>
    </div>
	<div class="container">
        <?php
        echo "<h1> Welcome, ".$_SESSION['user']['name']." </h1>";
        ?>
	</div>

	<div class='container'>
        <div class='row'>
            <div class = 'col-md-12 mt-4'>

            <?php if(isset($_SESSION['message'])) : ?>
                    <h5 class = 'alert alert-success'><?= $_SESSION['message']; ?></h5>
                <?php
                    unset($_SESSION['message']);
                    endif;
                ?>
               
                <div class='card'>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Quantity Available</th>
                                    <th>Total Quantity</th>
                                    <th>Average Rating</th>
                                    <th>Number of Pages</th>
                                    <th>Check Out</th>
                                    <th>Wishlist</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php
                                        if (isset($_POST['search'])) {
                                            $keyword=$_POST['keyword'];
                                            $query= $db->prepare("SELECT * FROM Books WHERE title like '%$keyword%' or author like '%$keyword%'");
                                            $query->execute();
                                            $query->setFetchMode(PDO::FETCH_OBJ);

                                            while($row=$query->fetch()) {

                                                ?>

                                             <tr>
                                                    <td><?=$row->itemID; ?></td>
                                                    <td><?=$row->title; ?></td>
                                                    <td><?=$row->author; ?></td>
                                                    <td><?=$row->quantityAvailable; ?></td>
                                                    <td><?=$row->totalQuantity; ?></td>
                                                    <td><?=$row->averageRating; ?></td>
                                                    <td><?=$row->numberOfPages; ?></td>
                                                    <td>
                                                        <a href="checkout.php?itemID=<?= $row->itemID; ?>" class="btn btn-primary">Check Out</a>
                                                    </td>
                                                    <td>
                                                        <form action="checkout.php" method='POST'>
                                                            <button type='submit' name="wishlist_book" value="<?= $row->itemID; ?>"class="btn btn-primary">Add to Wishlist</button>
                                                        </form>
                                                       
                                                    </td>
                                            </tr>
                                            <?php
                                            }
                                        
                                        } else {

                                            $query = "SELECT * FROM Books";
                                        $statement = $db->prepare($query);
                                        $statement->execute();
                                        
                                        $statement->setFetchMode(PDO::FETCH_OBJ);
                                        $result = $statement->fetchAll(); // PDO::FETCH_ASSOC
                                        if($result){

                                            foreach($result as $row)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?=$row->itemID; ?></td>
                                                    <td><?=$row->title; ?></td>
                                                    <td><?=$row->author; ?></td>
                                                    <td><?=$row->quantityAvailable; ?></td>
                                                    <td><?=$row->totalQuantity; ?></td>
                                                    <td><?=$row->averageRating; ?></td>
                                                    <td><?=$row->numberOfPages; ?></td>
                                                    <td>
                                                        <a href="checkout.php.php?itemID=<?= $row->itemID; ?>" class="btn btn-primary">Check Out</a>
                                                    </td>
                                                    <td>
                                                        <form action="wishlist.pho" method='POST'>
                                                            <button type='submit' name="wishlist_book" value="<?= $row->itemID; ?>"class="btn btn-primary">Add to Wishlist</button>
                                                        </form>
                                                       
                                                    </td>
                                                </tr>
                                                <?php

                                            }

                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="5">No Record Found</td>
                                            </tr>
                                            <?php
                                        }

                                        }
                                        
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>