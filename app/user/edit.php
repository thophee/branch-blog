<?php
use App\ErrorHandler;
use App\UserPostView;
$view = new UserPostView($parameters);
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
        <div class="posts">
            <div class="button  row">
                <a href="/create-post-user" class="col-2 btn btn-primary">Create</a>
                <span class="col-1"></span>
            </div>
            <div class="row title-table">
                <h2>Edit article</h2>
            </div>
            <div class="row add-post">
                <form method="post" enctype="multipart/form-data">
                    <div class="text-danger mb-2">
                        <?php
                        foreach (['empty_fields', 'long_title', 'short_title'] as $error) {
                            ErrorHandler::show($error);
                        }
                        ?>
                    </div>
                    <input type="hidden" name="id" value="<?=$view->post->id;?>">
                    <div class="col mb-4">
                        <input value="<?=$view->post->title;?>" name="title" type="text" class="form-control" placeholder="Title" aria-label="Article name">
                    </div>
                    <div class="col mb-4">
                        <label for="editor" class="form-label">Article text</label>
                        <textarea name="content" id="editor" class="form-control" rows="6"><?=$view->post->content;?></textarea>
                    </div>
                    <div class="input-group col mb-4">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        <input name="img" type="file" class="form-control" id="inputGroupFile02">
                    </div>
                    <select name="topic" class="form-select mb-4" aria-label="Default select example">
                        <?php foreach ($view->getTopics() as $topic): ?>
                            <option value="<?=$topic->id;?>"><?=$topic->name;?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="col col-6 ">
                        <button name="edit_user_post" type="submit" class="btn btn-primary">Save post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<a href=""></a>

<?php
include '../app/include/footer.php';
?>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="/assets/js/script.js"></script>

</body>
</html>