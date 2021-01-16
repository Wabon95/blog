<?php if (isset($user) && $user->getId() == $article->getAuthor()->getId()): ?>
    <p class="text-right">
        <a class="btn btn-success" href="/article/editer/<?= $article->getSlug() ?>" role="button">Modifier</a>
        <a class="btn btn-danger" href="/article/supprimer/<?= $article->getSlug() ?>" role="button">Supprimer</a>
    </p>
<?php endif; ?>

<div class="article mb-4 p-3">
    <h4><?= $article->getTitle() ?></h4>
    <p>Rédigé par <a href="#"><?= $article->getAuthor()->getNickname() ?></a></p>

    <div class="content">
        <?= $article->getContent() ?>
    </div>
</div>