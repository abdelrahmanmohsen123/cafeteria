<?php 
session_start();
if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    include_once '../database.php';
   

    // $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
    // unlink($rootDir .'/'.  $product->image);
    $count =  $conn->prepare("DELETE from current_order where id = ?")->execute([$id]);
    if($count){
        
        $_SESSION['deleted']['item'] = "item deleted successfully";
        header('location:../homepage.php');
    }
}   
?>