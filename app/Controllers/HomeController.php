<?php

namespace App\Controllers;

use App\Utils\FlashMessages;

class HomeController extends CoreController {

    public function home() {
        $this->render('home', [
            'page_title' => 'Accueil',
            'flash_messages' => FlashMessages::getMessages()
            ]);
    }
}