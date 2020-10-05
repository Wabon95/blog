<?php

namespace App\Controllers;

use App\Utils\Database;
use App\Utils\FlashMessages;

class CoreController extends Database {

    protected function render(string $view, ?array $data) {
        $view = str_replace('.', '/', $view);
        extract($data);
        $flash_messages = FlashMessages::getMessages();
        require_once __DIR__.'/../views/header.php';
        require_once __DIR__.'/../views/'.$view.'.php';
        require_once __DIR__.'/../views/footer.php';
    }

    protected function redirect(string $url) {
        header("Location: $url");
    }
}