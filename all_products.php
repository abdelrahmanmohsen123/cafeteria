<?php
    session_start();
    include_once 'database.php';
    $query10 = "SELECT * FROM users where is_admin = 1"  ;          
    $sql10 = $conn->prepare($query10);
    $result  = $sql10->execute();
    
    $user = $sql10->fetch();
    if(isset($_GET)){

            $query = 'SELECT * FROM products'  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute();
            
            $products = $sql->fetchAll();

    }
    if(isset($_SESSION['products'])){
        $products =$_SESSION['products'];
        unset($_SESSION['products']);
    }

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

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
                <form action="handle_search.php" method="post" class="d-flex" role="search w-100">
                            <input class="form-control me-2  text-dark border-0 " name="search_product"  type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-success me-3" name="search_button_product" type="submit">Search</button>
                 </form>
                    <img src="<?php  echo $user['image'] ?>" class="rounded" style="width: 50px;" alt="">
                    <p  class="mx-3"><?php  echo $user['username'] ?></p>
                </div>
                <p class="mx-1 ">
                        <a class="btn btn-secondary mx-1 " href="logout.php">logout</a>
                    </p>
            </div>
        </div>
    </nav>

    </div>
    <div class="container">
        <div class="row my-3">
            <div class="col-8 ">
                <h2>All Products</h2>
            </div>
            <div class="col-4 ">
                <a href="add_product.php" class="btn btn-primary">Add Products</a>
            </div>
            <?php  if(isset($_SESSION['inserted_product'])){?>
                                                <span class="alert alert-success">
                                                    <?php  echo $_SESSION['inserted_product']; 
                                                    unset($_SESSION['inserted_product'])
                                                    ?>
                                                    
                                                </span>
                                                
                                            <?php }  ?>
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th> product</th>
                            <th>price</th>
                            
                            <th>image</th>
                            <th>action</th>
                            <!-- <th>created_at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(isset($products)  && !empty($products)){
                            foreach ($products as $product) { ?>
                                
                                    <tr>
                                        <td>
                                                <?php  echo $product['id'] ?>
                                        </td>

                                        <td>
                                        <?php  echo $product['name'] ?>

                                        </td>
                                        <td>
                                        <?php  echo $product['price'] ?> EGP

                                        </td>
                                    
                                        <td>
                                            <img class="" style="width: 100px;height=100px" src="<?php echo $product['image']  ?>" alt="">
                                        

                                        </td>
                                        
                                        <td>
                                            <a class="btn btn-secondary" href="edit_product.php?id=<?php echo $product['id'] ?>">Update</a>
                                            <a class="btn btn-danger" href="./delete/product.php?id=<?php echo $product['id'] ?>">delete</a>

                                        </td>
                                        
                                    </tr>
                                   
                            
                        
                        <?php }
                        }  ?> 
                    </tbody>
                </table>
        </div>
    </div>
    <script src="./lab.js"></script>
</body>


</html>