<?php 
session_start();
include_once 'database.php';
    if(isset($_POST)){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $ext = $_POST['ext'];
        $room_no = $_POST['room_no'];
        $_SESSION['errors_updated']['user'] =[];

         /////select form db
         $query = 'SELECT * FROM users WHERE id = ?'  ;          
         $sql = $conn->prepare($query);
         $result  = $sql->execute([$id]);
         
         $user = $sql->fetch();


         if (($_FILES["image"])) {

            
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
            
            // Get image file extension
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                
            // Validate file input to check if is with valid extension
            if (! in_array($file_extension, $allowed_image_extension)) {
                $_SESSION['updated_user_error'][0] = "image must be png or jpg or jpeg";
                $errors = 1;
            } 

            
            $target =  "images_users/" . time() .'.' . $file_extension;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
                $errors = 0;
                $image = $target;
            
            }
            
            
        }else{
            $image = $user['image'];
        }
         if(!empty($username) && !empty($email) && !empty($user) && !empty($ext) && !empty($room_no)){
            $query = "UPDATE  users SET `username` = ? ,`email` = ? ,`ext` = ? ,`room_no` = ? ,`image` = ?    WHERE `id` = ?";

            $updated =  $conn->prepare($query)->execute([$username,$email,$ext,$room_no,$image,$id]);

            if($updated){

                $_SESSION['updated_user'] = 'Success updated user';;
                header('location:all_users.php');


            }
        }else{
            $_SESSION['updated_user_error'][1] = 'enter valid data ,plz try again';
            header("location:edit_user.php?id=$id");
        }
    }

?>