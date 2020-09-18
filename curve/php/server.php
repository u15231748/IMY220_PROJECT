<?php
    session_start();
    function createNewAccount($userObject){
        global $connection;
        $default = addslashes(file_get_contents("../images/profile/default.jpg"));

        if($userObject->pass1 == $userObject->pass2)
        {
            $newUser = $connection->query("INSERT INTO `users` (`name`, `surname`, `email`, `birthday`, `profile`) VALUES ('$userObject->fname', '$userObject->lname', '$userObject->mail', '$userObject->bday', '$default')");
            
            if($newUser)
            {
                $getID = $connection->query("SELECT * FROM `users` WHERE `email` = '$userObject->mail'");
                
                if($getID->num_rows > 0)
                {
                    $_SESSION["signed"] = true;
                    $user = $getID->fetch_assoc();
                    $pass = hashPassword($userObject->pass1);
                    $setLogin = $connection->query("INSERT INTO `login` (`username`, `password`, `user_id`) VALUES ('$userObject->mail', '$pass', '$user[user_id]')");
                }
            }
            else
                $_SESSION["signed"] = false;
        }
        else
            $_SESSION["signed"] = false;

        redirectBackToIndex();
    }

    function hashPassword($textPassword){
        return password_hash($textPassword, PASSWORD_BCRYPT, ["cost" => 12]);
    }

    function login($loginObject)
    {
        global $connection;
        $userLogin = $connection->query("SELECT * FROM `login` WHERE `username` = '$loginObject->log_user'");
        if($userLogin->num_rows == 1)
        {
            $user = $userLogin->fetch_assoc();
            if(password_verify($loginObject->log_pass, $user["password"]))
            {
                $_SESSION["logged_user"] = getUserDetails($user["username"]);
                unset($_SESSION["logged"]);
                redirectToHome();
            }
            else {
                $_SESSION["logged"] = false;
            }
        }
        else {
            $_SESSION["logged"] = false;
        }
    }

    function getUserDetails($userId)
    {
        global $connection;
        $loggedUser = array();
        $fetchDetails = $connection->query("SELECT * FROM `users` WHERE `email` = '$userId'");
        $details = $fetchDetails->fetch_assoc();
        return $details["user_id"];
    }

    function redirectBackToIndex(){
        // Remote server
        // header("Location: http://imy.up.ac.za/IMY220//u15231748/index.php");
        
        // Local Server
        header("Location: http://localhost/u15231748/index.php");
    }

    function redirectToHome(){
        // Remote Server
        // header("Location: http://imy.up.ac.za/IMY220/u15231748/curve/home.php");
        
        // Local Server
        header("Location: http://localhost/u15231748/curve/home.php");
    }

    function createNewPost($postObject, $images)
    {
        global $connection;
        $countfiles = count($images);
        $date = date("Y-m-d H:i:s", time());
        $newPost = $connection->query("INSERT INTO `posts` (`description`, `hashtags`, `user`, `post_datetime`) VALUES ('$postObject->textpost', '$postObject->hashtag', '$_SESSION[logged_user]', '$date')");
        if($newPost)
        {
            if($countfiles > 0)
            {
                $postId = getPostId($_SESSION["logged_user"]);
                $img = addslashes(file_get_contents($images));
                $saveImage = $connection->query("INSERT INTO `post_images` (`image`, `post`) VALUES ('$img', '$postId')");
            }
            redirectToHome();
        }
    }

    function getPostId($user)
    {
        global $connection;
        $getID = $connection->query("SELECT MAX(`post_id`) FROM `posts` WHERE `user` = '$user'");
        $postId = $getID->fetch_assoc();
        return $postId["MAX(`post_id`)"];
    }

    function globalActivity()
    {
        global $connection;
        $loadPosts = $connection->query("SELECT * FROM `posts`, `users`, `post_images` WHERE `users`.`user_id` = `posts`.`user` AND `posts`.`post_id` = `post_images`.`post` ORDER BY `posts`.`post_datetime` DESC");
        while ($post =  $loadPosts->fetch_assoc()) 
        {
            echo '<div class="card post">
                    <span class="card-header p-2">
                        <span>
                            <img src="data:image/*;base64,'.base64_encode($post["profile"]).'" class="rounded-circle" width="50" height="50">
                        </span>
                        <span>
                            <label>'.$post["name"].' '.$post["surname"].'</label>
                            <label><i class="fa fa-images mr-1"></i>My Story</label>
                        </span>
                        <span>
                            <label>Today</label>
                            <i class="fas fa-caret-square-down"></i>
                        </span>
                    </span>
                    <span class="card-body p-0">
                        <div class="postText">
                            '.$post["description"].'
                        </div>
                        <div class="postHashTag">
                            <a href="#">'.$post["hashtags"].'</a>
                        </div>
                        <div class="postMedia">
                            <img src="data:image/*;base64,'.base64_encode($post["image"]).'">
                        </div>
                    </span>
                    <span class="card-footer p-1">
                        <img src="./images/display/img17.jpg" class="rounded-circle"/>
                        <img src="./images/display/img13.jpg" class="rounded-circle"/>
                        <img src="./images/display/img18.jpg" class="rounded-circle"/>
                        <label><a href="#">Commented</a> on your post</label>
                        <span class="post_reactions">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-comment"></i>
                        </span>
                    </span>
                </div>';
        }
    }
?>