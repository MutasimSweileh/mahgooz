<link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css/pages/page-auth.min.css">
<div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
        <!-- Login v1 -->
        <div class="card mb-0" id="login-card">
            <div class="card-body">
                <a href="<?= getSiteUrl("index") ?>" class="brand-logo">
                    <img src="<?= getUpUrl($_St["logo" . $clang]) ?>" alt="<?= $St->title ?>">
                </a>

                <h4 class="card-title mb-1"><?= $_pageAr["title" . $clang] ?></h4>
                <p class="card-text mb-2"><?= $_pageAr["subtitle" . $clang] ?></p>

                <form data-block="#login-card" id="forgot" class="auth-login-form mt-2" action="<?= getSiteUrl("reset") ?>" method="POST" novalidate="novalidate">

                    <div class="mb-1">
                        <label for="register-username" class="form-label"><?= $_lang["code"] ?></label>
                        <input type="text" value="<?= isv("id") ?>" data-validmsg="<?= $_lang["valid"] ?>" class="form-control" id="register-username" name="code" placeholder="567894" aria-describedby="register-username" tabindex="1" autofocus="">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="login-password"><?= $_lang["newpassword"] ?></label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input data-validmsg="<?= $_lang["valid"] ?>" type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="············" aria-describedby="login-password">
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg></span>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 waves-effect waves-float waves-light" tabindex="4"><?= $_lang["reset"] ?></button>
                </form>
                <p class="text-center mt-2">
                    <a href="<?= getSiteUrl("login") ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg> <?= $_lang["backlogin"] ?> </a>
                </p>


                <div class="divider my-2 d-none">
                    <div class="divider-text">or</div>
                </div>

                <div class="auth-footer-btn d-flex justify-content-center d-none">
                    <a href="#" class="btn btn-facebook waves-effect waves-float waves-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                    <a href="#" class="btn btn-twitter white waves-effect waves-float waves-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter">
                            <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                        </svg>
                    </a>
                    <a href="#" class="btn btn-google waves-effect waves-float waves-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </a>
                    <a href="#" class="btn btn-github waves-effect waves-float waves-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github">
                            <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Login v1 -->
    </div>
</div>