<nav class="navbar">
    <span class="col-4 p-0">
        <img src="./images/logo/curve__.png">
    </span>
    <span class="col-4 p-0">
        <input type="search" class="form-control" name="findPost" placeholder="Search for a post...">
    </span>
    <span class="col-4 p-0">
        <div>
            <img <?php 
                    $profile = $connection->query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[logged_user]'");
                    $user = $profile->fetch_assoc();
                    $img = "data:image/*;base64,".base64_encode($user["profile"]);
                    echo "src='$img'";
                ?> width="43" height="43" class="rounded-circle">
            <a class="fa fa-power-off" href="http://imy.up.ac.za/IMY220//u15231748/index.php"></a>
        </div>
    </span>
</nav>