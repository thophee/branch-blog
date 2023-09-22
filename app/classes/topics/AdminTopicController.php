<?php
namespace App;
use PDO;

class AdminTopicController {
    public static function  getTopics() {
        $result = [];
        $stmt = Connection::getInstance()->prepare("SELECT id, name FROM topic ORDER BY created_on DESC;");
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                array_push($result, AdminTopicController::getTopicByRow($row));
            }
        }
        return $result;
    }
    public static function getTopicByID($id) {
        $stmt = Connection::getInstance()->prepare("SELECT * FROM topic WHERE id=?");
        $stmt->execute(array($id));
        return self::getTopicByRow($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function add($name) {
        if($this->topicExists(-1, $name)) {
            header("Location: create.php?error=topicAlreadyExists");
            exit();
        }
        $stmt = Connection::getInstance()->prepare("INSERT INTO topic (name) VALUES(?)");
        $stmt->execute(array($name));
        header("Location: /topics");
    }
    private function validation($id, $name) {
        $isValid = true;
        if (strlen($name) < 3 && (!empty($name))) {
            ErrorHandler::add('short_topic');
            $isValid = false;
        }
        if (empty($name)) {
            ErrorHandler::add('empty_fields');
            $isValid = false;
        }
        if($this->topicExists($id, $name)) {
            ErrorHandler::add('topic_exists');
            $isValid = false;
        }
        return $isValid;
    }
    public function edit($id, $name) {
        if(!self::validation($id,$name)) {
            return;
        }
        $stmt = Connection::getInstance()->prepare("UPDATE topic SET name=? WHERE id=?");
        $stmt->execute(array($name, $id));
        header('Location: /topics');
    }
    public function topicExists($id, $name) {
        $stmt = Connection::getInstance()->prepare('SELECT name FROM topic WHERE id != ? AND name = ?;');
        $stmt->execute(array($id, $name));
        return $stmt->fetch() > 0;
    }

    public function delete($id) {
        $stmt = Connection::getInstance()->prepare("DELETE FROM topic WHERE id=?");
        $stmt->execute(array($id));
    }
    public static function getTopicByRow($row) {
        $topic = new Topic();
        $topic->id = $row['id'];
        $topic->name = $row['name'];
        return $topic;
    }
}