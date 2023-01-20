<?php
var_dump($_POST);
session_start();
include_once 'database.php';
    if(isset($_POST)){
        $user_id = $_POST['user_id'];
        if(isset($_POST['user_id_2'])){
            $user_id = $_POST['user_id_2'];
        }

        $room_no = $_POST['room_no'];
        $notes = $_POST['notes'];
        $amount = $_POST['amount'];
        $date = date("Y/m/d h:i:s");
        
            $query4 = "INSERT INTO  orders (`user_id`,`amount`,`status`,`date`,`product_quantity`,`room_no`,`ext`) VALUES (?,?,?,?,?,?,?)  ";
            $inserted =  $conn->prepare($query4)->execute([$user_id,$amount,0,$date,0,$room_no,0]);
            if(!$inserted){
                $_SESSION['try again'] = "try,again";
                header('location:homepage.php');
            }

            if($inserted && $_POST['user_id']==1){
                    $_SESSION['added_order'] = "the order has been added";
                    header('location:admin_orders.php');
            }else{
                $_SESSION['added_order'] = "the order has been added";
                header('location:user_orders.php');
            }
           

    }


?>