<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table" data-datatable="true" data-export="true" data-rawdata="{'city':<?= $_id ?>}" data-btn="<?= $_lang["Addarea"] ?>,add-area,center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-id="method"><?= $_lang["name"] ?></th>
                            <th data-id="code"><?= $_lang["name_arabic"] ?></th>
                            <th data-id="code"><?= $_lang["city"] ?></th>
                            <th data-id="code"><?= $_lang["price"] ?></th>
                            <th data-id="status"><?= $_lang["Status"] ?></th>

                            <th><?= $_lang["Action"] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $variable = getUser("delivery_areas", ($_id ? "where city=" . $_id : ""));
                        foreach ($variable as $k => $v) {
                            $sel = Selaa("delivery_cities", "where id=" . $v["city"]);
                            //  $sel2 = Selaa("method_type", "where id=" . $sel["method_type"]);
                            // $roles = roles($v["role"]);

                        ?>
                            <tr>
                                <td> <?= $v["id"] ?> </td>
                                <td><?= $v["name"] ?></td>
                                <td class="arabic"><?= $v["name_arabic"] ?></td>
                                <td><?= $sel["name" . $clang] ?></td>
                                <td><?= $v["price"] ?> <?= $_lang["currency"] ?></td>
                                <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                                <td>
                                    <div class="text-center">
                                        <a href="javascript:;" data-red="this" data-action="remove" data-table="delivery_areas" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                            <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                        </a>

                                        <a href="javascript:;" data-center data-modal="edit-area" data-table="delivery_areas" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
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