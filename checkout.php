<?php

require_once 'connect-db.php';
session_start();

if( isset($_SESSION['user']) ){
  header("location: checkout.php");
}




if(isset($_REQUEST['checkout-btn'])){

    checkoutBook($_SESSION['user']['userID'], $_POST['checkout-btn']);
    header("location: member-homepage.php");
}

function checkoutBook($userID, $itemID)
{
    global $db;
    try{
    $query = "UPDATE Books set quantityAvailable = quantityAvailable - 1 where itemID = :itemID AND quantityAvailable>0";
    $select_stmt = $db->prepare($query);
    $select_stmt->bindValue(':itemID', $itemID);
    $select_stmt->execute();
    $select_stmt ->closeCursor();
    
    if($select_stmt->rowCount() == 0){
        $errorMsg[]= "book not available";
    }
    else{
    $query = "INSERT INTO checks_out VALUES (:userID, :itemID)";
    $select_stmt = $db->prepare($query);
    $select_stmt->bindValue(':userID', $userID);
    $select_stmt->bindValue(':itemID', $itemID);
    $select_stmt->execute();
    $select_stmt ->closeCursor();
    $Date = date('Y-m-d');
    $RDate = date('Y-m-d', strtotime($Date. ' + 14 days'));
    $query = "INSERT INTO checked_out_history VALUES (:userID, :itemID, :checkOutDate, :returnDate)";
    $select_stmt = $db->prepare($query);
    $select_stmt->bindValue(':userID', $userID);
    $select_stmt->bindValue(':itemID', $itemID);
    $select_stmt->bindValue(':checkOutDate', $Date);
    $select_stmt->bindValue(':returnDate', $RDate);
    $select_stmt->execute();
    $select_stmt ->closeCursor();
    }

}
    catch(PDOException $e){
        echo $e->getMessage();
      }
}
?>