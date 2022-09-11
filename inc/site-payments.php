<!-- Basic table -->
<ul class="nav nav-pills mb-2">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#account-money" role="tab" aria-controls="account-money" aria-selected="true">
            <i class="fas fa-money-bill mr-50 font-medium-3"></i>
            <span class="fw-bold"><?= $_lang["Moneyrequests"] ?></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#payment-method" role="tab" aria-controls="payment-method" aria-selected="false">
            <i class="fa fa-credit-card mr-50 font-medium-3"></i>
            <span class="fw-bold"><?= $_lang["paymentmethod"] ?></span></a>
    </li>
</ul>
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="tab-content pt-1">
                    <div class="tab-pane active" id="account-money" role="tabpanel">
                        <table class="table" data-datatable="true" data-export="true">
                            <thead>
                                <tr>
                                    <th data-id="id">#</th>
                                    <th data-id="fullname"><?= $_lang["user"] ?></th>
                                    <th data-id="method"><?= $_lang["method"] ?></th>
                                    <th data-id="code"><?= $_lang["Paymentcode"] ?></th>
                                    <th data-id="total"><?= $_lang["Total"] ?></th>
                                    <th data-id="status"><?= $_lang["Status"] ?></th>
                                    <th data-id="date"><?= $_lang["Date"] ?></th>
                                    <th><?= $_lang["Action"] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? $variable = getUser("payments");
                                foreach ($variable as $k => $v) {
                                    $sel = Selaa("payment_methods", "where id=" . $v["method"]);
                                    $sel2 = Selaa("method_type", "where id=" . $sel["method_type"]);
                                    $u = Selaa("login", "where id=" . $v["user_id"]);
                                    $roles = payStatus($v["status"]);
                                ?>
                                    <tr>
                                        <td><?= $v["id"] ?></td>
                                        <td>
                                            <div class="d-flex justify-content-left align-items-center">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar  me-1"><img src="<?= getUpUrl($u["avatar"]) ?>" alt="Avatar" height="32" width="32"></div>
                                                </div>

                                                <div class="d-flex flex-column">
                                                    <span class="emp_name text-truncate fw-bold"><?= $u["fullname"] ?></span>
                                                    <small class="emp_post text-truncate text-muted"><?= $u["phone"] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-left align-items-center">
                                                <div class="avatar  bg-light-<?= ($v["status"] || 1 == 1 ? "secondary" : "warning") ?>  me-1">
                                                    <span class="avatar-content"><?= $sel2["icon"] ?></span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="emp_name text-truncate fw-bold"><?= $sel2["name" . $clang] ?></span>
                                                    <small class="emp_post text-truncate text-muted"><?= $sel["method_number"] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $v["code"] ?></td>
                                        <td><?= number_format($v["total"]) ?> <?= $_lang["currency"] ?></td>
                                        <td><span class="badge rounded-pill badge-light-<?= $roles["class"] ?>" text-capitalized=""> <?= $roles["title"] ?> </span></td>
                                        <td><?= date("d/m/Y", $v["date"]) ?></td>
                                        <td>
                                            <div class="text-center">
                                                <a href="javascript:;" data-red="this" data-action="remove" data-table="payments" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                                    <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                                </a>
                                                <a href="javascript:;" data-modal="edit-payment" data-table="payments" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
                                                    <i data-feather='edit' class="font-medium-2 text-body"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="payment-method" role="tabpanel">
                        <table class="table" data-datatable="true" data-btn="<?= $_lang["Addmethod"] ?>,add-method">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $_lang["method"] ?></th>

                                    <th><?= $_lang["Status"] ?></th>

                                    <th><?= $_lang["Action"] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? $variable = getUser("method_type");
                                foreach ($variable as $k => $v) {

                                    //  $sel2 = Selaa("method_type", "where id=" . $v["method_type"]);


                                ?>
                                    <tr>
                                        <td><?= $v["id"] ?></td>
                                        <td>
                                            <div class="d-flex justify-content-left align-items-center">
                                                <div class="avatar  bg-light-secondary  me-1">
                                                    <span class="avatar-content"><?= $v["icon"] ?></span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="emp_name text-truncate fw-bold"><?= $v["name" . $clang] ?></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>

                                        <td>
                                            <div class="text-center">
                                                <a href="javascript:;" data-red="this" data-action="remove" data-table="method_type" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                                    <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                                </a>

                                                <a href="javascript:;" data-modal="edit-method" data-table="method_type" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
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
        </div>
    </div>

</section>
<!--/ Basic table -->
<div class="modal fade" id="add-faq-category" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="addNewCardTitle"><?= $_lang["addcategory"] ?></h1>


                <!-- form -->
                <form id="faq_category" data-red="this" class="row gy-1 pt-75">
                    <div class="col-12">
                        <div class="mb-1">
                            <label for="todoTitleAdd" class="form-label"><?= $_lang["title"] ?></label>
                            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title" class="new-todo-item-title form-control" placeholder="<?= $_lang["title"] ?>" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label for="todoTitleAdd" class="form-label"><?= $_lang["title_arabic"] ?></label>
                            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title_arabic" class="new-todo-item-title form-control" placeholder="<?= $_lang["title_arabic"] ?>" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label for="task-tag" class="form-label d-block"><?= $_lang["Status"] ?></label>
                            <select class="form-select task-tag" id="task-tag" name="active">
                                <option value="1"><?= $_lang["Activated"] ?></option>
                                <option value="0"><?= $_lang["inactive"] ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1"><?= $_lang["add"] ?></button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <?= $_lang["Cancel"] ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>