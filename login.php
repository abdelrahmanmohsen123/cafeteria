<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>login</title>
</head>
<body>
    <div class="container">
        <div class="row text-center mt-5">
            <div class="col-12">
                <h2>Cafteria</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

            <!-- error login -->
            <?php
                if(isset($_SESSION['error_login'])){ ?>

                <div class="alert alert-danger w-50 text-center m-auto">
                    <span>
                        <?php echo $_SESSION['error_login']; ?>
                    </span>
                </div>
                    
                <?php session_unset();   } ?>


                <!-- reset password -->
                <?php
                if(isset($_SESSION['updated_password'])){ ?>

                <div class="alert alert-success w-50 text-center m-auto">
                    <span>
                        <?php echo $_SESSION['updated_password']; ?>
                    </span>
                </div>
                    
                <?php session_unset();   } ?>

                
                       
                <form action="handle_login.php" method="post">
                    <div class="card p-3 w-50 mx-auto my-3">
                        <div class="mb-3 row text-center ">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="email"  name="email" class="form-control" id="staticEmail" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="inputPassword">
                            </div>
                        </div>
                        <div class="mx-auto my-5">
                            <button class="btn btn-primary" name="login" type="submit">login</button>

                        </div>
                       
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="forget_password.php">forget password</a>
                            </div>
                        </div>
                    </div>
                </form>
                
                 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>