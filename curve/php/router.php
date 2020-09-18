<?php
    include_once './server.php';
    include_once './config.php';

    switch ($_POST) 
    {
        case isset($_POST["login"]):
            login(json_decode(json_encode($_POST)));
            break;

        case isset($_POST["register"]):
            createNewAccount(json_decode(json_encode($_POST)));
            break;

        case isset($_FILES["file"]):
            createNewPost(json_decode(json_encode($_POST)), $_FILES["file"]["tmp_name"]);
            break;

        default:
            # code...
            break;
    }
?>