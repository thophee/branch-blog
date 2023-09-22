<?php
use App\AdminUsersView;
$view = new AdminUsersView($parameters);
?>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="theme-color" content="#000">

    <meta name="description" content="Description"/>
    <meta name="robots" content="index,follow">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d525a51c3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Patua+One&display=swap" rel="stylesheet">


    <title>My Blog</title>
</head>
<body>

<?php
include '../app/include/header.php';
?>

<div class="container">
    <div class="row">
        <div class="sidebar col-3">
            <ul>
                <li>
                    <a href="/admin-panel">Posts</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="/users">Users</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="/topics">Categories</a>
                </li>
            </ul>
        </div>
        <div class="posts col-9">
            <div class="button  row">
                <a href="/create-user" class="col-2 btn btn-primary">Create</a>
                <span class="col-1"></span>
                <a href="/users" class="col-2 btn btn-success">Manage</a>
            </div>
            <div class="row title-table">
                <h2>Users</h2>
                <div class="col-1">ID</div>
                <div class="col-5">Login</div>
                <div class="col-2">Role</div>
                <div class="col-4">Control</div>
            </div>
            <?php foreach ($view->getUsers() as $user): ?>
            <div class="row post">
                <div class="id col-1"><?=$user->id;?></div>
                <div class="login col-5"><?=$user->login;?></div>
                <?php if($user->admin == 1): ?>
                <div class="author col-2">Admin</div>
                <?php else: ?>
                <div class="author col-2">User</div>
                <?php endif; ?>
                <div class="edit col-2"><a href="edit-user/<?=$user->id;?>">edit</a></div>
                <div class="delete col-2"><a href="delete-user/<?=$user->id;?>/delete">delete</a></div>
            </div>
                <?php endforeach;?>
        </div>
    </div>
</div>
<a href=""></a>
<?php
include '../app/include/footer.php';
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

</body>
</html>