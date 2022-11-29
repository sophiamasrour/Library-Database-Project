<?php 

include_once("connect-db.php");
session_start();

if (isset($_REQUEST['member-login-btn'])){

  echo '<pre>';
      print_r($_REQUEST);
  echo "</pre>";

  $email = filter_var($_REQUEST['member-email'],FILTER_SANITIZE_STRING);
  $password = filter_var($_REQUEST['member-password'],FILTER_SANITIZE_STRING);
}

if(empty($email)){
  $errorMsg[0][] = 'Email required';
}

if(empty($email)){
  $errorMsg[0][] = 'Password required';
}


?>


<!doctype html>
<html lang="en">



<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Signin Template · Bootstrap v5.2</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">





  <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
  <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#712cf9">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin w-100 m-auto">

    <nav class="navbar navbar-light bg-light">
      <span class="navbar-brand mb-0 h1" style="margin-left:10px; font-size:30px ">ABC Library</span>
    </nav>

    <div>
      <h1 style="margin: 50px;">Welcome to ABC Library</h1>
      <h3>I am a </h3>

      <div>
        <button class="btn btn-lg btn-primary" onclick="openMemberLogin()">Member</button>
        <button class="btn btn-lg btn-primary" onclick="openEmployeeLogin()">Employee</button>
      </div>
    </div>

    <div style='position: relative; width: 500px; margin:15%; margin-left: 450px;'>



    </div>

  </main>

  <form action='landing-page.php' method='post' class="form-signin" style='display: none; margin-left: 450px; margin-right: 450px; bottom: 150px;'
    id="member-login">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <?php

    if(isset($errorMsg[0])){
      foreach($errorMsg[0] as $emailErrors){
        echo "<p class='small text-danger'>".$emailErrors."</p>";
      }
    }

    ?>
    <div>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="member-email" class="form-control" placeholder="Email address" required autofocus>
    </div>

    <div>

    <?php
    if(isset($errorMsg[1])){
      foreach($errorMsg[1] as $emailErrors){
        echo "<p class='small text-danger'>".$emailErrors."</p>";
      }
    }

    ?>
    
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="member-password" class="form-control" placeholder="Password">

    </div>

    <button class="btn btn-lg btn-primary btn-block" name="member-login-btn" type="submit">Sign in</button>
  </form>

  <form class="form-signin" method='POST'
    style='display: none; margin-left: 450px; margin-right: 450px; margin-top:10px' id="employee-login">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <div>
      <label for="inputEmployeeID" class="sr-only">Employee ID</label>
      <input type="number" id="inputEmployeeID" class="form-control" placeholder="Employee ID" required autofocus>
    </div>
    </div>
    <button class="btn btn-lg btn-primary btn-block" name="employee-login-btn" type="submit">Sign in</button>
  </form>

  <script>
    // When the user clicks on <div>, open the popup
    function openMemberLogin() {
      var x = document.getElementById("member-login");
      var y = document.getElementById("employee-login");
      if (y.style.display === "block") {
        y.style.display = "none";
        x.style.display = "block";
      } else if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }

    // When the user clicks on <div>, open the popup
    function openEmployeeLogin() {
      var x = document.getElementById("employee-login");
      var y = document.getElementById("member-login");
      if (y.style.display === "block") {
        y.style.display = "none";
        x.style.display = "block";
      } else if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>



</body>

</html>