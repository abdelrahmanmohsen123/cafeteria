<?php

session_start();
include_once 'database.php';
    if(isset($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];
            $query = 'SELECT * FROM USERS WHERE email = ? AND password = ?'  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute([$email,$password]);
            
            $user = $sql->fetch();

            if($user){
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('location:homepage.php');


            }else{
                $_SESSION['error_login'] = 'not aauthencable';
                header('location:login.php');
            }
            // $query = `Update  users set id=$id ,first_name =$first_name ,last_name=$last_name , phone = $phone 
            
            //         department = $department,salary=$salary ,joining_data =$date WHERE id =$id`;
    
        

    }


?>