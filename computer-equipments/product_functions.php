<?php

include 'db.php';

$name = $_POST['name'];
$about = $_POST['description'];
$price = $_POST['price'];
$count = $_POST['count'];
$id_category = $_POST['idCategory'];
$get_id = $_GET['id'];


//ADD
if (isset($_POST['add'])) {
    // $sql = ("INSERT INTO `equipments`(`id_category`, `Name`, `Price`, `Count`, `About`) VALUES (1,'[value-3]',345,23,'[value-6]')");
    // $query = $pdo->prepare($sql);
    // $query->execute([$name, $id_category, $count, $price, $about]);

    $sql = ("INSERT INTO `equipments`( `Name`, `id_category`, `Count`, `Price`, `About`) VALUES (?, ?, ?, ?, ?)");
    $query = $pdo->prepare($sql);
    $query->execute([$name, $id_category, $count, $price, $about]);

    if ($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

//READ
$sql = $pdo->prepare("SELECT equipments.id, equipments.Name, Price, Count, About, category.Name as Category FROM equipments INNER JOIN category ON equipments.id_category = category.id ");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);

$categorySql = $pdo->prepare("SELECT id, Name FROM category");
$categorySql->execute();
$category = $categorySql->fetchAll(PDO::FETCH_OBJ);



//UPDATE
if (isset($_POST['edit'])) {

    $sql = ("UPDATE equipments SET Name=?, Count=?, Price=?, id_category=?, About=?  WHERE id=?");
    $query = $pdo->prepare($sql);
    $query->execute([$name, $count, $price, $id_category, $about, $get_id]);
    if ($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}


//DELETE
if (isset($_POST['delete'])) {
    $sql = ("DELETE FROM equipments WHERE id=?");
    $query = $pdo->prepare($sql);
    $query->execute([$get_id]);
    if ($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
