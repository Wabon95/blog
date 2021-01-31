<?php

namespace App\Models;

use App\Utils\Database;
use App\Utils\FlashMessages;

class User extends Database {
    private int $id;
    private string $email;
    private string $nickName;
    private string $password;

    public function insert() {
        if (!$this->findByEmail($this->email)) {
            if ($this->validator()) {
                $db = Database::dbConnect();
                $sth = $db->prepare("INSERT INTO `user` (email, nickname, password) VALUES (:email, :nickname, :password)");
                $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
                $sth->bindParam(':email', $this->email, $db::PARAM_STR);
                $sth->bindParam(':nickname', $this->nickname, $db::PARAM_STR);
                $sth->bindParam(':password', $hashedPassword, $db::PARAM_STR);
                $sth->execute();
                FlashMessages::addMessage("Votre compte à correctement été créé.", 'success');
            }
        } else {
            FlashMessages::addMessage("Cette adresse email est déjà utilisé.", 'danger');
        }
    }

    public static function find(int $id) {
        $db = Database::dbConnect();
        $sth = $db->prepare("SELECT * FROM `user` WHERE id = :id");
        $sth->bindParam(':id', $id, $db::PARAM_INT);
        $sth->execute();
        return $sth->fetchObject(__CLASS__);
    }

    public static function findByEmail(string $email) {
        $email = htmlspecialchars($email);
        $db = Database::dbConnect();
        $sth = $db->prepare("SELECT * FROM `user` WHERE email = :email");
        $sth->bindParam(':email', $email, $db::PARAM_STR);
        $sth->execute();
        return $sth->fetchObject(__CLASS__);
    }

    public static function connectUser(string $email, string $password) {
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        if ($user = User::findByEmail($email)) {
            if (password_verify($password, $user->getPassword())) {
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'nickname' => $user->getNickname(),
                    'password' => $user->getPassword()
                ];
                return $user;
            }
            FlashMessages::addMessage("Mot de passe incorrect.", 'warning');
            return false;
        }
        FlashMessages::addMessage("Utilisateur non trouvé.", 'warning');
        return false;
    }

    public static function disconnectUser() {
        if (isset($_SESSION['user'])) unset($_SESSION['user']);
    }

    public static function getConnectedUser() {
        if (isset($_SESSION['user'])) {
            $user = new User();
            $user
                ->setId($_SESSION['user']['id'])
                ->setEmail($_SESSION['user']['email'])
                ->setNickname($_SESSION['user']['nickname'])
                ->setPassword($_SESSION['user']['password'])
            ;
            return $user;
        }
        return false;
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
    public function getNickname() {
        return $this->nickname;
    }
    public function getPassword() {
        return $this->password;
    }

    // SETTERS
    public function setId(int $id) {
        $this->id = htmlspecialchars($id);
        return $this;
    }
    public function setEmail(string $email) {
        $this->email = htmlspecialchars($email);
        return $this;
    }
    public function setNickname(string $nickname) {
        $this->nickname = htmlspecialchars($nickname);
        return $this;
    }
    public function setPassword(string $password) {
        $this->password = $password;
        return $this;
    }
}