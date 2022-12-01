<?php
require_once("conect-db.php")
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <h1>Wishlist</h1>
    <?php
                                        $userID = $_SESSION['user']['userID'];
                                        $query = "SELECT itemID FROM add_to_wishlist WHERE userID='$userID'";
                                        $statement = $db->prepare($query);
                                        $statement->execute();
                                        
                                        $statement->setFetchMode(PDO::FETCH_OBJ);
                                        $result = $statement->fetchAll(); // PDO::FETCH_ASSOC

                                        foreach($result as $book) {
                                            
                                        }
                                        if($result) {

                                            

                                            foreach($result as $row)   {
                                            
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
                                                    <form action="checkout.php" method='POST'>
                                                            <button type='submit' name="checkout-btn" value="<?= $row->itemID; ?>"class="btn btn-primary">Check out</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="wishlist.php" method='POST'>
                                                            <button type='submit' name="wishlist-btn" value="<?= $row->itemID; ?>"class="btn btn-primary">Add to Wishlist</button>
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
                                        
                                        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
