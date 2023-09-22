<?php
namespace App;
session_start();
class CommentsView {
    public RouteParameters $parameters;
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
    public function __construct(RouteParameters $parameters) {
        $this->parameters = $parameters;
        $this->commentController = new CommentController();
        $this->initialize();
    }
    private function initialize() {
        $this->id = $this->parameters->Uri[0];
        if(isset($_POST['add_comment'])) {
            $this->commentController->add($_SESSION['user_id'], $this->id, $_POST['text'] );
        }
        if(isset($this->parameters->Uri[1])) {
            $this->comment = $this->commentController->getCommentByID($this->parameters->Uri[1]);
        }
        if(isset($_POST['edit_comment'])) {
            $modifiedOn = date("Y-m-d H:i:s");
            $this->commentController->edit($_POST['text'], $modifiedOn, $_POST['comment_id']);
        }
        if($this->parameters->Uri[2] == 'delete') {
            $this->commentController->delete($this->parameters->Uri[1]);
            $page = $this->parameters->Uri[0];
            header("Location: ../../../page/$page");
        }
    }
}


