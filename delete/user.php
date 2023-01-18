<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    include_once '../database.php';
    $query = 'SELECT * FROM users WHERE id = ?'  ;          
    $sql = $conn->prepare($query);
    $result  = $sql->execute([$id]);
    
    $user = $sql->fetch();

    $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
    unlink($rootDir .'/'.  $user->image);
    $count =  $conn->prepare("DELETE from users where id = ?")->execute([$id]);
    if($count){
        
        $_SESSION['deleted']['user'] = " user deleted successfully";
        header('location:../all_users.php');
    }
}   
?>