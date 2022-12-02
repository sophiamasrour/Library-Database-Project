<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-light bg-light">
  <a href='employee-homepage.php'class="navbar-brand">ABC Library Admin</a>
        </nav>
    <div class='container'>
        <div class='row'>
            <div class = 'col-md-8 mt-4'>
                <div class='card'>
                    <div class='card-header'>
                        <h3>Add book to inventory
                            <a href="employee-homepage.php" class ='btn btn-danger float-end'>Back</a>
                        </h3>
                    </div>
                        <div class = 'card-body'>
                            <form action="code.php" method="POST">
                                <div class='mb-3'>
                                    <label >Title</label>
                                    <input type="text" name='title' class="form-control">
                                </div>
                                <div class='mb-3'>
                                    <label >Author</label>
                                    <input type="text" name='authorName' class="form-control">
                                </div>
                                <div class='mb-3'>
                                    <label >Quantity Available</label>
                                    <input type="number" name='quantityAvailable' class="form-control">
                                </div>
                                <div class='mb-3'>
                                    <label >Total Quantity</label>
                                    <input type="number" name='totalQuantity' class="form-control">
                                </div>
                                <div class='mb-3'>
                                    <label >Number of Pages</label>
                                    <input type="number" name='numberOfPages' class="form-control">
                                </div class='mb-3'>
                                    <button type="submit" name='save_book_btn' class="btn btn-primary">Save Book</button>
                                <div>

                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>