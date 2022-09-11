<?
if (!function_exists("getUser")) {
    include "../../inc.php";
}
$where = isv("where");
if (!isset($admin))
    $admin = isv("admin");
if ($where && !$admin)
    $where = " and " . $where;
if ($admin) {
    $where =  ($where ? "where " . $where : "");
} else
    $where =  "where user_id=" . $_login->id . $where;
$variable = getUser("support", $where . " order by `date` DESC");
foreach ($variable as $k => $v) {

    $udata = Sel("support_messages", "where support_id=" . $v["id"] . " order by `date` desc");
    if (!$udata)
        continue;
    $data = Sel("login", "where id=" . $udata->user_id);

?>
    <li class="d-flex user-mail <?= $v[($admin ? "" : "u") . "read"] ? "" : "mail-read" ?>" data-admin="<?= $admin ?>" data-id="<?= $v["id"] ?>">
        <div class="mail-left pe-50 justify-content-center align-content-center">

            <div class="user-action justify-content-center align-items-center">
                <div class="form-check">
                    <input value="<?= $v["id"] ?>" type="checkbox" class="form-check-input" id="customCheck1">
                    <label class="form-check-label" for="customCheck1"></label>
                </div>

            </div>
        </div>

        <div class="mail-body">
            <div class="mail-details">
                <div class="mail-items d-flex flex-row">
                    <div class="avatar me-50">
                        <img src="<?= getUpUrl($data->avatar) ?>" alt="avatar img holder">
                    </div>
                    <div>
                        <h5 class="mb-25"><?= $data->fullname ?></h5>
                        <span class="text-truncate"><?= $v["title"] ?></span>
                    </div>
                </div>
                <div class="mail-meta-item">
                    <span class="me-50 bullet bullet-<?= $v["status"] ? ($v["status"] == 2 ? "danger" : "warning") : "success" ?> bullet-sm"></span>
                    <span class="mail-date"><?= date("d/m/Y h:i A", $v["date"]) ?></span>
                </div>
            </div>
            <div class="mail-message">
                <p class="text-truncate mb-0">
                    <?= strip_tags($udata->message) ?>

                </p>
            </div>
        </div>
    </li>
<? } ?>