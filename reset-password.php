<?php
$successMsg = null;
$errorMsg = null;

if (isset($_GET['reset'])) {
  if ($_GET['reset'] == "success") {
    $successMsg = 'Проверьте ваш e-mail! (Эта страница вам больше не нужна).';
  }
} else if (isset($_GET['error'])) {
  if ($_GET['error'] == "emailSendError") {
    $errorMsg = 'Ошибка при отправке сообщения.';
  } else if ($_GET['error'] == "sqlError") {
    $errorMsg = 'Ошибка при обращении к базе данных.';
  } else if ($_GET['error'] == "UserNotFound") {
    $errorMsg = 'Такого пользователя не существует.';
  } else {
    $errorMsg = 'Возникла непредвиденная ошибка.';
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
  <title>Воостановление пароля</title>
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
      <h1>Восстановление пароля</h1>
      <p>Вам на электронную почту будет отправлено сообщение с инструкциями для восстановления Вашего пароля.</p>
      <div class="col-md-12">
        <form class="inline-block" action="php/reset-request.inc.php" method="post">
          <input class="form-control mb-4" type="email" name="email" placeholder="Введите ваш e-mail" value="">
          <button class="btn btn-success" type="submit" name="reset-request-submit">Послать запрос на восстановление</button>
        </form>
        <?php if ($errorMsg != null) : ?>
          <p><?php echo $errorMsg; ?></p>
        <?php elseif ($successMsg != null) : ?>
          <p><?php echo $successMsg; ?></p>
        <?php endif; ?>
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