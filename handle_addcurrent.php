<?php

session_start();
include_once 'database.php';
    if(isset($_GET)){
        $id = $_GET['id'];
       
            $query = 'SELECT * FROM products WHERE id = ?'  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute([$id]);
            
            $product = $sql->fetch();
            
            $query2 = 'SELECT * FROM current_order WHERE name = ?'  ;          
            $sql2 = $conn->prepare($query2);
            $result2  = $sql2->execute([$product['name']]);
            
            $curent_order = $sql2->fetch();
            // die($curent_order['name']);
            if(!$curent_order){
                
                    $query4 = "INSERT INTO  current_order (`name`,`price`,`quantity`) VALUES (?,?,?)  ";
                    $inserted =  $conn->prepare($query4)->execute([$product['name'],$product['price'],1]);
        
                    if($inserted){
        
                            header('location:homepage.php');
        
                    }
                
            }else{
                if($product['name'] == $curent_order['name'] ){
                    
                    $_SESSION['add_product'] = 'Already added !';
                    header('location:homepage.php');
                    
    
    
                }
            }



           
            // $query = `Update  users set id=$id ,first_name =$first_name ,last_name=$last_name , phone = $phone 
            
            //         department = $department,salary=$salary ,joining_data =$date WHERE id =$id`;
    
        

    }


?>