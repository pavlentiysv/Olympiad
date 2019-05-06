<?php
require 'php/session.inc.php';
require 'php/printSelect.inc.php';

$errorMsg = null;
$email = null;
$surname = null;
$name = null;
$middlename = null;
$city = null;
$institution_type = null;
$institution_number = null;
$grade = null;
$gender = null;
$day = null;
$month = null;
$year = null;
$telephone = null;
$photo = null;

if (isset($_GET['signup'])) {
    if ($_GET['signup'] == 'success') {
        header("Location: signin.php");
    }
}

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyFields') {
        $errorMsg = 'Заполните все обязательные поля';
    } else if ($_GET['error'] == 'sqlError') {
        $errorMsg = 'Ошибка при обращении к базе данных';
    } else if ($_GET['error'] == 'invalidEmail') {
        $errorMsg = 'Правильно введите e-mail';
    } else if ($_GET['error'] == 'passwordNotMatching') {
        $errorMsg = 'Пароли не совпадают';
    } else if ($_GET['error'] == 'emailTaken') {
        $errorMsg = 'Е-mail уже занят другим пользователем (' . $_GET['telephone'] . ')';
    } else if ($_GET['error'] == 'noGmail') {
        $errorMsg = 'Неправильно введен e-mail или пароль';
    } else {
        $errorMsg = 'Возникла непредвиденная ошибка';
    }
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}
if (isset($_GET['surname'])) {
    $surname = $_GET['surname'];
}
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}
if (isset($_GET['middlename'])) {
    $middlename = $_GET['middlename'];
}
if (isset($_GET['city'])) {
    $city = $_GET['city'];
}
if (isset($_GET['institution_type'])) {
    $institution_type = $_GET['institution_type'];
}
if (isset($_GET['institution_number'])) {
    $institution_number = $_GET['institution_number'];
}
if (isset($_GET['grade'])) {
    $grade = $_GET['grade'];
}
if (isset($_GET['gender'])) {
    $gender = $_GET['gender'];
}
if (isset($_GET['day'])) {
    $day = $_GET['day'];
}
if (isset($_GET['month'])) {
    $month = $_GET['month'];
}
if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
if (isset($_GET['telephone'])) {
    $telephone = '+' . trim($_GET['telephone']);
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
    <link rel="stylesheet" href="style/signup.css" />
    <title>Регистрация</title>
</head>

<body>
    <div id="home">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
            <a href="index.php" class="navbar-brand">
                <img src="img/bsuirlogo.png" alt="logo" />
            </a>
        </nav>
        <!-- End Navigation -->

        <div class="container">
            <div class="text-center">
                <h1 class="nice">Регистрация</h1>
            </div>

            <form action="php/signup.inc.php" method="post">
                <!-- Text input-->
                <div class="form-group text-center">
                    <?php if ($errorMsg != null) : ?>
                        <span class="error-text"><?php echo $errorMsg; ?></span>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-4 control-label">
                        <label for="surname">Фамилия</label>
                        <input type="text" class="form-control" name="surname" placeholder="Иванов" value="<?php echo $surname; ?>" required="" autofocus="">
                    </div>
                    <div class="col-md-4 control-label">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" name="name" placeholder="Иван" value="<?php echo $name; ?>" required="">
                    </div>

                    <div class="col-md-4 mb-4 control-label">
                        <label for="middleName">Отчество</label>
                        <input type="text" class="form-control" name="middlename" placeholder="Иванович" value="<?php echo $middlename; ?>">
                    </div>
                </div>
                <!-- Select Date Of Birth-->
                <div class="row">
                    <div class="col-md-7">
                        <div class="row form-group">
                            <label class="col-md-1 control-label" for="day">День</label>
                            <div class="col-md-2">
                                <select id="day" name="day" class="form-control">
                                    <?php printDaysList($day); ?>
                                </select>
                            </div>
                            <label class="col-md-1 control-label" for="month">Месяц</label>
                            <div class="col-md-3">
                                <select id="month" name="month" class="form-control">
                                    <?php printMonthsList($month); ?>
                                </select>
                            </div>
                            <label class="col-md-1 control-label" for="year">Год</label>
                            <div class="col-md-3">
                                <select id="year" name="year" class="form-control">
                                    <?php printYearList($year); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gender Input -->
                <div class="row form-group">
                    <label class="col-md-1" for="gender">Пол</label>
                    <div class="col-md-4">
                        <select id="gender" name="gender" class="form-control">
                            <option <?php if ($gender == null) echo 'selected' ?> value="">- Не выбран -</option>
                            <option <?php if ($gender == 'М') echo 'selected' ?> value="М">Мужской</option>
                            <option <?php if ($gender == 'Ж') echo 'selected' ?>value="Ж">Женский</option>
                        </select>
                    </div>
                </div>

                <!-- Address input-->
                <div class="row form-group">
                    <label class="col-md-1 control-label" for="city">Город</label>
                    <div class="col-md-4">
                        <input id="city" name="city" type="text" placeholder="а-г. Сёмково" class="form-control input-md" value="<?php echo $city; ?>" required="">
                        <span class="help-block">Ваш город (посёлок) проживания</span>
                    </div>
                </div>

                <!-- Phone input-->
                <div class="row form-group">
                    <label class="col-md-1 control-label" for="telephone">Телефон</label>
                    <div class="col-md-4">
                        <input id="telephone" name="telephone" type="tel" pattern="\+[0-9]{3}\([0-9]{2}\)[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="+375(29)123-45-67" class="form-control input-md" value='<?php echo $telephone; ?>' required="">
                        <span class="help-block">Ваш номер телефона</span>
                    </div>
                </div>

                <!-- School type input-->
                <div class="row form-group">
                    <label class="col-md-1 control-label" for="institution_type">Тип учебного заведения</label>

                    <div class="col-md-4">
                        <select id="institution_type" name="institution_type" class="form-control">
                            <option <?php if ($institution_type == null) echo 'selected' ?> value="">- Не выбран -</option>
                            <option <?php if ($institution_type == 'Средняя Школа') echo 'selected' ?> value="Средняя Школа">Средняя Школа</option>
                            <option <?php if ($institution_type == 'Гимназия') echo 'selected' ?> value="Гимназия">Гимназия</option>
                            <option <?php if ($institution_type == 'Лицей') echo 'selected' ?> value="Лицей">Лицей</option>
                            <option <?php if ($institution_type == 'Колледж') echo 'selected' ?> value="Колледж">Колледж</option>
                        </select>
                    </div>
                </div>
                <!-- School name input-->
                <div class="row form-group">
                    <label class="col-md-1 control-label" for="institution_number">Название учебного заведения</label>
                    <div class="col-md-4">
                        <input id="institution_number" name="institution_number" type="text" placeholder="Средняя школа №51 г. Минска" class="form-control input-md" value="<?php echo $institution_number; ?>" required="">
                        <span class="help-block">Название вашего учебного заведения</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="row form-group">
                            <label class="col-md-1 control-label" for="grade">Класс</label>
                            <div class="col-md-3">
                                <select id="grade" name="grade" class="form-control">
                                    <?php printGradeList($grade); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email input-->
                <div class="row form-group">
                    <label class="col-md-1 " for="email">Email</label>
                    <div class="col-md-4">
                        <input id="email" name="email" type="email" placeholder="Email" class="form-control input-md" required="" value=<?php echo $email; ?>>
                    </div>
                </div>

                <!--Password input-->
                <div class="row form-group">
                    <label class="col-md-1 " for="password">Пароль</label>
                    <div class="col-md-4">
                        <input id="password" name="password" type="password" placeholder="Укажите пароль" class="form-control input-md" required="">
                    </div>
                </div>

                <!--Password confirm-->
                <div class="row form-group">
                    <label class="col-md-1 " for="passwordRepeat">Подтвердите пароль</label>
                    <div class="col-md-4">
                        <input id="passwordRepeat" name="passwordRepeat" type="password" placeholder="Подтвердите пароль" class="form-control input-md" required="">
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="button1id"></label>
                    <div class="col-md-8">
                        <button type="submit" name="signup-submit" class="btn btn-success">Сохранить</button>
                        <a id="cancel" name="cancel" class="btn btn-danger" href="signin.php">Отмена</a>
                    </div>
                </div>
            </form>
        </div>
        <!--- Script Source Files -->
        <script src="src/jquery-3.3.1.min.js"></script>
        <script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
        <!--- End of Script Source Files -->
</body>

</html>