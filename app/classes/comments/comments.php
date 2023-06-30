<?php
session_start();
include_once "comment-controller.class.php";
include_once __DIR__ . '/../connection.class.php';
include_once __DIR__ . '/../../include/image.php';
include_once __DIR__ . '/../error-controller.class.php';

class CommentsView {
    public $commentController;
    public $comments;
    public $comment;
    public $id;


    public function getComments() {
        if(empty($this->comments)) {
            $this->comments = $this->commentController->getCommentsByPostID($this->id);
        }
        return $this->comments;
    }
    public function __construct() {
        $this->commentController = new CommentController();
        $this->initialize();
    }
    private function initialize() {
        $this->id = $_GET['id'];
        if(isset($_POST['add_comment'])) {
            $this->commentController->add($_SESSION['user_id'], $_GET['id'], $_POST['text'] );
        }
        if(isset($_GET['edit_id'])) {
            $this->comment = $this->commentController->getCommentByID($_GET['edit_id']);
        }
        if(isset($_POST['edit_comment'])) {
            $modifiedOn = date("Y-m-d H:i:s");
            $this->commentController->edit($_POST['text'], $modifiedOn, $_POST['comment_id']);
        }
        if(isset($_GET['delete_id'])) {
            $this->commentController->delete($_GET['delete_id']);
            $page = $_GET['page_id'];
            header("Location: ../../single-page.php?id=$page");
        }
    }
}


