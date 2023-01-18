<?php
    session_start();
    include_once 'database.php';
    if(isset($_GET)){

            $query = 'SELECT * FROM users'  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute();
            
            $users = $sql->fetchAll();

            // if(empty($categories)){
            //     $_SESSION['email'] = $email;
            //     header('location:homepage.php');
            // }else{
            //     $_SESSION['error_login'] = 'not aauthencable';
            //     header('location:login.php');
            // }
            // $query = `Update  users set id=$id ,first_name =$first_name ,last_name=$last_name , phone = $phone 
            
            //         department = $department,salary=$salary ,joining_data =$date WHERE id =$id`;
    
        

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
                <a class="nav-link active border-end" aria-current="page" href="#">Home</a>
                </li>
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
               
               
            </ul>
                <div class="d-flex">
                    <img src="images/proxy.jpg" class="rounded" style="width: 50px;" alt="">
                    <p  class="mx-3">Admin</p>
                </div>
            </div>
        </div>
    </nav>

    </div>
    <div class="container">
        <div class="row my-3">
            <div class="col-8 ">
                <h2>All users</h2>
            </div>
            <div class="col-4 ">
                <a href="add_user.php" class="btn btn-primary">Add user</a>
            </div>
            <?php  if(isset($_SESSION['inserted_user'])){?>
                                                <span class="alert alert-success">
                                                    <?php  echo $_SESSION['inserted_user']; 
                                                    unset($_SESSION['inserted_user'])
                                                    ?>
                                                    
                                                </span>
                                                
                                            <?php }  ?>
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th> name</th>
                            <th> email</th>

                            <th>room num</th>
                            <th>Ext</th>

                            <th>image</th>
                            <th>action</th>
                            <!-- <th>created_at</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(isset($users)  && !empty($users)){
                            foreach ($users as $user) { ?>
                                
                                    <tr>
                                        <td>
                                                <?php  echo $user['id'] ?>
                                        </td>

                                        <td>
                                        <?php  echo $user['username'] ?>

                                        </td>
                                        <td>
                                        <?php  echo $user['email'] ?> 

                                        </td>
                                        <td>
                                        <?php  echo $user['room_no'] ?> 

                                        </td>
                                        <td>
                                        <?php  echo $user['ext'] ?> 

                                        </td>
                                    
                                        <td>
                                            <img class="" style="width: 100px;height=100px" src="<?php echo $user['image']  ?>" alt="">
                                        

                                        </td>
                                        
                                        <td>
                                            <a href="edit.php?id=<?php echo $user['id'] ?>">Update</a>
                                            <a href="./delete/user.php?id=<?php echo $user['id'] ?>">delete</a>

                                        </td>
                                        
                                    </tr>
                                    <?php  if(isset($_SESSION['deleted']['user'])){?>
                                                <span class="alert alert-danger">
                                                    <?php  echo $_SESSION['user']; 
                                                    unset($_SESSION['user']);
                                                    ?>
                                                    
                                                </span>
                                                
                                            <?php }  ?>
                            
                        
                        <?php }
                        }  ?> 
                    </tbody>
                </table>
        </div>
    </div>
</body>
<script src="./lab.js"></script>

</html>