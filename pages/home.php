<?php
use App\MainPageView;
session_start();
$view = new MainPageView($parameters);
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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
<div class="modal" id="modal">test</div>
<div id="overlay">
    <a href="" id="close">X</a>
    <p>Logged in successfully</p>
</div>
<a href="" id="open"></a>
<div class="container">
    <div class="row">
        <h2 class="text-center py-2">Trending posts</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($view->getTrendingPosts() as $post): ?>
            <?php if ($post->trending == 1): ?>
            <div class="carousel-item active">
                <img src="<?='assets/images/posts/' . $post->image ?>" class="trending-image d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h5><a href="<?='page/' . $post->id?>"><?=$post->title;?></a></h5>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach;?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <h2>Latest posts</h2>
            <?php foreach ($view->getPaginatedPosts() as $post): ?>
            <div class="post_main row" id="post">
                <div class="img col-12 col-md-4">
                    <img src="<?='assets/images/posts/' . $post->image ?>" alt="<?=$post->title?>" class="img-thumbnail">
                </div>
                <div class="post-text col-12 col-md-8">
                    <h3>
                        <a href="<?='page/' . $post->id?>"><?=$post->title?></a>
                    </h3>
                    <i class="fa-regular fa-user"> <span><?=$post->username;?></span></i>
                    <i class="fa-regular fa-calendar"> <span><?=substr($post->createdOn, 0, 10);?></span></i>
                    <p class="preview-text">
                        <?=substr($post->content, 0, 100) . '...';?>
                    </p>
                </div>
            </div>
            <?php endforeach;?>
            <?php if(empty($view->getPaginatedPosts())):?>
               <h3 class="mt-5">No posts yet</h3>
            <?php else :
            include '../app/include/pagination.php';
                endif;?>

        </div>
        <div class="sidebar_main search col-md-3 col-12">
            <div class="section topics">
                <h3>Topics</h3>
                <ul>
                    <?php foreach ($view->getTopics() as $key => $topic): ?>
                        <li><a href="<?='category/' .$topic->id;?>"><?=$topic->name;?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include '../app/include/footer.php';
include '../app/include/popup.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
</body>
</html>