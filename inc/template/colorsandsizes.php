<?
$json = "";
$data = isv("data");
if ($data) {
    $data = json_decode(rawurldecode($data), true);
    $json = json_encode($data);
?>
    <label class="form-label" for="account-username"><?= $_lang["colorsandsizes"] ?></label>
    <div class="row">
        <? foreach ($data as $k => $v) { ?>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card  border shadow-sm rounded w-100" data-data='<?= $json ?>' data-index="<?= $k ?>" data-modal="edit-colorsandsizes">
                    <div class="card-header">
                        <p class="card-title2"><span class="badge badge-light-secondary me-2"><?= $v["title"] ?></span><span class="arabic badge badge-light-secondary"><?= $v["title_arabic"] ?></span></p>
                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
                    </div>
                    <div class="card-body">
                        <? foreach ($v["sizes"] as $key => $value) {

                        ?>
                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="fw-bold ms-75"><?= $value["size"] ?></span>
                                </div>
                                <span class="badge badge-light-primary"><?= $value["stock"] ?></span>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
<?  } ?>
<div class="px-0 mt-1 d-flex justify-content-end">
    <textarea name="product_specification" class="d-none" cols="30" rows="10"><?= ($data ? rawurlencode(json_encode($data)) : "") ?></textarea>
    <button type="button" data-data='<?= $json ?>' data-modal="add-colorsandsizes" class="btn btn-primary btn-sm btn-add-new waves-effect waves-float waves-light">
        <i data-feather="plus" class="me-25"></i>
        <span class="align-middle"><?= $_lang["add"] ?> <?= $_lang["colorandsize"] ?></span>
    </button>
</div>