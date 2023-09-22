<?php
namespace App;
session_start();
include_once __DIR__ . '/../../include/image.php';

class AdminPostsView {
    public RouteParameters $parameters;
    private $adminPostController;

    private $posts = null;
    public function getPosts() {
        if(empty($this->posts)) {
            $this->posts = AdminPostController::getAdminPosts();
        }
        return $this->posts;
    }
    private $topics = null;
    public function getTopics() {
        if(empty($this->topics)) {
            $this->topics = AdminTopicController::getTopics();
        }
        return $this->topics;
    }
    public $post;
    public $title;
    public $content;

    public function __construct(RouteParameters $parameters) {
        $this->parameters = $parameters;
        $this->adminPostController = new AdminPostController();
        $this->initialize();
    }
    public function initialize() {
        if(isset($_POST['create_post'])) {
            $this->title = $_POST['title'];
            $this->content = $_POST['content'];
            $image = $_POST['img'];
            $topic = $_POST['topic'];
            $published = $_POST['publish'];
            $userID = $_SESSION['user_id'];
            $trending = $_POST['trending'] != null ? 1 : 0;

            $this->adminPostController->add( $this->title, $this->content, $image, $topic, $userID, $trending, $published);
        }

        if  (isset($this->parameters->Uri[0])) {
            $this->post = $this->adminPostController->getPostByID($this->parameters->Uri[0]);
        }
        if(isset($_POST['edit_post'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_POST['img'];
            $topic = $_POST['topic'];
            $published = $_POST['publish'] != null ? 1 : 0;
            $trending = $_POST['trending'] != null ? 1: 0;

            $this->adminPostController->edit($title, $content, $topic, $published, $trending, $image, $id);
        }
        if ($this->parameters->Uri[1] == 'delete') {
            $this->adminPostController->delete($this->parameters->Uri[0]);
            header("Location: /admin-panel");
        }

        if (isset($this->parameters->Uri[1])) {
            $this->adminPostController->hide($this->parameters->Uri[0], $this->parameters->Uri[1]);
            header("Location: /admin-panel");
        }
    }


}
