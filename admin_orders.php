<?php
    session_start();
    include_once 'database.php';
    $admin =0;
    if (!empty($_SESSION['email'])) {
        $now_email = $_SESSION['email'];
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        if($now_email == "admin@gmail.com"){
            $admin = 1;
        }
        # code...
    }
    if(isset($_GET)){

            $query = "SELECT * FROM orders"  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute();
            
            $orders = $sql->fetchAll();


    }
    if(isset($_SESSION['orders'])){
        $orders =$_SESSION['orders'];
        unset($_SESSION['orders']);
    }

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Orders</title>
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
                <!-- <li class="nav-item">
                    <a class="nav-link border-end" href="admin_orders.php">All Orders</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link border-end" href="homepage.php">Manual Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border-end" href="admin_orders.php">Checks</a>
                </li>
                <?php }?>
                      
               
               
            </ul>
                <div class="d-flex d-flex align-self-center">
                    <?php if($admin ==1){  ?>
                        
                        <form action="handle_search.php" method="post" class="d-flex" role="search w-100">
                            <input class="form-control me-2  text-dark border-0 " name="search_order"  type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-success me-3" name="search_orders" type="submit">Search</button>
                        </form>
                    <?php } ?>

                
                    <p  class="mx-3 align-self-center"><?php echo $username;  ?></p>
                    <img src="images/proxy.jpg" class="rounded" style="width: 50px;" alt="">
    
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
                <h2>Admin orders</h2>
            </div>
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
                            <th> name</th>
                            <th> room no</th>
                            <th> ext</th>
                            <th>Total</th>
                            <th>Status</th>

                            <th>action</th>
                            <!-- <th>created_at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(isset($orders)  && !empty($orders)){
                            foreach ($orders as $order) {
                            $user_id = $order['user_id'];                 
                            $query3 = "SELECT * FROM users where id = $user_id" ;          
                            $sql3 = $conn->prepare($query3);
                            $result3  = $sql3->execute();
                            
                            $user = $sql3->fetch();
                            ?>
                                    <tr>
                                        <td>
                                                <?php  echo $order['date'] ?>
                                        </td>
                                        <td>
                                                <?php  echo $user['username'] ?>
                                        </td>
                                        <td>
                                                <?php  echo $order['room_no'] ?>
                                        </td>
                                        <td>
                                                <?php  echo $order['ext'] ?>
                                        </td>
                                        <td>
                                        <?php  echo $order['amount'] ?> EGP

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
                                           <form action="handle_cahngestatus.php" method="post">
                                            <div class="row w-100 text-start">
                                                <div class="col-9">
                                                <input type="hidden" value="<?php echo $order['id']; ?>" name="order_id">
                                                <select name="change_status" id=""  class="form-select w-50">
                                                            <option selected disabled>change status</option>
                                                            <option value="0">progress</option>
                                                            <option value="1">out to deliver</option>
                                                            <option value="2">Done</option>
                                                            </a>
                                                </select>
                                                </div>
                                                <div class="col-2">
                                                <button type="submit" class="btn btn-dark">change</button>

                                                </div>
                                            </div>
                                           
                                           </form>
                                            
                                           
                                            
                                            <!-- <a href="" class="btn btn-primary">progress</a>
                                            <a href="" class="btn btn-secondary">out to progress</a>
                                            <a href="" class="btn btn-success">Done</a> -->
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