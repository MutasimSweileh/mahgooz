<?
$id = isv("id");
if (!$id)
    header("Location: " . getSiteUrl("site-products"));
$jsonData = Sel("products", "where id=" . $id);
?>
<div class="blog-edit-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="" id="products" data-red="<?= getSiteUrl("site-products") ?>" class="mt-2">
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="mb-2">
                                    <label class="form-label" for="blog-edit-title"><?= $_lang["title"] ?></label>
                                    <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="blog-edit-title" class="english form-control" name="name" value="" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-2">
                                    <label class="form-label" for="blog-edit-title2"><?= $_lang["title_arabic"] ?></label>
                                    <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="blog-edit-title2" class="form-control" name="name_arabic" />
                                </div>
                            </div>
                            <?php $role = ($_login->role == 1 ? 3 : 4); ?>
                            <div class="row">
                                <div class="col-lg col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="blog-edit-category"><?= $_lang["Category"] ?></label>
                                        <select id="blog-edit-category" data-add<?= $_login->role == 1 ? "" : "1" ?>="<?= $_lang["Addcategory"] ?>,add-category,1" data-search="1" data-select name="category" class="select2 form-select">

                                            <? $variable = getUser('categories', 'where active=1');
                                            foreach ($variable as $k => $v) { ?>
                                                <option value="<?= $v["id"] ?>"><?= $v["name" . $clang] ?></option>
                                            <? } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="basic-default"><?= $_lang["price"] ?></label>
                                        <div class="input-group">
                                            <input data-validmsg="<?= $_lang["valid"] ?>" type="text" class="form-control" name="price" id="basic-default2" placeholder="0">
                                            <span class="input-group-text"><?= $_lang["currency"] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <? if ($_login->role == 1) { ?>
                                    <? if (!$jsonData->user_id) { ?>
                                        <div class="col-lg col-12">
                                            <div class="mb-2">
                                                <label for="task-tag" class="form-label"><?= $_lang["add_price"] ?></label>
                                                <div class="input-group">
                                                    <input data-validmsg="<?= $_lang["valid"] ?>" type="text" class="form-control" name="add_price" id="basic-default5" placeholder="0">
                                                    <span class="input-group-text"><?= $_lang["currency"] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <? } else { ?>
                                        <div class="col-lg col-12">
                                            <div class="mb-2">
                                                <label for="task-tag" class="form-label"><?= $_lang["add_price"] ?></label>
                                                <div class="input-group">
                                                    <input data-validmsg="<?= $_lang["valid"] ?>" readonly value="<?= $St->commission ?>" type="text" class="form-control" id="basic-default4" placeholder="0">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                    <div class="col-lg col-12">
                                        <div class="mb-2">
                                            <label for="task-tag" class="form-label"><?= $_lang["Commission"] ?></label>
                                            <div class="input-group">
                                                <input data-validmsg="<?= $_lang["valid"] ?>" type="text" class="form-control" name="commission" id="basic-default4" placeholder="0">
                                                <span class="input-group-text"><?= $_lang["currency"] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <? } else { ?>
                                    <div class="col-lg col-12">
                                        <div class="mb-2">
                                            <label for="task-tag" class="form-label"><?= $_lang["Commission"] ?></label>
                                            <div class="input-group">
                                                <input data-validmsg="<?= $_lang["valid"] ?>" readonly value="<?= $St->commission ?>" type="text" class="form-control" id="basic-default4" placeholder="0">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                                <div class="col-lg col-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="blog-edit-title3"><?= $_lang["InStock"] ?></label>
                                        <input type="text" data-TouchSpin data-validmsg="<?= $_lang["valid"] ?>" id="blog-edit-title3" placeholder="0" class="form-control" value="1" min="1" name="stock" />
                                    </div>
                                </div>

                                <? if ($_login->role == 1) { ?>
                                    <div class="col-lg col-12">
                                        <div class="mb-2">
                                            <label for="task-tag" class="form-label d-block"><?= $_lang["Status"] ?></label>
                                            <select class="form-select task-tag" id="task-tag" name="active">
                                                <option value="1"><?= $_lang["Activated"] ?></option>
                                                <option value="0"><?= $_lang["inactive"] ?></option>
                                            </select>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-2">
                                    <label class="form-label"><?= $_lang["description"] ?></label>
                                    <div id="blog-editor-wrapper">
                                        <div id="blog-editor-container">
                                            <div class="editor" data-placeholder="<?= $_lang["description"] ?>" data-editorel="description" name="description">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-2">
                                    <label class="form-label"><?= $_lang["description_arabic"] ?></label>
                                    <div id="blog-editor-wrapper2">
                                        <div id="blog-editor-container">
                                            <div class="editor" data-placeholder="<?= $_lang["description_arabic"] ?>" data-editorel="description_arabic" name="description_arabic">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-2">
                                <label class="form-label" for="account-username"><?= $_lang["product_images"] ?></label>
                                <div class="source-item " data-repeater="product_images" data-col="" data-undelete="" name="product_images">
                                    <div data-repeater-list="product_images">
                                        <div class="repeater-wrapper mb-50" data-repeater-item="">
                                            <div class="d-flex product-details-border position-relative pe-0">
                                                <div class="w-100 p-lg-1">
                                                    <div class="mb-0">
                                                        <input type="text" data-upload name="image" hidden="" accept="image/*">
                                                    </div>
                                                </div>
                                                <div class=" d-flex  flex-column align-items-center justify-content-between border-start invoice-product-actions py-50 px-25 ">
                                                    <i data-feather="x" data-repeater-delete class="cursor-pointer font-medium-3"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-0 mt-1 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary btn-sm btn-add-new waves-effect waves-float waves-light" data-repeater-create="">
                                            <i data-feather="plus" class="me-25"></i>
                                            <span class="align-middle"><?= $_lang["add"] ?> <?= $_lang["product_image"] ?></span>
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 col-12 mb-2">
                                <label class="form-label" for="account-username"><?= $_lang["product_features"] ?></label>

                                <div class="source-item" data-repeater="product_features" data-col data-empty2="" name="product_features">
                                    <div data-repeater-list="product_features">

                                        <div class="repeater-wrapper mb-50" data-repeater-item="">
                                            <div class="row2">
                                                <div class="d-flex product-details-border position-relative pe-0">
                                                    <div class="w-100 p-lg-1 row">
                                                        <div class="col-md-4 col-12">

                                                            <label for="todoTitleAdd" class="form-label"><?= $_lang["title"] ?></label>
                                                            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title" class="english new-todo-item-title form-control" placeholder="<?= $_lang["title"] ?>" />

                                                        </div>
                                                        <div class="col-md-4 col-12">

                                                            <label for="todoTitleAdd2" class="form-label"><?= $_lang["title_arabic"] ?></label>
                                                            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd2" name="title_arabic" class="new-todo-item-title form-control" placeholder="<?= $_lang["title_arabic"] ?>" />

                                                        </div>
                                                        <div class="col-md-4 col-12">

                                                            <label for="todoTitleAdd3" class="form-label"><?= $_lang["Icon"] ?></label>
                                                            <input type="text" data-icons data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd3" name="icon" class="new-todo-item-title form-control" placeholder="<?= $_lang["Icon"] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class=" d-flex  flex-column align-items-center justify-content-between border-start invoice-product-actions py-50 px-25 ">
                                                        <i data-feather="x" data-repeater-delete class="cursor-pointer font-medium-3"></i>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-0 mt-1 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary btn-sm btn-add-new waves-effect waves-float waves-light" data-repeater-create="">
                                            <i data-feather="plus" class="me-25"></i>
                                            <span class="align-middle"><?= $_lang["add"] ?> <?= $_lang["product_feature"] ?></span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-2" id="colorsandsizes" data-load="colorsandsizes" name="product_specification">

                            </div>


                            <div class="col-12 mt-50">
                                <input type="hidden" name="id">
                                <input type="hidden" name="user_id">
                                <input type="hidden" name="date" value="<?= time() ?>">
                                <button type="submit" class="btn btn-primary me-1"><?= $_lang["Savechanges"] ?></button>
                                <button type="reset" class="btn btn-outline-secondary"><?= $_lang["Cancel"] ?></button>
                            </div>
                        </div>
                    </form>
                    <!--/ Form -->
                </div>
            </div>
        </div>
    </div>
</div>