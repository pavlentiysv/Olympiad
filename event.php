<?php
require 'php/session.inc.php';
require 'php/event.inc.php';
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
  <link rel="stylesheet" href="style/event.css" />
  <link rel="icon" href="img/bsuirlogo_mini.png" />
  <title><?php $event->getTitle(); ?></title>
</head>

<body data-spy="scroll" data-target="#navbarResponsive">
  <!--- Start Home Section -->
  <div id="home">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="index.php" class="navbar-brand">
        <img src="img/bsuirlogo.png" alt="logo" />
      </a>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="profile.php" class="nav-link">Личный кабинет</a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navigation -->

    <!-- Profile Tab Content -->
    <div class="row main-content">
      <div class="col-md"></div>

      <div class="col-md-10">
        <div class="">
          <div class="col">
            <img class="" width="200px" height="200px" src="<?php $event->getLogo(); ?>"></img>
          </div>
          <div class="col p-4 d-flex flex-column position-static md-8">
            <strong class="d-inline-block mb-2 text-primary"><?php $event->getCountry(); ?>, г.<?php $event->getCity(); ?>, ул.<?php $event->getStreet(); ?>, <?php $event->getHouseNumber(); ?>, к.<?php $event->getCabinet(); ?></strong>
            <h3 class="mb-0"><?php $event->getTitle(); ?></h3>
            <div class="mb-1 text-muted"><?php $event->getStartDate(); ?></div>
            <div class="mb-1 text-muted"><?php $event->getEndDate(); ?></div>
            <p class="card-text mb-auto"><?php $event->getShortInfo(); ?></p>
            <a href="event.php?eventID=<?php $event->getEventID(); ?>" class="stretched-link">Продолжить чтение</a>
          </div>
        </div>
      </div>

      <div class="col-md"></div>
    </div>
  </div>
  <!--- End Home Section -->



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