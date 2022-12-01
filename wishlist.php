<?php

require_once 'connect-db.php';
session_start();

if( isset($_SESSION['user']) ){
  header("location: wishlist.php");
}




if(isset($_REQUEST['wishlist-btn'])){

    wishlistBook($_SESSION['user']['userID'], $_POST['wishlist-btn']);
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
?>