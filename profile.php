<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style/main.css" />
    <link rel="stylesheet" href="style/fixed.css" />
    <title>Личный кабинет</title>
</head>

<body>
    <div id="home">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="index.php" class="navbar-brand">
                <img src="img/bsuirlogo.png" alt="logo" />
            </a>
            <form action="php/signout.inc.php" method="post">
                <div class="form-group text-center">
                    <input type="submit" name="signout-submit" class="btn btn-outline-light btn-lg" id="submit" value="Выйти" />
                </div>
            </form>
        </nav>
        <!-- End Navigation -->
        <div class="container sign-up">
            <div class="row">
                <div class="empty-space col-md-4"></div>
                <div class="form-area col-md-5">
                    <h1 class="text-center">Выход</h1>
                    <form action="php/signout.inc.php" method="post">
                        <div class="form-group text-center">
                            <input type="submit" name="signout-submit" class="btn btn-outline-light btn-lg" id="submit" value="Выйти" />
                        </div>
                    </form>
                </div>
                <div class="empty-space col-md-4"></div>
            </div>
        </div>
    </div>
</body>

</html>