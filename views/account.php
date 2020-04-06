<div class="account bg-white">
    <div class="row ">

        <div class="col-lg-4  text-center">
            <img src="<?= $avatar_src ?>" class="mx-auto img-fluid img-circle d-block" alt="avatar">
            <h5 class="mt-2"><?= $strings["AVATAR"] ?></h5>
            <br/>
            <form enctype="multipart/form-data" method="post" class="text-center" action="/upload_avatar">

                <div class="form-group align-content-center"
                ">
                <input type="file" class="" name="avatar" id="avatar">
        </div>

        <div class="form-group  align-content-centertext-center">
            <input class="btn btn-dark " type="submit" value="<?= $strings["UPLOAD"] ?>"/>
        </div>
        </form>

    </div>

    <div class="col-lg-8" id="edit">


        <form role="form" action="/account" method="POST">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label form-control-lg"><?= $strings["NAME"] ?></label>
                <div class="col-lg-9">
                    <input class="form-control form-control-lg" name="name" type="text" value="<?= $name ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label form-control-lg"><?= $strings["SURNAME"] ?></label>
                <div class="col-lg-9">
                    <input class="form-control form-control-lg" type="text" name="surname" value="<?= $surname ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label form-control-lg"><?= $strings["EMAIL"] ?></label>
                <div class="col-lg-9">
                    <input class="form-control form-control-lg" type="text" name="mail" value="<?= $email ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label form-control-lg"><?= $strings["INFO"] ?></label>
                <div class="col-lg-9">
                    <textarea rows="6" class="form-control form-control-lg" name="info"
                              type="text"><?= $info ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label"></label>
                <div class="col-lg-9">
                    <input type="reset" class="btn btn-secondary" value="<?= $strings["CANCEL"] ?>">
                    <input type="submit" class="btn btn-dark" value="<?= $strings["SAVE"] ?>">
                </div>
            </div>
        </form>
    </div>


</div>

<? if (isset($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<? endif; ?>

<? if (isset($message)): ?>
    <div class="alert alert-info" role="alert">
        <?= $message ?>
    </div>
<? endif; ?>

</div>



