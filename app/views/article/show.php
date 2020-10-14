<div class="article mb-4 p-3">
    <h4><?= $article->getTitle() ?></h4>

    <div class="content">
        <?= $article->getContent() ?>
        <p class="text-right">Ecrit par <?= $article->getAuthor()->getNickname() ?></p>
    </div>
</div>