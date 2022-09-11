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
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#payment-settings" role="tab" aria-controls="payment-settings" aria-selected="false">
      <i class="fas fa-file-invoice-dollar mr-50 font-medium-3"></i>
      <span class="fw-bold"><?= $_lang["paymentsettings"] ?></span></a>
  </li>
</ul>
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="tab-content pt-1">
          <div class="tab-pane active" id="account-money" role="tabpanel">
            <table class="table" data-datatable="true" data-export="true" data-btn="<?= $_lang["Addrequest"] ?>,#Addrequest">
              <thead>
                <tr>
                  <th data-ac="" data-id="id">#</th>
                  <th data-id="method"><?= $_lang["method"] ?></th>
                  <th data-id="code"><?= $_lang["Paymentcode"] ?></th>
                  <th data-id="total"><?= $_lang["Total"] ?></th>
                  <th data-id="status"><?= $_lang["Status"] ?></th>
                  <th data-id="date"><?= $_lang["Date"] ?></th>
                  <th><?= $_lang["Action"] ?></th>
                </tr>
              </thead>
              <tbody>
                <? $variable = getUser("payments", "where user_id=" . $_login->id);
                foreach ($variable as $k => $v) {
                  $sel = Selaa("payment_methods", "where id=" . $v["method"]);
                  $sel2 = Selaa("method_type", "where id=" . $sel["method_type"]);
                  $roles = payStatus($v["status"]);

                ?>
                  <tr>
                    <td><?= $v["id"] ?></td>
                    <td>
                      <div class="d-flex  justify-content-left align-items-center">
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
                      </div>
                    </td>
                  </tr>
                <? } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="payment-settings" role="tabpanel">
            <form class="row card-body row" id="login_table">
              <div class="col-md-12 col-lg-12 mb-1">
                <div class="d-flex align-items-center mt-1">
                  <div class="form-check form-switch form-check-primary">
                    <input type="checkbox" name="auto_payment" class="form-check-input" id="customSwitch10" <?= $_login->auto_payment ? "checked" : "" ?> />
                    <label class="form-check-label" for="customSwitch10">
                      <span class="switch-icon-left"><i data-feather="check"></i></span>
                      <span class="switch-icon-right"><i data-feather="x"></i></span>
                    </label>
                  </div>
                  <label class="form-check-label fw-bolder" for="customSwitch10"><?= $_lang["paymentauto"] ?></label>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 mb-1">
                <label class="form-label" for="basicSelect"><?= $_lang["method"] ?></label>
                <select data-selecticons="true" name="auto_payment_method" data-validmsg="<?= $_lang["valid"] ?>" name="method" id="basicSelect" class="form-select">
                  <? $variable = getUser("payment_methods", "where status=1 and user_id=" . $_login->id);
                  foreach ($variable as $k => $v) {
                    $sel2 = Selaa("method_type", "where id=" . $v["method_type"]);
                  ?>
                    <option value="<?= $v["id"] ?>" <?= $_login->auto_payment_method == $v["id"] ? "selected" : "" ?> data-number="<?= $v["method_number"] ?>" data-icon="<?= str_replace('"', "'", $sel2["icon"]) ?>"><?= $sel2["name" . $clang] ?></option>
                  <? } ?>
                </select>
              </div>
              <div class="col-md-12 col-lg-6 mb-1">
                <label class="form-label" for="basic-default"><?= $_lang["PaymentThreshold"] ?></label>
                <div class="input-group">
                  <input data-validmsg="<?= $_lang["valid"] ?>" min="50" data-validmin="<?= $_lang["validMin"] ?>" type="number" class="form-control" name="payment_threshold" id="basic-default" placeholder="50" value="<?= $_login->payment_threshold ? $_login->payment_threshold : "" ?>" aria-label="Amount (to the nearest dollar)">
                  <span class="input-group-text"><?= $_lang["currency"] ?></span>
                </div>
              </div>
              <div class="col-12">
                <input type="hidden" name="data_id" value="<?= $_login->id ?>">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light"><?= $_lang["Savechanges"] ?></button>
                <button type="reset" class="btn btn-outline-secondary waves-effect"><?= $_lang["Cancel"] ?></button>
              </div>

            </form>
          </div>
          <div class="tab-pane" id="payment-method" role="tabpanel">
            <table class="table" data-datatable="true" data-btn="<?= $_lang["Addmethod"] ?>,Addmethod,1">
              <thead>
                <tr>
                  <th data-id="id">#</th>
                  <th data-id="method"><?= $_lang["method"] ?></th>
                  <th data-id="status"><?= $_lang["Status"] ?></th>
                  <th data-id="date"><?= $_lang["Date"] ?></th>
                  <th data-id="Action"><?= $_lang["Action"] ?></th>

                </tr>
              </thead>
              <tbody>
                <? $variable = getUser("payment_methods", "where user_id=" . $_login->id);
                foreach ($variable as $k => $v) {

                  $sel2 = Selaa("method_type", "where id=" . $v["method_type"]);


                ?>
                  <tr>
                    <td><?= $v["id"] ?></td>
                    <td>
                      <div class="d-flex justify-content-left align-items-center">
                        <div class="avatar  bg-light-<?= ($v["status"] || 1 == 1 ? "secondary" : "warning") ?>  me-1">
                          <span class="avatar-content"><?= $sel2["icon"] ?></span>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="emp_name text-truncate fw-bold"><?= $sel2["name" . $clang] ?></span>
                          <small class="emp_post text-truncate text-muted"><?= $v["method_number"] ?></small>
                        </div>
                      </div>
                    </td>

                    <td><span class="badge rounded-pill badge-light-<?= ($v["status"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["status"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                    <td><?= date("d/m/Y", $v["date"]) ?></td>
                    <td>
                      <div class="text-center">
                        <a href="javascript:;" data-red="this" data-action="remove" data-table="payment_methods" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                          <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                        </a>
                        <a href="javascript:;" data-center data-modal="Editmethod" data-table="payment_methods" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
                          <i data-feather='edit' class="font-medium-2 text-body"></i>
                        </a>
                        <a href="javascript:;" data-red="this" data-action="update" data-update="{'status':<?= ($v["status"] ? 0 : 1) ?>}" data-table="payment_methods" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= (!$v["status"] ? $_lang["Activated"] : $_lang["inactive"]) ?>" class="item-edit me-1">
                          <i data-feather='<?= ($v["status"] ? "x-circle" : "check-circle") ?>' class="font-medium-2 text-body"></i>
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
<!-- add new card modal  -->
<div class="modal fade" id="Addrequest" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-sm-5 mx-50 pb-5">
        <h1 class="text-center mb-1" id="addNewCardTitle"><?= $_lang["Addrequest"] ?></h1>
        <p class="text-center"><?= $_lang["Addrequestdes"] ?></p>

        <!-- form -->
        <form id="payments" data-red="this" class="row gy-1 pt-75">
          <div class="col-12">
            <label class="form-label" for="modalEditUserStatus"><?= $_lang["method"] ?></label>
            <select data-selecticons="true" name="method" data-validmsg="<?= $_lang["valid"] ?>" name="method" id="basicSelect2" class="form-select">
              <? $variable = getUser("payment_methods", "where status=1 and user_id=" . $_login->id);
              foreach ($variable as $k => $v) {
                $sel2 = Selaa("method_type", "where id=" . $v["method_type"]);
              ?>
                <option value="<?= $v["id"] ?>" <?= $_login->auto_payment_method == $v["id"] ? "selected" : "" ?> data-number="<?= $v["method_number"] ?>" data-icon="<?= str_replace('"', "'", $sel2["icon"]) ?>"><?= $sel2["name" . $clang] ?></option>
              <? } ?>
            </select>
          </div>
          <div class="col-md-12">
            <label class="form-label" for="basic-default"><?= $_lang["PaymentThreshold"] ?></label>
            <div class="input-group">
              <input data-validmsg="<?= $_lang["valid"] ?>" min="50" data-validmax="<?= $_lang["validMax"] ?>" data-validmin="<?= $_lang["validMin"] ?>" type="text" class="form-control" name="total" id="basic-default2" placeholder="50" value="<?= $_login->money ? $_login->money : "" ?>" max="<?= $_login->money ? $_login->money : "0" ?>" aria-label="Amount (to the nearest dollar)">
              <span class="input-group-text"><?= $_lang["currency"] ?></span>
            </div>
          </div>


          <div class="col-12 text-center mt-2 pt-50">
            <input type="hidden" name="user_id" value="<?= $_login->id ?>">
            <input type="hidden" name="code" value="<?= rand(99999, 999999) ?>">
            <input type="hidden" name="date" value="<?= time() ?>">
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
<!--/ add new card modal  -->