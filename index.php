<!DOCTYPE html>
<html lang="en">
    <?php 
        session_start();
        include_once './curve/components/head/head.html'; 
    ?>
    <body>
        <?php 
            switch (isset($_SESSION)) 
            {
                case isset($_SESSION["signed"]):
                    if($_SESSION["signed"])
                    {
                        echo "<script>alert('Welcome to Curve')</script>";
                    }
                    else {
                        echo "<script>alert('Your account could not be registered, please check your details and try again.')</script>";
                    }
                    unset($_SESSION["signed"]);
                    break;
                
                case isset($_SESSION["logged"]):
                    echo "<script>alert('Invalid login details')</script>";
                    unset($_SESSION["logged"]);
                    break;

                default:
                    unset($_SESSION["logged_user"]);
                    break;
            }
        ?>
        <div class="fluid-container">
            <div class="row m-0 splashContainer">
                <div class="col-12 upperNav">
                    <span>
                        <img src="./curve/images/logo/curve1.png">
                    </span>
                    <span>
                        <form method="POST" enctype="multipart/form-data" action="./curve/php/router.php">
                            <input class="form-control" type="email" name="log_user" placeholder="Username">
                            <input class="form-control" type="password" name="log_pass" placeholder="Password">
                            <button class="btn btn-danger btn-sm" name="login">Login</button>
                        </form>
                    </span>
                </div>
                <div class="col-8">

                </div>
                <div class="col-4 p-0" id="registerFrm">
                    <form method="POST" class="card" enctype="multipart/form-data" action="./curve/php/router.php">
                        <div class="card-header">
                            <h3 class="text-center" class='text-center'>Create a Free Account</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="fname" placeholder="Joe" required>
                                </div>
                                <div class="col-lg-6">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lname" placeholder="Doe" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="mail" placeholder="joe_doe@example.com" required>
                                </div>
                                <div class="col-lg-6">
                                    <label>Birthday</label>
                                    <input type="date" class="form-control" name="bday">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="pass1" placeholder="*******" required>
                                </div>
                                <div class="col-lg-6">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="pass2" placeholder="*******" required>
                                </div>
                            </div>
                            <div class="row pl-3 pr-3">
                                <button type="submit" class="btn btn-success form-control" name="register">Create Account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>