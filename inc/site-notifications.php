<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table" data-datatable="true" data-export="true" data-btn="<?= $_lang["Addnotification"] ?>,add-notification">
                    <thead>
                        <tr>
                            <th data-hide>#</th>
                            <th data-id="code"><?= $_lang["Icon"] ?></th>
                            <th data-id="method"><?= $_lang["title"] ?></th>
                            <th data-id="code"><?= $_lang["description"] ?></th>
                            <th data-id="code"><?= $_lang["user"] ?></th>
                            <th data-id="status"><?= $_lang["Status"] ?></th>
                            <th data-id="date"><?= $_lang["Date"] ?></th>
                            <th><?= $_lang["Action"] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $variable = getUser("notifications");
                        foreach ($variable as $k => $v) {
                            $u = Selaa("login", "where id=" . $v["user_id"]);
                            if (!$u)
                                $u = ["avatar" => "", "fullname" => $_lang["AllUsers"], "email" => ""];
                            //  $sel2 = Selaa("method_type", "where id=" . $sel["method_type"]);
                            //$roles = roles($v["role"]);

                        ?>
                            <tr>
                                <td> <?= $v["id"] ?> </td>
                                <td>
                                    <div class="avatar bg-light-<?= $v["type"] ?>">
                                        <div class="avatar-content">
                                            <?= ($v["icon"] ? $v["icon"] : '<i data-feather="disc"></i>') ?>

                                        </div>
                                    </div>
                                </td>
                                <td><?= $v["title" . $clang] ?></td>
                                <td><?= $v["description" . $clang] ?></td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <div class="avatar  me-1"><img src="<?= getUpUrl($u["avatar"], "blank-user.png") ?>" alt="Avatar" height="32" width="32"></div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <span class="emp_name text-truncate fw-bold"><?= $u["fullname"] ?></span>
                                            <small class="emp_post text-truncate text-muted"><?= $u["email"] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                                <td><?= date("d/m/Y", $v["date"]) ?></td>
                                <td>
                                    <div class="text-center">
                                        <a href="javascript:;" data-red="this" data-action="remove" data-table="notifications" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                            <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                        </a>
                                        <a href="javascript:;" data-modal="edit-notification" data-table="notifications" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
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