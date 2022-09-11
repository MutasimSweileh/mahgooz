<div class="misc-wrapper">
    <a class="brand-logo d-block text-center mt-1" href="<?= getSiteUrl("index") ?>">
        <img src="<?= getUpUrl($_St["logo" . $clang]) ?>" class="img-fluid" alt="<?= $St->title ?>">
    </a>
    <div class="misc-inner p-2 p-sm-3">
        <div class="w-100 text-center">
            <h2 class="mb-1"><?= $_pageAr["title" . $clang] ?> <?= $_page->icon ?></h2>
            <p class="mb-3"><?= $_pageAr["subtitle" . $clang] ?></p>
            <form id="subscribes" data-red="this" data-msg="<?= $_lang["Sentsuccessfully"] ?>" class="row row-cols-md-auto row justify-content-center align-items-start m-0 mb-2 gx-3" action="javascript:void(0)">
                <div class="col-12 m-0 mb-1">
                    <input class="form-control" name="email" data-validmsg-email="<?= $_lang["valid-email"] ?>" data-validmsg="<?= $_lang["valid"] ?>" id="notify-email" type="email" placeholder="<?= $_lang["email"] ?>">
                </div>
                <div class="col-12 m-0 mb-1">
                    <input class="form-control" name="phone" data-validmsg="<?= $_lang["valid"] ?>" type="number" placeholder="<?= $_lang["phone"] ?>">
                </div>
                <div class="col-12 d-md-block d-grid ps-md-0 ps-auto">
                    <button class="btn btn-primary mb-1 btn-sm-block waves-effect waves-float waves-light" type="submit"><?= $_lang["Send"] ?></button>
                </div>
            </form><img class="img-fluid" src="../../../app-assets/images/pages/coming-soon.svg" alt="Coming soon page">
        </div>
    </div>
</div>