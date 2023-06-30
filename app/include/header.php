<?php
include_once __DIR__ . '/../classes/users/user-controller.class.php';
include_once __DIR__ . '/../classes/users/user.php';
$userController = new UserController();
$_SERVER
?>
<header class="container-fluid text-white">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1 class="text-white mt-2">
                    <a href="<?='/index.php' ?>">My Blog</a>
                </h1>
            </div>
            <nav class="col-8">

                <ul class="d-flex justify-content-end">
                    <?php if($_SESSION['user_login'] != null): ?>
                    <li><a href="<?='/index.php' ?>">Home</a></li>
                     <?php if(!$_SESSION['admin'] && $_SESSION['user_login']): ?>
                            <li> <a href="<?='/app/user/user-profile.php'?>">Profile</a></li>
                    <?php else: { ?>
                         <li><a href="<?='/app/admin/posts/index.php'?>">Admin panel</a></li>
                    <?php } endif; ?>
                    <?php endif; ?>
                    <?php if($_SESSION['isLoggedIn']): ?>
                    <li><a href="<?='/logout.php' ?>">Log out</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
    </div>
</header>