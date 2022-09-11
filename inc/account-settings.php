<section id="page-account-settings">
    <div class="row">
        <!-- left menu section -->
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column nav-left">
                <!-- general -->
                <li class="nav-item">
                    <a class="nav-link active" id="account-pill-general" data-bs-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user font-medium-3 me-1">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="fw-bold"><?= $_lang["General"] ?></span>
                    </a>
                </li>
                <!-- change password -->
                <li class="nav-item">
                    <a class="nav-link" id="account-pill-password" data-bs-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock font-medium-3 me-1">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <span class="fw-bold"><?= $_lang["ChangePassword"] ?></span>
                    </a>
                </li>
                <!-- information -->
                <li class="nav-item">
                    <a class="nav-link" id="account-pill-info" data-bs-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info font-medium-3 me-1">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span class="fw-bold"><?= $_lang["settings"] ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="account-pill-store" data-bs-toggle="pill" href="#account-vertical-store" aria-expanded="false">

                        <i data-feather='shopping-bag' class="font-medium-3 me-1"></i>
                        <span class="fw-bold"><?= $_lang["Store"] ?></span>
                    </a>
                </li>

            </ul>
        </div>
        <!--/ left menu section -->

        <!-- right content section -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <!-- general tab -->
                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                            <!-- header section -->
                            <form class="validate-form mt-2" id="login_table" novalidate="novalidate">



                                <!-- form -->

                                <div class="row">
                                    <div class="col-12 row pe-0">
                                        <div class="col-lg-6 col-md-12">
                                            <label class="form-label" for="account-username"><?= $_lang["avatar"] ?></label>
                                            <input type="file" data-upload="avatar" value="<?= $_login->avatar ?>" name="avatar" hidden="" accept="image/*">
                                        </div>
                                        <div class="col-lg-6 col-md-12 pe-0">
                                            <div class="mb-1">
                                                <label class="form-label" for="account-username"><?= $_lang["fullname"] ?></label>
                                                <input type="text" data-validmsg="<?= $_lang["valid"] ?>" class="form-control" id="account-username" name="fullname" placeholder="<?= $_lang["fullname"] ?>" value="<?= $_login->fullname ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="account-e-mail"><?= $_lang["email"] ?></label>
                                                <input type="email" data-validmsg-email="<?= $_lang["valid-email"] ?>" data-validmsg="<?= $_lang["valid"] ?>" class="form-control" id="account-e-mail" name="email" placeholder="Email" value="<?= $_login->email ?>">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-12 col-sm-6">
                                        <div class="mb-1">
                                            <label class="form-label" for="account-name2"><?= $_lang["phone"] ?></label>
                                            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" class="form-control" id="account-name2" name="phone" placeholder="<?= $_lang["phone"] ?>" value="<?= $_login->phone ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="mb-1">
                                            <label class="form-label" for="account-name3"><?= $_lang["fb"] ?></label>
                                            <input type="text" class="form-control" id="account-name3" name="fb" placeholder="<?= $_lang["fb"] ?>" value="<?= $_login->fb ?>">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <input type="hidden" name="data_id" value="<?= $_login->id ?>">
                                        <button type="submit" class="btn btn-primary mt-2 me-1 waves-effect waves-float waves-light"><?= $_lang["Savechanges"] ?></button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect"><?= $_lang["Cancel"] ?></button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ general tab -->

                        <!-- change password -->
                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                            <!-- form -->
                            <form class="validate-form" id="login_table" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="account-old-password"><?= $_lang["oldpassword"] ?></label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input data-validmsg="<?= $_lang["valid"] ?>" type="password" class="form-control" id="account-old-password" name="old_password" placeholder="<?= $_lang["oldpassword"] ?>">
                                                <div class="input-group-text cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="account-new-password"><?= $_lang["newpassword"] ?></label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input data-validmsg="<?= $_lang["valid"] ?>" type="password" id="account-new-password" name="password" class="form-control" placeholder="<?= $_lang["newpassword"] ?>">
                                                <div class="input-group-text cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" name="data_id" value="<?= $_login->id ?>">
                                        <button type="submit" class="btn btn-primary mt-2 me-1 waves-effect waves-float waves-light"><?= $_lang["Savechanges"] ?></button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect"><?= $_lang["Cancel"] ?></button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ change password -->

                        <!-- information -->
                        <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                            <!-- form -->
                            <form class="validate-form" data-red="this" id="login_table" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="accountTextarea"><?= $_lang["Interface"] ?></label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" <?= (!$_login->interface || $_login->interface == "light" ? "checked" : "") ?> type="radio" name="interface" value="light">
                                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["light"] ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" <?= ($_login->interface == "dark" ? "checked" : "") ?> type="radio" name="interface" value="dark">
                                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["dark"] ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" <?= ($_login->interface == "semi-dark" ? "checked" : "") ?> type="radio" name="interface" value="semi-dark">
                                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["semi-dark"] ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="accountTextarea"><?= $_lang["lang"] ?></label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" <?= (!$_login->lang || $_login->lang == "english" ? "checked" : "") ?> type="radio" name="lang" value="english">
                                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["english"] ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" <?= ($_login->lang == "_arabic" ? "checked" : "") ?> type="radio" name="lang" value="_arabic">
                                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["_arabic"] ?></label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-12">
                                        <input type="hidden" name="data_id" value="<?= $_login->id ?>">
                                        <button type="submit" class="btn btn-primary mt-2 me-1 waves-effect waves-float waves-light"><?= $_lang["Savechanges"] ?></button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect"><?= $_lang["Cancel"] ?></button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ information -->
                        <div class="tab-pane fade" id="account-vertical-store" role="tabpanel" aria-labelledby="account-pill-store" aria-expanded="false">
                            <!-- form -->
                            <form class="validate-form" data-red="this" id="login_table" novalidate="novalidate">
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h4 class="card-title"><?= $_lang["storesList"] ?></h4>
                                        <button type="button" data-center data-modal="add-store" data-table="login" class="btn btn-outline-primary waves-effect"><?= $_lang["Addstore"] ?></button>
                                    </div>
                                    <div class="card-body pt-2">
                                        <p><?= $_lang["StoreDes"] ?></p>

                                        <? $variable = getUser("stores", "where user_id=" . $_login->id);
                                        if ($variable)
                                            foreach ($variable as $k => $v) { ?>
                                            <div class="d-flex mt-2">
                                                <div class="flex-shrink-0">
                                                    <img src="<?= getUpUrl($v["logo"]) ?>" alt="facebook" class="me-1 border shadow p-25" height="38" width="38">
                                                </div>
                                                <div class="d-flex justify-content-between flex-grow-1">
                                                    <div class="me-1">
                                                        <p class="fw-bolder mb-0"><?= $v["name"] ?> <span class="badge badge-light-<?= ($v["active"] ? "success" : "danger") ?> ms-50"><?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?></span></p>
                                                        <span><a href="<?= $v["link"] ?>" target="_blank" rel="noopener noreferrer"><?= rtrim($v["link"], "/") ?></a></span>
                                                    </div>
                                                    <div class="mt-50 mt-sm-0">
                                                        <a href="javascript:;" data-red="this" data-action="remove" data-table="stores" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                                            <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                                        </a>
                                                        <a href="javascript:;" data-center data-modal="edit-store" data-table="stores" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
                                                            <i data-feather='edit' class="font-medium-2 text-body"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <? } ?>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ right content section -->
    </div>
</section>