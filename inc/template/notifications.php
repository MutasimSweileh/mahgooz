<?
$show = (isv("action") ? "show" : "");
$w = "(user_id=" . $_login->id . " || user_id=0) and admin=0";
if ($_login->role == 1)
    $w = "admin=1";

if ($show) {
    $variable = getUser('notifications', 'where active=1 and  ' . $w . '  and date <= ' . time() . ' order by `id` desc');
    $noneSys = array_filter($variable, function ($v) {
        return !$v["system"];
    });
    $reads = array_filter($variable, function ($v) use ($_login) {
        $done = explode(",", $v["done"]);
        return !$v["read"] && !in_array($_login->id, $done);
    });
}
?>

<li class="dropdown-menu-header">
    <div class="dropdown-header d-flex">
        <h4 class="notification-title mb-0 me-auto"><?= $_lang[($noneSys ? "Notifications" : "SystemNotifications")] ?></h4>
        <div class="badge rounded-pill badge-light-primary"><?= count($reads) ?> <?= $_lang["New"] ?></div>
    </div>
</li>
<li class="scrollable-container media-list">
    <?
    foreach ($noneSys as $k => $v) {
    ?>
        <a class="d-flex" href="<?= getSiteUrl("notifications") ?>">
            <div class="list-item d-flex align-items-start  <?= ($v["read"] || in_array($_login->id, explode(",", $v["done"])) ? "" : "active") ?>">
                <div class="me-1">
                    <div class="avatar bg-light-<?= $v["type"] ?>">
                        <div class="avatar-content"><?= $v["icon"] ?></div>
                    </div>
                </div>
                <div class="list-item-body flex-grow-1">
                    <p class="media-heading d-flex justify-content-between align-content-center">
                        <span class="fw-bolder"><?= $v["title" . $clang] ?></span>
                        <span class=" text-muted small"><?= cptime($v["date"]) ?></span>
                    </p>
                    <small class="notification-text text-truncate"> <?= limit_str(strip_tags($v["description" . $clang]), 8) ?></small>
                </div>
            </div>
        </a>
    <? }
    $variable = array_filter($variable, function ($v) {
        return $v["system"];
    });
    ?>
    <? if ($variable) { ?>
        <div class="list-item d-flex align-items-center <?= (!$noneSys ? "d-none" : "") ?>">
            <h6 class="fw-bolder me-auto mb-0"><?= $_lang["SystemNotifications"] ?></h6>
            <div class="form-check form-check-primary form-switch d-none">
                <input class="form-check-input" id="systemNotification" type="checkbox" checked="">
                <label class="form-check-label" for="systemNotification"></label>
            </div>
        </div>
    <? } ?>
    <? foreach ($variable as $k => $v) {
    ?>
        <a class="d-flex" href="<?= getSiteUrl("notifications") ?>">
            <div class="list-item d-flex align-items-start <?= ($v["read"] || !in_array($_login->id, explode(",", $v["done"])) ? "" : "active") ?>">
                <div class="me-1">
                    <div class="avatar bg-light-<?= $v["type"] ?>">
                        <div class="avatar-content"><?= $v["icon"] ?></div>
                    </div>
                </div>
                <div class="list-item-body flex-grow-1">
                    <p class="media-heading d-flex justify-content-between align-content-center">
                        <span class="fw-bolder"><?= $v["title" . $clang] ?></span>
                        <span class=" text-muted small"><?= cptime($v["date"]) ?></span>
                    </p>
                    <small class="notification-text text-truncate"> <?= $v["description" . $clang] ?></small>
                </div>
            </div>
        </a>
    <? } ?>

</li>
<li class="dropdown-menu-footer"><a class="btn btn-primary w-100 waves-effect waves-float waves-light" href="<?= getSiteUrl("notifications") ?>"><?= $_lang["allnotifications"] ?></a></li>