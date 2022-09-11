<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table" data-datatable="true" data-export="true" data-btn="<?= $_lang["Addcoupon"] ?>,add-coupon">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-id="method"><?= $_lang["Coupon"] ?></th>
                            <th data-id="code"><?= $_lang["discount"] ?></th>
                            <th data-id="status"><?= $_lang["Status"] ?></th>
                            <th data-id="date"><?= $_lang["Date"] ?></th>
                            <th><?= $_lang["Action"] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $variable = getUser("coupons");
                        foreach ($variable as $k => $v) {


                        ?>
                            <tr>
                                <td> <?= $v["id"] ?> </td>

                                <td><?= $v["code"] ?></td>
                                <td><?= $v["cost"] ?></td>
                                <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                                <td><?= ($v["date"] ? date("d/m/Y", $v["date"]) : $_lang["none"]) ?></td>
                                <td>
                                    <div class="text-center ">
                                        <a href="javascript:;" data-red="this" data-action="remove" data-table="coupons" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                            <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                        </a>
                                        <a href="javascript:;" data-modal="edit-coupon" data-table="coupons" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
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