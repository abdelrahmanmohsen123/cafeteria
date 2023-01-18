<?php
    session_start();
    $amount=0;
    include_once 'database.php';
    $admin =0;
    if (!empty($_SESSION['email'])) {
        $now_email = $_SESSION['email'];
        if($now_email == "ahmed@gmail.com"){
            $admin = 1;
        }
        # code...
    }
    if(isset($_GET)){
                //product 
            $query = 'SELECT * FROM products'  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute();
            
            $products = $sql->fetchAll();

            // category
            $query2 = 'SELECT * FROM category'  ;          
            $sql2 = $conn->prepare($query2);
            $result2  = $sql2->execute();
            
            $categories = $sql2->fetchAll();

            // current
            $query3 = 'SELECT * FROM current_order'  ;          
            $sql3 = $conn->prepare($query3);
            $result3  = $sql3->execute();
            
            $current_orders = $sql3->fetchAll();



    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        /* start variables */
        :root {
            --bg-color: #18191A;
            --bg-dark: #212529;
            --sec-color: #303031;
            --secondry-color: #c0b7ab;
            --hover-color: #4e4f5079;
            --text-color: #e9edf3;
            --drawer-icon-color: #5781d6;
            --scrollbar-color: rgba(128, 128, 128, 0.651);
            --hr-color: #c0b7ab75;
            --active-color: #6F4E37;
            --main-duration: 0.2s;
        }

        /* end variables */
        /* start global rules */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* start scroll bar */
        /* width */
        article::-webkit-scrollbar {
            width: 8px;
        }

        /* Handle */
        article::-webkit-scrollbar-thumb {
            visibility: hidden;
            background: var(--active-color);
            border-radius: 10px;
        }

        /* Handle on hover */
        article::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
            visibility: visible;
        }

        article:hover::-webkit-scrollbar-thumb {
            background: -var(--active-color);
            visibility: visible;
        }

        /* order-list */
        /* width */
        .order-list::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        /* Handle */
        .order-list::-webkit-scrollbar-thumb {
            visibility: hidden;
            background: var(--active-color);
            border-radius: 10px;
        }

        /* Handle on hover */
        .order-list::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
            visibility: visible;
        }

        .order-list:hover::-webkit-scrollbar-thumb {
            background: -var(--active-color);
            visibility: visible;
        }

        /* end scroll bar */

        .primary-bg {
            background-color: var(--bg-color) !important;
        }

        .accent-bg {
            background-color: var(--bg-dark);
        }

        .secondry-bg {
            background-color: var(--sec-color);
        }

        .hover-bg {
            background-color: var(--hover-color);
        }

        .primary-text {
            color: var(--text-color);
        }

        .accent-text {
            color: var(--secondry-color);
        }

        section {
            height: calc(100vh - 56px);
        }

        section article nav a {
            margin: 5px 10px;
            background-color: var(--bg-color) !important;
        }

        section article nav a:hover {
            background-color: var(--hover-color) !important;
            color: var(--text-color) !important;
        }

        .active-cat {
            background-color: var(--active-color) !important;
            color: var(--text-color) !important;
        }

        .active-color {
            color: var(--active-color) !important;
        }

        .product-card .card:hover {
            background-color: var(--hover-color) !important;
            color: var(--text-color) !important;
            cursor: pointer;
            transform: scale(1.005);
            transition: var(--main-duration);
        }

        body {
            background-image: linear-gradient(#212529, #18191A, #4e4f5079, #303031);
        }

        .order-list {
            height: 55vh;
            overflow-y: auto;
            margin: 0 !important;
            padding: 0 !important;
            /* overflow-x: hidden; */
        }

        .bill-list {
            height: 23vh;
        }

        /* end global rules */
        /* Google fonts import link */

        .order-card {
            width: 95%;
            margin: auto;
        }

        .wrapper {
            height: 40x;
            min-width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FFF;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .wrapper span {
            width: 100%;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            background-color: var(--active-color);
            color: var(--text-color);
        }

        .wrapper span:hover {
            background-color: var(--bg-dark) !important;
            color: var(--text-color) !important;
        }

        .wrapper span.num {
            font-size: 18px;
            border-right: 2px solid rgba(0, 0, 0, 0.2);
            border-left: 2px solid rgba(0, 0, 0, 0.2);
            pointer-events: none;
            background-color: var(--sec-color);
            color: var(--text-color);
            background-color: var(--sec-color);
            color: var(--text-color);
        }
    </style>
</head>

<body class="accent-bg">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active border-end" aria-current="page" href="#">Home</a>
                </li>
                <?php if($admin ==1){  ?>
                <li class="nav-item">
                    <a class="nav-link border-end" href="all_products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border-end" href="all_users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border-end" href="#">Manual Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border-end" href="#">Checks</a>
                </li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link border-end" href="all_products.php">My Oreders</a>
                    </li>
                <?php }?>    
               
               
            </ul>
                <div class="d-flex">
                    <img src="images/proxy.jpg" class="rounded" style="width: 50px;" alt="">
                    <?php if($admin ==1){  ?>
                    <p  class="mx-3">Admin</p>
                    <?php } ?>

                      
                </div>
            </div>
        </div>
    </nav>
    <section class="d-flex">
        <article class="col-6 col-md-7 col-lg-8 col-xl-9 px-5 py-3 overflow-y-auto">
            <nav class="nav nav-pills flex-column flex-sm-row ">
                <a class="flex-sm-fill text-sm-center nav-link text-white-50 active-cat" aria-current="page"
                    href="#">All products</a>
                    
                    <?php 
                    if(!empty($categories)){
                        foreach ($categories as $category) {?>
                <a class="flex-sm-fill text-sm-center nav-link text-white-50" href="#"><?php echo $category['name']  ?></a>
                <?php }

                     }
                ?>
                <!-- <a class="flex-sm-fill text-sm-center nav-link text-white-50" href="#">Link</a>
                <a class="flex-sm-fill text-sm-center nav-link text-white-50" href="#">Link</a>
                <a class="flex-sm-fill text-sm-center nav-link text-white-50" href="#">Link</a> -->
            </nav>
            <?php  if(isset($_SESSION['add_product'])){ ?>
                <div class="row">
                    <div class="col-4 alert alert-primary">
                    <?php   echo $_SESSION['add_product']; ?>

                    </div>
                </div>
                <?php }session_unset() ?>       
            <div class="row row-cols-auto py-3">
                <?php 
                    if(!empty($products)){
                        foreach ($products as $product) {?>
                       
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-2 product-card " <?php  if(isset($_SESSION['add_product'])){ ?> data-bs-toggle="tooltip"   data-bs-placement="bottom" data-bs-title="<?php echo $_SESSION['add_product']; ?>" <?php } ?>>
                            <a href="handle_addcurrent.php?id=<?php echo $product['id']  ?>">
                                <div class="card text-white primary-bg">
                                    <i class="fab fa-apple fa-lg"></i>
                                    <img src="<?php echo $product['image']  ?>"
                                        class="card-img-top" alt=""  height="120vh"/>
                                    <div class="card-body ">
                                        <h5 class="card-title " ><?php echo $product['name']  ?></h5>
                                        <div class="d-flex">
                                            <span class="active-color fw-bold me-2">$<?php echo $product['price'];   ?></span><span
                                                class="text-white-50">/1pcs</span>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>

                       
                          
                        
                    <?php }} ?>
            </div>
        </article>
        <article class="col-6 col-md-5 col-lg-4 col-xl-3 p-4 primary-bg mt-1">
            <h3 class="primary-text">Current Order</h3>
            
            <div class="order-list ">
                 <!-- ///current_orders -->
                 <?php if(!empty($current_orders)){

                    foreach ($current_orders as $current_order) { ?>
                       <div class="row mb-1 order-card">
                            <div class="card border-0 rounded-3 accent-bg">
                                <div class="card-body">
                                    <button type="button" class="btn-close float-end" aria-label="Close"></button>
                                    <div class="row">
                                        <!-- <div class="col-4">
                                            <div class="rounded ">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(4).webp"
                                                    class="w-100" />
                                            </div>
                                        </div> -->

                                    
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="accent-text"><?php echo $current_order['name']  ?></h5>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-2 active-color">
                                                        <span class="price"><?php echo $current_order['price']   ?> EGY</span>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="wrapper col-6">
                                                <span class="minus">-</span>
                                                <span class="num"><?php echo $current_order['quantity']   ?></span>
                                                <span class="plus">+</span>
                                            </div>
                                            <div class="col-9 alert alert-danger">
                                                <span class="subtotal ">  </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <?php  }} ?>  
                  
                
            </div>
            <div class="bill-list d-flex flex-column  align-items-stretch justify-content-end">
                 <div class="input-group mb-3">
                    <span class="input-group-text active-cat border-0">Notes</span>
                    <textarea rows="2"  class="form-control accent-bg primary-text border-0"
                        aria-label="With textarea"></textarea>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text active-cat border-0" for="inputGroupSelect01">Room NO</label>
                    <input type="number" class="form-control" name="room_no">
                </div>
                
                <div class="d-flex justify-content-between px-3 mt-3">
                    <h4 class="primary-text">Total</h4>
                    <h4 class="primary-text">20 pt</h4>
                </div>
                <button class="btn btn-success col-12 mt-2" type="button">Confirm</button>

            </div>
        </article>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script>
        const plus = document.querySelector(".plus"),
            minus = document.querySelector(".minus"),
            num = document.querySelector(".num");
             console.log(num.innerText)
        let a = Number(num.innerText);
        plus.addEventListener("click", () => {
            a++;
            a = (a < 10) ? "0" + a : a;
            num.innerText = a;
        });

        minus.addEventListener("click", () => {
            if (a > 1) {
                a--;
                a = (a < 10) ? "0" + a : a;
                num.innerText = a;
            }
        });
        let subtotal = document.querySelector(".subtotal");
        let price = document.querySelector(".price");

        subtotal.innerText = a *  Number(price.innerText);


    </script>
</body>

</html>