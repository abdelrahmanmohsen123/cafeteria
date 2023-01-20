<?php 
session_start();
include_once 'database.php';
    if(isset($_POST['search'])){

        $search = $_POST['search'];


        $query = "SELECT * FROM products WHERE name like '%$search%'"  ;          
        $sql = $conn->prepare($query);
        $result  = $sql->execute();
        
        $products = $sql->fetchAll();

        if($products){
            
            $_SESSION['products'] = $products;
            header('location:homepage.php');

        }else{
            header('location:homepage.php');
        }
    }
    if(isset($_POST['search_orders'])){
        
        $search = $_POST['search_order'];


        $query = "SELECT * FROM orders WHERE status like '%$search%'"  ;          
        $sql = $conn->prepare($query);
        $result  = $sql->execute();
        
        $orders = $sql->fetchAll();

        if($orders){
            
            $_SESSION['orders'] = $orders;
            header('location:admin_orders.php');

        }else{
            header('location:admin_orders.php');
        }

        
    }
    if(isset($_POST['search_user'])){
        
        $search = $_POST['search_user'];


        $query = "SELECT * FROM users WHERE username like '%$search%'"  ;          
        $sql = $conn->prepare($query);
        $result  = $sql->execute();
        
        $users = $sql->fetchAll();

        if($users){
            
            $_SESSION['users'] = $users;
            header('location:all_users.php');

        }else{
            header('location:all_users.php');
        }

        
    }
    if(isset($_POST['search_product'])){
        
        $search = $_POST['search_product'];


        $query = "SELECT * FROM products WHERE name like '%$search%'"  ;          
        $sql = $conn->prepare($query);
        $result  = $sql->execute();
        
        $products = $sql->fetchAll();

        if($products){
            
            $_SESSION['products'] = $products;
            header('location:all_products.php');

        }else{
            header('location:all_products.php');
        }

        
    }
    
    
    

?>