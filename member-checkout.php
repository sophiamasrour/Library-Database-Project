<?php
require_once 'connect-db.php';
session_start();

if(!isset($_SESSION['user'])){
    header('location:member-login.php');
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

        .space-block-1 {
            width:250px;
        }

        .space-block-2 {
            width:500px;
        }

        .search-bar-button {
            display: inline-block;
        }

        .nav-link {
			font-size: larger;
		}


        .search-bar {
            float:left;
        }

        .search-button {
            float:right;
        }

		.navbar {
            padding: 10px;
            height: min-content;
            margin-bottom: 25px;
        }
        .navbar-brand {
            font-size: xx-large;
        }

	</style>

</head>
<body>

<div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="member-homepage.php">ABC Library</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="member-checkout.php">Checked Out</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="member-wishlist.php">Wishlist</a>
      </li>
      <li>
       <div class='space-block-1'></div> 
	  <li>
	  <li class = 'search-bar-button'>
	  <form class="form-inline" action="member-homepage.php" method="POST">
    <input class="form-control mr-sm-2 search-bar" type="search" name="keyword" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0 search-button" name="search" type="submit">Search</button>
  </form>
	  </li>
      <li>
       <div class='space-block-2'></div> 
	  <li>
	  <a class='btn btn-danger' style ='float:right' href="member-logout.php">Logout</a>
	  </li>
     
    </ul>
  </div>
</nav>
    </div>
	<div class="container">
        <?php
        echo "<h3> Welcome, ".$_SESSION['user']['name']." </h3>";
        ?>
	</div>

	<?php if(isset($_SESSION['message'])) : ?>
                    <h5 class = 'alert alert-success'><?= $_SESSION['message']; ?></h5>
                <?php
                    unset($_SESSION['message']);
                    endif;
                ?>

	<div class='container'>
        <div class='row'>
            <div class = 'col-md-12 mt-4'>

            <?php if(isset($_SESSION['message'])) : ?>
                    <h5 class = 'alert alert-success'><?= $_SESSION['message']; ?></h5>
                <?php
                    unset($_SESSION['message']);
                    endif;
                ?>

				<h1>Check Out History</h1>
               
                <div class='card'>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Check Out Date</th>
                                    <th>Return Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php
                                        function checkgrab($userID){
                                            global $db;
                                            $query= $db->prepare("SELECT * FROM checked_out_history WHERE userID=:userID");
                                            $query->bindValue(':userID', $userID);
                                            $query->execute();
                                            $query->setFetchMode(PDO::FETCH_OBJ);
                                            while($row=$query->fetch()) {

                                                ?>

                                             <tr>
                                                    <td><?=$row->itemID; ?></td>
                                                    <td><?=$row->checkOutDate; ?></td>
                                                    <td><?=$row->returnDate; ?></td>
                                                    
                                            </tr>
                                            <?php
                                            }
                                        }
                                        if (isset($_POST['search'])) {
                                          
                                            checkgrab($_SESSION['user']['userID']);
                                            // $query= $db->prepare("SELECT * FROM checked_out_history WHERE $_SESSION['user']['userID']=:userID");
                                            // $query->execute();
                                            // $query->setFetchMode(PDO::FETCH_OBJ);
                                            
                                            
                                        
                                        } else {

                                       
                                            checkgrab($_SESSION['user']['userID']);
                                            

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