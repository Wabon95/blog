<?php

namespace App\Controllers;

use App\Models\User;
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
                ->setAuthor(User::getConnectedUser())
            ;
            $article->insert();
            $this->redirect('/articles/' . $article->getSlug());
        }
        $this->render('article.add', [
            'page_title' => 'Ajouter un article'
        ]);
    }

    public function edit($articleSlug) {
        if ($_POST) {
            $article = Article::findBySlug($articleSlug);
            $article
                ->setTitle($_POST['inputTitle'])
                ->setContent($_POST['inputContent'])
            ;
            $article->update($article->getId());
            $this->redirect('/articles/' . $article->getSlug());
        }
        $this->render('article.edit', [
            'page_title' => 'Modifier un article',
            'article' => Article::findBySlug($articleSlug)
        ]);
    }
}