<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    include_once '../database.php';
    $query = 'SELECT * FROM products WHERE id = ?'  ;          
    $sql = $conn->prepare($query);
    $result  = $sql->execute([$id]);
    
    $product = $sql->fetch();

    $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
    unlink($rootDir .'/'.  $product->image);
    $count =  $conn->prepare("DELETE from products where id = ?")->execute([$id]);
    if($count){
        
        $_SESSION['deleted']['product'] = "Great ,product deleted successfully";
        header('location:../all_products.php');
    }
}   
?>