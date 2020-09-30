<?php

namespace App\Models;

use App\Utils\Database;
use App\Utils\FlashMessages;

class User extends Database {
    private int $id;
    private string $email;
    private string $password;

    public function insert() {
        if (!$this->findByEmail($this->email)) {
            $db = Database::dbConnect();
            $sth = $db->prepare("INSERT INTO `user` (email, password) VALUES (:email, :password)");
            $sth->bindParam(':email', $this->email, $db::PARAM_STR);
            $sth->bindParam(':password', $this->password, $db::PARAM_STR);
            $sth->execute();
        } else {
            FlashMessages::addMessage("Cette adresse email est déjà utilisé.", 'danger');
        }
    }

    public static function findByEmail(string $email) {
        $db = Database::dbConnect();
        $sth = $db->prepare("SELECT * FROM `user` WHERE email = :email");
        $sth->bindParam(':email', $email, $db::PARAM_STR);
        $sth->execute();
        return $sth->fetchObject(__CLASS__);
    }

    // GETTERS
    public function getId() {
        return $this->id;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }

    // SETTERS
    public function setEmail(string $email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = htmlspecialchars($email);
        }
        return $this;
    }
    public function setPassword(string $password) {
        if (strlen($password) > 7) {
            $this->password = password_hash($password, PASSWORD_BCRYPT);
        } else {
            FlashMessages::addMessage("Votre mot de passe doit contenir au moins 8 caractères.", 'danger');
        }
        return $this;
    }
}