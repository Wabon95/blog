<h2><?= $page_title ?></h2>
<p class="text-right">
    <a class="btn btn-primary" href="/articles/add" role="button">Ajouter un article</a>
</p>

<?php

foreach ($articles as $article) {
    include('_article.php');
}