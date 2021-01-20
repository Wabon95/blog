<?php

namespace App\Models;

use App\Models\User;
use App\Utils\Database;
use Cocur\Slugify\Slugify;
use App\Utils\FlashMessages;

class Article extends Database {
    private int $id;
    private string $title;
    private string $slug;
    private string $content;
    private $author;
    private $created_at;
    private $updated_at;

    public function insert() {
        $db = Database::dbConnect();
        $sth = $db->prepare("INSERT INTO `article` (title, slug, content, author, created_at) VALUES (:title, :slug, :content, :author, :created_at)");
        $this->created_at = new \DateTime();
        $createdAt = $this->created_at->format('Y-m-d H:i:s');
        if (!self::findBySlug($this->slug)) {
            $sth->bindParam(':title', $this->title, $db::PARAM_STR);
            $sth->bindParam(':slug', $this->slug, $db::PARAM_STR);
            $sth->bindParam(':content', $this->content, $db::PARAM_STR);
            $sth->bindParam(':author', $this->author->getId(), $db::PARAM_INT);
            $sth->bindParam(':created_at', $createdAt, $db::PARAM_STR);
            $sth->execute();
            FlashMessages::addMessage("Votre article à correctement été ajouté.", 'success');
            return true;
        } else {
            FlashMessages::addMessage("Un article avec ce même titre existe déjà, veuillez en choisir un autre.", 'warning');
            return false;
        }
    }

    public function update(int $id) {
        $db = Database::dbConnect();
        $sth = $db->prepare("UPDATE `article` SET title = :title, slug = :slug, content = :content, updated_at = :updated_at WHERE article.id = $id");
        $this->updated_at = new \DateTime();
        $updated_at = $this->updated_at->format('Y-m-d H:i:s');
        $sth->bindParam(':title', $this->title, $db::PARAM_STR);
        $sth->bindParam(':slug', $this->slug, $db::PARAM_STR);
        $sth->bindParam(':content', $this->content, $db::PARAM_STR);
        $sth->bindParam(':updated_at', $updated_at, $db::PARAM_STR);
        $sth->execute();
        FlashMessages::addMessage("Votre article à correctement été modifié.", 'success');
    }

    public static function find(int $id) {
        $db = Database::dbConnect();
        $sth = $db->prepare("SELECT * FROM `article` WHERE id = :id");
        $sth->bindParam(':id', $id, $db::PARAM_INT);
        $sth->execute();
        $article = $sth->fetchObject(__CLASS__);
        if ($article instanceof Article) {
            $article->author = User::find($article->author);
            $article->created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $article->created_at);
            return $article;
        }
        return false;
    }

    public static function findBySlug(string $slug) {
        $db = Database::dbConnect();
        // $sth = $db->prepare("SELECT article.*, user.id AS userid, user.* FROM `article` LEFT JOIN user ON article.author = user.id WHERE article.slug = :slug");
        $sth = $db->prepare("SELECT * FROM `article` WHERE slug = :slug");
        $sth->bindParam(':slug', $slug, $db::PARAM_STR);
        $sth->execute();
        $article = $sth->fetchObject(__CLASS__);
        if ($article instanceof Article) {
            $article->author = User::find($article->author);
            // $article->author = new User();
            // $article->author->setId($article->userid);
            // $article->author->setEmail($article->email);
            // $article->author->setNickname($article->nickname);
            // $article->author->setPassword($article->password);
            $article->created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $article->created_at);
            return $article;
        }
        return false;
    }

    public static function findAll(int $limit = 20) {
        $db = Database::dbConnect();
        $sth = $db->prepare("SELECT * FROM `article` ORDER BY created_at DESC LIMIT $limit");
        $sth->execute();
        $articles = [];
        while ($article = $sth->fetchObject(__CLASS__)) {
            if ($article instanceof Article) {
                $article->author = User::find($article->author);
                $article->created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $article->created_at);
                $articles[] = $article;
            }
        }
        return $articles;
    }

    public static function delete(int $id) {
        $db = Database::dbConnect();
        $sth = $db->prepare("DELETE FROM `article` WHERE id = $id");
        $sth->execute();
    }

    // GETTERS
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getSlug() {
        return $this->slug;
    }
    public function getContent() {
        return $this->content;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    // SETTERS
    public function setTitle(string $title) {
        $this->title = htmlspecialchars($title);
        $this->setSlug($title);
        return $this;
    }
    public function setContent(string $content) {
        $this->content = htmlspecialchars($content);
        return $this;
    }
    private function setSlug(string $title) {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($title);
    }
    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }
}