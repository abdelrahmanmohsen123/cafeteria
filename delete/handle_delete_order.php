<?php 
session_start();
if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    include_once '../database.php';
   

    // $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
    // unlink($rootDir .'/'.  $product->image);
    $count =  $conn->prepare("DELETE from orders where id = ?")->execute([$id]);
    if($count){
        
        $_SESSION['deleted']['order'] = "order cancelled ";
        header('location:../user_orders.php');
    }
}   
?>