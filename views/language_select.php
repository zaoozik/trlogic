<form id="language_select_form" class="form-inline float-right language-select" action="/change_language" method="POST">
    <label for="language_select"><?= $strings["LANGUAGE"] ?></label>
    <select class="form-control" id="language_select_select" name="language">
        <? foreach ($options as $option) : ?>
            <option value="<?= $option['value'] ?>" <?= $option['selected'] ?> > <?= $option['caption'] ?> </option>
        <? endforeach; ?>
    </select>
</form>

<script src="/assets/js/language_select.js"></script>