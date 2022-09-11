<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table" data-datatable="true" data-export="true" data-btn="<?= $_lang["Addproduct"] ?>,<?= getSiteUrl("add-product", $_id) ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-id="method"><?= $_lang["product"] ?></th>
                            <th data-id="code"><?= $_lang["description"] ?></th>
                            <th data-id="code"><?= $_lang["category"] ?></th>
                            <th data-id="code"><?= $_lang["price"] ?></th>
                            <th data-id="status"><?= $_lang["Status"] ?></th>
                            <? if ($_login->role == 1) { ?>
                                <th data-id="date"><?= $_lang["seller"] ?></th>

                            <? } ?> <th data-id="date"><?= $_lang["Date"] ?></th>
                            <th><?= $_lang["Action"] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $where = "";
                        $category = isv("category");
                        if ($category)
                            $where = "where id=" . $_id;
                        else if ($_id)
                            $where = "where category=" . $_id;
                        $variable = getUser("products", ($_login->role == 1 ? $where : "where user_id=" . $_login->id));
                        foreach ($variable as $k => $v) {
                            $sel = Selaa("categories", "where id=" . $v["category"]);
                            $login = Sel("login", "where id=" . $v["user_id"]);
                            $image = "";
                            if ($v["product_images"]) {

                                $image = json_decode(rawurldecode($v["product_images"]), true)[0]["image"];
                            }
                            //  $sel2 = Selaa("method_type", "where id=" . $sel["method_type"]);
                            //$roles = roles($v["role"]);

                        ?>
                            <tr>
                                <td> <?= $v["id"] ?> </td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <div class="avatar  me-1"><img src="<?= getUpUrl($image) ?>" alt="Avatar" height="32" width="32"></div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <span class="emp_name text-truncate fw-bold"><?= $v["name" . $clang] ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?= limit_str(strip_tags($v["description" . $clang]), 10) ?></td>
                                <td><?= $sel["name" . $clang] ?></td>
                                <td><?= number_format($v["price"]) ?> <?= $_lang["currency"] ?></td>
                                <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                                <? if ($_login->role == 1) { ?>
                                    <td><a href="<?= ($login ? getSiteUrl("users", $login->id) : "#") ?>" target="_blank"><?= ($login ? $login->fullname : $_lang["none"]) ?></a></td>

                                <? } ?> <td><?= date("d/m/Y", $v["date"]) ?></td>
                                <td>
                                    <div class="text-center">
                                        <a href="<?= getSiteUrl("product-details", $v["id"]) ?>" data-bs-toggle="tooltip" data-bs-placement="top" class="item-edit me-1" title="<?= $_lang["product-preview"] ?>">
                                            <i data-feather='eye' class="font-medium-2 text-body"></i>
                                        </a>
                                        <a href="javascript:;" data-red="this" data-action="remove" data-table="products" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                            <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                        </a>
                                        <a href="<?= getSiteUrl("edit-product", $v["id"]) ?>" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
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