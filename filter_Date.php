<?php 

    if(isset($_POST['date_from'])){
        session_start();
        include_once 'database.php';
        $date_From = $_POST['date_from'];
        $date_to = $_POST['date_to'];

        if(!empty($date_From) && !empty($date_to)){
            $query = "SELECT * FROM orders WHERE date between '$date_From' and '$date_to'"  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute();
            
            $orders = $sql->fetchAll();
    
            if($orders){
                
                $_SESSION['filter_orders'] = $orders;
                header('location:all_orders.php');
    
            }
        }else{

            header('location:all_orders.php');
        }
       
    }

?>