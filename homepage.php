<?php
    session_start();
    $amount=0;
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
            //product 
            $query = 'SELECT * FROM products'  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute();
            
            $products = $sql->fetchAll();

            if(isset($_SESSION['products'])){
                $products=$_SESSION['products'];
                unset($_SESSION['products']);
            }
            if(isset($_SESSION['category_products'])){
                $products=$_SESSION['category_products'];
                unset($_SESSION['category_products']);
            }
            if(isset($_SESSION['empty_category_products'])){
                $products=$_SESSION['empty_category_products'];
                unset($_SESSION['empty_category_products']);
            }

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


            //users
            $query4 = 'SELECT * FROM users where is_admin =0'  ;          
            $sql4 = $conn->prepare($query4);
            $result4  = $sql4->execute();
            
            $users = $sql4->fetchAll();



    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
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
                    <a class="nav-link border-end" href="admin_orders.php">Checks</a>
                </li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link border-end" href="user_orders.php">My Orders</a>
                    </li>
                <?php }?>    
               
               
            </ul>

                <div class="d-flex align-self-center ">

                      
                        <form action="handle_search.php" method="post" class="d-flex" role="search w-100">
                            <input class="form-control me-2  text-dark border-0 " name="search"  type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-success me-3" name="search_button" type="submit">Search</button>
                        </form>
 

                
                    <p  class="mx-3 align-self-center"><?php echo $username;  ?></p>
                    <img src="<?php  echo $user['image'] ?>" class="rounded" style="width: 50px;" alt="">
     
                    <p class="mx-1 ">
                        <a class="btn btn-secondary mx-1 " href="logout.php">logout</a>
                    </p>

                      
                </div>
            </div>
        </div>
    </nav>
    <section class="d-flex">
        <article class="col-6 col-md-7 col-lg-8 col-xl-9 px-5 py-3 overflow-y-auto">
            <nav class="nav nav-pills flex-column flex-sm-row ">
                <a class="flex-sm-fill text-sm-center nav-link text-white-50 active-cat" aria-current="page"
                    href="homepage.php">All products</a>
                    
                    <?php 
                    if(!empty($categories)){
                        foreach ($categories as $category) {?>
                <a class="flex-sm-fill text-sm-center nav-link text-white-50" href="handle_category_products.php?id=<?php echo $category['id']  ?>"><?php echo $category['name']  ?></a>
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
                <?php }unset($_SESSION['add_product']); ?>       
            <div class="row row-cols-auto py-3">
                <?php 
                    if(!empty($products)){
                        foreach ($products as $product) {?>
                       
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-2 product-card " <?php  if(isset($_SESSION['add_product'])){ ?> data-bs-toggle="tooltip"   data-bs-placement="bottom" data-bs-title="<?php echo $_SESSION['add_product']; ?>" <?php } unset($_SESSION['add_product']) ?>>
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
        <?php
                if(isset( $_SESSION['try again'])){?>
                <div class="alert alert-success my-2">
                    <span><?php echo  $_SESSION['try again']; ?></span>

                </div>
            <?php } unset( $_SESSION['try again'])?>
            <h3 class="primary-text">Current Order</h3>
            <?php
                if(isset($_SESSION['deleted']['item'])){?>
                <div class="alert alert-success my-2">
                    <span><?php echo $_SESSION['deleted']['item']; ?></span>

                </div>
            <?php } unset($_SESSION['deleted']['item'])?>
           
            <div class="order-list ">
                 <!-- ///current_orders -->
                 <?php if(!empty($current_orders)){

                    foreach ($current_orders as $current_order) { ?>
                       <div class="row mb-1 order-card">
                            <div class="card border-0 rounded-3 accent-bg">
                                <div class="card-body">
                                    <a type="button" href="delete/handle_deleteitem.php?id=<?php echo $current_order['id']   ?>" class="btn-close float-end" aria-label="Close"></a>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="accent-text"><?php echo $current_order['name']  ?></h5>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-2 text-light">
                                                        <span class="price"><?php echo $current_order['price']   ?> </span>EGY
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="wrapper col-12">
                                                <span class="minus">-</span>
                                                <span class="num"><?php echo $current_order['quantity']   ?></span>
                                                <span class="plus">+</span>
                                                
                                                <span  class="subtotal   ms-5 text-light">  </span>
                                            </div>
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <?php  }} ?>  
                  
                
            </div>
            <form action="handle_allorders.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $id  ?>">
                <div class="bill-list d-flex flex-column  align-items-stretch justify-content-end">
                    <div class="input-group mb-3">
                        <span class="input-group-text active-cat border-0">Notes</span>
                        <textarea rows="2" name="notes"  class="form-control accent-bg primary-text border-0"
                            aria-label="With textarea"></textarea>
                    </div>
                    <div class="input-group mb-3 row">
                        <div class="<?php if($admin==0){ ?> col-12 <?php }else{?> col-6 <?php } ?>">
                            <label class="input-group-text active-cat border-0" for="inputGroupSelect01">Room NO</label>
                            <input type="number" class="form-control" name="room_no">
                        </div>
                        <?php if($admin ==1){  ?>
                            <div class="col-6">
                                <label class="input-group-text active-cat border-0" for="inputGroupSelect01">User</label>
                                <select class="form-select  text-dark border-0 " name="user_id_2"  id="inputGroupSelect01 " >
                                    <option selected disabled>Choose...</option>
                                    <?php if(!empty($users)){ 
                                        foreach ($users as $user) { ?>
                                            <option value="<?php echo $user['id'] ?>"><?php echo $user['username']  ?></option>
                                        
                                        <?php }}  ?>
                                    
                                    
                                </select>
                            </div>
                        <?php } ?>
                       
                    </div>
                    
                    <div class="d-flex justify-content-between px-3 mt-3">
                        <h4 class="primary-text">Total</h4>
                        <!-- <h4 class="primary-text total "></h4> -->
                        <input type="text" name="amount" class="total text-dark fw-bolder fs-xl w-50 text-center" readonly >

                        <span class="text-light">EGY</span> 
                    </div>
                    <button class="btn btn-success col-12 mt-2" type="submit">Confirm</button>

                </div>
            </form>
            
        </article>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
        <script src="js/jquery-3.5.1.js"></script>
    <script>
        
        let plus = document.querySelectorAll(".plus"),
            minus = document.querySelectorAll(".minus"),
            // total = 0,
            num = document.querySelectorAll(".num");
            let result =0;            
            //  console.log(total);
                  

        let subtotal = document.querySelectorAll(".subtotal");
        let total = 0;
        let price = document.querySelectorAll(".price");


        for (let index = 0; index < subtotal.length; index++) {
            
              
            subtotal[index].innerText = Number(num[index].innerText) *  Number(price[index].innerText); 
            total +=Number(subtotal[index].innerText);  
            console.log(total+ "sfwefewf")
           result +=Number(subtotal[index].innerText);
            //   console.log(result);
            // console.log(Number(price[index].innerText)+"hi" ); 
            let a = Number(num[index].innerText);
            plus[index].addEventListener("click", () => {
                // let finalval = Number(subtotal[index].innerText)
                a++;
                a = (a < 10) ? "0" + a : a;
                num[index].innerText = a;
                console.log(subtotal[index].innerText + "before");

                let oldvar = Number(subtotal[index].innerText);

                subtotal[index].innerText = Number(num[index].innerText) *  Number(price[index].innerText); 


                 let newVar  = Number(subtotal[index].innerText);
                console.log(subtotal[index].innerText + "after");
                // total += Number(subtotal[index].innerText);
                
                let newval = subtotal[index].innerText;
                let dev = newval - result;
                result += dev;                 
                console.log(result +"resul")

                // total
                subtotal = document.querySelectorAll(".subtotal");
                total = 0;
                for(let i=0; i<subtotal.length; i++){
                    total += Number(subtotal[i].innerText); 
                    console.log(subtotal[i].innerText)
                }
                document.querySelector(".total").value = total;


                
            });

            minus[index].addEventListener("click", () => {
                if (a > 1) {
                    a--;
                    a = (a < 10) ? "0" + a : a;
                    num[index].innerText = a;
                    subtotal[index].innerText = Number(num[index].innerText) *  Number(price[index].innerText);
                   
                    // total +=Number(subtotal[index].innerText);
                    
                    // document.querySelector(".total").innerText = total;

                    // total
                    subtotal = document.querySelectorAll(".subtotal");
                    total = 0;
                    for(let i=0; i<subtotal.length; i++){
                        total += Number(subtotal[i].innerText); 
                    }
                    document.querySelector(".total").value = total;
                }
            });

        }  

        // total
        total = 0;
        for(let i=0; i<subtotal.length; i++){
            total += Number(subtotal[i].innerText); 
            console.log(subtotal[i])
        }
        document.querySelector(".total").value = total;

    </script>
</body>

</html>