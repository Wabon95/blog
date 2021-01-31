<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends CoreController {

    public function addComment() {
        $comment = new Comment();
        $comment
            ->setContent($_POST['textAreaComment'])
            ->setAuthor(User::getConnectedUser())
            ->setArticle(Article::find($_POST['articleId']))
        ;
        $comment->insert();
        $this->redirect('/article/' . $comment->getArticle()->getSlug());
    }

}