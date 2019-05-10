<?php
require 'php/session.inc.php';
require 'php/profile.inc.php';
require 'php/printSelect.inc.php';
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
            <?php if ($session_usertype == 'admin' || $session_usertype == 'org') :?>
                <form class="ml-auto" action="php/profile-find-user.inc.php" method="post">
                    <input type="email" name="desired-email" id="desired-email" class="" placeholder="<?php echo $email?>">
                    <input type="submit" name="submit-search" class="btn btn-outline-light btn-lg ml-auto" id="submit" value="Найти пользователя" /> 
                </form>
                <a class="btn btn-danger" href="profile.php">Х</a>
            <?php endif;?>
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
                <?php if ($photo != null && file_exists("uploads/users/avatars/$photo")) : ?>
                    <img class="avatar" src="uploads/users/avatars/<?php echo $photo; ?>" alt="avatar">
                <?php else : ?>
                    <img class="avatar" src="img/default_avatar.jpg" alt="avatar">
                <?php endif; ?>
                <p class="fullname"><?php echo $surname; ?><br><?php echo $name; ?><br><?php echo $middlename; ?></p>
            </div>
            <!-- Right Block -->
            <div class="right-block col-md-9">
                <!-- Tabs -->
                <!-- Tab Toggler -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Профиль</a>
                        <a class="nav-item nav-link" id="nav-tests-tab" data-toggle="tab" href="#nav-tests" role="tab" aria-controls="nav-tests" aria-selected="false">Тесты</a>
                        <?php if ($email == $session_email || $session_usertype=='admin') :?>
                        <a class="nav-item nav-link" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" role="tab" aria-controls="nav-settings" aria-selected="false">Настройки</a>
                        <?php endif;?>
                        <?php if ($email == $session_email && ($session_usertype=='admin' || $session_usertype=='org')) :?>
                        <a class="nav-item nav-link" id="nav-settings-tab" data-toggle="tab" href="#nav-event" role="tab" aria-controls="nav-event" aria-selected="false">Мероприятия</a>
                        <?php endif;?>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <!-- Profile Tab Content -->
                    <div class="nav-profile tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <?php if ($session_usertype == 'admin' || $session_usertype == 'org') :?>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Тип пользователя</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <?php if ($userType=='admin') :?>
                                        <p>Администратор</p>
                                    <?php elseif ($userType=='org') :?>
                                        <p>Организатор</p>
                                    <?php else:?>
                                        <p>Участник</p>
                                    <?php endif;?>
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Фамилия</p>
                            </div>
                            <div class="info-value col-md-9">
                                <p><?php echo $surname; ?></p>
                            </div>
                        </div>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Имя</p>
                            </div>
                            <div class="info-value col-md-9">
                                <p><?php echo $name; ?></p>
                            </div>
                        </div>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Отчество</p>
                            </div>
                            <div class="info-value col-md-9">
                                <p><?php echo $middlename; ?></p>
                            </div>
                        </div>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Пол</p>
                            </div>
                            <div class="info-value col-md-9">
                                <?php if ($gender == 'М') : ?>
                                    <p>Мужской</p>
                                <?php elseif ($gender == 'Ж') : ?>
                                    <p>Женский</p>
                                <?php else : ?>
                                    <p>?</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Дата рождения</p>
                            </div>
                            <div class="info-value col-md-9">
                                <p><?php echo "$day.$month.$year"; ?></p>
                            </div>
                        </div>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Адрес</p>
                            </div>
                            <div class="info-value col-md-9">
                                <p><?php echo $city; ?></p>
                            </div>
                        </div>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Телефон</p>
                            </div>
                            <div class="info-value col-md-9">
                                <p><?php echo $telephone; ?></p>
                            </div>
                        </div>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Учебное заведение</p>
                            </div>
                            <div class="info-value col-md-9">
                                <p><?php echo $institution_number; ?><br><?php echo $grade; ?> класс</p>
                            </div>
                        </div>
                        <div class="info-row row">
                            <div class="info-title col-md-3">
                                <p>Электронная почта</p>
                            </div>
                            <div class="info-value col-md-9">
                                <p><?php echo $session_email; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- Test Tab Content -->
                    <div class="nav-tests tab-pane fade" id="nav-tests" role="tabpanel" aria-labelledby="nav-tests-tab">
                        <p>Результаты</p>
                    </div>
                    
                    
                    <!-- Settings Tab Content -->
                    <?php if ($email == $session_email || $session_usertype=='admin') :?>
                    <div class="nav-settings tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">

                        <h3>Редактирование профиля</h3>
                        <form action="php/profile-update.inc.php" method="post" enctype="multipart/form-data">
                            <?php if ($session_usertype == 'admin') : ?>
                                <div class="info-row row">
                                    <div class="info-title col-md-3">
                                        <p>Тип пользователя</p>
                                    </div>
                                    <div class="info-value col-md-9">
                                        <select id="usertype" name="usertype" class="form-control">
                                            <option <?php if ($userType == null) echo 'selected' ?> value="">Участник</option>
                                            <option <?php if ($userType == 'admin') echo 'selected' ?> value="admin">Администратор</option>
                                            <option <?php if ($userType == 'org') echo 'selected' ?>value="org">Организатор</option>
                                        </select>
                                    </div>
                                </div>
                            <?php else : ?>
                                <input type="hidden" class="form-control" name="usertype" value="<?php echo $userType; ?>" />
                            <?php endif; ?>
                            <input type="hidden" class="form-control" name="email" value="<?php echo $email; ?>" />

                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Фамилия</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input type="text" class="form-control" name="surname" value="<?php echo $surname; ?>" <?php if ($session_usertype != 'admin') echo 'required=""';?> />
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Имя</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" <?php if ($session_usertype != 'admin') echo 'required=""';?>/>
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Отчество</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input type="text" class="form-control" name="middlename" value="<?php echo $middlename; ?>" />
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Пол</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <select id="gender" name="gender" class="form-control">
                                        <option <?php if ($gender == null) echo 'selected'; ?> value="">- Не выбран - .<?php echo $gender?>.</option>
                                        <option <?php if ($gender == 'М') echo 'selected'; ?> value='М'>Мужской</option>
                                        <option <?php if ($gender == 'Ж') echo 'selected';?> value='Ж'>Женский</option>
                                    </select>
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Дата рождения</p>
                                </div>
                                <div class="info-value bday col-md-9">
                                    <div class="row form-group">
                                        <div class="col-md-1">
                                            <label class="control-label" for="day">День</label></div>
                                        <div class="col-md-2">
                                            <select id="day" name="day" class="form-control">
                                                <?php printDaysList(intval($day)); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label" for="month">Месяц</label></div>
                                        <div class="col-md-3">
                                            <select id="month" name="month" class="form-control">
                                                <?php printMonthsList(intval($month)); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label" for="year">Год</label></div>
                                        <div class="col-md-3">
                                            <select id="year" name="year" class="form-control">
                                                <?php printYearList(intval($year)); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Aдрес</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" <?php if ($session_usertype != 'admin') echo 'required=""';?> />
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Телефон</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input id="telephone" name="telephone" type="tel" pattern="\+[0-9]{3}\([0-9]{2}\)[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="+375(29)123-45-67" class="form-control" value="<?php echo $telephone; ?>" <?php if ($session_usertype != 'admin') echo 'required=""';?>>
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Тип учебного заведения</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <select id="institution_type" name="institution_type" class="form-control">
                                        <option <?php if ($institution_type == null) echo 'selected'; ?> value="">- Не выбран -</option>
                                        <option <?php if (trim($institution_type)== 'Средняя Школа') echo 'selected'; ?> value="Средняя Школа">Средняя Школа</option>
                                        <option <?php if (trim($institution_type) == 'Гимназия') echo 'selected'; ?> value="Гимназия">Гимназия</option>
                                        <option <?php if (trim($institution_type) == 'Лицей') echo 'selected'; ?> value="Лицей">Лицей</option>
                                        <option <?php if (trim($institution_type) == 'Колледж') echo 'selected'; ?> value="Колледж">Колледж</option>
                                    </select>
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Название/номер учебного заведения</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input type="text" class="form-control" name="institution_number" value="<?php echo $institution_number; ?>" <?php if ($session_usertype != 'admin') echo 'required=""';?> />
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Класс/Курс</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input type="text" class="form-control" name="grade" value="<?php echo $grade; ?>" <?php if ($session_usertype != 'admin') echo 'required=""';?> />
                                </div>
                            </div>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Новое фото профиля</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input id="newphoto" name="newphoto" type="file" class="input-md" />
                                </div>
                            </div>
                            
                                <div class="info-row row">
                                    <div class="info-title col-md-3">
                                        <p>Новый пароль</p>
                                    </div>
                                    <div class="info-value col-md-9">
                                        <input type="password" class="form-control" name="newpassword" />
                                    </div>
                                </div>
                                <div class="info-row row">
                                    <div class="info-title col-md-3">
                                        <p>Подтвердите новый пароль</p>
                                    </div>
                                    <div class="info-value col-md-9">
                                        <input type="password" class="form-control" name="newrepeatpassword" />
                                    </div>
                                </div>
                            
                            <h3>Подтверждение изменений</h3>
                            <div class="info-row row">
                                <div class="info-title col-md-3">
                                    <p>Пароль</p>
                                </div>
                                <div class="info-value col-md-9">
                                    <input type="password" class="form-control" name="password" required="" />
                                </div>
                            </div>
                            <input type="submit" name="update-submit" class="btn btn-success" value="Сохранить">
                            <a id="cancel" name="cancel" class="btn btn-danger" href="signin.php">Отмена</a>
                        </form>
                    </div>
                    <?php endif;?>


                    <!-- Settings Tab Content -->
                    <?php if ($email == $session_email && ($session_usertype=='admin' || $session_usertype=='org')) :?>
                    <div class="nav-event tab-pane fade" id="nav-event" role="tabpanel" aria-labelledby="nav-event-tab">
                        <h3>Мероприятия</h3>
                            
                    <?php endif;?>
                </div>
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