<?php
include_once  __DIR__ .'/../classes/comments/comments.php';
include_once __DIR__ . '/../classes/error-controller.class.php';
$view = new CommentsView();
?>
<div class="col-md-12 col-12 comments">
    <h3>Leave a comment</h3>
    <form action="<?="../../single-page.php?id=$view->id"?>" method="post">
        <div class="mb-3">
            <textarea name="text" class="form-control" id="text" rows="3"></textarea>
        </div>
        <div class="col-12">
            <div class="text-danger mb-2">
                <?php
                    ErrorHandler::show('empty_fields')
                ?>
            </div>
            <button type="submit" name="add_comment" class="btn btn-primary">Add comment</button>
        </div>
    </form>
    <?php if(count($view->getComments()) > 0): ?>
        <div class="row all-comments mt-5">
            <h3 class="col-12 pb-5">Comments</h3>
            <?php foreach ($view->comments as $comment):?>
                <input type="hidden" name="page" value="<?=$comment->text;?>">
                <div class="col-12 single-comment">
                        <i class="fa-regular fa-user mt-2"> <span><?=$comment->username?></span></i>
                        <i class="fa-regular fa-calendar"> <span><?=substr($comment->modifiedOn,0,16)?></span></i>
                    <?php
                    ?>
                    <div class="buttons">
                        <?php if($_SESSION['admin']): ?>
                    <div class="edit col-2"><a href="app/include/edit.php?id=<?=$view->id?>&edit_id=<?=$comment->id;?>">edit</a></div>
                    <div class="delete col-2"><a href="app/include/comments.php?delete_id=<?=$comment->id;?>&page_id=<?=$view->id?>">delete</a></div>
                        <?php elseif(!$_SESSION['admin'] && $comment->userID == $_SESSION['user_id']): ?>
                        <div class="edit col-2"><a href="app/include/edit.php?id=<?=$view->id?>&edit_id=<?=$comment->id;?>">edit</a></div>
                        <div class="delete col-2"><a href="app/include/comments.php?delete_id=<?=$comment->id;?>&page_id=<?=$view->id?>">delete</a></div>
                        <?php endif;?>
                    </div>
                    <?php if($comment->isModified == 1): ?>
                    <div class="text-muted small">edited</div>
                    <?php endif; ?>
                    <form action=""></form>
                    <div class="col-12 text pt-2 mb-2">
                        <?=$comment->text?>
                    </div>
                </div>
    <?php endforeach; ?>
    </div>
    <?php endif;?>
</div>

