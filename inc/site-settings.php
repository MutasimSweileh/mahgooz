<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form class="validate-form" id="settings_table" novalidate="novalidate">

                <!--/ header section -->

                <!-- form -->
                <div class="row">
                    <div class="col-12 row pe-0 ">
                        <div class="col-lg-6 col-md-12">
                            <label class="form-label" for="account-username"><?= $_lang["LogoArabic"] ?></label>
                            <input type="file" data-upload="logo" value="<?= $St->logo_arabic ?>" name="logo_arabic" id="account-upload" hidden="" accept="image/*">
                        </div>
                        <div class="col-lg-6 col-md-12 pe-0 ps-2">
                            <label class="form-label" for="account-username"><?= $_lang["Logo"] ?></label>
                            <input type="file" data-upload="logo" value="<?= $St->logo ?>" name="logo" id="account-upload2" hidden="" accept="image/*">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 row pe-0 ">
                        <div class="col-lg-6 col-md-12">
                            <label class="form-label" for="account-username"><?= $_lang["Icon"] ?></label>
                            <input type="file" data-upload="icon" value="<?= $St->icon ?>" name="icon" id="account-upload3" hidden="" accept="image/*">
                        </div>
                        <div class="col-lg-6 col-md-12 pe-0 ps-2">
                            <div class="mb-1">
                                <label class="form-label" for="account-username"><?= $_lang["title"] ?></label>
                                <input type="text" data-validmsg="<?= $_lang["valid"] ?>" class="form-control" id="account-username" name="title" placeholder="<?= $_lang["title"] ?>" value="<?= $St->title ?>">
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="account-e-mail"><?= $_lang["email"] ?></label>
                                <input type="email" data-validmsg-email="<?= $_lang["valid-email"] ?>" data-validmsg="<?= $_lang["valid"] ?>" class="form-control" id="account-e-mail" name="email" placeholder="Email" value="<?= $St->email ?>">
                            </div>
                        </div>
                    </div>



                    <div class="col-12 col-sm-4">
                        <div class="mb-2">
                            <label class="form-label" for="account-name2"><?= $_lang["phone"] ?></label>
                            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" class="form-control" id="account-name2" name="mobile" placeholder="<?= $_lang["phone"] ?>" value="<?= $St->mobile ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="mb-2">
                            <label class="form-label" for="accountTextarea"><?= $_lang["Interface"] ?></label>
                            <div class="demo-inline-spacing">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" <?= (!$St->interface || $St->interface == "light" ? "checked" : "") ?> type="radio" name="interface" value="light">
                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["light"] ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" <?= ($St->interface == "dark" ? "checked" : "") ?> type="radio" name="interface" value="dark">
                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["dark"] ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" <?= ($St->interface == "semi-dark" ? "checked" : "") ?> type="radio" name="interface" value="semi-dark">
                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["semi-dark"] ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="mb-2">
                            <label class="form-label" for="accountTextarea"><?= $_lang["lang"] ?></label>
                            <div class="demo-inline-spacing">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" <?= (!$St->lang || $St->lang == "english" ? "checked" : "") ?> type="radio" name="lang" value="english">
                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["english"] ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" <?= ($St->lang == "_arabic" ? "checked" : "") ?> type="radio" name="lang" value="_arabic">
                                    <label class="form-check-label" for="inlineRadio1"><?= $_lang["_arabic"] ?></label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="mb-2">
                            <label class="form-label" for="account-name3"><?= $_lang["facebook"] ?></label>
                            <input type="text" class="form-control" id="account-name3" name="fb" placeholder="<?= $_lang["facebook"] ?>" value="<?= $St->fb ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="mb-2">
                            <label class="form-label" for="account-name3"><?= $_lang["twitter"] ?></label>
                            <input type="text" class="form-control" id="account-name3" name="twitter" placeholder="<?= $_lang["twitter"] ?>" value="<?= $St->twitter ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="mb-2">
                            <label class="form-label" for="account-name3"><?= $_lang["instagram"] ?></label>
                            <input type="text" class="form-control" id="account-name3" name="instagram" placeholder="<?= $_lang["instagram"] ?>" value="<?= $St->instagram ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="mb-2">
                            <label class="form-label" for="account-name3"><?= $_lang["whatsapp"] ?></label>
                            <input type="text" class="form-control" id="account-name3" name="whatsapp" placeholder="<?= $_lang["whatsapp"] ?>" value="<?= $St->whatsapp ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-2">
                            <label class="form-label" for="exampleFormControlTextarea1"><?= $_lang["description"] ?></label>
                            <textarea class="form-control" data-validmsg="<?= $_lang["valid"] ?>" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="<?= $_lang["description"] ?>" spellcheck="false"><?= $St->description ?></textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="hidden" name="data_id" value="<?= $St->id ?>">
                        <button type="submit" class="btn btn-primary mt-2 me-1 waves-effect waves-float waves-light"><?= $_lang["Savechanges"] ?></button>
                        <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect"><?= $_lang["Cancel"] ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>