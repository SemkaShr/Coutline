<?php
$db_password = "pass";
$db_username = "user";
$db_name = "db";
$db = mysqli_connect('localhost', $db_username, $db_password, $db_name);

if(!$db)
{
    echo "Ошибка загрузки баз данных";
    exit();
}

mysqli_query($db, "SET NAMES 'utf8'");
mysqli_query($db, "SET CHARACTER SET 'utf8'");
mysqli_query($db, "SET SESSION collation_connection = 'utf8_general_ci'");
?>
