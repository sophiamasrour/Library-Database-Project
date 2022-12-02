<?php

require_once 'connect-db.php';
session_start();

if( isset($_SESSION['user']) ){
  header("location: employee-homepage.php");
}




if(isset($_REQUEST['login-btn'])){

  $accessKey = $_REQUEST['accessKey'];

  if(empty($accessKey)){
      $errorMsg[] = 'Must enter access key';
  }
  else{
    try {
      $select_stmt = $db->prepare("SELECT * from Employees WHERE accessKey = :accessKey LIMIT 1");
    $select_stmt->execute([
      ':accessKey' => $accessKey
    ]);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if($select_stmt->rowCount() > 0){
      if($accessKey == $row['accessKey']) {

        $_SESSION['user']['userID'] = $row["userID"];

        header("location: employee-homepage.php");
      }
      else {
        $errorMsg[] = "Wrong email or password";
      }
    }else{
      $errorMsg[] = "Email does not exist";
    }
    } catch(PDOException $e){
      echo $e->getMessage();
    }
    

  }
}

?>


<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<title>Login</title>

  <style>
  
      .member-or-employee {
      margin: auto;
      width: 50%;
      padding: 10px;
      text-align: center;
      }

      #employee-login {
        margin: auto;
        width: 75%;
        padding: 10px;
      }

  </style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
      <span class="navbar-brand mb-0 h1" style="margin-left:10px; font-size:30px ">ABC Library Admin</span>
    </nav>

    <div class="container member-or-employee">
      <h1 style="margin: 50px;">Welcome, ABC Library Employee</h1>


    </div>

    <div style='position: relative; width: 500px; margin:15%; margin-left: 450px;'>



    </div>

  </main>

	<div class="container">
  <?php

if(isset($errorMsg)){
    foreach($errorMsg as $loginErrors) {
        echo "<p class='small text-danger'>".$loginErrors."</p>";
    }
}
?>
		<form action="employee-login.php" id = 'employee-login' method="post">
      <div class="mb-3">
          <label for="accessKey" class="form-label">Access Key</label>
          <input type="accessKey" name="accessKey" class="form-control" placeholder="">
        </div>
			<button type="submit" name="login-btn" class="btn btn-primary">Login</button>
    </form>
    <a class = 'member-login' href="member-login.php">Login as a member</a>
	</div>


</body>
</html>