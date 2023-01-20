<?php 

if(isset($_GET['id'])){
    session_start();
    include_once 'database.php';
    $id = $_GET['id'];


    $query = "SELECT * FROM products WHERE category_id = $id"  ;          
    $sql = $conn->prepare($query);
    $result  = $sql->execute();
    
    $categories = $sql->fetchAll();

    if($categories){
        
        $_SESSION['category_products'] = $categories;
        header('location:homepage.php');


    }else{
        $_SESSION['empty_category_products'] = $categories;
        header('location:homepage.php');
    }
}
?>