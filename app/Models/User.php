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
            if ($this->validator()) {
                $db = Database::dbConnect();
                $sth = $db->prepare("INSERT INTO `user` (email, password) VALUES (:email, :password)");
                $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
                $sth->bindParam(':email', $this->email, $db::PARAM_STR);
                $sth->bindParam(':password', $hashedPassword, $db::PARAM_STR);
                $sth->execute();
            }
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

    private function validator() {
        $errors = false;
        if (!filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL)) {
            FlashMessages::addMessage("Votre adresse email n'est pas valide.", 'warning');
            $errors = true;
        }
        if (strlen($this->getPassword()) < 8) {
            FlashMessages::addMessage("Votre mot de passe doit contenir au moins 8 caractères.", 'warning');
            $errors = true;
        }
        return !$errors;
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
        $this->email = htmlspecialchars($email);
        return $this;
    }
    public function setPassword(string $password) {
        $this->password = $password;
        return $this;
    }
}