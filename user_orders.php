<?php
    session_start();
    include_once 'database.php';
    $admin =0;
    if (!empty($_SESSION['email'])) {
        $now_email = $_SESSION['email'];
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $query10 = "SELECT * FROM users where id = $id"  ;          
        $sql10 = $conn->prepare($query10);
        $result  = $sql10->execute();
        
        $user = $sql10->fetch();
        if($user['is_admin'] == 1){
            $admin = 1;
        }else{
            $admin = 0;
        }
        # code...
    }
    if(isset($_GET)){

            $query = "SELECT * FROM orders where user_id = $id"  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute();
            
            $orders = $sql->fetchAll();


    }
    if(isset($_SESSION['filter_orders'])){
        $orders = $_SESSION['filter_orders'];
        unset($_SESSION['filter_orders']);

    }

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Orders</title>
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
                <?php if($admin ==1){  ?>
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
                    <a class="nav-link border-end" href="#">Checks</a>
                </li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link border-end" href="user_orders.php">My Orders</a>
                    </li>
                <?php }?>    
               
               
            </ul>
                <div class="d-flex d-flex align-self-center">
                    <?php if($admin ==1){  ?>
                        
                        <form action="handle_search.php" method="post" class="d-flex" role="search w-100">
                            <input class="form-control me-2  text-dark border-0 " name="search"  type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-success me-3" name="search_button" type="submit">Search</button>
                        </form>
                    <?php } ?>

                
                    <p  class="mx-3 align-self-center"><?php echo $username;  ?></p>
                    <img src="<?php  echo $user['image'] ?>" class="rounded" style="width: 50px;" alt="">
    
                    <p class="mx-1 ">
                        <a class="btn btn-secondary mx-1 " href="logout.php">logout</a>
                    </p>
                </div>
            </div>
        </div>
    </nav>

    </div>
    <div class="container">
        <div class="row my-2">
            <div class="col-6 ">
                <h2>My orders</h2>
            </div>
        </div> 
        <div class=" my-1">
   
            <form action="filter_Date.php" class="row align-items-center" method="post" >
                <div class="col-4 ">
                    <label for="">date from</label>
                    <input type="date" name="date_from" class="form-control">
                </div>
                <div class="col-4">
                    <label for="">date to</label>
                    <input type="date" name="date_to" class="form-control">
                </div>
                <div class="col-1 align-items-center p-1">
                    <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-1 align-items-center p-1">
                    <button type="reset"  class="btn btn-secondary">reset</button>
                </div>

            </form>
            
        </div>
        <div class="row mt-3">    
                <?php  if(isset($_SESSION['added_order'])){?>
                    <div  class="alert alert-success text-center">
                        <?php  echo $_SESSION['added_order']; 
                        unset($_SESSION['added_order'])
                        ?>
                        
                    </div >
                    
                <?php }  ?>
                <?php  if(isset($_SESSION['deleted']['order'])){?>
                    <div class="alert alert-success text-center">
                        <?php  echo $_SESSION['deleted']['order']; 
                        unset($_SESSION['deleted']['order'])
                        ?>
                        
                    </div>
                    
                <?php }  ?>
                
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Order date</th>
                            <th> status</th>
                            <th>amount</th>
                            <th>action</th>
                            <!-- <th>created_at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(isset($orders)  && !empty($orders)){
                            foreach ($orders as $order) { ?>
                                
                                    <tr>
                                        <td>
                                                <?php  echo $order['date'] ?>
                                        </td>

                                        <td>
                                        <?php if($order['status'] == 0){ ?>
                                            <p class="btn btn-primary"> in progress</p>
                                        <?php   } elseif ($order['status'] == 1) { ?>
                                            <p class="btn btn-secondary"> out to deliver</p>

                                       <?php   }else{ ?>
                                        <p class="btn btn-success"> done</p>
                                        <?php } ?>
                                        

                                        </td>
                                        <td>
                                        <?php  echo $order['amount'] ?> EGP

                                        </td>

                                        <td>
                                        <?php if($order['status'] == 0){  ?>

                                            <a class="btn btn-danger" href="delete/handle_delete_order.php?id=<?php echo $order['id'] ?>">cancel</a>
                                            <?php  } ?>
                                        </td>
                                        
                                    </tr>

                            
                        
                        <?php }
                        }  ?> 
                    </tbody>
                </table>
        </div>
    </div>
</body>
<script src="./lab.js"></script>

</html>