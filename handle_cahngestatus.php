<?php

session_start();
include_once 'database.php';
    if(isset($_POST)){
        $change_status = $_POST['change_status'];
        $order_id = $_POST['order_id'];

        /////select form db
            $query = 'SELECT * FROM orders WHERE id = ?'  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute([$order_id]);
            
            $order = $sql->fetch();


            if($order){
                $query = "UPDATE  orders SET `status` = ?  WHERE `id` = ?";

                $updated =  $conn->prepare($query)->execute([$change_status,$order_id]);
    
                if($updated){
    
                    $_SESSION['updated_status'] = 'status changed success';;
                    header('location:admin_orders.php');
    
    
                }
            }else{
                echo "jello";
            }
            
            

        

    }


?>