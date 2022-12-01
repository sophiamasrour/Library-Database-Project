<?php

require_once 'connect-db.php';
session_start();

if( isset($_SESSION['user']) ){
  header("location: wishlist.php");
}




if(isset($_REQUEST['wishlist-btn'])){

    wishlistBook($_SESSION['user']['userID'], $_POST['wishlist-btn']);
    wishlistwishlistBook($_SESSION['user']['userID'], $_POST['wishlist-btn']);
    header("location: member-homepage.php");
}

function wishlistBook($userID, $itemID)
{
    global $db;
    try{
        $query = "INSERT INTO add_to_wishlist VALUES (:userID, :itemID)";
        $select_stmt = $db->prepare($query);
        $select_stmt->bindValue(':userID', $userID);
        $select_stmt->bindValue(':itemID', $itemID);
        $select_stmt->execute();
        $select_stmt ->closeCursor();
}
    catch(PDOException $e){
        echo $e->getMessage();
      }
}

function wishlistwishlistBook($userID, $itemID)
{
    global $db;
    try{
      
        $query = "UPDATE add_to_wishlist_wishlist SET wishlist =  CONCAT(wishlist, ', ', :itemID) WHERE userID = :userID";
        $select_stmt2 = $db->prepare($query);
        $select_stmt2->bindValue(':userID', $userID);
        $select_stmt2->bindValue(':itemID', $itemID);
        $select_stmt2->execute();
        $select_stmt2 ->closeCursor();

        if($select_stmt2->rowCount() == 0){
          $query = "INSERT INTO add_to_wishlist_wishlist VALUES (:userID, :itemID, :itemID)";
          $select_stmt = $db->prepare($query);
          $select_stmt->bindValue(':userID', $userID);
          $select_stmt->bindValue(':itemID', $itemID);
          $select_stmt->execute();
          $select_stmt ->closeCursor();
      }
      $query = "UPDATE add_to_wishlist_wishlist
        SET itemID = :itemID
        WHERE userID = :userID";
        $select_stmt = $db->prepare($query);
        $select_stmt->bindValue(':userID', $userID);
        $select_stmt->bindValue(':itemID', $itemID);
        $select_stmt->execute();
        $select_stmt ->closeCursor();
}
    catch(PDOException $e){
        echo $e->getMessage();
      }
}
?>