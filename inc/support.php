<div class="content-area-wrapper container-xxl p-0" data-select2-id="11">
    <div class="sidebar-left">
        <div class="sidebar">
            <div class="sidebar-content email-app-sidebar">
                <div class="email-app-menu">
                    <div class="form-group-compose text-center compose-btn">
                        <button type="button" class="compose-email btn btn-primary w-100 waves-effect waves-float waves-light" data-bs-backdrop="false" data-bs-toggle="modal" data-bs-target="#compose-mail">
                            <?= $_lang["Compose"] ?>
                        </button>
                    </div>
                    <? $variable = getUser("support", "where `uread` =0 and user_id=" . $_login->id); ?>
                    <div class="sidebar-menu-list">
                        <div class="list-group list-group-messages">
                            <a href="javascript:;" data-where="" class="list-group-item list-group-item-action active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail font-medium-3 me-50">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span class="align-middle"><?= $_lang["allMessages"] ?></span>
                                <? if ($variable) { ?>
                                    <span id="unread" class="badge badge-light-primary rounded-pill float-end"><?= count($variable) ?></span>
                                <? } ?>
                            </a>
                            <a href="javascript:;" data-where="system=0" class="list-group-item list-group-item-action">
                                <i data-feather='send' class="font-medium-3 me-50"></i>
                                <span class="align-middle"><?= $_lang["SentMessages"] ?></span>
                            </a>
                            <a href="javascript:;" data-where="system=1" class="list-group-item list-group-item-action">
                                <i data-feather='cpu' class="font-medium-3 me-50"></i>
                                <span class="align-middle"><?= $_lang["systemMessages"] ?></span>
                            </a>

                        </div>
                        <!-- <hr /> -->
                        <h6 class="section-label mt-3 mb-1 px-2"><?= $_lang["Status"] ?></h6>
                        <div class="list-group list-group-labels">
                            <a href="javascript:;" data-where="status=0" class="list-group-item list-group-item-action"><span class="bullet bullet-sm bullet-success me-1"></span><?= $_lang['Opened'] ?></a>
                            <a href="javascript:;" data-where="status=1" class="list-group-item list-group-item-action"><span class="bullet bullet-sm bullet-warning me-1"></span><?= $_lang['Pending'] ?></a>
                            <a href="javascript:;" data-where="status=2" class="list-group-item list-group-item-action"><span class="bullet bullet-sm bullet-danger me-1"></span><?= $_lang['Closed'] ?></a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="content-right" data-select2-id="10">
        <div class="content-wrapper container-xxl p-0" data-select2-id="9">
            <div class="content-header row">
            </div>
            <div class="content-body" data-select2-id="8">
                <div class="body-content-overlay"></div>
                <!-- Email list Area -->
                <div class="email-app-list">
                    <!-- Email search starts -->
                    <div class="app-fixed-search d-flex align-items-center">
                        <div class="sidebar-toggle d-block d-lg-none ms-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu font-medium-5">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </div>
                        <div class="d-flex align-content-center justify-content-between w-100">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-muted">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg></span>
                                <input type="text" class="form-control" id="email-search" placeholder="<?= $_lang['search'] ?>" aria-label="Search..." aria-describedby="email-search">
                            </div>
                        </div>
                    </div>
                    <!-- Email search ends -->

                    <!-- Email actions starts -->
                    <div class="app-action">
                        <div class="action-left">
                            <div class="form-check selectAll">
                                <input type="checkbox" class="form-check-input" id="selectAllCheck">
                                <label class="form-check-label fw-bolder ps-25" for="selectAllCheck"><?= $_lang['SelectAll'] ?></label>
                            </div>
                        </div>
                        <div class="action-right">
                            <ul class="list-inline m-0">



                                <li class="list-inline-item mail-delete">
                                    <span class="action-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Email actions ends -->
                    <? $variable = getUser("support", "where user_id=" . $_login->id); ?>
                    <!-- Email list starts -->
                    <div class="email-user-list <?= ($variable ? "" : "d-flex") ?> justify-content-center align-content-center">
                        <ul class="email-media-list" id="emailList">
                            <? include "inc/template/email-user-list.php"; ?>
                        </ul>
                        <div class="no-results m-auto <?= ($variable ? "" : "show") ?>">
                            <h5><?= $_lang['No Items Found'] ?></h5>
                        </div>

                    </div>
                    <!-- Email list ends -->
                </div>
                <!--/ Email list Area -->
                <!-- Detailed Email View -->

                <div class="email-app-details w5-100">
                    <!-- Detailed Email Header starts -->
                    <div class="email-detail-header">
                        <div class="email-header-left d-flex align-items-center">
                            <span class="go-back me-1"><i data-feather="chevron-left" class="font-medium-4"></i></span>
                            <h4 class="email-subject mb-0">{title}</h4>
                        </div>
                        <div class="email-header-right ms-2 ps-1">
                            <ul class="list-inline m-0">
                                <li class="list-inline-item d-none">
                                    <span class="bullet bullet-{status} bullet-sm"></span>
                                </li>
                                <li class="list-inline-item">
                                    <div class="dropdown no-arrow">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag font-medium-2">
                                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="tag" style="">

                                            <a href="javascript:;" data-action="update" data-update="{'status':0}" data-table="support" data-id="{id}" class="dropdown-item"><span class="me-50 bullet bullet-success bullet-sm"></span><?= $_lang['Opened'] ?></a>
                                            <a href="javascript:;" data-action="update" data-update="{'status':1}" data-table="support" data-id="{id}" class="dropdown-item"><span class="me-50 bullet bullet-warning bullet-sm"></span><?= $_lang['Pending'] ?></a>
                                            <a href="javascript:;" data-action="update" data-update="{'status':2}" data-table="support" data-id="{id}" class="dropdown-item"><span class="me-50 bullet bullet-danger bullet-sm"></span><?= $_lang['Closed'] ?></a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <span data-action="remove" data-table="support" data-id="{id}" data-red="this" class="action-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg></span>
                                </li>
                                <li class=" d-none list-inline-item email-prev">
                                    <span class="action-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left font-medium-2">
                                            <polyline points="15 18 9 12 15 6"></polyline>
                                        </svg></span>
                                </li>
                                <li class="d-none list-inline-item email-next">
                                    <span class="action-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Detailed Email Header ends -->

                    <!-- Detailed Email Content starts -->
                    <div class="email-scroll-area mt-2">
                        {messages}

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" data-msg="<?= $_lang['Sentsuccessfully'] ?>" data-callback="newFunction({id});" id="support_messages" data-nodata2="true" enctype="multipart/form-data" method="post">

                                            <div class="mb-2" data-editor2="true">
                                                <div class="editor" data-editorEl="true" name="message"></div>
                                                <div data-editorBar="true" class="compose-editor-toolbar">

                                                    <span class="ql-formats me-0">
                                                        <button class="ql-bold"></button>
                                                        <button class="ql-italic"></button>
                                                        <button class="ql-underline"></button>
                                                        <button class="ql-link"></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="btn-wrapper d-flex align-items-center">
                                                    <input type="hidden" name="support_id" value="{id}">
                                                    <input type="hidden" name="status" value="0">
                                                    <input type="hidden" name="uread" value="1">
                                                    <input type="hidden" name="user_id" value="<?= $_login->id ?>">
                                                    <input type="hidden" name="date" value="<?= time() ?>">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><?= $_lang['Send'] ?></button>
                                                </div>
                                                <div class="footer-action d-flex align-items-center">
                                                    <div class="email-attachement">
                                                        <label for="file-input" class="form-label">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip ms-50">
                                                                <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                                            </svg>
                                                        </label>

                                                        <input id="file-input" name="attach" type="file" class="d-none">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Detailed Email Content ends -->
                </div>
                <!--/ Detailed Email View -->

                <!-- compose email -->
                <div class="modal modal-sticky" id="compose-mail" data-bs-keyboard="false" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content p-0">
                            <div class="modal-header">
                                <h5 class="modal-title"><?= $_lang["Compose"] ?></h5>
                                <div class="modal-actions">

                                    <a href="#" class="text-body me-75 compose-maximize"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize-2">
                                            <polyline points="15 3 21 3 21 9"></polyline>
                                            <polyline points="9 21 3 21 3 15"></polyline>
                                            <line x1="21" y1="3" x2="14" y2="10"></line>
                                            <line x1="3" y1="21" x2="10" y2="14"></line>
                                        </svg></a>
                                    <a class="text-body" href="#" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg></a>
                                </div>
                            </div>
                            <div class="modal-body flex-grow-1 p-0">
                                <form data-red="this" data-msg="<?= $_lang['Sentsuccessfully'] ?>" class="compose-form" id="support">
                                    <div class="compose-mail-form-field flex-column">

                                        <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="emailSubject" class="form-control" placeholder="<?= $_lang['Subject'] ?>" name="title">
                                    </div>
                                    <div id="message-editor" data-editor="true">
                                        <div class="editor" data-validmsg="<?= $_lang["valid"] ?>" data-editorEl="true" name="message"></div>
                                        <div data-editorBar="true" class="compose-editor-toolbar">

                                            <span class="ql-formats me-0">
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <button class="ql-link"></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="compose-footer-wrapper">
                                        <div class="btn-wrapper d-flex align-items-center">
                                            <input type="hidden" name="user_id" value="<?= $_login->id ?>">
                                            <input type="hidden" name="date" value="<?= time() ?>">
                                            <input type="hidden" name="uread" value="1">
                                            <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"><?= $_lang['Send'] ?></button>
                                        </div>
                                        <div class="footer-action d-flex align-items-center">
                                            <div class="email-attachement">
                                                <label for="file-input" class="form-label">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip ms-50">
                                                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                                    </svg>
                                                </label>

                                                <input id="file-input" name="attach" type="file" class="d-none">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ compose email -->

            </div>
        </div>
    </div>
</div>