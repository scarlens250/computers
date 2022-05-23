<?php 
include 'db.php';

$count = $_POST['count'];
$get_id = $_GET['id'];

$sql = $pdo->prepare("SELECT equipments.id, equipments.Name, Price, Count, About, category.Name as Category FROM equipments INNER JOIN category ON equipments.id_category = category.id ");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);


if (isset($_POST['edit'])) {

  $sql1 = "SELECT `Count` FROM `equipments` WHERE id=?;";
  $query1 = $pdo->prepare($sql1);
  $query1->execute([$get_id]);
  $re = $query1->fetchAll(PDO::FETCH_OBJ);


  $sql = ("UPDATE equipments SET Count=? WHERE id=?");
  $query = $pdo->prepare($sql);
  $query->execute([$re[0]->Count - $count, $get_id]);
  if ($query) {
      header("Location: " . $_SERVER['HTTP_REFERER']);
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Продаж</title>
</head>

<body style="background-color: #9fa8da;">
  <!-- Menu -->
  <div class="mb-2 d-flex flex-wrap justify-content-end ">
    <div class="dropdown dropstart">
      <button class="btn btn-secondary dropdown-toggle m-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Меню
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a href="/" class="dropdown-item">Категорії</a></li>
        <li><a href="./products.php" class="dropdown-item">Техніка</a></li>
        <li><a href="./sell.php" class="dropdown-item">Продаж</a></li>
      </ul>
    </div>
  </div>
  <div class="mb-5 mx-3 px-1 rounded-2" style="background-color: #fff59d;">
    <div class="row">
      <div class="col-12">
        <table class="table table-striped table-hover mt-2">
          <thead style="background-color: #1e88e5;">
            <th>Назва</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Опис</th>
            <th></th>
          </thead>
          <tbody style="background-color: #e0e0e0;">
            <?php foreach ($result as $res) { ?>
              <tr>
                <td><?php echo $res->Name; ?></td>
                <td><?php echo $res->Price; ?></td>
                <td><?php echo $res->Count; ?></td>
                <td><?php echo $res->About; ?></td>
                <td class='block w-25'>
                  <a href="?id=<?php echo $res->id; ?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit<?php echo $res->id; ?>" style="background-color: #81c784;">
                    Продати
                  </a>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="edit<?php echo $res->id; ?>" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content" style="background-color: #81c784;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Продаж продукту</h5>
                    </div>
                    <div class="modal-body">
                      <form action="?id=<?php echo $res->id; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <small>Назва: <?php echo $res->Name; ?></small>
                        </div>
                        <div class="form-group">
                          <small id="price">Ціна: <?php echo $res->Price; ?></small>
                        </div>
                        <div class="form-group">
                          <small>Кількість: </small>
                          <input type="number" id="count" class="form-control-sm" name="count" max="<?php echo $res->Count; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" id="but" class="btn" style="background-color: #c8e6c9;" name="edit">Продати</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Modal Edit -->
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>