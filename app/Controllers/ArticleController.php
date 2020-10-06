<?php

namespace App\Controllers;

use App\Models\Article;

class ArticleController extends CoreController {

    public function showAll() {
        $this->render('article.showAll', [
            'page_title' => 'Les derniers articles postés',
            'articles' => Article::findAll()
        ]);
    }

    public function show($articleSlug) {
        $article = Article::findBySlug($articleSlug);
        $this->render('article.show', [
            'page_title' => $article->getTitle(),
            'article' => $article
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
            $this->redirect('/articles/' . $article->getSlug());
        }
        $this->render('article.add', [
            'page_title' => 'Ajouter un article'
        ]);
    }
}