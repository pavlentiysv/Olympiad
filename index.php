<?php
require 'php/session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="style/main.css" />
  <link rel="stylesheet" href="style/fixed.css" />  
  <link rel="icon" href="img/bsuirlogo_mini.png" />
  <title>Олимпиада БГУИР</title>
</head>

<body data-spy="scroll" data-target="#navbarResponsive">
  <!--- Start Home Section -->
  <div id="home">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a href="#" class="navbar-brand">
        <img src="img/bsuirlogo.png" alt="logo" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="#home" class="nav-link">Главная</a>
          </li>
          <li class="nav-item">
            <a href="#info" class="nav-link">Информация</a>
          </li>
          <li class="nav-item">
            <a href="#news" class="nav-link">Новости</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="nav-link">Контакты</a>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['userEmail'])) : ?>
              <a href="profile.php" class="nav-link">Личный кабинет</a>
            <?php else : ?>
              <a href="signin.php" class="nav-link">Войти</a>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navigation -->

    <!-- Start Landing Page Section-->
    <div class="landing">
      <div class="home-wrap">
        <div class="home-inner"></div>
      </div>
    </div>
    <div class="caption text-center">
      <h1>Добро пожаловать!</h1>
      <h3>Олимпиада для абитуриентов БГУИР</h3>
      <a href="#info" class="btn btn-outline-light btn-lg">Подробнее</a>
    </div>
    <!-- End Landing Page Section-->
  </div>
  <!--- End Home Section -->

  <!--- Start Info Section -->
  <div id="info" class="offset">
    <div class="info col-12 narrow text-center">
      <h1>Об олимпиаде</h1>
      <p class="lead">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut
        congue tellus. Nunc pellentesque aliquam metus vel vestibulum. Aliquam
        posuere euismod massa vel fermentum. Curabitur accumsan sodales
        turpis, lobortis sollicitudin augue consectetur eget. Cras laoreet
        nunc lorem, eu fringilla odio fringilla id. Quisque fringilla mauris
        venenatis purus pellentesque maximus. Mauris ut pellentesque mi, et
        laoreet orci. Morbi aliquet malesuada tincidunt. Sed at mi quis tellus
        auctor auctor. Sed blandit nisi vitae iaculis finibus. Donec mollis
        enim volutpat, bibendum metus ac, blandit purus.Cras porta, lacus vel
        molestie lacinia, turpis justo fermentum erat, a feugiat massa velit
        ut enim. Aenean ut nisl suscipit, facilisis erat nec, interdum mauris.
        Nulla venenatis gravida ex sit amet eleifend. Etiam finibus vitae est
        vel faucibus. Mauris eget tincidunt ligula. Fusce nisi erat,
        scelerisque vel tempor egestas, semper et magna. Ut eleifend enim eu
        tellus commodo, sit amet auctor erat ultrices. Etiam arcu dui,
        tincidunt et molestie eu, egestas vel ipsum. Morbi ligula urna,
        feugiat eget ligula et, ornare egestas nisl. Nunc in arcu mattis,
        pharetra erat eu, suscipit lectus. Vivamus dictum sagittis ex. Fusce
        at tellus vel ex suscipit blandit. Pellentesque sodales purus et justo
        facilisis mollis. Duis ut efficitur quam. Nunc convallis augue eu
        hendrerit finibus. Vivamus a libero sapien. Maecenas ut ultrices
        ipsum, id ullamcorper neque.
      </p>
      <a href="https://youtu.be/dQw4w9WgXcQ" class="btn btn-secondary btn-md" target="_blank">Не нажимать</a>
    </div>
  </div>
  <!--- End Info Section -->

  <!--- Start News Section -->
  <div id="news" class="offset">
    <!-- Start Jumbotron -->
    <div class="jumbotron">
      <div class="narrow text-center">
        <div class="col-12">
          <h3 class="heading">Ближайшие мероприятия</h3>
          <div class="heading-underline"></div>
        </div>
        <div class="row text-center">
          <div class="col-md-4">
            <div class="news-item">
              <i class="fas fa-exclamation-circle fa-3x" data-fa-transform="shrink-3 up-5"></i>
              <h3>Заголовок мероприятия</h3>
              <p>
                Краткое описание события бла бла бла бла бла бла бла бла бла
                бла
              </p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="news-item">
              <i class="fas fa-exclamation-circle fa-3x" data-fa-transform="shrink-3 up-5"></i>
              <h3>Заголовок мероприятия</h3>
              <p>
                Краткое описание события бла бла бла бла бла бла бла бла бла
                бла
              </p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="news-item">
              <i class="fas fa-exclamation-circle fa-3x" data-fa-transform="shrink-3 up-5"></i>
              <h3>Заголовок мероприятия</h3>
              <p>
                Краткое описание события бла бла бла бла бла бла бла бла бла
                бла
              </p>
            </div>
          </div>
        </div>
        <!-- End Row-->
      </div>
      <!-- End Narrow -->
    </div>
    <!-- End Jumbotron-->
  </div>
  <!--- End News Section -->

  <!--- Start Contact Section -->
  <div id="contact" class="offset">
    <footer>
      <div class="row justify-content-center">
        <div class="col-md-12 text-center">
          <img src="img/bsuirlogo_mini.png" alt="" />
          <p>
            БЕЛОРУССКИЙ ГОСУДАРСТВЕННЫЙ УНИВЕРСИТЕТ ИНФОРМАТИКИ И
            РАДИОЭЛЕКТРОНИКИ
          </p>
          <strong>Контакты</strong>
          <p>9999-999-99-99<br />trofimovich_a_f@tut.by</p>
          <strong>Адрес</strong>
          <p>
            Республика Беларусь, Минск<br />
            220013, ул. П. Бровки, 6 <br />
            <a href="https://www.bsuir.by/ru/skhema-korpusov" target="_blank"><i class="location fas fa-map-marker-alt"></i>Схема корпусов</a>
          </p>
          <a href="https://www.instagram.com/bsuir_official/" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://vk.com/bsuir_official" target="_blank"><i class="fab fa-vk"></i></a>
          <a href="https://www.youtube.com/user/videostudiabsuir" target="_blank"><i class="fab fa-youtube"></i></a>
          <a href="https://www.facebook.com/bsuir.by/" target="_blank"><i class="fab fa-facebook-square"></i></a>
        </div>

        <hr class="socket" />
        &copy;WhereIsInput
        <!-- <p><br>whereisinput@gmail.com</p> -->
      </div>
    </footer>
  </div>
  <!--- End Contact Section -->

  <!--- Script Source Files -->
  <script src="src/jquery-3.3.1.min.js"></script>
  <script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
  <!--- End of Script Source Files -->
</body>

</html>