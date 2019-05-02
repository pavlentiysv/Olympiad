<?php
require('db/dbManager.class.php');
$mysql = new dbManager();
$conn = $mysql->getConnection();
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
    <title>Олимпиада БГУИР</title>
</head>

<body>
    <?php
    $query = "SELECT * FROM accounts";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) : ?>
            <?php echo $row["accountID"] ?>
            <?php echo $row["email"] ?>
            <?php echo $row["password"] ?>
            <?php echo $row["userType"] ?>
        <?php endwhile;
} else {
    echo "Ошибка при запросе к БД.";
}
?>
</body>

</html>