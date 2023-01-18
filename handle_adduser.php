<?php

session_start();
include_once 'database.php';
    if(isset($_POST)){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $ext = $_POST['ext'];
        $room_no = $_POST['room_no'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $_SESSION['errors']['user'] =[];
        
        var_dump($_POST);


        $errors =0;

        ///image 
       
        if (isset($_FILES["image"])) {

            
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
            
            // Get image file extension
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            
            // Validate file input to check if is not empty
            if (! file_exists($_FILES["image"]["tmp_name"])) {
                $_SESSION['errors']['user'][0] = "choose an image plz";
                

                $errors = 1;
                

            }    
            // Validate file input to check if is with valid extension
            if (! in_array($file_extension, $allowed_image_extension)) {
                $_SESSION['errors']['user'][1] = "image must be png or jpg or jpeg";
                $errors = 1;
                


            } 
            if($password != $confirm_password ){
                $_SESSION['errors']['user'][7] = "not confirm password,  try again";
                // header('location:add_user.php');
                $errors=1;
    
            }  
  

            
            $target =  "images_users/" . time() .'.' . $file_extension;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
                $errors = 0;
                $image = $target;
            
            }
            
            
        }else{
            $_SESSION['errors']['user'][2] = "choose  an image plzzz";
            $errors = 1;
        }

        
        

      
            if( !empty($name) && !empty($email) && !empty($ext) && !empty($room_no) && !empty($password)  && $errors ==0){
                
                $query = "INSERT INTO  users (`username`,`email`,`ext`,`room_no`,`password`,`image`) VALUES (?,?,?,?,?,?)  ";
    
                $inserted =  $conn->prepare($query)->execute([$name,$email,$ext ,$room_no ,$password ,$image]);
    
                if($inserted){
    
                        $_SESSION['inserted_user'] = 'Success inserted user';;
                        header('location:all_users.php');
    
                }else{
                    $_SESSION['errors']['user'][3] = 'not added user ,plz try again';
                    header('location:add_user.php');
                }
            }
            else{
                $_SESSION['errors']['user'][4] = 'all fields are required ,plz try again';
                header('location:add_user.php');
            }
        
           


        // }else{
        //     $_SESSION['error_insertcategory'][2] = 'this category already exist';
        //     header('location:add_category.php');
        // }


        
              
            

        

    }


?>