<?php
require 'php/session.inc.php';
require 'php/printDate.inc.php';

if (isset($_GET['signup'])) {
  if ($_GET['signup'] == 'success') {
    header("Location: signin.php");
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
    <link rel="stylesheet" href="style/example.css" />
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
            <div class="row">
                <div class="col-md-4 control-label">
                    <label for="lastName">Фамилия</label>
                    <input type="text" class="form-control" name="surname" placeholder="Иванов" value="" required="">
                    <div class="invalid-feedback">
                    Valid last name is required.
                </div>
                </div>
                <div class="col-md-4 control-label">
                <label for="firstName">Имя</label>
                <input type="text" class="form-control" name="name" placeholder="Иван" value="" required="">
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
                </div>

                <div class="col-md-4 mb-4 control-label">
                    <label for="MiddleName">Отчество</label>
                    <input type="text" class="form-control" name="middlename" placeholder="Иванович" value="" required="">
                    <div class="invalid-feedback">
                    Valid MiddleName is required.
                    </div>
                </div>
            </div>
            <!-- Select Date Of Birth-->
            <div class="row">
            <div class="col-md-7">
                <div class="row form-group">  
                    <label class="col-md-1 control-label" for="selectbasic">День</label>
                    <div class="col-md-2">
                        <select id="selectbasic" name="day" class="form-control">
                            <?php printDaysList(); ?>
                        </select>
                        </div>
                    <label class="col-md-1 control-label" for="selectbasic">Месяц</label>
                    <div class="col-md-3">
                        <select id="selectbasic" name="month" class="form-control">
                            <?php printMonthsList(); ?>
                        </select>   
                    </div>
                    <label class="col-md-1 control-label" for="selectbasic">Год</label>
                    <div class="col-md-3">
                        <select id="selectbasic" name="year" class="form-control">
                            <?php printYearList(); ?>
                        </select>
                    </div>
                </div>
            </div>
            </div>
            <!-- Gender Input -->
            <div class="row form-group">
                <label class="col-md-1" for="checkboxes">Пол</label>
    
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <input name="gender" id="genderboxes-0" value="М" type="radio">
                            Мужской
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="gender" id="genderboxes-1" value="Ж" type="radio">
                            Женский
                        </label>
                    </div>
                    <span class="help-block">Укажите пол</span>
    
                </div>
            </div>

            <!-- Address input-->
            <div class="row form-group">
                <label class="col-md-1 control-label" for="name">Адрес</label>
    
                <div class="col-md-4">
                    <input id="address" name="city" type="text" placeholder="Адрес" class="form-control input-md" required="">
                    <span class="help-block">Укажите адрес проживания</span>
                </div>
            </div>
            <!-- Phone input-->
            <div class="row form-group">
                <label class="col-md-1 control-label" for="phone">Телефон</label>
    
                <div class="col-md-4">
                    <input id="phone" name="telephone" type="tel" placeholder="Номер телефона"class="form-control input-md" required="">
                    <span class="help-block">Укажите ваш номер мобильного</span>
                </div>
            </div>
            <!-- School type input-->
            <div class="row form-group">
                <label class="col-md-1 control-label" for="name">Тип учебного заведения</label>
    
                <div class="col-md-4">
                    <input id="school" name="institution_type" type="text" placeholder="Гимназия/Средняя школа/Лицей/Колледж" class="form-control input-md" required="">
                    <span class="help-block">Укажите тип вашего учебного заведения</span>
                </div>
            </div>
            <!-- School name input-->
            <div class="row form-group">
                <label class="col-md-1 control-label" for="name">Название учебного заведения</label>
    
                <div class="col-md-4">
                    <input id="aschool" name="institution_number" type="text" placeholder="Название учебного заведения" class="form-control input-md" required="">
                    <span class="help-block">Укажите название вашего учебного заведения</span>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12 mb-2">
                <div class="row form-group">
                    <label class="col-md-1 control-label" for="selectbasic">Класс</label>

                    <div class="col-md-3">
                        <select id="selectbasic" name="grade" class="form-control">
                            <option selected>Выберите класс</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </select>   
                    </div>
                </div>
            </div>
            </div>

            <!-- Email input-->
            <div class="row form-group">
                <label class="col-md-1 " for="password">Email</label>
    
                <div class="col-md-4">
                    <input id="email" name="email" type="email" placeholder="Email"
                        class="form-control input-md" required="">
                    <span class="help-block">Укажите email</span>
                </div>
            </div>
                <!--Password input-->       
                <div class="row form-group">
                    <label class="col-md-1 " for="password">Пароль</label>
        
                    <div class="col-md-4">
                        <input id="pass" name="password" type="password" placeholder="Укажите пароль"
                            class="form-control input-md" required="">
                        <span class="help-block">Укажите пароль</span>
                    </div>
            </div> 
                <!--Password confirm-->       
                <div class="row form-group">
                        <label class="col-md-1 " for="password">Подтвердите пароль</label>
            
                        <div class="col-md-4">
                            <input id="pass" name="passwordRepeat" type="password" placeholder="Подтвердите пароль"
                                class="form-control input-md" required="">
                            <span class="help-block">Подтвердите пароль</span>
                        </div>
                </div>                         
            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="button1id"></label>
    
                <div class="col-md-8">
                    <button type="submit" name="signup-submit" class="btn btn-success">Сохранить</button>
                    <a id="cancel" name="cancel" class="btn btn-danger" href="signin.php">
                        Отмена</a>
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