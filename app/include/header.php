<?php
use App\UserController;
$userController = new UserController();
?>
<header class="container-fluid text-white">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1 class="text-white mt-2">
                    <a href="<?='/' ?>">My Blog</a>
                </h1>
            </div>
            <nav class="col-8">

                <ul class="d-flex justify-content-end">
                    <?php if($_SESSION['user_login'] != null): ?>
                    <li><a href="<?='/' ?>">Home</a></li>
                     <?php if(!$_SESSION['admin'] && $_SESSION['user_login']): ?>
                            <li> <a href="<?='/profile'?>">Profile</a></li>
                    <?php else: { ?>
                         <li><a href="<?='/admin-panel'?>">Admin panel</a></li>
                    <?php } endif; ?>
                    <?php endif; ?>
                    <?php if($_SESSION['isLoggedIn']): ?>
                    <li><a href="<?='/logout' ?>">Log out</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
    </div>
</header>