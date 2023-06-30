<?php
include_once __DIR__ . '/app/classes/main-page/main-page.php';
$view = new MainPageView();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="theme-color" content="#000">

    <meta name="description" content="Description"/>
    <meta name="robots" content="index,follow">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d525a51c3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Patua+One&display=swap" rel="stylesheet">
    <title>My Blog</title>
</head>
<body>
<?php
include 'app/include/header.php';
?>
<div class="container category_container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <?php if (empty($view->getPostsByCategory())):?>
                <h2>No posts yet</h2>
            <?php else:?>
            <h2><?=$view->getTopicByID()->name?></h2>
            <?php foreach ($view->getPostsByCategory() as $post): ?>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="<?='assets/images/posts/' . $post->image ?>" alt="<?=$post->title?>" class="img-thumbnail">
                    </div>
                    <div class="post-text col-12 col-md-8">
                        <h3>
                            <a href="<?='single-page.php?id=' . $post->id?>"><?=$post->title?></a>
                        </h3>
                        <i class="fa-regular fa-user"> <span><?=$post->username;?></span></i>
                        <i class="fa-regular fa-calendar"> <span><?=substr($post->createdOn, 0, 10);?></span></i>
                        <p class="preview-text">
                            <?=substr($post->content, 0, 100) . '...';?>
                        </p>
                    </div>
                </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>

        <div class="sidebar_main search col-md-3 col-12">
            <div class="section topics">
                <h3>Topics</h3>
                <ul>
                    <?php foreach ($view->getTopics() as $key => $topic): ?>
                        <li><a href="<?='category.php?id=' .$topic->id;?>"><?=$topic->name;?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include 'app/include/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
</body>
</html>