<?php session_start();
include('connect-db.php'); 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABC Library Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        @media (min-width: 768px){
    .input-group-btn{
    width: 1% !important;
    }
    }
        .navbar {
            padding: 10px;
            height: min-content;
        }
        .navbar-brand {
            font-size: xx-large;
        }
        .logout {
            margin:10px;
            left:250px;
            float:left;
        }

        .container {
            margin-top: 50px;
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-light bg-light justify-content-between input-group">
  <a href='employee-homepage.php'class="navbar-brand">ABC Library Admin</a>
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="fine.php">Fine<span class="sr-only"></span></a>
      </li>
    </ul>
     
      <form class="form-inline" action="employee-homepage.php" method="POST">
    <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
  </form>

      <a class='btn btn-danger' href="employee-logout.php">Logout</a>
   
 
</nav>

       
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
                    <div class='card-header'>
                        <h3>Book Inventory
                            <a href="book-add.php" class ='btn btn-primary float-end'>Add Book</a>
                        </h3>
                    </div>
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
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php
                                        if (isset($_POST['search'])) {
                                            $keyword=$_POST['keyword'];
                                            $query= $db->prepare("SELECT * FROM Books WHERE title like '%$keyword%' or authorName like '%$keyword%'");
                                            $query->execute();
                                            $query->setFetchMode(PDO::FETCH_OBJ);

                                            while($row=$query->fetch()) {

                                                ?>

                                             <tr>
                                                    <td><?=$row->itemID; ?></td>
                                                    <td><?=$row->title; ?></td>
                                                    <td><?=$row->authorName; ?></td>
                                                    <td><?=$row->quantityAvailable; ?></td>
                                                    <td><?=$row->totalQuantity; ?></td>
                                                    <td><?=$row->averageRating; ?></td>
                                                    <td><?=$row->numberOfPages; ?></td>
                                                    <td>
                                                        <a href="book-edit.php?itemID=<?= $row->itemID; ?>" class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="code.php" method='POST'>
                                                            <button type='submit' name="delete_book" value="<?= $row->itemID; ?>"class="btn btn-danger">Delete</button>
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
                                                    <td><?=$row->authorName; ?></td>
                                                    <td><?=$row->quantityAvailable; ?></td>
                                                    <td><?=$row->totalQuantity; ?></td>
                                                    <td><?=$row->averageRating; ?></td>
                                                    <td><?=$row->numberOfPages; ?></td>
                                                    <td>
                                                        <a href="book-edit.php?itemID=<?= $row->itemID; ?>" class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="code.php" method='POST'>
                                                            <button type='submit' name="delete_book" value="<?= $row->itemID; ?>"class="btn btn-danger">Delete</button>
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
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>