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

    <!-- Footer -->

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