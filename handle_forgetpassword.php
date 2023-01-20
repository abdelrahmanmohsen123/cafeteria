<?php

session_start();
include_once 'database.php';
    if(isset($_POST)){
        $email = $_POST['email'];
        $new_password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        /////select form db
            $query = 'SELECT * FROM USERS WHERE email = ?'  ;          
            $sql = $conn->prepare($query);
            $result  = $sql->execute([$email]);
            
            $user = $sql->fetch();

            if(!$user){
                $_SESSION['error_not_email'] = 'enter email ,plz try again ';
                header('location:forget_password.php');
            }


            if($new_password == $confirm_password && !empty($email) && !empty($new_password && $user)){
                $query = "UPDATE  users SET `password` = ?  WHERE `email` = ?";

                $updated =  $conn->prepare($query)->execute([$new_password,$email]);
    
                if($updated){
    
                    $_SESSION['updated_password'] = 'Success reset password';;
                    header('location:index.php');
    
    
                }else{
                    echo 'hello';
                }
            }else{
                $_SESSION['error_forgetpassword'] = 'enter valid password ,plz try again';
                header('location:forget_password.php');
            }
            

        

    }


?>