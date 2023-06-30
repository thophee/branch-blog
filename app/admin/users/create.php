<?php
include '../../classes/users/admin-users.php';
$view = new AdminUsersView();
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
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Patua+One&display=swap" rel="stylesheet">


    <title>My Blog</title>
</head>
<body>

<?php
include '../../include/header.php';
?>

<div class="container">
    <div class="row">
        <div class="sidebar col-3">
            <ul>
                <li>
                    <a href="../posts/index.php">Posts</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="index.php">Users</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="../topics/index.php">Categories</a>
                </li>
            </ul>
        </div>
        <div class="posts col-9">
            <div class="button  row">
                <a href="create.php" class="col-2 btn btn-primary">Create</a>
                <span class="col-1"></span>
                <a href="index.php" class="col-2 btn btn-success">Manage</a>
            </div>
            <div class="row title-table">
                <h2>Create new user</h2>
            </div>
            <div class="error">
            </div>
            <div class="row add-post">
                <form action="create.php" method="post">
                    <div class="text-danger mb2">
                        <?php
                        foreach (['empty_fields', 'user_exists', 'password_not_match'] as $error) {
                            ErrorHandler::show($error);
                        }
                        ?>
                    </div>
                    <div class="col mb-2">
                        <label for="formGroupExampleInput" class="form-label">Login</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="login">
                    </div>
                    <div class="col mb-2">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="col mb-4">
                        <label for="exampleInputPassword1" class="form-label">Repeat password</label>
                        <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation">
                    </div>
                    <div class="form-check">
                        <input name="admin" value="1" class="form-check-input" type="checkbox" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Admin
                        </label>
                    </div>
                    <div class="col">
                        <button name="create_user" type="submit" class="btn btn-primary">Add user</button>
                    </div>
            </div>
        </div>
    </div>
</div>
<a href=""></a>

<?php
include '../../include/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

</body>
</html>