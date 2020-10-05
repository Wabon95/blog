<?php

// TODO: Récupérer la date depuis la BDD en format DateTime

namespace App\Models;

use App\Utils\Database;
use App\Utils\FlashMessages;

class Article extends Database {
    private int $id;
    private string $title;
    private string $content;
    private $created_at;

    public function insert() {
        $db = Database::dbConnect();
        $sth = $db->prepare("INSERT INTO `article` (title, content, created_at) VALUES (:title, :content, :created_at)");
        $this->created_at = new \DateTime();
        $createdAt = $this->created_at->format('Y-m-d H:i:s');
        $sth->bindParam(':title', $this->title, $db::PARAM_STR);
        $sth->bindParam(':content', $this->content, $db::PARAM_STR);
        $sth->bindParam(':created_at', $createdAt, $db::PARAM_STR);
        $sth->execute();
        FlashMessages::addMessage("Votre article à correctement été ajouté.", 'success');
    }

    public static function find(int $id) {
        $db = Database::dbConnect();
        $sth = $db->prepare("SELECT * FROM `article` WHERE id = :id");
        $sth->bindParam(':id', $id, $db::PARAM_INT);
        $sth->execute();
        return $sth->fetchObject(__CLASS__);
    }


    // GETTERS
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getContent() {
        return $this->content;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }

    // SETTERS
    public function setTitle(string $title) {
        $this->title = $title;
        return $this;
    }
    public function setContent(string $content) {
        $this->content = $content;
        return $this;
    }
}