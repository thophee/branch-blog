<?php
namespace App;
class Post {
    public int $id;
    public string $title;
    public string $content;
    public string $image = '';
    public bool $published = false;
    public bool $trending = false;
    public int $topic;
    public string $createdOn;
}
