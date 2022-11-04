<?php

function getAllBooks()
{
    global $db;
    $query = "SELECT * FROM books";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

?>