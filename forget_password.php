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
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="handle_forgetpassword.php" method="post">
                    <div class="card p-3 w-50 mx-auto my-5">
                        <div class="mb-3 row text-center ">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                            <input type="text"  class="form-control" name="email" placeholder="Enter your email" id="staticEmail" >
                            </div>
                        </div>
                        
                        <!-- error_not_email -->
                        <?php
                            if(isset($_SESSION['error_not_email'])){ ?>

                            <div class="alert alert-danger w-100 text-center m-auto mb-2">
                                <span>
                                    <?php echo $_SESSION['error_not_email']; ?>
                                </span>
                            </div>
                                
                            <?php session_unset();   } ?>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                            <input type="password" name="password"  class="form-control" id="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Confirm New Password</label>
                            <div class="col-sm-8">
                            <input type="password" name="confirm_password" class="form-control" id="">
                            </div>
                        </div>
                         <!-- reset password -->
                            <?php
                            if(isset($_SESSION['error_forgetpassword'])){ ?>

                            <div class="alert alert-danger w-100 text-center m-auto">
                                <span>
                                    <?php echo $_SESSION['error_forgetpassword']; ?>
                                </span>
                            </div>
                                
                            <?php session_unset();   } ?>

                        <div class="mx-auto my-5">
                            <button class="btn btn-primary" name="confirm" type="submit">Confirm  </button>
                            <a class="btn btn-secondary" href="login.php"  type="submit">back  </a>

                        </div>
                        
                    </div>
                </form>
                 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>