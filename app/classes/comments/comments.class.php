<?php

class Comment {
    public int $id;
    public string $text;
    public bool $isModified = false;
    public string $modifiedOn;
    public int $userID;
    public int $postID;
    public string $createdOn;
    public string $username;
}
