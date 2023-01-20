<?php 

session_start();
include_once 'database.php';
$query10 = "SELECT * FROM users where is_admin = 1"  ;          
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
    <title>Add Category</title>
</head>
<style >
    body{
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
                    <img src="<?php  echo $user['image'] ?>" class="rounded" style="width: 50px;" alt="">
                    <p  class="mx-3"><?php  echo $user['username'] ?></p>

                </div>
            </div>
        </div>
    </nav>

    </div>
    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <h2>Add Category</h2>
            </div>
        </div>
        <!-- error add category -->
        <?php
                if(isset($_SESSION['error_insertcategory'])){ 
                    foreach ($_SESSION['error_insertcategory'] as $err) {  ?>
                        <div class="alert alert-danger w-50 text-center m-auto">
                            <span>
                                <?php echo $err; ?>
                            </span>
                        </div>
                    
                <?php session_unset();   }   } ?>
        <div class="row">
            <div class="col-12">
                <div class=" p-3  mx-auto my-3">
                    <form action="handle_addcategory.php" method="post">
                        <div class="mb-3 row  ">
                            <label  class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-4">
                            <input type="text"  class="form-control" placeholder="Enter new Category" name="name" >
                            </div>
                        </div>
                        <div class="w-100 text-center mx-auto my-5 ">
                            <button class="btn btn-primary" type="submit">save</button>
                            <button class="btn btn-secondary" >reset</button>

                        </div>
                    </form>
                   
                     
                    
                    
                </div>
                 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>