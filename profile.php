<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style/main.css" />
    <link rel="stylesheet" href="style/fixed.css" />
    <link rel="stylesheet" href="style/profile.css" />
    <link rel="icon" href="img/bsuirlogo_mini.png" />
    <title>Личный кабинет</title>
</head>

<body>
    <!-- Header  -->
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="index.php" class="navbar-brand">
                <img src="img/bsuirlogo.png" alt="logo" />
            </a>
            <form class="ml-auto" action="php/signout.inc.php" method="post">
                <input type="submit" name="signout-submit" class="btn btn-outline-light btn-lg ml-auto" id="submit" value="Выйти" />
            </form>
        </nav>
    </header>

    <!-- Personal Page Section -->
    <div class="profile-caption">
        <div class="col-md-12 text-center">
            <h3 class="heading">Личный кабинет</h3>
            <div class="heading-underline"></div>
        </div>
    </div>

    <div class="personal-page">
        <div class="row">
            <!-- Left Block -->
            <div class="col-md-3 text-center left-block">
                <img class="avatar" src="img/default_avatar.jpg" alt="avatar">
                <p class="fullname">Фамилия<br>Имя<br>Отчество</p>
            </div>
            <!-- Right Block -->
            <div class="right-block col-md-9">
                <!-- Tabs -->
                <!-- Tab Toggler -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Профиль</a>
                        <a class="nav-item nav-link" id="nav-tests-tab" data-toggle="tab" href="#nav-tests" role="tab" aria-controls="nav-tests" aria-selected="false">Тесты</a>
                        <a class="nav-item nav-link" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" role="tab" aria-controls="nav-settings" aria-selected="false">Настройки</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="nav-profile tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <p>Фамилия:</p>
                            </div>
                            <div class="col-md-9">
                                <p>Иванов</p>
                            </div>
                        </div>
                    </div>
                    <div class="nav-tests tab-pane fade" id="nav-tests" role="tabpanel" aria-labelledby="nav-tests-tab">...</div>
                    <div class="nav-settings tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Page Section End -->






    <!-- Footer -->
    <div class="contact">
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
    <!--- End Footer -->

    <!--- Script Source Files -->
    <script src="src/jquery-3.3.1.min.js"></script>
    <script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
    <!--- End of Script Source Files -->
</body>

</html>