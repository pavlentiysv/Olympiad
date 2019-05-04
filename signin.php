<?php
require 'php/session.inc.php';

if (isset($_GET['signin'])) {
  if ($_GET['signin'] == 'success') {
    header("Location: index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css" />
  <link rel="icon" href="img/bsuirlogo_mini.png" />
  <link rel="stylesheet" href="style/main.css" />
  <link rel="stylesheet" href="style/fixed.css" />
  <link rel="stylesheet" href="style/signin.css" />
  <title>Авторизация</title>
</head>

<body>
  <div id="home">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="index.html" class="navbar-brand">
        <img src="img/bsuirlogo.png" alt="logo" />
      </a>
    </nav>
    <!-- End Navigation -->

    <div class="container sign-up">
      <div class="row">
        <div class="empty-space col-md-4"></div>
        <div class="form-area col-md-5">
          <h1 class="text-center">Вход</h1>

          <form action="php/signin.inc.php" method="post">
            <div class="form-group">
              <label for="email" class="label">E-mail</label>
              <input type="email" name="email" class="form-control" id="email" />
            </div>
            <div class="form-group">
              <label for="password" class="label">Пароль</label>
              <input type="password" name="password" class="form-control" id="password" />
            </div>
            <div class="form-group">
              <input type="checkbox" id="remember" />
              <label for="remember" class="label remember">Запомнить меня</label>
            </div>
            <div class="form-group text-center">
              <!-- <a href="#info" class="btn btn-outline-light btn-lg">Войти</a> -->
              <input type="submit" name="signin-submit" class="btn btn-outline-light btn-lg" id="submit" value="Войти" />
            </div>
            <div class="form-group">
              <a href="#">
                <p class="forgot text-center">Забыли пароль?</p>
              </a>
            </div>
            <p class="no-account text-center">
              У вас нет аккаунта? <a href="signup.php"> Регистрация</a>
            </p>
          </form>
        </div>
        <div class="empty-space col-md-4"></div>
      </div>
    </div>
  </div>

  <!--- Script Source Files -->
  <script src="src/jquery-3.3.1.min.js"></script>
  <script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
  <!--- End of Script Source Files -->
</body>

</html>