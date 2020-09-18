<!DOCTYPE html>
<html>
    <?php
        include_once './components/head/head.html';
        include_once './php/config.php';
        include_once './php/server.php';

        if(!isset($_SESSION["logged_user"]))
            redirectBackToIndex();
    ?>
    <body>
        <div class="fluid-container">
            <?php include_once './components/navigation/nav.php'; ?>
            <div class="row m-0 postContent">
                <div id="messages">
                    <h1 class="text-center">Under Construction</h1>
                </div>
                <div id="posts">
                    <?php
                        globalActivity();
                    ?>
                </div>
                <div id="albums">
                    <h1 class="text-center">Under Construction</h1>
                </div>
            </div>
        </div>
        <?php include_once './components/buttons/buttons.html'; ?>
        <?php include_once './components/post/new_post.php'; ?>
    </body>
    <?php include_once './components/footer/footer.html'; ?>
</html>