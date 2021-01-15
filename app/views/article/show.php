<div class="article mb-4 p-3">
    <h4><?= $article->getTitle() ?></h4>
    <p>Rédigé par <a href="#"><?= $article->getAuthor()->getNickname() ?></a></p>

    <div class="content">
        <?= $article->getContent() ?>
    </div>
</div>