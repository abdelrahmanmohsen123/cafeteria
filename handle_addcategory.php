<?php

var_dump($_POST);

?><?php

session_start();
include_once 'database.php';
    if(isset($_POST)){
        $name = $_POST['name'];

        $query = 'SELECT * FROM category WHERE name = ?'  ;          
        $sql = $conn->prepare($query);
        $result  = $sql->execute([$name]);
        
        $user = $sql->fetch();

        if(!$user){

            if(!empty($name)){
                $query = "INSERT INTO  category (`name`) VALUES (?)  ";
    
                $inserted =  $conn->prepare($query)->execute([$name]);
    
                if($inserted){
    
                        $_SESSION['inserted_category'] = 'Success inserted category';;
                        header('location:add_product.php');
    
                }else{
                    $_SESSION['error_insertcategory'][0] = 'not added category ,plz try again';
                    header('location:add_category.php');
                }
            }
            else{
                $_SESSION['error_insertcategory'][1] = 'you cant add empty category ,plz try again';
                header('location:add_category.php');
            }


        }else{
            $_SESSION['error_insertcategory'][2] = 'this category already exist';
            header('location:add_category.php');
        }


        
              
            

        

    }


?>