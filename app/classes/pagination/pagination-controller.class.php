<?php

class Pagination {
    public static int $rowsPerPage = 3;
    public int $start = 0;
    public function getPosts() {
        $result = [];
        $stmt = Connection::getInstance()->prepare('SELECT t1.id, t1.title, t1.content, t1.created_on, t1.img, t1.published, t1.trending, t2.login FROM post AS t1 JOIN user AS t2 ON t1.user_id = t2.id WHERE published = 1 ORDER BY created_on DESC LIMIT '."$this->start".', 3;');
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                array_push($result, AdminPostController::getAdminPostByRow($row));
            }
        }
        return $result;
    }

    public static function getPagesAmount() {
        $stmt = Connection::getInstance()->prepare('SELECT COUNT(*) FROM post');
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_NUM)[0];
        return ceil($rows / self::$rowsPerPage);
    }
}