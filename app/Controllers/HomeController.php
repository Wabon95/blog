<?php

namespace App\Controllers;

class HomeController extends CoreController {

    public function home() {
        $this->render('home', [
            'page_title' => 'Accueil'
        ]);
    }
}