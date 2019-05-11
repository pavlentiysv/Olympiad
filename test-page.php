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

    <!-- PDF Viewer -->
    <div class="content">
      <embed src="uploads\events\Tasks\test-content.pdf#toolbar=0" type="application/pdf" height="99%" width="90%">
    </div>

    <!-- Sidebar -->
    <div class="answer-bar">
      <div class="answer-bar-btn ">
        <a class="btn btn-secondary btn-md ml-auto" href="#">Ответы</a>
      </div>
      <div class="answer-list">
        <form action="">
          <ol>
            <li>
              <select name="VALERALOX" class="answer-select">
                <option value="">-</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </li>

          </ol>
          <div class="submit-btn text-center">
            <input type="submit" name="submit-answers" class="btn btn-outline-light btn-lg ml-auto">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="src/jquery-3.3.1.min.js"></script>
  <script src="src/answer-bar.js"></script>

</body>



</html>