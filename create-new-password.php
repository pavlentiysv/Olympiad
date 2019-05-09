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
  <title>Создание нового пароля</title>
</head>

<body>
  <div id="home">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="index.php" class="navbar-brand">
        <img src="img/bsuirlogo.png" alt="logo" />
      </a>
    </nav>
    <!-- End Navigation -->
    <div class="row">
      <?php
      $selector = $_GET['selector'];
      $validator = $_GET['validator'];

      if (empty($selector) || empty($validator)) {
        echo "Запрос не подтвержден!";
      } else {
        if (ctype_xdigit($selector) && ctype_xdigit($validator)) {
          ?>
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <form action="php/reset-password.inc.php" method="post">
              <div class="row">
                <div class="col-md-6 text-right">
                  <p>Новый пароль</p>
                </div>
                <div class="col-md-6">
                  <input id="password" name="password" type="password" required="" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 text-right">
                  <p>Повторите новый пароль</p>
                </div>
                <div class="col-md-6">
                  <input id="passwordRepeat" name="passwordRepeat" type="password" required="" />
                </div>
              </div>
              <input type="hidden" name="selector" value="<?php echo $selector; ?>">
              <input type="hidden" name="validator" value="<?php echo $validator; ?>">
              <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <button type="submit" name="reset-password-submit">Сохранить</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-3"></div>
        <?php
      }
    }
    ?>
      <!--- Script Source Files -->
      <script src="src/jquery-3.3.1.min.js"></script>
      <script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
      <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
      <!--- End of Script Source Files -->
</body>

</html>