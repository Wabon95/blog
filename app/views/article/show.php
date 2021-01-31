<div class="article mb-4 p-3">

    <div class="row">
        <div class="col-6 text-left">
            <h4><?= $article->getTitle() ?></h4>
        </div>
        <div class="col-4 text-right">
            <p>Rédigé par <a href="#"><?= $article->getAuthor()->getNickname() ?></a> le <?= $article->getFormatedDate() ?></p>
        </div>
        <div class="col-2 text-right">
            <a class="btn btn-success" href="/article/editer/<?= $article->getSlug() ?>" role="button">Edit.</a>
            <a class="btn btn-danger" href="/article/supprimer/<?= $article->getSlug() ?>" role="button">Suppr.</a>
        </div>
    </div>

    <div class="content">
        <?= $article->getContent() ?>
    </div>
</div>

<form action="/article/ajouter-commentaire" method="post">
    <div class="mb-3">

        <label for="textAreaComment" class="form-label">Écrire un commentaire</label>
        <textarea class="form-control" id="textAreaComment" name="textAreaComment" rows="2"></textarea>

        <label for="articleId" class="form-label"></label>
        <input type="hidden" class="form-control" id="articleId" name="articleId" value="<?= $article->getId() ?>">

        <button class="btn btn-primary mt-3" type="submit">Envoyer</button>
    </div>
<form action="/article/ajouter" method="post">

<?php foreach($article->getComments() as $comment): ?>
    <div class="comment p-2 mb-2">
        <h5><?= $comment->getAuthor()->getNickname() ?> le <?= $comment->getFormatedDate() ?></h5>
        <p><?= $comment->getContent() ?></p>
    </div>
<?php endforeach; ?>
