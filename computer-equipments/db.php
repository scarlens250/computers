<?php 

$host = 'eu-cdbr-west-02.cleardb.net';
$db = 'heroku_ca0659de5fdb97f';
$user = 'bfc9b3c441be18';
$pass = 'd59acaf5';

try {
    $pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);
} catch (PDOException $e) {
    echo 'Помилка з`єднання з базою даних '.$e->getMessage();
}