<nav class="navbar navbar-light bg-light">
    <div class="navbar-brand"><img src="/assets/images/logo.png" height="50" alt="LOGO"></div>
    <div class="form-inline"><?= $language_select ?>
        <span style="margin-right: 0.5em;"><?= $_SESSION["user_login"] ?></span>
        <a class="nav-item" href="/logout"><?= $strings["LOGOUT"] ?></a>
    </div>
</nav>