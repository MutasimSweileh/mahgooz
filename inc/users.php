<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table" data-datatable="true" data-export="true" data-index="4" data-statustext="<?= $_lang["SelectRole"] ?>" data-status='<?= json_encode(roles()) ?>' data-btn="<?= $_lang["Adduser"] ?>,add-user">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-id="method"><?= $_lang["fullname"] ?></th>
                            <th data-id="code"><?= $_lang["phone"] ?></th>
                            <th data-id="code"><?= $_lang["Gender"] ?></th>
                            <th data-id="code"><?= $_lang["role"] ?></th>
                            <th data-id="total"><?= $_lang["AvailableBalance"] ?></th>
                            <th data-id="status"><?= $_lang["Status"] ?></th>
                            <th data-id="date"><?= $_lang["regDate"] ?></th>
                            <th data-id="date"><?= $_lang["last_login"] ?></th>
                            <th><?= $_lang["Action"] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $w = "";
                        if ($_id)
                            $w = "where id=" . $_id;

                        $variable = getUser("login", $w);
                        foreach ($variable as $k => $v) {
                            // $sel = Selaa("payment_methods", "where id=" . $v["method"]);
                            //  $sel2 = Selaa("method_type", "where id=" . $sel["method_type"]);
                            $roles = roles($v["role"]);

                        ?>
                            <tr>
                                <td> <?= $v["id"] ?> </td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <div class="avatar  me-1"><img src="<?= getUpUrl($v["avatar"]) ?>" alt="Avatar" height="32" width="32"></div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <span class="emp_name text-truncate fw-bold"><?= $v["fullname"] ?></span>
                                            <small class="emp_post text-truncate text-muted"><?= $v["email"] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $v["phone"] ?></td>
                                <td><?= $_lang[$v["gender"]] ?></td>
                                <td> <span class="text-truncate align-middle">
                                        <i class="font-medium-3 text-<?= $roles["color"] ?> me-50" data-feather='<?= $roles["icon"] ?>'></i><?= $roles["name"] ?></span></td>
                                <td><?= number_format($v["money"]) ?> <?= $_lang["currency"] ?></td>
                                <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                                <td><?= date("d/m/Y", $v["date"]) ?></td>
                                <td><?= date("d/m/Y", $v["last_login"]) ?></td>
                                <td>
                                    <div class="text-center">
                                        <a href="javascript:;" data-red="this" data-action="remove" data-table="login" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                            <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                        </a>
                                        <a href="javascript:;" data-modal="edit-user" data-table="login" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
                                            <i data-feather='edit' class="font-medium-2 text-body"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>