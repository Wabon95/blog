<?php
// TODO: Faire un système de requête Ajax afin de vérifier le formulaire, pour éviter d'avoir à envoyer le formulaire pour le vérifier
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title><?= $page_title ?></title>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
            <a class="navbar-brand" href="/">Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Les derniers articles postés</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user'])): ?> 
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">Mon profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Se déconnecter</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/sign_up">S'inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Se connecter</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>


    </header>

    <div class="container">
        <?php
            if (isset($flash_messages)) {
                foreach ($flash_messages as $value) {
                    echo '<div class="alert alert-' . $value['type'] . '" role="alert">' . $value['message'] . '</div>';
                }
            }
        ?>
