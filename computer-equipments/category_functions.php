<?php

include 'db.php';

$name = $_POST['name'];
$get_id = $_GET['id'];


//ADD
if (isset($_POST['add'])) {

    $sql = ("INSERT INTO `category`(`Name`) VALUES (?)");
    $query = $pdo->prepare($sql);
    $query->execute([$name]);

    if ($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

//READ
$sql = $pdo->prepare("SELECT `id`, `Name`FROM `category` ");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);



//UPDATE
if (isset($_POST['edit'])) {
        $sql = ("UPDATE `category` SET Name=? WHERE id=?");
        $query = $pdo->prepare($sql);
        $query->execute([$name, $get_id]);
        if ($query) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
}

//DELETE
if (isset($_POST['delete'])) {
    $sql = ("DELETE FROM `category` WHERE id=?");
    $query = $pdo->prepare($sql);
    $query->execute([$get_id]);
    if ($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
