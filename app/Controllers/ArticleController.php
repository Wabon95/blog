<?php

namespace App\Controllers;

use App\Models\Article;
use Cocur\Slugify\Slugify;

class ArticleController extends CoreController {

    public function showAll() {
        $this->render('article.showAll', [
            'page_title' => 'Les derniers articles postés',
            'articles' => Article::findAll()
        ]);
    }

    public function show($articleTitle) {

        // TODO: trouver un système pour que cette merde se fasse automatiquement
        $articleTitle = str_replace('-', ' ', $articleTitle); // Modification du slug dans l'url, pour pouvoir appeller la fonction suivante et qu'elle matche avec une entrée en BDD
        $article = Article::findByTitle($articleTitle);
        // TODO: trouver un système pour que cette merde se fasse automatiquement

        $this->render('article.show', [
            'page_title' => 'Article',
            'article' => Article::findByTitle($articleTitle)
        ]);
    }

    public function add() {
        if ($_POST) {
            $article = new Article();
            $article
                ->setTitle($_POST['inputTitle'])
                ->setContent($_POST['inputContent'])
            ;
            $article->insert();
            $slugify = new Slugify();
            $this->redirect('/articles/' . $slugify->slugify($article->getTitle()));
        }
        $this->render('article.add', [
            'page_title' => 'Ajouter un article'
        ]);
    }
}