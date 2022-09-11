<?
$sel = Sel("method_type", "where id=" . $id);
if ($sel && $sel->items) {
  $variable = json_decode(rawurldecode($sel->items), true);
?>
  <div class="mb-1">
    <label class="form-label" for="basicInput"><?= $_lang["accountNumber"] ?></label>
    <input data-validmsg="<?= $_lang["valid"] ?>" value="" type="text" name="method_number" class="form-control" id="basicInput" placeholder="<?= $_lang["accountNumber"] ?>">
  </div>
  <div class="mb-1">
    <label class="form-label" for="basicSelect"><?= $_lang["Provider"] ?></label>
    <select data-validmsg="<?= $_lang["valid"] ?>" name="provider" id="basicSelect" class="form-select">
      <?
      foreach ($variable as $k => $v) { ?>
        <option value="<?= $v["name" . $clang] ?>"><?= $v["name" . $clang] ?></option>
      <? } ?>
    </select>
  </div>
  <?
}
if (1 == 2)
  switch ($id) {
    case 2: ?>
    <div class="mb-1">
      <label class="form-label" for="basicInput"><?= $_lang["WalletNumber"] ?></label>
      <input data-validmsg="<?= $_lang["valid"] ?>" value="" type="number" name="method_number" class="form-control" id="basicInput" placeholder="<?= $_lang["WalletNumber"] ?>">
    </div>
    <div class="mb-1">
      <label class="form-label" for="basicSelect"><?= $_lang["Provider"] ?></label>
      <select data-validmsg="<?= $_lang["valid"] ?>" name="provider" id="basicSelect" class="form-select">
        <? $variable = getUser("payment_providers", "where active=1");
        foreach ($variable as $k => $v) { ?>
          <option value="<?= $v["name" . $clang] ?>"><?= $v["name" . $clang] ?></option>
        <? } ?>
      </select>
    </div>

  <?
      break;
    case 1: ?>
    <div class="mb-1">
      <label class="form-label" for="basicInput"><?= $_lang["accountNumber"] ?></label>
      <input data-validmsg="<?= $_lang["valid"] ?>" value="" type="text" name="method_number" class="form-control" id="basicInput" placeholder="<?= $_lang["accountNumber"] ?>">
    </div>
    <div class="mb-1">
      <label class="form-label" for="basicSelect"><?= $_lang["Bank"] ?></label>
      <select data-validmsg="<?= $_lang["valid"] ?>" name="provider" id="basicSelect" class="form-select">
        <? $variable = getUser("payment_banks", "where active=1");
        foreach ($variable as $k => $v) { ?>
          <option value="<?= $v["name" . $clang] ?>"><?= $v["name" . $clang] ?></option>
        <? } ?>
      </select>
    </div>
    <div class="mb-1">
      <label class="form-label" for="basicInput"><?= $_lang["branchname"] ?></label>
      <input data-validmsg="<?= $_lang["valid"] ?>" value="" type="text" name="branch" class="form-control" id="basicInput" placeholder="<?= $_lang["branchname"] ?>">
    </div>

<?
      break;

    default:
      # code...
      break;
  }
?>