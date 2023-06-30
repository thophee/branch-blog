<?php
include_once "user-posts.php";
include_once __DIR__ . '/../classes/connection.class.php';
include_once __DIR__ . '/../classes/posts/admin-post-controller.class.php';
class UserPostController
{
    private function validation($title, $content, $topic, $userID) {
        $isValid = true;
        if (empty($title) || empty($content) || empty($topic) || $topic == 'Choose category') {
            ErrorHandler::add('empty_fields');
            $isValid = false;
        }
        if (mb_strlen($title) < 6 && !empty($title)) {
            ErrorHandler::add('short_title');
            $isValid = false;
        }
        if (mb_strlen($title) > 100) {
            ErrorHandler::add('long_title');
            $isValid = false;
        }
        return $isValid;
    }

    public function add($title, $content, $image, $topic, $userID) {
        if (!self::validation($title, $content, $image, $topic, $userID)) {
            return;
        }
        $stmt = Connection::getInstance()->prepare("INSERT INTO post (title, content, img, topic_id, user_id) VALUES(?,?,?,?,?)");
        $stmt->execute(array($title, $content, $image, $topic, $userID));
        header("Location: user-profile.php");
    }

    public static function getPostsByUserID($id) {
        $result = [];
        $stmt = Connection::getInstance()->prepare('SELECT t1.title, t1.id, t1.published, t1.content, t2.login FROM post AS t1 JOIN user AS t2 ON t1.user_id = t2.id WHERE user_id=? ORDER BY created_on DESC;');
        if ($stmt->execute(array($id))) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                array_push($result, AdminPostController::getAdminPostByRow($row));
            }
        }
        return $result;
    }

    public function edit($title, $content, $topic, $image, $id) {
        if (!self::validation($title, $content, $image, $topic)) {
            return;
        }
        $post = AdminPostController::getPostByID($id);
        $queryText = 'UPDATE post SET ';
        $queryParams = [];
        if ($title !== $post->title) {
            $queryText .= 'title=?';
            array_push($queryParams, $title);
        }
        if ($content !== $post->content) {
            if (count($queryParams)) {
                $queryText .= ', ';
            }
            $queryText .= 'content=?';
            array_push($queryParams, $content);
        }
        if ($topic !== $post->topic) {
            if (count($queryParams)) {
                $queryText .= ', ';
            }
            $queryText .= 'topic_id=?';
            array_push($queryParams, $topic);
        }
        if ($image !== $post->image) {
            if (count($queryParams)) {
                $queryText .= ', ';
            }
            $queryText .= 'img=?';
            array_push($queryParams, $image);
        }
        if (count($queryParams)) {
            $queryText .= ' WHERE id=?';
            array_push($queryParams, $id);
            $stmt = Connection::getInstance()->prepare($queryText);
            $stmt->execute($queryParams);
        }
        header('Location: user-profile.php');
    }

    public function delete($id) {
        $stmt = Connection::getInstance()->prepare("DELETE FROM post WHERE id=?");
        $stmt->execute(array($id));
        header('Location: user-profile.php');
    }
}