<?php

require_once 'connect-db.php';
session_start();

if( isset($_SESSION['user']) ){
  header("location: returns.php");
}




if(isset($_REQUEST['returns-btn'])){

    returnBook($_SESSION['user']['userID'], $_POST['returns-btn']);
    header("location: member-homepage.php");
}

function returnBook($userID, $itemID)
{
    global $db;
    try{
        $query = "UPDATE Books SET quantityAvailable = quantityAvailable +  1 WHERE itemID = :itemID";
        $select_stmt = $db->prepare($query);
       // $select_stmt->bindValue(':userID', $userID);
        $select_stmt->bindValue(':itemID', $itemID);
        $select_stmt->execute();
        $select_stmt ->closeCursor();
}
    catch(PDOException $e){
        echo $e->getMessage();
      }
}

?>