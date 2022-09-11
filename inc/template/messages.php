<? $variable = getUser('support_messages', 'where support_id=' . $id);
foreach ($variable as $k => $v) {
    $data = Sel("login", "where id=" . $v["user_id"]);
    UpDate("support_messages", "uread", 1, "where id=" . $v["id"]);
?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header email-detail-head">
                    <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
                        <div class="avatar me-75">
                            <img src="<?= getUpUrl($data->avatar) ?>" alt="avatar img holder" width="48" height="48">
                        </div>
                        <div class="mail-items">
                            <h5 class="mb-0"><?= $data->fullname ?></h5>
                            <div class="email-info-dropup dropdown">
                                <span role="button" class="font-small-3 text-muted">
                                    <?= $data->email ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mail-meta-item d-flex align-items-center">
                        <small class="mail-date-time text-muted"><?= date("d/m/Y h:i A", $v["date"]) ?></small>

                    </div>
                </div>
                <div class="card-body mail-message-wrapper pt-2">
                    <div class="mail-message">
                        <?= $v["message"] ?>
                    </div>
                </div>
                <? if ($v["attach"]) { ?>
                    <div class="card-footer">
                        <div class="mail-attachments">
                            <div class="d-flex align-items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip font-medium-1 me-50">
                                    <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                </svg>
                                <h5 class="fw-bolder text-body mb-0"><?= $_lang['Attachment'] ?></h5>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="<?= getUpUrl($v["attach"]) ?>" class="mb-50">
                                    <small class="text-muted fw-bolder"><?= $v["attach"] ?></small>
                                </a>

                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
<? } ?>