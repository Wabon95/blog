<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Utils\Database;
use Cocur\Slugify\Slugify;
use App\Utils\FlashMessages;

class Article extends Database {
    private int $id;
    private string $title;
    private string $slug;
    private string $content;
    private array $comments;
    private $author;
    private $created_at;
    private $updated_at;

    public function insert() {
        $db = Database::dbConnect();
        $sql = "
            INSERT INTO `article` (title, slug, content, author, created_at)
            VALUES (:title, :slug, :content, :author, :created_at)
        ";
        $sth = $db->prepare($sql);
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
        $sql = "
            UPDATE `article`
            SET title = :title, slug = :slug, content = :content, updated_at = :updated_at
            WHERE article.id = $id
        ";
        $sth = $db->prepare($sql);
        $this->updated_at = new \DateTime();
        $updated_at = $this->updated_at->format('Y-m-d H:i:s');
        $sth->bindParam(':title', $this->title, $db::PARAM_STR);
        $sth->bindParam(':slug', $this->slug, $db::PARAM_STR);
        $sth->bindParam(':content', $this->content, $db::PARAM_STR);
        $sth->bindParam(':updated_at', $updated_at, $db::PARAM_STR);
        $sth->execute();
        FlashMessages::addMessage("Votre article à correctement été modifié.", 'success');
    }

    public static function findBySlug(string $slug) {
        $db = Database::dbConnect();
        $sql = "
            SELECT article.*, user.email, user.nickname, user.password
            FROM `article`
            LEFT JOIN user ON article.author = user.id
            WHERE article.slug = :slug
        ";
        $sth = $db->prepare($sql);
        $sth->bindParam(':slug', $slug, $db::PARAM_STR);
        $sth->execute();
        $article = $sth->fetchObject(__CLASS__);
        if ($article instanceof Article) {
            $author = new User();
            $author
                ->setId($article->getAuthor())
                ->setEmail($article->email)
                ->setNickname($article->nickname)
                ->setPassword($article->password)
            ;
            $article->setAuthor($author);
            $article->setComments(Comment::findAllRelatedToAnArticle($article->getId()));
            $article->created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $article->created_at);
            return $article;
        }
        return false;
    }

    public static function find(int $id) {
        $db = Database::dbConnect();
        $id = htmlspecialchars($id);
        $sql = "
            SELECT article.*, user.email, user.nickname, user.password
            FROM `article`
            LEFT JOIN user ON article.author = user.id
            WHERE article.id = $id
        ";
        $sth = $db->prepare($sql);
        $sth->execute();
        $article = $sth->fetchObject(__CLASS__);
        if ($article instanceof Article) {
            $author = new User();
            $author
                ->setId($article->getAuthor())
                ->setEmail($article->email)
                ->setNickname($article->nickname)
                ->setPassword($article->password)
            ;
            $article->setAuthor($author);
            $article->created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $article->created_at);
        }
        return $article;
    }

    public static function findAll(int $limit = 20) {
        $db = Database::dbConnect();
        $sql = "
            SELECT article.*, user.email, user.nickname, user.password
            FROM `article`
            LEFT JOIN user ON article.author = user.id
            ORDER BY created_at DESC LIMIT $limit
        ";
        $sth = $db->prepare($sql);
        $sth->execute();

        $articles = [];
        while ($article = $sth->fetchObject(__CLASS__)) {
            if ($article instanceof Article) {
                $author = new User();
                $author
                    ->setId($article->getAuthor())
                    ->setEmail($article->email)
                    ->setNickname($article->nickname)
                    ->setPassword($article->password)
                ;
                $article->setAuthor($author);
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
    public function getComments() {
        return $this->comments;
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
    public function getFormatedDate() {
        return $this->created_at->format('d/m/Y à H:i');
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
    public function setComments(array $comments) {
        $this->comments = $comments;
    }
}