<div class="row">
    <div class="col-sm-12">
        <img src="/assets/images/logo.png">
        <?= $language_select ?>
    </div>
</div>
<div class="row">


    <form class="form-horizontal registration" action="/registration" method="POST">

        <div class="form-group">
            <div class="col-sm-12">
                <p class="lead h1 display-4"><?= $strings["REGISTRATION_WELCOME"] ?></p>
                <p class="small"><?= $strings["REGISTRATION_WELCOME_SUB"] ?></p>
            </div>

        </div>
        <div class="form-group">
            <label for="login"
                   class=" control-label form-control-lg"><?= $strings["REGISTRATION_LOGIN_PLACEHOLDER"] ?></label>
            <div class="col-sm-12">
                <input type="login" class="form-control form-control-lg" name="login" id="login"
                       value="<?= $_POST['login'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="password"
                   class="control-label form-control-lg"><?= $strings["REGISTRATION_PASSWORD_PLACEHOLDER"] ?></label>
            <div class="col-sm-12">
                <input type="password" name="password" class="form-control form-control-lg" id="password">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirm"
                   class="control-label form-control-lg"><?= $strings["REGISTRATION_CONFIRM_PASSWORD_PLACEHOLDER"] ?></label>
            <div class="col-sm-12">
                <input type="password" name="password_confirm" class="form-control form-control-lg"
                       id="password_confirm">
            </div>
        </div>
        <div class="form-group">
            <div class=" col-sm-12 text-center ">
                <button type="submit" class="btn btn-dark"><?= $strings["REGISTRATION"] ?></button>
            </div>
        </div>
        <div class="col-sm-12">
            <p class="small sign-up"><?= $strings["REGISTRATION_AUTH"] ?></p>
            <a href='/auth' class="small"><?= $strings["SIGN_IN"] ?></a>
        </div>

        <? if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <? endif; ?>

    </form>

</div>

