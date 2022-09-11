<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table" data-datatable="true" data-export="true" data-btn="<?= $_lang["Addcategory"] ?>,add-category,center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-id="method"><?= $_lang["name"] ?></th>
                            <th data-id="code"><?= $_lang["name_arabic"] ?></th>
                            <th data-id="code"><?= $_lang["products"] ?></th>
                            <th data-id="status"><?= $_lang["Status"] ?></th>
                            <th><?= $_lang["Action"] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $variable = getUser("categories");
                        foreach ($variable as $k => $v) {
                            $sel = getUser("products", "where category=" . $v["id"]);
                            //  $sel2 = Selaa("method_type", "where id=" . $sel["method_type"]);
                            // $roles = roles($v["role"]);

                        ?>
                            <tr>
                                <td> <?= $v["id"] ?> </td>

                                <td><?= $v["name"] ?></td>
                                <td class="arabic"><?= $v["name_arabic"] ?></td>
                                <td><?= count($sel) ?></td>
                                <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                                <td>
                                    <div class="text-center">
                                        <a href="javascript:;" data-red="this" data-action="remove" data-table="categories" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                            <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                        </a>
                                        <a href="<?= getSiteUrl("site-products", $v["id"]) ?>" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["products"] ?>" class="item-edit me-1">
                                            <i data-feather='square' class="font-medium-2 text-body"></i>
                                        </a>
                                        <a href="javascript:;" data-center data-modal="edit-category" data-table="categories" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
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