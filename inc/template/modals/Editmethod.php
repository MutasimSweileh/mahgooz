<!-- form -->
<form id="payment_methods" data-red="this" class="row gy-1 pt-75">
    <div class="col-12">
        <label class="form-label" for="modalEditUserStatus"><?= $_lang["method"] ?></label>
        <select data-select="<?= $_lang["choose"] ?> <?= $_lang["method"] ?>" data-validmsg="<?= $_lang["valid"] ?>" data-load="method_type,#method_type" id="modalEditUserStatus" name="method_type" class="form-select" aria-label="Default select example">
            <option value="" selected><?= $_lang["choose"] ?> <?= $_lang["method"] ?></option>
            <? $variable = getUser("method_type", "where active=1");
            foreach ($variable as $key => $value) {

            ?>
                <option data-icon='<?= $value["icon"] ?>' value="<?= $value["id"] ?>"><?= $value["name" . $clang] ?></option>
            <? } ?>

        </select>
    </div>
    <div class="col-12" id="method_type">

    </div>
    <div class="col-12">
        <div class="d-flex align-items-center mt-1">
            <div class="form-check form-switch form-check-primary">
                <input type="checkbox" name="status" class="form-check-input" id="customSwitch102" checked />
                <label class="form-check-label" for="customSwitch10">
                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                </label>
            </div>
            <label class="form-check-label fw-bolder" for="customSwitch102"><?= $_lang["setdefault"] ?></label>
        </div>
    </div>
    <div class="col-12 text-center mt-2 pt-50">
        <input type="hidden" name="user_id" value="<?= $_login->id ?>">
        <input type="hidden" name="date" value="<?= time() ?>">
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["add"] ?></button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
            <?= $_lang["Cancel"] ?>
        </button>
    </div>
</form>