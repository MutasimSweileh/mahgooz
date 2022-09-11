<section id="faq-search-filter">
    <div class="card faq-search" style="background-image: url('<?= $_site ?>/app-assets/images/banner/banner.png')">
        <div class="card-body text-center">
            <!-- main title -->
            <h2 class="text-primary"><?= $_lang["answerquestions"] ?></h2>

            <!-- subtitle -->
            <p class="card-text mb-2"><?= $_lang["answerquestionschoose"] ?></p>

            <!-- search input -->
            <form class="faq-search-input">
                <div class="input-group input-group-merge">
                    <div class="input-group-text">
                        <i data-feather="search"></i>
                    </div>
                    <input type="text" id="searchFq" class="form-control" placeholder="<?= $_lang["search"] ?>" />
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /search header -->

<!-- frequently asked questions tabs pills -->
<section id="faq-tabs">
    <!-- vertical tab pill -->
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 faq-category">
            <div class="faq-navigation d-flex justify-content-between flex-column mb-2 mb-md-0">
                <!-- pill tabs navigation -->
                <ul class="nav nav-pills nav-left flex-column" role="tablist">
                    <!-- payment -->

                    <? $variable = getUser('faq_category', 'where active=1');
                    foreach ($variable as $k => $v) { ?>
                        <li class="nav-item">
                            <a class="nav-link <?= (!$k ? "active" : "") ?>" id="faq2_category<?= $v["id"] ?>" data-bs-toggle="pill" href="#faq_category<?= $v["id"] ?>" aria-expanded="true" role="tab">
                                <?= $v["icon"] ?>
                                <span class="fw-bold"><?= $v["title" . $clang] ?></span>
                            </a>
                        </li>
                    <? } ?>

                </ul>

                <!-- FAQ image -->
                <img src="<?= $_site ?>/app-assets/images/illustration/faq-illustrations.svg" class="img-fluid d-none d-md-block" alt="demand img" />
            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-12 faq-ansers">
            <!-- pill tabs tab content -->
            <div class="tab-content">
                <!-- payment panel -->
                <?
                foreach ($variable as $k => $v) { ?>
                    <div role="tabpanel" class="tab-pane <?= (!$k ? "active" : "") ?>" id="faq_category<?= $v["id"] ?>" aria-labelledby="payment<?= $v["id"] ?>" aria-expanded="true">
                        <!-- icon and header -->
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-tag bg-light-primary me-1">
                                <?= str_replace("me-1", "", $v["icon"]) ?>
                            </div>
                            <div>
                                <h4 class="mb-0"><?= $v["title" . $clang] ?></h4>
                                <span><?= $v["subtitle" . $clang] ?></span>
                            </div>
                        </div>

                        <!-- frequent answer and question  collapse  -->
                        <div class="accordion accordion-margin mt-2" id="faq-payment-qna<?= $v["id"] ?>">

                            <? $variable2 = getUser('faq', 'where faq_category=' . $v["id"]);
                            foreach ($variable2 as $k => $v2) { ?>
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="paymentOne<?= $v2["id"] ?>">
                                        <button class="accordion-button <?= ($k ? "" : "collapsed") ?>" data-bs-toggle="collapse" role="button" data-bs-target="#faq-payment-one<?= $v2["id"] ?>" aria-expanded="<?= ($k ? "false" : "true") ?>" aria-controls="faq-payment-one<?= $v2["id"] ?>">
                                            <?= $v2["question" . $clang] ?>
                                        </button>
                                    </h2>

                                    <div id="faq-payment-one<?= $v2["id"] ?>" class="collapse accordion-collapse <?= ($k ? "" : "show") ?>" aria-labelledby="paymentOne<?= $v2["id"] ?>" data-bs-parent="#faq-payment-qna<?= $v2["id"] ?>">
                                        <div class="accordion-body">
                                            <?= $v2["answer" . $clang] ?>
                                        </div>
                                    </div>
                                </div>

                            <? } ?>

                        </div>
                    </div>
                <? } ?>

            </div>
        </div>
        <div class="col-12 text-center no-result d-none">
            <h4 class="mt-4"><?= $_lang["nofresult"] ?></h4>
        </div>
    </div>
</section>
<!-- / frequently asked questions tabs pills -->

<!-- contact us -->
<section class="faq-contact">
    <div class="row mt-5 pt-75">
        <div class="col-12 text-center">
            <h2><?= $_lang["havequestion"] ?></h2>
            <p class="mb-3">
                <?= $_lang["findquestion"] ?>
            </p>
        </div>
        <div class="col-sm-6">
            <div class="card text-center faq-contact-card shadow-none py-1">
                <div class="accordion-body">
                    <div class="avatar avatar-tag bg-light-primary mb-2 mx-auto">
                        <i data-feather="phone-call" class="font-medium-3"></i>
                    </div>
                    <h4><?= $St->mobile ?></h4>
                    <span class="text-body"><?= $_lang["alwayshappy"] ?></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card text-center faq-contact-card shadow-none py-1">
                <div class="accordion-body">
                    <div class="avatar avatar-tag bg-light-primary mb-2 mx-auto">
                        <i data-feather="mail" class="font-medium-3"></i>
                    </div>
                    <h4><?= $St->email ?></h4>
                    <span class="text-body"><?= $_lang["Bestway"] ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ contact us -->