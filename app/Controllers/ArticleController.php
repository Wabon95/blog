<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class ArticleController extends CoreController {

    public function showAll() {
        $this->render('article.showAll', [
            'page_title' => 'Les derniers articles postés',
            'articles' => Article::findAll()
        ]);
    }

    public function show($articleSlug) {
        if ($article = Article::findBySlug($articleSlug)) {
            $comments = Comment::findAllRelatedToAnArticle($article->getId());
            $this->render('article.show', [
                'page_title' => $article->getTitle(),
                'article' => $article,
                'comments' => $comments
            ]);
        } else {
            $this->redirect('/article');
        }
    }

    public function addView() {
        $this->render('article.add', [
            'page_title' => 'Ajouter un article'
        ]);
    }

    public function addTreatment() {
        $article = new Article();
        $article
            ->setTitle($_POST['inputTitle'])
            ->setContent($_POST['inputContent'])
            ->setAuthor(User::getConnectedUser())
        ;
        if ($article->insert()) $this->redirect('/article/' . $article->getSlug());
        $this->redirect('/article');
    }

    public function editView($articleSlug) {
        $this->render('article.edit', [
            'page_title' => 'Modifier un article',
            'article' => Article::findBySlug($articleSlug)
        ]);
    }

    public function editTreatment($articleSlug) {
        if ($article = Article::findBySlug($articleSlug)) {
            $article
                ->setTitle($_POST['inputTitle'])
                ->setContent($_POST['inputContent'])
            ;
            $article->update($article->getId());
            $this->redirect('/article/' . $article->getSlug());
        } else {
            $this->redirect('/article');
        }
    }

    public function deleteTreatment($articleSlug) {
        if ($article = Article::findBySlug($articleSlug)) {
            $article->delete($article->getId());
        }
        $this->redirect('/article');
    }
}