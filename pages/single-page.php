<?php
use App\SinglePageView;
$view = new SinglePageView($parameters);
?>

<!doctype html>
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
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <h2>
                <a href=""><?=$view->getPost()->title?></a>
            </h2>
            <div class="single_post row">
                <div class="img col-12 col-md-9">
                    <img src="<?='/assets/images/posts/' . $view->getPost()->image ?>" alt="<?=$view->getPost()->title?>" class="image-single">
                </div>
                <div class="info">
                    <i class="fa-regular fa-user"> <span><?=$view->getPost()->username;?></span></i>
                    <i class="fa-regular fa-calendar"> <span><?=substr($view->getPost()->createdOn, 0, 10);?></span></i>
                </div>
                <div class="single_post_text post-text col-12">
                    <?=$view->getPost()->content;?>
                </div>
                <?php include_once '../app/include/comments.php' ?>
            </div>
        </div>
    </div>
</div>
<?php
include '../app/include/footer.php';
?>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

</body>
</html>