<form action="" data-nodata="true">



  <div class="content-detached content-right">

    <div class="content-body">
      <!-- E-commerce Content Section Starts -->

      <section id="ecommerce-header">

        <div class="row">

          <div class="col-sm-12">

            <div class="ecommerce-header-items">

              <div class="result-toggler">

                <button class="navbar-toggler shop-sidebar-toggler" type="button" data-bs-toggle="collapse">

                  <span class="navbar-toggler-icon d-block d-lg-none"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                      <line x1="3" y1="12" x2="21" y2="12"></line>
                      <line x1="3" y1="6" x2="21" y2="6"></line>
                      <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg></span>

                </button>

                <div class="search-results"><span id="search_results"" ><?= count(getUser("products", "where active=1")) ?></span> <?= $_lang["resultsfound"] ?></div>

        </div>

        <div class=" view-options d-flex">

                    <div class="btn-group dropdown-sort">

                      <button type="button" class="btn btn-outline-primary dropdown-toggle me-1 waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="active-sorting"><?= $_lang["AllProducts"] ?></span>

                      </button>

                      <div class="dropdown-menu" style="">

                        <a class="dropdown-item" data-action="applyFilters" href="#"><?= $_lang["AllProducts"] ?></a>

                        <a class="dropdown-item" data-action="applyFilters" data-sort="Wishlist" href="#"><?= $_lang["Wishlist"] ?></a>

                        <a class="dropdown-item" data-action="applyFilters" data-sort="Lowest" href="#"><?= $_lang["Lowest"] ?></a>

                        <a class="dropdown-item" data-action="applyFilters" data-sort="Highest" href="#"><?= $_lang["Highest"] ?></a>

                      </div>

                    </div>

                    <div class="btn-group" role="group">

                      <input type="radio" class="btn-check" name="radio_options" id="radio_option1" autocomplete="off" checked="">

                      <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn waves-effect active" for="radio_option1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid font-medium-3">
                          <rect x="3" y="3" width="7" height="7"></rect>
                          <rect x="14" y="3" width="7" height="7"></rect>
                          <rect x="14" y="14" width="7" height="7"></rect>
                          <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></label>

                      <input type="radio" class="btn-check" name="radio_options" id="radio_option2" autocomplete="off">

                      <label class="btn btn-icon btn-outline-primary view-btn list-view-btn waves-effect" for="radio_option2"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list font-medium-3">
                          <line x1="8" y1="6" x2="21" y2="6"></line>
                          <line x1="8" y1="12" x2="21" y2="12"></line>
                          <line x1="8" y1="18" x2="21" y2="18"></line>
                          <line x1="3" y1="6" x2="3.01" y2="6"></line>
                          <line x1="3" y1="12" x2="3.01" y2="12"></line>
                          <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg></label>

                    </div>

                </div>

              </div>

            </div>

          </div>

      </section>

      <!-- E-commerce Content Section Starts -->



      <!-- background Overlay when sidebar is shown  starts-->

      <div class="body-content-overlay"></div>

      <!-- background Overlay when sidebar is shown  ends-->



      <!-- E-commerce Search Bar Starts -->

      <section id="ecommerce-searchbar" class="ecommerce-searchbar">

        <div class="row mt-1">

          <div class="col-sm-12">

            <div class="input-group input-group-merge">

              <input type="text" class="form-control search-product" data-action="applyFilters" name="search_product" id="shop-search" placeholder="<?= $_lang["SearchProduct"] ?>" aria-label="Search..." aria-describedby="shop-search">

              <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-muted">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg></span>

            </div>

          </div>

        </div>

      </section>

      <!-- E-commerce Search Bar Ends -->

      <div id="products">

        <?php include "inc/template/products.php"  ?>

      </div>





    </div>

  </div>

  <div class="sidebar-detached sidebar-left">

    <div class="sidebar">
      <!-- Ecommerce Sidebar Starts -->

      <div class="sidebar-shop">

        <div class="row">

          <div class="col-sm-12">

            <h6 class="filter-heading d-none d-lg-block"><?= $_lang["Filters"] ?></h6>

          </div>

        </div>

        <div class="card">

          <div class="card-body">





            <!-- Price Slider starts -->

            <div class="price-slider">

              <h6 class="filter-title  mt-0"><?= $_lang["PriceRange"] ?></h6>

              <input type="hidden" name="PriceRange" id="PriceRange">

              <div class="price-slider">

                <div class="range-slider mt-2" data-uslider="100,10000" data-currency="<?= $_lang["currency"] ?>"></div>

              </div>

            </div>

            <!-- Price Range ends -->



            <!-- Categories Starts -->

            <div id="product-categories">

              <h6 class="filter-title"><?= $_lang["Categories"] ?></h6>

              <ul class="list-unstyled categories-list">

                <li>

                  <div class="form-check">

                    <input type="checkbox" id="category<?= $v["id"] ?>" onclick="$('.category').prop('checked',false);" name="categoryAll" class="form-check-input" checked="">

                    <label class="form-check-label" for="category<?= $v["id"] ?>"><?= $_lang["All"] ?></label>

                  </div>

                </li>

                <?php

                $data = getUser("categories", "where active=1  order by `index`");

                foreach ($data as $k => $v) {

                  $d = getUser("products", "where category=" . $v["id"]);

                ?>

                  <li>

                    <div class="form-check">

                      <input type="checkbox" id="category<?= $v["id"] ?>" onclick="$('input[name=categoryAll]').prop('checked',false);" name="category[]" value="<?= $v["id"] ?>" class="form-check-input category">

                      <label class="form-check-label" for="category<?= $v["id"] ?>"><?= $v["name" . $clang] ?> (<?= count($d) ?>)</label>

                    </div>

                  </li>

                <?php } ?>



              </ul>

            </div>

            <!-- Categories Ends -->





            <!-- Clear Filters Starts -->

            <div id="clear-filters">

              <button type="button" data-block="#products" data-action="applyFilters" class="btn w-100 btn-success waves-effect waves-float waves-light"><?= $_lang["applyFilters"] ?></button>

              <button type="button" data-action="ClearFilters" class="btn w-100 mt-1 btn-primary waves-effect waves-float waves-light"><?= $_lang["ClearFilters"] ?></button>

            </div>

            <!-- Clear Filters Ends -->



          </div>

        </div>

      </div>

      <!-- Ecommerce Sidebar Ends -->



    </div>

  </div>
</form>