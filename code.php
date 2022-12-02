<?php
session_start();
include('connect-db.php');

if(isset($_POST['delete_book'])){

    $itemID = $_POST['delete_book'];

    try{
        $query = "DELETE FROM Books  WHERE itemID=:itemID";
        $statement = $db -> prepare($query);
        $data = [':itemID' => $itemID];
        $query_execute = $statement->execute($data);

        if($query_execute){
            $_SESSION['message'] = 'Deleted Successfully';
            header('location:employee-homepage.php');
            exit(0);
        }
        else {
            $_SESSION['message'] = 'Not Deleted';
            header('location:employee-homepage.php');
            exit(0);
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

if(isset($_POST['update_book_btn'])) {
    $itemID = $_POST['itemID'];
    $title = $_POST['title'];
    $authorName = $_POST['authorName'];
    $totalQuantity = $_POST['totalQuantity'];
    $quantityAvailable = $_POST['quantityAvailable'];
    $numberOfPages = $_POST['numberOfPages'];

    try {
        $query = 'UPDATE Books SET numberOfPages=:numberOfPages, title=:title, authorName=:authorName, totalQuantity=:totalQuantity, quantityAvailable=:quantityAvailable WHERE itemID=:itemID LIMIT 1';
        $statement = $db->prepare($query);

        $data = [
            ':itemID' => $itemID,
            ':title' => $title,
            ':authorName' => $authorName ,
            ':totalQuantity' => $totalQuantity,
            ':quantityAvailable' => $quantityAvailable,
            ':numberOfPages' => $numberOfPages
        ];

        $query_execute = $statement->execute($data);

        if($query_execute){
            $_SESSION['message'] = 'Updated Successfully';
            header('location:employee-homepage.php');
            exit(0);
        }
        else {
            $_SESSION['message'] = 'Not Updated';
            header('location:employee-homepage.php');
            exit(0);
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

}

if(isset($_POST['save_book_btn'])){

    $title = $_POST['title'];
    $author = $_POST['authorName'];
    $totalQuantity = $_POST['totalQuantity'];
    $quantityAvailable = $_POST['quantityAvailable'];
    $numberOfPages = $_POST['numberOfPages'];

    $query = 'INSERT INTO Books (itemID, totalQuantity, title, quantityAvailable, averageRating, authorName , numberOfPages) VALUES (:itemID, :totalQuantity, :title, :quantityAvailable, :averageRating, :author, :numberOfPages)';
    $query_run = $db->prepare($query);
    $randomID = rand(1, 100000);

    $data = [
        ':itemID' => $randomID,
        ':title' => $title,
        ':author' => $author,
        ':totalQuantity' => $totalQuantity,
        ':quantityAvailable' => $quantityAvailable,
        ':numberOfPages' => $numberOfPages,
        ':averageRating' => 0

    ];

    $query_execute = $query_run->execute($data);

    if($query_execute){
        $_SESSION['message'] = 'Added Successfully';
        header('location:employee-homepage.php');
        exit(0);
    }
    else {
        $_SESSION['message'] = 'Not Added';
        header('location:employee-homepage.php');
        exit(0);
    }
}

?>