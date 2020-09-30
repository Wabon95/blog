<?php

namespace App\Utils;

abstract class FlashMessages {

    public static function addMessage(string $message, string $type) {
        $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
    }

    public static function getMessages() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
    }
}