<?php
require 'php/session.inc.php';
require 'php/printSelect.inc.php';
require 'php/user.class.php';

$errorMsg = null;
$user = null;

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyFields') {
        $errorMsg = 'Заполните все обязательные поля.';
    } else if ($_GET['error'] == 'sqlError') {
        $errorMsg = 'Ошибка при обращении к базе данных.';
    } else if ($_GET['error'] == 'invalidEmail') {
        $errorMsg = 'Правильно введите e-mail';
    } else if ($_GET['error'] == 'passwordNotMatching') {
        $errorMsg = 'Пароли не совпадают.';
    } else if ($_GET['error'] == 'emailTaken') {
        $errorMsg = 'Е-mail уже занят другим пользователем';
    } else if ($_GET['error'] == 'noGmail') {
        $errorMsg = 'Неправильно введен e-mail или пароль.';
    } else if ($_GET['error'] == 'photoExt') {
        $errorMsg = 'Вы можете загружать файлы только с типами jpg, jpeg, png.';
    } else if ($_GET['error'] == 'photoUpload') {
        $errorMsg = 'Возникла ошибка при загрузке фото.';
    } else if ($_GET['error'] == 'photoSize') {
        $errorMsg = 'Размер фото не может превышать 5 Мб.';
    } else {
        $errorMsg = 'Возникла непредвиденная ошибка.';
    }
}

$user = new User(null, $_GET['email'], null, $_GET['usertype'], null, null, $_GET['surname'], $_GET['name'], $_GET['middlename'], $_GET['city'], $_GET['institution_type'], $_GET['institution_number'], $_GET['grade'], $_GET['gender'], $_GET['birthdate'], "+".trim($_GET['telephone']), $_GET['photo']);
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
    <link rel="stylesheet" href="style/signup.css" />
    <title>Регистрация</title>
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
        <div class="signup">
            <!-- Heading -->
            <div class="col-md-12 text-center">
                <h3 class="heading">Регистрация</h3>
                <div class="heading-underline"></div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>

                <!-- Registration Form -->
                <div class="col-md-8">
                    <form action="php/signup.inc.php" method="post" enctype="multipart/form-data">
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Фамилия</p>
                            </div>
                            <div class="reg-value col-md-9">
                              <input type="text" class="form-control" name="surname" value="<?php echo $user->getSurname(); ?>" />
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Имя</p>
                            </div>
                            <div class="reg-value col-md-9">
                              <input type="text" class="form-control" name="name" value="<?php echo $user->getName(); ?>" />
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Отчество</p>
                            </div>
                            <div class="reg-value col-md-9">
                              <input type="text" class="form-control" name="middlename" value="<?php echo $user->getMiddlename(); ?>" />
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Пол</p>
                            </div>
                            <div class="reg-value col-md-9">
                                <select id="gender" name="gender" class="form-control">
                                  <option <?php if ($user->getGender() == null) {echo 'selected';} ?> value="">- Не выбран -</option>
                                  <option <?php if ($user->getGender() == 'М') {echo 'selected';} ?> value='М'>Мужской</option>
                                  <option <?php if ($user->getGender() == 'Ж') {echo 'selected';} ?> value='Ж'>Женский</option>
                                </select>
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Дата рождения</p>
                            </div>
                            <div class="reg-value bday col-md-9">
                                <div class="row form-group">
                                    <div class="col-md-1">
                                        <label class="control-label" for="day">День</label></div>
                                    <div class="col-md-2">
                                        <select id="day" name="day" class="form-control">
                                            <?php printDaysList(intval(date("d", strtotime($user->getBirthDate())))); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" for="month">Месяц</label></div>
                                    <div class="col-md-3">
                                        <select id="month" name="month" class="form-control">
                                            <?php printMonthsList(intval(date("m", strtotime($user->getBirthDate())))); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label" for="year">Год</label></div>
                                    <div class="col-md-3">
                                        <select id="year" name="year" class="form-control">
                                            <?php printYearList(intval(date("Y", strtotime($user->getBirthDate())))); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Aдрес</p>
                            </div>
                            <div class="reg-value col-md-9">
                              <input type="text" class="form-control" name="city" value="<?php echo $user->getCity(); ?>" />
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Телефон</p>
                            </div>
                            <div class="reg-value col-md-9">
                              <input id="telephone" name="telephone" type="tel" pattern="\+[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2}" placeholder="+375291234567" class="form-control" value="<?php echo $user->getTelephoneNumber(); ?>">
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Тип учебного заведения</p>
                            </div>
                            <div class="reg-value col-md-9">
                                <select id="institution_type" name="institution_type" class="form-control">
                                  <option <?php if ($user->getInstitutionType() == null) {echo 'selected';} ?> value="">- Не выбран -</option>
                                    <option <?php if (trim($user->getInstitutionType()) == 'Средняя Школа') {echo 'selected';} ?> value="Средняя Школа">Средняя Школа</option>
                                    <option <?php if (trim($user->getInstitutionType()) == 'Гимназия') {echo 'selected';} ?> value="Гимназия">Гимназия</option>
                                    <option <?php if (trim($user->getInstitutionType()) == 'Лицей') {echo 'selected';} ?> value="Лицей">Лицей</option>
                                    <option <?php if (trim($user->getInstitutionType()) == 'Колледж') {echo 'selected';} ?> value="Колледж">Колледж</option>
                                </select>
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Название/номер учебного заведения</p>
                            </div>
                            <div class="reg-value col-md-9">
                              <input type="text" class="form-control" name="institution_number" value="<?php echo $user->getInstitutionNumber(); ?>" />
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Класс/Курс</p>
                            </div>
                            <div class="reg-value col-md-9">
                              <input type="text" class="form-control" name="grade" value="<?php echo $user->getGrade(); ?>" />
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Фото профиля</p>
                            </div>
                            <div class="reg-value col-md-9">
                                <input id="photo" name="photo" type="file" class="input-md" />
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>E-mail</p>
                            </div>
                            <div class="reg-value col-md-9">
                              <input name="email" type="email" class="form-control" required="" value="<?php echo $user->getEmail(); ?>">
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Пароль</p>
                            </div>
                            <div class="reg-value col-md-9">
                                <input type="password" class="form-control" name="password" />
                            </div>
                        </div>
                        <div class="reg-row row">
                            <div class="reg-title col-md-3">
                                <p>Подтвердите пароль</p>
                            </div>
                            <div class="reg-value col-md-9">
                                <input type="password" class="form-control" name="passwordRepeat" />
                            </div>
                        </div>
                        <div class="reg-buttons reg-row row">
                            <div class="reg-title col-md-3">
                                <input type="submit" name="signup-submit" class="btn btn-success" value="Сохранить">
                            </div>
                            <div class="reg-value col-md-9">
                                <a id="cancel" name="cancel" class="btn btn-danger" href="signin.php">Отмена</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-2"></div>
            </div>

        </div>
        <!-- Contact Section -->
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
        <!--- Script Source Files -->
        <script src="src/jquery-3.3.1.min.js"></script>
        <script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
        <!--- End of Script Source Files -->
</body>

</html>