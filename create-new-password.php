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
    <div class="col-md-12 control-label text-center">
      <?php
      $selector = $_GET['selector'];
      $validator = $_GET['validator'];

      if (empty($selector) || empty($validator)) {
        echo "Запрос не подтвержден!";
      } else {
        if (ctype_xdigit($selector) && ctype_xdigit($validator)) {
          ?>
          <form class="inline-block" action="php/reset-password.inc.php" method="post">
            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
            <input id="password" name="password" type="password" placeholder="Введите новый пароль" required="">
            <input id="passwordRepeat" name="passwordRepeat" type="password" placeholder="Подтвердите новый пароль" required="">
            <button type="submit" name="reset-password-submit">Сохранить</button>
          </form>
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