<?php include_once("connect-db.php"); ?>
  <?php include_once("book-db.php"); ?>
    <?php include("search.php"); ?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction'] && $_POST['btnAction'] == 'Add'))
  {
    addUser($_POST['userID'], $_POST['name'], $_POST['email'], $_POST['phone']);
  }
}

else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == 'Delete')
  {
    deleteBook($_POST['id']);
    $bookList = getAllBooks();
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>ABC Library</title>
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

    <div>

<div class="container">
  <h1>Add User</h1>  

<form name="mainForm" action="index.php" method="post">   
<div class="row mb-3 mx-3">
    ID:
    <input type="number" class="form-control" name="userID" required 
    />            
  </div>  
  <div class="row mb-3 mx-3">
    Name:
    <input type="text" class="form-control" name="name" required 
    />            
  </div>  
  <div class="row mb-3 mx-3">
    Email:
    <input type='email' class="form-control" name="email" required 
    />            
  </div> 
  <div class="row mb-3 mx-3">
    Phone Number:
    <input type="number" class="form-control" name="phone" required 
    />            
  </div>   
  <!-- <div class="row mb-3 mx-3"> -->
  <div>
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark"                    
  </div>  

</form>   
    </div>

</form> 
    </div>

    <div style="margin-top: 50px; padding: 15px;">
        <h1>Books</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Pages</th>
                <!-- change this to ratio of checked out / total quantity when user functionality is added -->
                <th scope="col">Available</th>
                <th scope="col">Rating</th>
                <th scope="col"></th>
                <!-- will be added when users are able to rate books -->
                <!-- <th scope="col">Rating</th> -->
              </tr>
            </thead>

            //<?php $bookList = getAllBooks(); ?>
            <?php foreach ($bookList as $book): ?>
              <tr>
                <td><?php echo $book['itemID']?></td>
                <td><?php echo $book['title']?></td>
                <td><?php echo $book['numberOfPages']?></td>
                <td><?php echo $book['quantityAvailable']?></td>
                <td><?php echo $book['averageRating']?></td>
                <td>
      <form action="index.php" method="post">
        <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" />
        <input type="hidden" name="id" value=<?php echo $book['itemID']?> />
      </form>
    </td>        

              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
    </div>

  
     
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>