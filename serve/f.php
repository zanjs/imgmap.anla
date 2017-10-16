<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php

    header("content-type:text/html; charset=utf-8");

    $getTitle = $_GET["t"];
    $getImg = $_POST["i"];
    $getId = $_POST["id"];


    $name = str_replace(' ', '_', $getTitle);
    echo $name;
    //    echo '<br/>';
    //    echo $getTitle;

    ?>
</body>
</html>

