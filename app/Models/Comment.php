<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use App\Utils\Database;
use App\Utils\FlashMessages;

class Comment extends Database {
    private int $id;
    private string $content;
    private $author;
    private $article;
    private $created_at;

    public function insert() {
        $db = Database::dbConnect();
        $sth = $db->prepare("INSERT INTO `comment` (content, author, article, created_at) VALUES (:content, :author, :article, :created_at)");
        $this->created_at = new \DateTime();
        $createdAt = $this->created_at->format('Y-m-d H:i:s');
        $sth->bindParam(':content', $this->content, $db::PARAM_STR);
        $sth->bindParam(':author', $this->author->getId(), $db::PARAM_INT);
        $sth->bindParam(':article', $this->article->getId(), $db::PARAM_INT);
        $sth->bindParam(':created_at', $createdAt, $db::PARAM_STR);
        $sth->execute();
        FlashMessages::addMessage("Votre commentaire à correctement été posté.", 'success');
    }

    public static function findAllRelatedToAnArticle(int $articleId) {
        $db = Database::dbConnect();
        $sql = "
            SELECT comment.*, user.nickname, user.email, user.password
            FROM `comment`
            LEFT JOIN user ON comment.author = user.id
            WHERE comment.article = $articleId
            ORDER BY created_at DESC
        ";
        $sth = $db->prepare($sql);
        $sth->execute();
        $comments = [];
        while ($comment = $sth->fetchObject(__CLASS__)) {
            if ($comment instanceof Comment) {
                $author = new User();
                $author
                    ->setEmail($comment->email)
                    ->setNickname($comment->nickname)
                    ->setPassword($comment->password)
                ;
                $comment->setAuthor($author);
                $comment->created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $comment->created_at);
                $comments[] = $comment;
            }
        }
        return $comments;
    }


    // GETTERS
    public function getId() {
        return $this->id;
    }
    public function getContent() {
        return $this->content;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getArticle() {
        return $this->article;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getFormatedDate() {
        return $this->created_at->format('d/m/Y à H:i');
    }

    // SETTERS
    public function setContent(string $content) {
        $this->content = htmlspecialchars($content);
        return $this;
    }
    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }
    public function setArticle(Article $article) {
        $this->article = $article;
        return $this;
    }
}