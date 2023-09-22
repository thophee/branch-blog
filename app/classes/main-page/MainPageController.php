<?php
namespace App;
use PDO;
class MainPageController {
    public function getTrendingPosts() {
        $result = [];
        $stmt = Connection::getInstance()->prepare('SELECT t1.id, t1.title, t1.content, t1.created_on, t1.img, t1.published, t1.trending, t2.login FROM post AS t1 JOIN user AS t2 ON t1.user_id = t2.id WHERE trending = 1 AND published = 1 ORDER BY created_on DESC ;');
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                array_push($result, AdminPostController::getAdminPostByRow($row));
            }
        }
        return $result;
    }
    public function getPostsByCategory($topicID) {
        $result = [];
        $stmt = Connection::getInstance()->prepare('SELECT t1.id, t1.title, t1.content, t1.created_on, t1.img, t1.published, t1.trending, t2.login FROM post AS t1 JOIN user AS t2 ON t1.user_id = t2.id WHERE topic_id = '."$topicID".' ORDER BY created_on DESC ;');
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                array_push($result, AdminPostController::getAdminPostByRow($row));
            }
        }
        return $result;
    }
}
