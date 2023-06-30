<?php
include "posts.class.php";
include_once __DIR__ . '/../connection.class.php';
class AdminPostController {
    private function validation($title, $content, $image, $topic, $userID, $trending, $published) {
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
    public function add($title, $content, $image, $topic, $userID, $trending, $published) {
        if(!self::validation($title, $content, $image, $topic, $userID, $trending, $published)) {
            return;
        }
        $stmt = Connection::getInstance()->prepare("INSERT INTO post (title, content, img, topic_id, user_id, trending, published) VALUES(?,?,?,?,?,?,?)");
        $stmt->execute(array($title, $content, $image, $topic, $userID, $trending, $published));
        header("Location: index.php");
    }
    public static function getAdminPosts() {
        $result = [];
        $stmt = Connection::getInstance()->prepare('SELECT t1.title, t1.id, t1.published, t1.content, t2.login FROM post AS t1 JOIN user AS t2 ON t1.user_id = t2.id ORDER BY created_on DESC;');
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                array_push($result, AdminPostController::getAdminPostByRow($row));
            }
        }
        return $result;
    }
    public static function getPostByID($id) {
        $stmt = Connection::getInstance()->prepare("SELECT * FROM post WHERE id=?");
        $stmt->execute(array($id));
        return AdminPostController::getPostByRow($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function edit($title, $content, $topic, $published, $trending, $image, $id) {
        if(!self::validation($title, $content, $image, $topic, $id, $trending, $published)) {
            return;
        }
        $post = $this->getPostByID($id);
        $queryText = 'UPDATE post SET ';
        $queryParams = [];
        if($title !== $post->title) {
            $queryText.='title=?';
            array_push($queryParams, $title);
        }
        if($content !== $post->content) {
            if(count($queryParams)) {
                $queryText.=', ';
            }
            $queryText.='content=?';
            array_push($queryParams, $content);
        }
        if($topic !== $post->topic) {
            if(count($queryParams)) {
                $queryText.=', ';
            }
            $queryText.='topic_id=?';
            array_push($queryParams, $topic);
        }
        if($published !== $post->published) {
            if(count($queryParams)) {
                $queryText.=', ';
            }
            $queryText.='published=?';
            array_push($queryParams, $published);
        }
        if($trending !== $post->trending) {
            if(count($queryParams)) {
                $queryText.=', ';
            }
            $queryText.='trending=?';
            array_push($queryParams, $trending);
        }
        if($image !== $post->image) {
            if(count($queryParams)) {
                $queryText.=', ';
            }
            $queryText.='img=?';
            array_push($queryParams, $image);
        }
        if (count($queryParams)) {
            $queryText.=' WHERE id=?';
            array_push($queryParams, $id);
            $stmt = Connection::getInstance()->prepare($queryText);
            $stmt->execute($queryParams);
        }
        header('Location: index.php');
    }
    public function delete($id) {
        $stmt = Connection::getInstance()->prepare("DELETE FROM post WHERE id=?");
        $stmt->execute(array($id));
    }
    public function hide($id, $published) {
        $stmt = Connection::getInstance()->prepare("UPDATE post SET published=? WHERE id=?");
        $stmt->execute(array($published, $id));
    }
    private static function getPostByRow($row) {
        $post = new Post();
        $post->id = $row['id'];
        $post->title = $row['title'];
        $post->content = $row['content'];
        $post->image = $row['img'];
        $post->published = $row['published'];
        $post->trending = $row['trending'];
        $post->topic = $row['topic_id'];
        return $post;
    }
    public static function getAdminPostByRow($row) {
        $post = new AdminPost();
        !empty($row['id']) ? $post->id = $row['id'] : '';
        !empty($row['title']) ? $post->title = $row['title'] : '';
        !empty($row['content']) ? $post->content = $row['content'] : '';
        !empty($row['img']) ? $post->image = $row['img'] : '';
        !empty($row['published']) ? $post->published = $row['published'] : '';
        !empty($row['trending']) ? $post->trending = $row['trending'] : '';
        !empty($row['login']) ? $post->username = $row['login'] : '';
        !empty($row['created_on']) ? $post->createdOn = $row['created_on'] : '';
        return $post;
    }
}