<div class="container">

    <form id="form-signin" action="/sign_up" method="post">
        <h2>Inscription</h2>
        <!-- <label for="inputEmail" class="sr-only">Adresse email</label> -->
        <input type="email" id="inputEmail" name="inputEmail" class="form-control mb-3" placeholder="Veuillez renseigner votre adresse email" required autofocus>

        <!-- <label for="inputPassword" class="sr-only">Mot de passe</label> -->
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Veuillez renseigner votre mot de passe" required>
        <small class="text-muted">Minimum de 8 caractères</small>

        <button class="btn btn-primary btn-block mt-3" type="submit">S'inscrire</button>
    </form>

</div>