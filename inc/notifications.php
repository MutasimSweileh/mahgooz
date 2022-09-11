<div class="card card-user-timeline">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list user-timeline-title-icon">
                <line x1="8" y1="6" x2="21" y2="6"></line>
                <line x1="8" y1="12" x2="21" y2="12"></line>
                <line x1="8" y1="18" x2="21" y2="18"></line>
                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                <line x1="3" y1="18" x2="3.01" y2="18"></line>
            </svg>
            <h4 class="card-title"><?= $_pageAr["title" . $clang] ?></h4>
        </div>
        <i data-feather="trash" data-action="remove" data-where="{'user_id':<?= $_login->id ?>,'active':1}" data-red="this" data-table="notifications"></i>
    </div>
    <div class="card-body">
        <ul class="timeline ms-50">
            <?
            $w = "(user_id=" . $_login->id . " || user_id=0) and admin=0";
            if ($_login->role == 1)
                $w = "admin=1";

            $variable = getUser('notifications', 'where ' . $w . ' and date <= ' . time() . ' order by `id` desc');
            foreach ($variable as $k => $v) { ?>
                <li class="timeline-item">
                    <span class="timeline-point timeline-point-<?= $v["type"] ?> <?= $v["icon"] ? "" : "timeline-point-indicator" ?>"><?= $v["icon"] ?></span>
                    <div class="timeline-event">
                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                            <h6><?= $v["title" . $clang] ?></h6>
                            <span class="timeline-event-time me-1"><?= cptime($v["date"]) ?></span>
                        </div>
                        <div class="d-lg-flex justify-content-between  align-content-center mb-1">
                            <p class="mb-0"><?= $v["description" . $clang] ?></p>
                            <? if ($v["link"]) { ?>
                                <div>
                                    <a href="<?= $v["link"] ?>" class="btn btn-outline-info btn-sm waves-effect" type="button">
                                        <?= $_lang["Show"] ?>
                                    </a>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </li>
            <? } ?>

        </ul>
    </div>
</div>