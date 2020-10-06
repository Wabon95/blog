<form id="form-signin" action="/sign_up" method="post">
    <h2><?= $page_title ?></h2>
    <input type="email" id="inputEmail" name="inputEmail" class="form-control mb-3" placeholder="Veuillez renseigner votre adresse email" required autofocus>

    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Veuillez renseigner votre mot de passe" required>
    <small class="text-muted">Minimum de 8 caractères</small>

    <button class="btn btn-primary btn-block mt-3" type="submit">S'inscrire</button>
</form>

<script src="/js/signup.js"></script>