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
  <div class="event-page-content" id="home">
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


    <div class="row main-content">
      <div class="col-md-1"></div>

      <div class="col-md-10">

        <!-- Short Info / Heading -->
        <div class="heading row">
          <div class="img-container col-md-4">
            <img class="" width="200px" height="200px" src="<?php $event->getLogo(); ?>"></img>
          </div>
          <div class="short-info col-md-8">
            <h3 class="mb-0"><?php $event->getTitle(); ?></h3>
            <div class="mb-1 text-muted"><?php $event->getStartDate(); ?></div>
            <div class="mb-1 text-muted"><?php $event->getEndDate(); ?></div>
            <p class="mb-auto"><?php $event->getShortInfo(); ?></p>
            <strong class="d-inline-block mb-2"><?php $event->getCountry(); ?>, г.<?php $event->getCity(); ?>, ул.<?php $event->getStreet(); ?>, <?php $event->getHouseNumber(); ?>, к.<?php $event->getCabinet(); ?></strong>
            <form action="">
              <input class="btn btn-outline-primary btn-sm" type="button" value="Зарегистрироваться" />
              <input class="btn btn-outline-primary btn-sm" type="button" value="Пройти тест" />
              <input class="btn btn-outline-primary btn-sm" type="button" value="Редактировать" />
            </form>
          </div>
        </div>

        <!-- Full Info -->
        <div class="full-event-info col-md-12">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi vero temporibus ullam numquam labore quis, iusto laboriosam, asperiores accusantium ratione quod reiciendis quibusdam repellat nulla, corrupti et maxime eligendi cumque culpa! Minima consequatur veritatis recusandae at provident, illum ut aperiam non nisi tenetur deserunt facilis pariatur alias! Vel quibusdam culpa consequuntur, molestiae, tenetur nulla accusantium similique optio nostrum autem a, alias illum sapiente itaque cupiditate expedita labore magnam veniam nihil voluptas? Iste neque iusto voluptatum exercitationem iure vel nesciunt velit tempora necessitatibus optio debitis qui voluptates eius culpa, totam sunt, nisi sint. Fuga molestias cupiditate, deleniti dicta reprehenderit culpa itaque!</p>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>

    <!-- Feedback -->
    <div class="feedback jumbotron">
      <div class="feedback col-md-12 text-center">
        <button class="toggle-button btn btn-secondary btn-md">Связь с организатором</button>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="feedback-message form-group col-md-6">
          <form action="">
            <label for="message">Обращение:</label>
            <textarea class="form-control" rows="5" id="message" name="message"></textarea>
            <input class="send btn btn-outline-primary btn-sm" type="submit" value="Отправить">
          </form>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>


  </div>




  <!--- Start Contact Section -->
  <div id="contact">
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
  <script src="src/feedback-section.js"></script>
  <!--- End of Script Source Files -->
</body>

</html>