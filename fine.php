<?php
require_once('connect-db.php');
session_start();

if(isset($_POST['fine_btn'])){

    try {

    $userID = $_POST['userID'];
    $amount = $_POST['amount'];

    $query = 'UPDATE Users SET fine_total = fine_total + :amount WHERE userID = :userID';
    $statement = $db->prepare($query);
    $data = [
        ':userID' => $userID,
        ':amount' => $amount
    ];

    $query_execute = $statement->execute($data);
    if($query_execute){
        $_SESSION['message'] = 'Fined Successfully';
        header('location:employee-homepage.php');
        exit(0);
    }
    else {
        $_SESSION['message'] = 'Not Fined';
        header('location:employee-homepage.php');
        exit(0);
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}


}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABC Library Admin Fines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        @media (min-width: 768px){
    .input-group-btn{
    width: 1% !important;
    }
    }
        .fine_title {
            margin: 20px;
        }
        .navbar {
            padding: 10px;
            height: min-content;
        }

        .nav-item {
            font-size: larger;
        }
        .navbar-brand {
            font-size: xx-large;
        }
        .logout {
            margin:10px;
            left:250px;
        }

        .card-body {
            margin: 150px;
            padding: 50px;
            outline: 1px solid grey;
            border-radius: 2pt;
        }

        .container {
            margin-top: 50px;
        }
    </style>
  </head>
  <body>
    <nav class='navbar navbar-light bg-light'>
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
    <h1 class='fine_title'>Fine Member</h1>

    <div class='card-body'>
        <form action="fine.php" method="POST">
            <div class='mb-3'>
                <label >userID</label>
                <input type="number" name='userID' class="form-control">
            </div>
            <div class='mb-3'>
                <label >Fine Amount</label>
                    <input type="number" name='amount' class="form-control">
            </div>

            <div class='mb-3'>
                <button type="submit" name='fine_btn' class="btn btn-primary">Apply Fine</button>
            </div>
                                
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
