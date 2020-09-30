<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends CoreController {

    public function signUp() {
        $this->render('user.signup', [
            'page_title' => "S'inscrire"
        ]);
    }

    public function signUpTreatment() {
        if($_POST) {
            $user = new User();
            $user
                ->setEmail($_POST['inputEmail'])
                ->setPassword($_POST['inputPassword'])
            ;
            $user->insert();
        }
        $this->redirect('/');
    }
}