<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css" />
  <link rel="icon" href="img/bsuirlogo_mini.png" />
  <link rel="stylesheet" href="style/main.css" />
  <link rel="stylesheet" href="style/test-page.css" />
  <title>Тестирование</title>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="answer-bar">
      <div class="answer-bar-btn">
        <a href="#">Ответы</a>
      </div>
      <div class="title text-center">
        <h2>Ваши ответы</h2>
      </div>
      <div class="answer-list">
        <form action="">
          <ol>
            <li><input type="text" name="answer1" placeholder="ваш ответ"></li>
            <li><input type="text" name="answer2" placeholder="ваш ответ"></li>
            <li><input type="text" name="answer3" placeholder="ваш ответ"></li>
          </ol>
          <div class="submit-btn text-center">
            <input type="submit" name="submit-answers">
          </div>
        </form>
      </div>
    </div>

    <!-- Test  -->
    <div class="content">
      <section class="test">
        <h2>Задание</h2>
        <!-- <embed src="uploads/tasks/test-content.pdf#toolbar=0" type="application/pdf"> -->
      </section>
    </div>
  </div>
  <script src="src/jquery-3.3.1.min.js"></script>
  <script src="src/answer-bar.js"></script>

</body>



</html>