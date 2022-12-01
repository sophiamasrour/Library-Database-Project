
<?php

function addUser($userID, $name, $email, $phone)
{
    global $db;
    $query = "INSERT INTO users VALUES (:userID, :name, :email, :phone)";  
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->execute();
        $statement->closeCursor();

        echo "User added!";
        // if ($statement->rowCount() == 0)
        //     echo "Failed to add a friend <br/>";
    }
    catch (PDOException $e) 
    {
        // echo $e->getMessage();
        // if there is a specific SQL-related error message
        //    echo "generic message (don't reveal SQL-specific message)";

        if (str_contains($e->getMessage(), "Duplicate"))
		   echo "Failed to add a user <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function getAllBooks()
{
    global $db;
    $query = "SELECT * FROM Books";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function deleteBook($id)
{
    global $db;
    $query = 'DELETE FROM Books WHERE itemID=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();

}


?>

