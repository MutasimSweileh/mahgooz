<?
//echo __DIR__;
$show = "";
if(!function_exists("getUser")){
include "../../inc.php";
//$show = (isv("show")?"show":"");
}
                                 $data = getUser("cart","where user_id=".$_login->id);

                                ?>
<a class="nav-link <?=$show?>" href="#" id="cart_icon" data-bs-toggle="dropdown" aria-expanded="<?=$show?"true":"false"?>" ><i class="ficon" data-feather="shopping-cart"></i><span class="badge rounded-pill bg-primary badge-up cart-item-count"><?=count($data)?></span></a>
                    <ul class="<?=(!$data?"d-none":"")?> dropdown-menu dropdown-menu-media dropdown-menu-end <?=$show?>" data-bs-popper="none">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto"><?= $_lang["cart"]?></h4>
                               
                                <div class="badge rounded-pill badge-light-primary"><?=count($data)?> <?= $_lang["Items"]?></div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            <? $price = 0; foreach ($data as $key => $v) {
                              $p = Selaa("products","where id=".$v["product_id"]);
                              $s = Selaa("product_sizes","where id=".$v["product_size"]);
                              $c = Selaa("product_colors","where id=".$v["product_color"]); 
                              $price += ($v["amount"]*$p["price"]);
                              $stock = $p["stock"];
                              $company = "";
                              if($c){
                              $stock = $c["stock"];
                              $company = ucfirst($c["title".$clang]);
                              }
                              if($s){
                              $stock = $s["stock"];
                              $company = ($company?$company." - ".$s["title"]:$s["title"]);
                              }
                              ?>
                             
                           
                            <div class="list-item align-items-center"><img class="d-block rounded me-1" src="<?=getUpUrl($p["image"])?>" alt="donuts" width="62">
                                <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove fas fa-times"  data-id="<?=$p["id"]?>" ></i>
                                    <div class="media-heading">
                                        <h6 class="cart-item-title"><a class="text-body" href="<?=getSiteUrl("product-details",$p["id"])?>"> <?=$p["name".$clang]?></a></h6>
                                        <small class="cart-item-by"><?=$c["title".$clang]?></small>
                                    </div>
                                    <div class="cart-item-qty">
                                        <div class="input-group">
                                      <input value="<?=$v["amount"]?>" data-table="cart_table"  data-id="<?=$v["id"]?>"  min="1" name="amount_cart" max="<?=$stock?>" readonly data-TouchSpin="true" type="number">
                                        </div>
                                    </div>
                                    <h5 class="cart-item-price"><?= number_format(($v["amount"]*$p["price"])) ?> <?= $_lang["currency"]?></h5>
                                </div>
                            </div>
                            <? }?>
                        </li>
                        <li class="dropdown-menu-footer">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bolder mb-0"><?= $_lang["Total"]?>:</h6>
                                <h6 class="text-primary fw-bolder mb-0"><?= number_format($price) ?> <?= $_lang["currency"]?></h6>
                            </div><a class="btn btn-primary w-100" href="<?=getSiteUrl("checkout")?>"><?= $_lang["Checkout"]?></a>
                        </li>
                    </ul>