<?php include_once("index.php"); ?>
<?php

if (isset($_POST['searchButton'])) {
    $search = $_POST['search'];
    $sql = 'SELECT * FROM library WHERE title LIKE '%search%'';
    $queryResult = mysqli_num_rows($sql);

    if ($queryResult > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h3>".$row['title']."</h3>";
        }
    } else {
        echo "There are no results matching your search.";
    }

}



?>
