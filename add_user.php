<?php
session_start();
include_once 'database.php';

$query10 = "SELECT * FROM users where is_admin = 1";
$sql10 = $conn->prepare($query10);
$result  = $sql10->execute();

$user = $sql10->fetch();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Add User</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
    }
</style>

<body>
    <div class="container-fluid header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active border-end" aria-current="page" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-end" href="all_products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-end" href="all_users.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-end" href="homepage.php">Manual Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-end" href="admin_orders.php">Checks</a>
                        </li>


                    </ul>
                    <div class="d-flex">
                        <img src="<?php echo $user['image'] ?>" class="rounded" style="width: 50px;" alt="">
                        <p class="mx-3"><?php echo $user['username'] ?></p>
                    </div>
                </div>
            </div>
        </nav>

    </div>
    <div class="container align-center">
        <div class="row my-2">
            <div class="col-12">
                <h2>Add User</h2>
            </div>
        </div>

        <form action="handle_adduser.php" method="post" class="card align-center" enctype="multipart/form-data">
            <?php if (isset($_SESSION['errors']['user'])) {
                foreach ($_SESSION['errors']['user'] as $err_user) { ?>
                    <div class="alert alert-danger w-50 m-auto text center">
                        <span>
                            <?php echo $err_user;
                            ?>
                        </span>
                    </div>
            <?php }
            }
            unset($_SESSION['errors']['user']) ?>
            <div class="row ">
                <div class="col-12">
                    <div class="text-center p-3  mx-auto my-3">
                        <div class="mb-3 row  ">
                            <label class="col-sm-3 col-form-label"> Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Enter Name" name="name">
                            </div>
                        </div>
                        <div class="mb-3 row  ">
                            <label class="col-sm-3 col-form-label"> email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" placeholder="Enter email" name="email">
                            </div>
                        </div>
                        <div class="mb-3 row  ">
                            <label class="col-sm-3 col-form-label"> password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" placeholder="Enter password" name="password">
                            </div>
                        </div>
                        <div class="mb-3 row  ">
                            <label class="col-sm-3 col-form-label">Confirm password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" placeholder="Enter Confirm_password" name="confirm_password">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Room no</label>
                            <div class="col-sm-8">
                                <input type="number" name="room_no" placeholder="2" class="form-control ">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Ext</label>
                            <div class="col-sm-8">
                                <input type="number" placeholder="2" name="ext" class="form-control ">
                            </div>
                        </div>

                        <div class="mb-3 ">
                            <div class="row">

                                <label class="col-sm-3 col-form-label">User Picture</label>

                                <div class="col-8">
                                    <div class="input-group mb-3">
                                        <input type="file" name="image" class="form-control" id="inputGroupFile02">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="w-100 text-center mx-auto my-5 ">
                            <button class="btn btn-primary" type="submit">save</button>
                            <button class="btn btn-secondary" type="reset">reset</button>

                        </div>

                    </div>

                </div>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>