<form id="form-signin" action="/login" method="post">
    <h2><?= $page_title ?></h2>
    <!-- <label for="inputEmail" class="sr-only">Adresse email</label> -->
    <input type="email" id="inputEmail" name="inputEmail" class="form-control mb-3" placeholder="Veuillez renseigner votre adresse email" required autofocus>

    <!-- <label for="inputPassword" class="sr-only">Mot de passe</label> -->
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Veuillez renseigner votre mot de passe" required>

    <button class="btn btn-primary btn-block mt-3" type="submit">Se connecter</button>
</form>