<?php

session_start();
include_once 'database.php';
    if(isset($_POST)){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $errors =0;
        $image=0;

        ///image 
        $_SESSION['errors']['image'] =[];
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
                $_SESSION['errors']['product'][0] = "choose an image plz";
                $errors = 1;
                

            }    
            // Validate file input to check if is with valid extension
            else if (! in_array($file_extension, $allowed_image_extension)) {
                $_SESSION['errors']['product'][1] = "image must be png or jpg or jpeg";
                $errors = 1;

            }   
  

            
            $target =  "images/" . time() .'.' . $file_extension;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
                $errors = 0;
                $image = $target;
            
            }
            
        }else{
            $_SESSION['errors']['image']['choose'] = "choose an image plz";
            header('location:add_product.php');
            $errors = 1;
        }

        if(empty($_FILES['image'])){
            header('location:add_product.php');
            $errors = 1;
        }



            if(!empty($name) && !empty($price) && !empty($category) && $errors ==0  ){
                $query = "INSERT INTO  products (`name`,`price`,`category_id`,`image`) VALUES (?,?,?,?)  ";
    
                $inserted =  $conn->prepare($query)->execute([$name,$price,$category,$image]);
    
                if($inserted){
    
                        $_SESSION['inserted_product'] = 'Success inserted product';;
                        header('location:all_products.php');
    
                }else{
                    $_SESSION['errors']['product'][3] = 'not added product ,plz try again';
                    header('location:add_product.php');
                }
            }
            else{
                $_SESSION['errors']['product'][4] = 'you cant add empty field ,plz try again';
                header('location:add_product.php');
            }


        // }else{
        //     $_SESSION['error_insertcategory'][2] = 'this category already exist';
        //     header('location:add_category.php');
        // }


        
              
            

        

    }


?>