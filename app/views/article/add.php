<h2><?= $page_title ?></h2>

<form action="/articles/add" method="post">

    <div class="form-group">
        <label for="inputTitle">Titre de l'article</label>
        <input type="text" class="form-control" id="inputTitle" name="inputTitle">
    </div>

    <div class="form-group">
        <label for="inputContent">Contenu de l'article</label>
        <input type="text" class="form-control" id="inputContent" name="inputContent">
    </div>

    <button class="btn btn-primary btn-block mt-3" type="submit">Envoyer</button>
</form>