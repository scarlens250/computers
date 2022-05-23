<?php include 'product_functions.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Техніка</title>
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
        <button class="btn mt-2" data-bs-toggle="modal" data-bs-target="#create" style="background-color: #81c784;">
          Створити нову техніку
        </button>
        <table class="table table-striped table-hover mt-2">
          <thead style="background-color: #1e88e5;">
            <th>Назва</th>
            <th>Категорія</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Опис</th>
            <th></th>
          </thead>
          <tbody style="background-color: #e0e0e0;">
            <?php foreach ($result as $res) { ?>
              <tr>
                <td><?php echo $res->Name; ?></td>
                <td><?php echo $res->Category; ?></td>
                <td><?php echo $res->Price; ?></td>
                <td><?php echo $res->Count; ?></td>
                <td><?php echo $res->About; ?></td>
                <td class='block w-25'>
                  <a href="?id=<?php echo $res->id; ?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit<?php echo $res->id; ?>" style="background-color: #81c784;">
                    Редагувати
                  </a>
                  <a href="" class="btn" data-bs-toggle="modal" data-bs-target="#delete<?php echo $res->id; ?>" style="background-color: #ef9a9a;">
                    Видалити
                  </a>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="edit<?php echo $res->id; ?>" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content" style="background-color: #81c784;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Змінити продукт</h5>
                    </div>
                    <div class="modal-body">
                      <form action="?id=<?php echo $res->id; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <small>Назва</small>
                          <input type="text" class="form-control-sm" name="name" value='<?php echo $res->Name; ?>'>
                        </div>
                        <div class="form-group">
                          <small>Категорія</small>
                          <select class="form-select-sm" aria-label="Default select example" name="idCategory">
                            <?php foreach ($category as $categ) { ?>
                              <option value="<?php echo $categ->id; ?>" <?php if (strcasecmp($categ->Name, $res->Category) == 0) {
                                                                          echo 'selected';
                                                                        } ?>><?php echo $categ->Name; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <small>Ціна</small>
                          <input type="number" class="form-control-sm" name="price" value='<?php echo $res->Price; ?>'>
                        </div>
                        <div class="form-group">
                          <small>Кількість</small>
                          <input type="number" class="form-control-sm" name="count" value='<?php echo $res->Count; ?>'>
                        </div>
                        <div class="form-group">
                          <small>Опис</small>
                          <input type="text" class="form-control-sm" name="description" value='<?php echo $res->About; ?>'>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn" style="background-color: #c8e6c9;" name="edit">Зберегти</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Modal Edit -->
              <!-- Modal Delete -->
              <div class="modal fade" id="delete<?php echo $res->id; ?>" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content" style="background-color: #ef9a9a;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Точно видалити продукт "<?php echo $res->Name; ?>"</h5>
                    </div>
                    <div class="modal-footer">
                      <form action="?id=<?php echo $res->id; ?>" method="post">
                        <button type="submit" class="btn" name="delete">Так</button>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
              <!-- Modal Delete -->
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <!-- Modal Add -->
  <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: #bbdefb;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Додати продукт</h5>
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <small>Назва</small>
              <input type="text" class="form-control-sm" name="name">
            </div>
            <div class="form-group">
              <small>Ціна</small>
              <input type="number" class="form-control-sm" name="price">
            </div>
            <div class="form-group">
              <small>Кількість</small>
              <input type="number" class="form-control-sm" name="count">
            </div>
            <div class="form-group">
              <small>Опис</small>
              <input type="text" class="form-control-sm" name="description">
            </div>
            <div class="form-group">
              <small>Категорія</small>
              <select class="form-select-sm" aria-label="Default select example" name="idCategory">
                <?php foreach ($category as $categ) { ?>
                  <option value="<?php echo $categ->id; ?>"><?php echo $categ->Name; ?></option>
                <?php } ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn" style="background-color: #c8e6c9;" name="add">Зберегти</button>
        </div>
        </form>

      </div>
    </div>
  </div>
  <!-- Modal Add -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>