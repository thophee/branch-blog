<?php
namespace App;
session_start();
class SinglePageView {
    public RouteParameters $parameters;
    public $singlePostController;
    public $id;
    public function getPost() {
        return $this->singlePostController->getPostByID($this->parameters->Uri[0]);
    }
    public function __construct(RouteParameters $parameters) {
        $this->parameters = $parameters;
        $this->singlePostController = new SinglePostController();
        $this->initialize();
    }
    private function initialize() {
        $this->id = $this->parameters->Uri[0];
    }
}



