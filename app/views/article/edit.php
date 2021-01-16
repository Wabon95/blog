<h2><?= $page_title ?></h2>

<form action="/articles/edit/<?= $article->getSlug() ?>" method="post">

    <div class="form-group">
        <label for="inputTitle">Titre de l'article</label>
        <input type="text" class="form-control" id="inputTitle" name="inputTitle" value="<?= $article->getTitle() ?>">
    </div>

    <div class="form-group">
        <label for="inputContent">Contenu de l'article</label>
        <input type="text" class="form-control" id="inputContent" name="inputContent" value="<?= $article->getContent() ?>">
    </div>

    <button class="btn btn-primary btn-block mt-3" type="submit">Modifier</button>
</form>