<form id="language_select_form" class="form-inline" action="/change_language" method="POST">
    <label for="language_select"><?= $strings["LANGUAGE"] ?></label>
    <select class="form-control" id="language_select_select" name="language">
        <? foreach ($options as $option) : ?>
            <option value="<?= $option['value'] ?>" <?= $option['selected'] ?> > <?= $option['caption'] ?> </option>
        <? endforeach; ?>
    </select>
</form>