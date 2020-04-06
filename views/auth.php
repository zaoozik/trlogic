<div class="row">
    <div class="col-sm-12">
        <img src="/assets/images/logo.png">
        <?= $language_select ?>
    </div>
</div>
<div class="row">


    <form class="form-horizontal auth" action="/auth" method="POST" id="auth_form" novalidate>

        <div class="form-group">
            <div class="col-sm-12">
                <p class="lead h1 display-4"><?= $strings["AUTH_WELCOME"] ?></p>
                <p class="small"><?= $strings["AUTH_WELCOME_SUB"] ?></p>
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="login" class="form-control form-control-lg" name="login" id="login"
                       placeholder="<?= $strings["LOGIN"] ?>" value="<?= $_POST['login'] ?>" required>
                <div class="invalid-feedback">
                    <?= $strings["VALIDATION_AUTH_LOGIN"] ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="password" name="password" class="form-control form-control-lg" id="password"
                       placeholder="<?= $strings["PASSWORD"] ?>" required>
                <div class="invalid-feedback">
                    <?= $strings["VALIDATION_AUTH_PASSWORD"] ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-12">
                <button type="submit" class="btn btn-dark"><?= $strings["SIGN_IN"] ?></button>
            </div>
        </div>
        <div class="col-sm-12">
            <p class="small sign-up"><?= $strings["AUTH_SIGN_UP"] ?></p>
            <a href='/registration' class="small"><?= $strings["REGISTRATION"] ?></a>
        </div>

        <? if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <? endif; ?>

    </form>


</div>

<script src="/assets/js/auth.js"></script>