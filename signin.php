<?php
require 'php/session.inc.php';

$errorMsg = null;
$email = null;
$succesMsg = null;

if (isset($_GET['signin'])) {
  if ($_GET['signin'] == 'success') {
    header("Location: index.php");
  }
}

if (isset($_GET['success'])) {
  if ($_GET['success'] == 'signup') {
    $succesMsg = 'Регистрация прошла успешно!</br>Осталось подтвердить ваш e-mail.';
  } else if ($_GET["success"] == "newpwd") {
    $succesMsg = 'Ваш пароль был успешно обновлен!';
  }
}

if (isset($_GET['error'])) {
  if ($_GET['error'] == 'sqlError') {
    $errorMsg = 'Ошибка при обращении к базе данных';
  } else if ($_GET['error'] == 'noGmail') {
    $errorMsg = 'Неправильно введен e-mail или пароль';
  } else if ($_GET['error'] == 'noSession') {
    $errorMsg = 'Сессия была прервана. Войдите заново.';
  } else if ($_GET['error'] == 'noActivation') {
    $errorMsg = 'Регистрация не подтверждена. Проверьте почту.';
  } else {
    $errorMsg = 'Возникла непредвиденная ошибка';
  }
}

if (isset($_GET['email'])) {
  $email = $_GET['email'];
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
  <div class="main <?php if ($errorMsg != null) echo "main-under-error"; ?>" id="home">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="index.php" class="navbar-brand">
        <img src="img/bsuirlogo.png" alt="logo" />
      </a>
    </nav>
    <!-- End Navigation -->

    <div class="container sign-up">
      <div class="row">
        <div class="empty-space col-md-3"></div>
        <div class="form-area col-md-6">
          <h1 class="text-center">Вход</h1>

          <form action="php/signin.inc.php" method="post">
            <div class="form-group">
              <label for="email" class="label">E-mail</label>
              <?php if ($errorMsg != null) : ?>
                <input type="email" name="email" class="form-error form-control" id="email" value="<?php echo $email; ?>" required="" />
              <?php else : ?>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>" required="" />
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="password" class="label">Пароль</label>
              <?php if ($errorMsg != null) : ?>
                <input type="password" name="password" class="form-error form-control" id="password" required="" />
              <?php else : ?>
                <input type="password" name="password" class="form-control" id="password" required="" />
              <?php endif; ?>
            </div>
            <!-- <div class="form-group"> -->
              <!-- <input type="checkbox" id="remember" /> -->
              <!-- <label for="remember" class="label remember">Запомнить меня</label> -->
            <!-- </div> -->
            <div class="form-group text-center">
              <?php if ($errorMsg != null) : ?>
                <span class="error-text"><?php echo $errorMsg; ?></span>
              <?php endif; ?>
              <?php if ($succesMsg != null) : ?>
                <span class="success-text"><?php echo $succesMsg; ?></span>
              <?php endif; ?>
            </div>
            <div class="form-group text-center">
              <!-- <a href="#info" class="btn btn-outline-light btn-lg">Войти</a> -->
              <input type="submit" name="signin-submit" class="btn btn-outline-light btn-lg" id="submit" value="Войти" />
            </div>
            <div class="form-group">
              <a href="reset-password.php">
                <p class="forgot text-center">Забыли пароль?</p>
              </a>
            </div>
            <p class="no-account text-center">
              У вас нет аккаунта? <a href="signup.php"> Регистрация</a>
            </p>
          </form>
        </div>
        <div class="empty-space col-md-3"></div>
      </div>
    </div>
  </div>

  <?php if ($errorMsg != null) : ?>
    <div class="overlay js-overlay-campaign">
      <div class="popup js-popup-campaign text-center col-md-4">
        <h2>Произошла ошибка!</h2>
        <?php echo $errorMsg; ?>
        <a href="signin.php" class="cross">
          <div class="close-popup js-close-campaign">
            <i class="fas fa-times fa-2x"></i>
          </div>
        </a>
      </div>
    </div>
  <?php endif; ?>

  <!--- Script Source Files -->
  <script src="src/popup-window.js"></script>
  <script src="src/jquery-3.3.1.min.js"></script>
  <script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
  <!--- End of Script Source Files -->
</body>

</html>