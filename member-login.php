<?php

require_once 'connect-db.php';
session_start();

if( isset($_SESSION['user']) ){
  header("location: member-homepage.php");
}

if(isset($_REQUEST['login-btn'])){
  $email = filter_var(strtolower($_REQUEST['email']), FILTER_SANITIZE_EMAIL);
  $password = strip_tags($_REQUEST['password']);

  if(empty($email)){
      $errorMsg[] = 'Must enter email';
      
  }
  else if(empty($password)){
      $errorMsg[] = 'Must enter password';
      
  }
  else{
    try {
      $select_stmt = $db->prepare("SELECT * from Users WHERE email = :email LIMIT 1");
    $select_stmt->execute([
      ':email' => $email
    ]);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if($select_stmt->rowCount() > 0){
      if(password_verify($password, $row['password'])) {

        $_SESSION['user']['name'] = $row["name"];
        $_SESSION['user']['email'] = $row["email"];
        $_SESSION['user']['userID'] = $row["userID"];
        $_SESSION['user']['fine_total'] = $row["fine_total"];

        header("location: member-homepage.php");
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

      #member-login {
        margin: auto;
        width: 75%;
        padding: 10px;
      }

  </style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
      <span class="navbar-brand mb-0 h1" style="margin-left:10px; font-size:30px ">ABC Library</span>
    </nav>

    <div class="container member-or-employee">
      <h1 style="margin: 50px;">Welcome to ABC Library</h1>


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
		<form action="member-login.php" id = 'member-login' method="post">
      <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" placeholder="">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="">
        </div>
			<button type="submit" name="login-btn" class="btn btn-primary">Login</button>
      No Account? <a class="register" href="register.php">Register Instead</a>
    </form>
    <a href="employee-login.php">Login as Employee</a>
	</div>


</body>
</html>