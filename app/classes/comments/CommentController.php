<?php
namespace App;
use PDO;

class CommentController {

    public function validation($text) {
        if(empty($text) || $text == '') {
            ErrorHandler::add('empty_fields');
            return false;
        }
        return true;
    }
    public function add($userID, $postID, $text) {
        if(!self::validation($text)) {
            return;
        }
        $stmt = Connection::getInstance()->prepare("INSERT INTO post_comment (user_id, post_id, text) VALUES(?,?,?)");
        $stmt->execute(array($userID, $postID, $text));
        header('Location:' . $postID);
    }
    public function getCommentsByPostID($id) {
        $result = [];
        $stmt = Connection::getInstance()->prepare("SELECT pc.id, pc.text, pc.post_id, pc.created_on, pc.is_modified, pc.modified_on, u.id AS uid, u.login AS uname FROM post_comment pc INNER JOIN user u ON u.id = pc.user_id WHERE post_id=? ORDER BY created_on DESC");
        $stmt->execute(array($id));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                array_push($result, $this->getCommentByRow($row));
            }
            return $result;
        }
    public function getCommentByID($id) {
        $stmt = Connection::getInstance()->prepare("SELECT * FROM post_comment WHERE id=?");
        $stmt->execute(array($id));
        return $this->getCommentByRow($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function edit($text, $modifiedOn, $id) {
        if(!self::validation($text)) {
            return;
        }
        $stmt = Connection::getInstance()->prepare("UPDATE post_comment SET text=?, modified_on=?, is_modified=1 WHERE id=?");
        $stmt->execute(array($text, $modifiedOn, $id));
    }
    public function delete($id) {
        $stmt = Connection::getInstance()->prepare("DELETE FROM post_comment WHERE id=?");
        $stmt->execute(array($id));
    }
    private function getCommentByRow($row) {
        $comment = new Comment();
        !empty($row['id']) ? $comment->id = $row['id'] : '';
        !empty($row['text']) ? $comment->text  = $row['text'] : '';
        !empty($row['uid']) ? $comment->userID = $row['uid'] : '';
        !empty($row['post_id']) ? $comment->postID = $row['post_id'] : '';
        !empty($row['created_on']) ? $comment->createdOn = $row['created_on'] : '';
        !empty($row['is_modified']) ? $comment->isModified = $row['is_modified'] : '';
        !empty($row['modified_on']) ? $comment->modifiedOn = $row['modified_on'] : '';
        !empty($row['uname']) ? $comment->username = $row['uname'] : '';
        !empty($row['id']) ? $comment->id = $row['id'] : '';
        return $comment;
    }
}