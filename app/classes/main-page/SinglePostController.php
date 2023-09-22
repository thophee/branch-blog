<?php
namespace App;
use PDO;

class SinglePostController {
    public function getPostByID($id) {
        if(empty($id)) {
            return null;
        }
        $stmt = Connection::getInstance()->prepare("SELECT * FROM post AS t1 JOIN user AS t2 ON t1.user_id = t2.id WHERE t1.id=? ORDER BY created_on DESC ");
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return AdminPostController::getAdminPostByRow($row);
    }
}