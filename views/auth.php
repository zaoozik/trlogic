<form class="form-horizontal auth" action="/auth" method="POST">
    <div class="form-group">
        <label for="login" class="col-sm-2 control-label"><?= $strings["LOGIN"] ?></label>
        <div class="col-sm-10">
            <input type="login" class="form-control" name="login" id="login" placeholder="<?= $strings["LOGIN"] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label"><?= $strings["PASSWORD"] ?></label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="password"
                   placeholder="<?= $strings["PASSWORD"] ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default"><?= $strings["SIGN_IN"] ?></button>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href='/register' class="btn btn-default"><?= $strings["REGISTRATION"] ?></a>
        </div>
    </div>


</form>

