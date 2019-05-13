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
  <link rel="stylesheet" href="style/signup.css" />
  <link rel="icon" href="img/bsuirlogo_mini.png" />
  <?php if ($isCreate) : ?>
    <title>Создание мероприятия</title>
  <?php else : ?>
    <title><?php echo $event->getTitle(); ?></title>
  <?php endif; ?>
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
            <?php if ($isRegistred != 2) : ?>
              <a href="profile.php" class="nav-link">Личный кабинет</a>
            <?php else : ?>
              <a href="signin.php" class="nav-link">Войти</a>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navigation -->

    <?php if ($isCreate == 0) : ?>
      <div class="row main-content">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <!-- Short Info / Heading -->
          <div class="heading row">
            <div class="img-container col-md-4 text-center">
              <img width="100%" src="<?php echo $event->getLogo(); ?>"></img>
            </div>
            <div class="short-info col-md-8">
              <h3 class="mb-0"><?php echo $event->getTitle(); ?></h3>
              <div class="mb-1 text-muted"><?php echo $event->getStartDate(); ?></div>
              <div class="mb-1 text-muted"><?php echo $event->getEndDate(); ?></div>
              <a href="<?php echo $event->getSite(); ?>" class="mb-auto"><?php echo $event->getSite(); ?></p></a>
              <p class="mb-auto"><?php echo $event->getShortInfo(); ?></p>
              <strong class="d-inline-block mb-2"><?php echo $event->getCountry(); ?>, г.<?php echo $event->getCity(); ?>, ул.<?php echo $event->getStreet(); ?>, <?php echo $event->getHouseNumber(); ?>, к.<?php echo $event->getCabinet(); ?></strong>

              <?php if ($session_usertype == 'admin' || $isOrganisator == '1') : ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                  <input type="hidden" name="eventID" value="<?php echo $event->getEventID(); ?>" />
                  <input class="btn btn-outline-primary btn-sm" type="submit" name="update-event-submit" value="Редактировать" />
                </form>
                <form action="php/test-add-config.inc.php" method="post">
                  <input type="hidden" name="eventID" value="<?php echo $event->getEventID(); ?>" />
                  <input class="btn btn-outline-primary btn-sm" type="submit" name="add-test-submit" value="Добавить тест" />
                </form>
              <?php endif; ?>
              <?php if ($isRegistred == 0) : ?>
                <form action="php/event-registration.inc.php" method="post">
                  <input type="hidden" name="eventID" value="<?php echo $event->getEventID(); ?>" />
                  <input class="btn btn-outline-primary btn-sm" type="submit" name="registration-submit" value="Зарегистрироваться" />
                </form>
              <?php elseif ($isRegistred == 1) : ?>
                <form action="test-page.php" method="post">
                  <input class="btn btn-outline-primary btn-sm" type="submit" value="Пройти тест" />
                </form>
              <?php endif; ?>
            </div>
          </div>

          <!-- Full Info -->
          <div class="full-event-info col-md-12">
            <p><?php echo $event->getFullInfo(); ?></p>
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
            <form action="php/send-to-organisator.inc.php" method="post">
              <label for="message">Обращение:</label>
              <textarea class="form-control" rows="5" id="message" name="message" required></textarea>
              <input type="hidden" name="email" value="<?php echo $session_email; ?>">
              <input type="hidden" name="eventID" value="<?php echo $event->getEventID(); ?>">
              <input class="send btn btn-outline-primary btn-sm" name="message-submit" type="submit" value="Отправить">
            </form>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>

    <?php elseif ($isCreate == 1 || $isCreate == 2) : ?>
      <div class="row main-content">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <form action="php/event-create.inc.php" method="post" enctype="multipart/form-data">
            <!-- Short Info / Heading -->
            <?php if ($isCreate == 2) : ?>
              <input type="hidden" name="eventID" value="<?php if ($event != null) echo $event->getEventID(); ?>" />
              <input type="hidden" name="isPublished" value="<?php if ($event != null) echo $event->getIsPublished(); ?>" />
            <?php endif; ?>
            <div class="row">
              <div class="short-info col-md-12">
                <div class="reg-row row">
                  <div class="reg-title col-md-3">
                    <p>Название мероприятия</p>
                  </div>
                  <div class="reg-value col-md-9">
                    <input type="text" class="form-control" name="title" value="<?php if ($event != null) echo $event->getTitle(); ?>" required />
                  </div>
                </div>

                <div class="reg-row row">
                  <div class="reg-title col-md-3">
                    <p>Время начала</p>
                  </div>
                  <div class="reg-value col-md-9">
                    <div class="row">
                      <div class="col-md-3">
                        <label class="text-center">День</label>
                        <input type="text" class="form-control" name="startDay" placeholder="<?php echo date("d"); ?>" value="<?php if (isset($startDay)) echo $startDay; ?>" required />
                      </div>
                      <div class="col-md-3">
                        <label class="text-center">Месяц</label>
                        <input type="text" class="form-control" name="startMonth" placeholder="<?php echo date("m"); ?>" value="<?php if (isset($startMonth)) echo $startMonth; ?>" required />
                      </div>
                      <div class="col-md-3">
                        <label class="text-center">Год</label>
                        <input type="text" class="form-control" name="startYear" placeholder="<?php echo date("yy") + 100; ?>" value="<?php if (isset($startYear)) echo $startYear; ?>" required />
                      </div>
                      <div class="col-md-3">
                        <label class="text-center">Время</label>
                        <input type="text" class="form-control" name="startTime" placeholder="<?php echo date("G:i"); ?>" value="<?php if (isset($startTime)) echo $startTime; ?>" required />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="reg-row row">
                  <div class="reg-title col-md-3">
                    <p>Время завершения</p>
                  </div>
                  <div class="reg-value col-md-9">
                    <div class="row">
                      <div class="col-md-3">
                        <label class="text-center">День</label>
                        <input type="text" class="form-control" name="endDay" placeholder="<?php echo date("d") + 1; ?>" value="<?php if (isset($endDay)) echo $endDay; ?>" required />
                      </div>
                      <div class="col-md-3">
                        <label class="text-center">Месяц</label>
                        <input type="text" class="form-control" name="endMonth" placeholder="<?php echo date("m"); ?>" value="<?php if (isset($endMonth)) echo $endMonth; ?>" required />
                      </div>
                      <div class="col-md-3">
                        <label class="text-center">Год</label>
                        <input type="text" class="form-control" name="endYear" placeholder="<?php echo date("yy") + 100; ?>" value="<?php if (isset($endYear)) echo $endYear; ?>" required />
                      </div>
                      <div class="col-md-3">
                        <label class="text-center">Время</label>
                        <input type="text" class="form-control" name="endTime" placeholder="<?php echo date("G:i"); ?>" value="<?php if (isset($endTime)) echo $endTime; ?>" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="reg-row row">
                  <div class="reg-title col-md-3">
                    <p>Адрес проведения мероприятия</p>
                  </div>
                  <div class="reg-value col-md-9">
                    <div class="row">
                      <div class="col-md-4">
                        <label class="text-center">Страна</label>
                        <input type="text" class="form-control" name="country" placeholder="" value="<?php if ($event != null) echo $event->getCountry(); ?>" required />
                      </div>
                      <div class="col-md-4">
                        <label class="text-center">Город</label>
                        <input type="text" class="form-control" name="city" placeholder="" value="<?php if ($event != null) echo $event->getCity(); ?>" required />
                      </div>
                      <div class="col-md-4">
                        <label class="text-center">Улица</label>
                        <input type="text" class="form-control" name="street" placeholder="" value="<?php if ($event != null) echo $event->getStreet(); ?>" required />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label class="text-center">Дом</label>
                        <input type="text" class="form-control" name="houseNumber" placeholder="" value="<?php if ($event != null) echo $event->getHouseNumber(); ?>" required />
                      </div>
                      <div class="col-md-4">
                        <label class="text-center">Кабинет</label>
                        <input type="text" class="form-control" name="cabinet" placeholder="" value="<?php if ($event != null) echo $event->getCabinet(); ?>" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="reg-row row">
                  <div class="reg-title col-md-3">
                    <p>Сайт</p>
                  </div>
                  <div class="reg-value col-md-9">
                    <input type="text" class="form-control" name="site" value="<?php if ($event != null) echo $event->getSite(); ?>" />
                  </div>
                </div>
                <div class="reg-row row">
                  <div class="reg-title col-md-3">
                    <p>Загрузить логотип</p>
                  </div>
                  <div class="reg-value col-md-9">
                    <input id="logo" name="logo" type="file" class="input-md" />
                  </div>
                </div>
              </div>
            </div>


            <div class="heading row">
              <strong class="text-center">Краткая информация</strong>
              <textarea class="form-control" rows="5" id="shortInfo" name="shortInfo" required><?php if ($event != null) echo $event->getShortInfo(); ?></textarea>
            </div>
            <!-- Full Info -->
            <div class="full-event-info">
              <h4 class="text-center">Полная информация</h4>
              <textarea class="form-control" rows="30" id="fullInfo" name="fullInfo"><?php if ($event != null) echo $event->getFullInfo(); ?></textarea>
            </div>
            <div class="reg-buttons reg-row row">
              <div class="reg-title col-md-3">
                <?php if ($isCreate == 1) : ?>
                  <input type="submit" name="create-event-submit" class="btn btn-success" value="Сохранить">
                <?php elseif ($isCreate == 2) : ?>
                  <input type="submit" name="update-event-submit" class="btn btn-success" value="Обновить">
                <?php endif; ?>
              </div>
            </div>
          </form>
        </div>

      </div>
    <?php endif; ?>
    <div class="col-md-1"></div>
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