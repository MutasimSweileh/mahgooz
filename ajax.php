<?php
include "inc.php";
$action = isv("action");
$multi =  isv("multiple");
$msg  = "";
if ($action == "upload") {
    $temp = current($_FILES);
    $ismulti = is_array($temp["tmp_name"]);
    if (!$ismulti) {
        $fileCount = 1;
    } else
        $fileCount = count($temp["tmp_name"]);
    $ar = array();
    for ($i = 0; $i < $fileCount; $i++) {
        $file_name = $temp['name'];
        $file_tmp = $temp['tmp_name'];
        if ($ismulti) {
            $file_name = $temp['name'][$i];
            $file_tmp = $temp['tmp_name'][$i];
        }
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        $is_video = in_array(strtolower($file_type), array("webm", "mp4", "ogv"));
        $img = $file_name;
        if ($is_video)
            $img = str_replace($file_type, "jpg", $file_name);
        if (move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
            $ar["files"][] =  $file_name;
            $ar["urls"][] =  getSiteUrl("uploads", $img);
        }
    }
    if ($ar)
        $msg = array_merge($ar, array("st" => "success", "msg" => $_lang["Uploadedsuccessfully"]));
    else
        $msg = array("st" => "error", "msg" => $_lang["uploadingerror"]);
} else if ($action == "login") {
    $email = Cstr(isv("email"));
    $password =  Cstr(isv("password"), true);
    $sql = Sel("login", "where email='" . $email . "' and password='" . $password . "' ");
    if ($sql) {
        if (!$sql->active) {
            exit(json_encode(array('st' => "error", $password, "msg" => $_lang["accountneedsactivation"], "type_msg" => "large")));
        }
        Sion("login_id", $sql->id);
        UpDate("login", "last_login", time(), "where email='" . $email . "'");
        echo json_encode(array('st' => "success", "red" => getSiteUrl("index"), "msg" => $_lang["signedsuccessfully"], "type_msg" => "large"));
    } else
        echo json_encode(array('st' => "error", $password, "msg" => $_lang["incorrect"], "type_msg" => "large"));
} else if ($action == "forgot") {
    $email = Cstr(isv("email"));
    $password =  isv("password");
    $code = isv("code");
    if ($code) {
        $sql = Sel("login", "where forgot='" . $code . "'");
        if (!$sql) {
            echo json_encode(array('st' => "error", "msg" => $_lang["incorrectcode"], "type_msg" => "large"));
        } else {
            UpDate("login", "password", md5($password), "where forgot='" . $code . "'");
            Sion("login_id", $sql->id);
            echo json_encode(array('st' => "success", "red" => getSiteUrl("instagram-accounts"), "msg" => $_lang["resetsuccessfully"], "type_msg" => "large"));
        }
        die();
    }
    $sql = Sel("login", "where email='" . $email . "'");
    if (!$sql) {
        echo json_encode(array('st' => "error", "msg" => $_lang["emailerror"], "type_msg" => "large"));
        die();
    }
    $mail->AddAddress($email, $sql->fullname);
    $rand = md5($email) . rand(3333, 9999);
    $mail->IsHTML(true);
    $mail->Subject = "Recover your password on " . $_title;
    $mail->Body = '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="' . getSiteUrl() . '/uploads/' . $St->logo . '" /></p>
    <p>Hello, <strong>' . $sql->fullname . '</strong></p>
    <p>Recover your password on <strong>' . $St->title . '</strong></p>
    <p>The password recovery code is: <code>' . $rand . '</code></p>
    <p>Return to the site and enter the code to reset the password Or click on the link below</p>
    <p><a href="' . getSiteUrl("reset-password", $rand) . '">' . getSiteUrl("reset-password", $rand) . '</a></p>
    <p>&nbsp;</p>
    <p>Best Wishes</p>
    <p><strong>' . $St->title . '</strong></p>';
    ob_start();
    include 'inc/template/mail-reset-password.php';
    $template = ob_get_contents();
    ob_end_clean();
    $mail->Body = $template;
    if ($mail->Send()) {
        UpDate("login", "forgot", $rand, "where email='" . $email . "'");
        echo json_encode(array('st' => "success", "msg" => $_lang["sentcode"], "type_msg" => "large", "hide" => ".email", "show" => ".code"));
    } else
        echo json_encode(array('st' => "error", "msg" => $_lang["sentcodeerror"] . "<br>" . $mail->ErrorInfo, "type_msg" => "large"));
} else if ($action == "register") {
    $email = Cstr(isv("email"));
    $fullname = isv("fullname");
    $_POST["email"]  = $email;
    $_POST["date"]  = time();
    $_POST["last_login"]  = time();
    $_POST["avatar"]  = "";
    //$_POST["lang"]  = "english";
    $rand = md5($email) . rand(3333, 9999);
    $_POST["forgot"]  = $rand;
    // $_POST["active"] = 1;
    unset($_POST["agree"]);
    $sql = Sel("login", "where email='" . $email . "'");
    if ($sql) {
        echo json_encode(array('st' => "error", "msg" => $_lang["alreadyregistered"], "type_msg" => "large"));
        die();
    }
    $sql = SqlIn("login", $_POST);
    if ($sql) {
        $mail->AddAddress($email, $fullname);
        $mail->IsHTML(true);
        $mail->Subject = $_title . " Account Activation";
        $mail->Body = '<div style="max-width: 600px; margin:20px auto; background-color: #f5f5f5; border-radius: 8px;">
            <div style="padding:30px 30px 20px; border-bottom: 1px solid #e0e0e0">
                <a href="' . getSiteUrl() . '" style="color: #3b7cff; text-decoration: none; font-weight: bold;">
                    ' . $St->title . '
                </a>
            </div>
            <div style="padding: 0 30px;">
                <p>Hi ' . $fullname . ', </p><p>Please verify the email address <strong>' . $email . '</strong> belongs to you. To do so, simply click the button below.</p><div style="margin-top: 30px; font-size: 14px; color: #9b9b9b"><a style="display: inline-block; background-color: #3b7cff; color: #fff; font-size: 14px; line-height: 24px; text-decoration: none; padding: 6px 12px; border-radius: 4px;" href="' . getSiteUrl("index", "?activation=" . $rand . "&e=" . base64_encode($email)) . '">Verify Email</a></div>
                <p style="margin:30px 0; font-size: 14px; color: #828282;">
                    Thanks for using ' . $St->title . '.
                </p>
            </div>
            <div style="padding: 30px; border-radius: 0px 0px 8px 8px; background-color: #f0f0f0; border-top: 1px solid #e0e0e0;">
                <table style="border: none; border-collapse: collapse; width: 100%; table-layout: fixed; font-size: 12px; color: #9b9b9b;">
                    <tbody><tr>
                        <td style="vertical-align: top; text-align: left;">
                            <a href="' . getSiteUrl() . '" style="color: #3b7cff; text-decoration: none; font-weight: bold;">' . $St->title . '</a>
                        </td>
                        <td style="vertical-align: top; text-align: right;">
                            All rights reserved.
                        </td>
                    </tr>
                </tbody></table>
            </div>
        </div>';
        ob_start();
        include 'inc/template/mail-verify-email.php';
        $template = ob_get_contents();
        ob_end_clean();
        $mail->Body = $template;
        if ($mail->Send()) {
            // Sion("login_id",$sql);
            echo json_encode(array('st' => "success", "red" => getSiteUrl("index"), "msg" => $_lang["registeredsuccessfully"], "type_msg" => "large"));
        } else {
            // Remove("login", "where id=" . $sql);
            echo json_encode(array('st' => "error", "msg" => $_lang["sendingerror"] . "<br>" . $mail->ErrorInfo, "type_msg" => "large"));
        }
    } else
        echo json_encode(array('st' => "error", "msg" => SqlError(), "type_msg" => "large"));
} else if ($action == "get_orders") {
    $variable = getUser("orders", "");
    $columns = [];
    $variable = array_map(function ($v) use ($_lang, $clang) {
        $v["total"] = number_format($v["total"]) . " " . $_lang["currency"];
        $v["area"] = Selaa("delivery_areas", "where id=" . $v["area"])["name" . $clang];
        $v["city"] = Selaa("delivery_cities", "where id=" . $v["city"])["name" . $clang];
        return $v += ["responsive_id" => ""];
    }, $variable);
    $columns = array_map(function ($k, $v) {
        return ["data" => $k];
    }, array_keys($variable[0]), $variable);
    echo json_encode(array("data" => $variable, "columns" => $columns));
} else if ($action == "method_type") {
    $id = isv("id");
    include 'inc/template/method_type.php';
} else if ($action == "_get") {
    $id = isv("id");
    $variable = getUser($id, "where user_id=" . $_login->id);
    $columns = [];
    $variable = array_map(function ($v) use ($_lang, $clang) {
        $v["total"] = number_format($v["total"]) . " " . $_lang["currency"];
        $v["area"] = Selaa("delivery_areas", "where id=" . $v["area"])["name" . $clang];
        $v["city"] = Selaa("delivery_cities", "where id=" . $v["city"])["name" . $clang];
        return $v += ["responsive_id" => ""];
    }, $variable);
    $columns = array_map(function ($k, $v) {
        return ["data" => $k];
    }, array_keys($variable[0]), $variable);
    echo json_encode(array("data" => $variable, "columns" => $columns));
} else if ($action == "product_sizes") {
    $id = isv("id");
    $pid = isv("pid");
    $cid = isv("cid");
    $data = Selaa("products", "where id=" . $pid);
    $data = json_decode(rawurldecode($data["product_specification"]), true)[$cid];
    $html = "";
    $stock = $data["sizes"][$id]["stock"];
    echo json_encode(array('st' => "success", "html" => $html, "stock" => $stock));
} else if ($action == "product_colors") {
    $id = isv("id");
    $pid = isv("pid");
    $data = Selaa("products", "where id=" . $pid);
    $data = json_decode(rawurldecode($data["product_specification"]), true)[$id];
    $stock = $data["sizes"][0]["stock"];
    $stock = 0;
    $variable = $data["sizes"];
    $html = "";
    $index = 0;
    foreach ($variable as $k => $v) {
        if (!$v["stock"])
            continue;
        if (!$stock)
            $stock =  $v["stock"];
        $html .= '<input type="radio" ' . (!$index ? "checked" : "") . ' data-cid="' . $id . '"  data-action="product_sizes" data-pid="' . $pid . '" data-id="' . $k . '" value="' . $k . '" class="btn-check" name="product_size" id="product_size' . $k . '">
        <label type="button" for="product_size' . $k . '" class="btn btn-outline-secondary waves-effect">' . $v["size"] . '</label>';
        $index++;
    }
    //if ($variable)
    //$stock = $variable[0]["stock"];
    echo json_encode(array('st' => "success", "html" => $html, $pid, "stock" => $stock));
} else if ($action == "product_sizes2") {
    $id = isv("id");
    $sel = Sel("product_sizes", "where id=" . $id);
    $html = "";
    $stock = $sel->stock;
    echo json_encode(array('st' => "success", "html" => $html, "stock" => $stock));
} else if ($action == "product_colors2") {
    $id = isv("id");
    $pid = isv("pid");
    $sel = Sel("product_colors", "where id=" . $id);
    $stock = $sel->stock;
    $variable = getUser("product_sizes", "where stock != 0 and color_id=" . $sel->id);
    $html = "";
    foreach ($variable as $k => $v) {
        $html .= '<input type="radio" ' . (!$k ? "checked" : "") . '  data-action="product_sizes" data-id="' . $v["id"] . '" value="' . $v["id"] . '" class="btn-check" name="product_size" id="product_size' . $v["id"] . '">
        <label type="button" for="product_size' . $v["id"] . '" class="btn btn-outline-secondary waves-effect">' . $v["title"] . '</label>';
    }
    if ($variable)
        $stock = $variable[0]["stock"];
    echo json_encode(array('st' => "success", "html" => $html, "stock" => $stock));
} else if ($action == "up_notifications") {
    ob_start();
    include 'inc/template/notifications.php';
    $output = ob_get_contents();
    ob_end_clean();
    $w = "(user_id=" . $_login->id . " || user_id=0) and admin=0";
    if ($_login->role == 1)
        $w = "admin=1";
    $variable = getUser('notifications', 'where ( ' . $w . ' ) and date <= ' . time() . ' and `read`=0 order by `id` desc');
    if ($variable) {
        foreach ($variable as $key => $v) {
            if (!$v["user_id"]) {
                $done = explode(",", $v["done"]);
                if (!in_array($_login->id, $done)) {
                    $done[] = $_login->id;
                    UpDate("notifications", "done", join(",", $done), "where id=" . $v["id"]);
                }
            } else
                UpDate("notifications", "read", 1, "where id=" . $v["id"]);
        }
    }
    echo json_encode(array('st' => "success", "id" => ["#template_notifications", "#nof-read"], "template" => [$output, "0"]));
} else if ($action == "messages_list") {
    $id = isv("id");
    ob_start();
    include 'inc/template/email-user-list.php';
    $output = ob_get_contents();
    ob_end_clean();
    echo json_encode(array('st' => "success", "html" => $output, "count" => count($variable)));
} else if ($action == "load") {
    $id = isv("id");
    // ob_start();
    include 'inc/template/' . $id . '.php';
    //$output = ob_get_contents();
    // ob_end_clean();
    // echo json_encode(array('st' => "success", "html" => $output, "count" => count($variable)));
} else if ($action == "messages") {
    // echo json_encode($_POST);
    $id = isv("id");
    $admin = isv("admin");
    $sel = Sel("support", "where id=" . $id);
    UpDate("support", ($admin ? "" : "u") . "read", 1, "where id=" . $id);
    $variable2 = getUser("support", "where `uread` =0 and user_id=" . $_login->id);
    ob_start();
    include 'inc/template/messages.php';
    $output = ob_get_contents();
    ob_end_clean();
    echo json_encode(array('st' => "success", "status" => ($sel->status ? ($sel->status == 1 ? "warning" : "danger") : "success"), "messages" => $output, "id" => $id, "title" => $sel->title, "unread" => count($variable2)));
} else if ($action == "modal") {
    $table = isv("table");
    $modal = isv("modal");
    $index = isv("index");
    $data = null;
    $jsondata = isv("jsondata");
    $rawdata = isv("rawdata");
    if ($jsondata &&  isset($_POST["index"])) {
        $data = $jsondata[$index];
    }
    if ($rawdata) {
        $data = json_decode(str_replace("'", '"', $rawdata), true);
        //$data = $rawdata;
    }
    $emodal = explode("-", $modal);
    $id = isv("id");
    if (!$table) {
        $table = end($emodal);
    }
    $title = getPages($modal, false);
    if (!$title || $title["slug"] == "index")
        $title = $_lang[$emodal[0]];
    else
        $title = $title["title" . $clang];
    if ($id)
        $data = Sel($table, "where id=" . $id);
    ob_start();
    include 'inc/template/modals/' . $modal . '.php';
    $output = ob_get_contents();
    ob_end_clean();
    // print_r($data);
    echo json_encode([
        'st' => "success",
        "modal" => ["body" => $output, "data" => $data, "title" => $title]
    ]);
} else if ($action == "colorsandsizes") {
    $data = isv("data");
    $index = isv("index");
    unset($_POST["data"]);
    if ($data) {
        $data = json_decode($data, true);
    } else
        $data = [];
    if (isset($_POST["index"])) {
        unset($_POST["index"]);
        $data[$index] = $_POST;
    } else
        $data[] = $_POST;
    $_POST["data"] = $data;
    $_POST["data"] = rawurlencode(json_encode($_POST["data"]));
    ob_start();
    include 'inc/template/colorsandsizes.php';
    $output = ob_get_contents();
    ob_end_clean();
    echo json_encode(array('st' => "success", "hide" => "#slideModal", "template" => $output, "id" => "#colorsandsizes"));
} else if ($action == "applyFilters") {
    // echo json_encode($_POST);
    ob_start();
    include 'inc/template/products.php';
    $output = ob_get_contents();
    ob_end_clean();
    echo json_encode(array('st' => "success", "template" => $output, "id" => "#products", "search_results" => count($data)));
} else if ($action == "delivery_areas") {
    $id = isv("id");
    $city = Sel("delivery_cities", "where active=1 and id=" . $id);
    $variable = getUser("delivery_areas", "where active=1 and city=" . $id);
    $html = "";
    $price = $city->price;
    foreach ($variable as $k => $v) {
        $html .= '<option data-price="' . $v["price"] . '"  value="' . $v["id"] . '">' . $v["name" . $clang] . '</option>';
    }
    if ($variable)
        $price = $variable[0]["price"];
    echo json_encode(array('st' => "success", "html" => $html, "target" => "select[name=area]", "price" => $price));
} else if ($action == "cart") {
    $id = isv("id");
    $remove = isv("remove");
    $sel = Sel("cart", "where product_id=" . $id . " and user_id=" . $_login->id . " and  product_size='" . isv("product_size") . "' and  product_color='" . isv("product_color") . "' ");
    unset($_POST["action"]);
    unset($_POST["id"]);
    $_POST["product_id"] = $id;
    $_POST["user_id"] = $_login->id;
    if ($remove) {
        Remove("cart", "where id=" . $id);
        echo json_encode(array('st' => "error", "title" => "", "btnmsg" => $_lang["Addcart"], "msg" => $_lang["removedCart"], "type_msg" => "large"));
    } else {
        if (!$sel || $sel->product_size != $_POST["product_size"] &&  $sel->product_color != $_POST["product_color"]) {
            if (!$_POST["amount"]) {
                exit(json_encode(['st' => "error", "title" => "", "msg" => $_lang["productnotinstock"]]));
            }
            SqlIn("cart", $_POST);
            echo json_encode(array('st' => "success", "title" => "", "btnmsg" => $_lang["removeCart"], "msg" => $_lang["AddedCart"], "type_msg" => "large"));
        } else {
            echo json_encode(array('st' => "error", "title" => "", "msg" => $_lang["alreadyCart"], "type_msg" => "large"));
        }
    }
    // UpDate("login","cart",join(",",$cart),"where id=".$_login->id);
} else if ($action == "cancel-order") {
    $id = isv("id");
    // $sel = Sel("orders","where id=".$id);
    UpDate("orders", "status", 1, "where id=" . $id);
    echo json_encode(array('st' => "success", "msg" => $_lang["ordercanceled"]));
    //}
} else if ($action == "wishlist") {
    $id = isv("id");
    $cart = explode(",", $_login->wishlist);
    if (in_array($id, $cart)) {
        unset($cart[array_search($id, $cart)]);
        echo json_encode(array('st' => "error", "title" => "", "msg" => $_lang["removedwishlist"], "type_msg" => "large"));
    } else {
        $cart[] = $id;
        echo json_encode(array('st' => "success", "title" => "", "msg" => $_lang["Addedwishlist"], "type_msg" => "large"));
    }
    UpDate("login", "wishlist", join(",", $cart), "where id=" . $_login->id);
} else if ($action == "support") {
    $message = isv("message");
    $d = ["message" => $message, "user_id" => isv("user_id"), "date" => time()];
    if (isset($_FILES["attach"]) && $_FILES["attach"]["tmp_name"]) {
        $file_tmp = $_FILES["attach"]["tmp_name"];
        $file_type = pathinfo($_FILES["attach"]["name"], PATHINFO_EXTENSION);
        $file_name = $_FILES["attach"]["name"] . time() . "." . $file_type;
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        $d["attach"] = $file_name;
    }
    if (!trim(strip_tags($message))) {
        exit(json_encode(array('st' => "error", "msg" => $_lang["entermessage"], "data" => $_POST)));
    } else {
        unset($_POST["message"]);
    }
    $ids = isv("user_ids");
    if (!$ids)
        $ids = [isv("user_id")];
    unset($_POST["user_ids"]);
    foreach ($ids as $key => $value) {
        $_POST["user_id"] = $value;
        $sql = SqlIn($action, $_POST);
        if ($sql) {
            $d["support_id"] = $sql;
            $sql = SqlIn("support_messages", $d);
        }
    }
    if ($sql) {
        echo json_encode(array('st' => "success", "red" => getSiteUrl("support"), "msg" => $_lang["Sentsuccessfully"], "type_msg" => "large"));
    } else {
        echo json_encode(array('st' => "error", "msg" => $_lang["savingerror"], "error" => SqlError(), "data" => $_POST));
    }
} else if ($action == "payments") {
    $id = isv("user_id");
    $_POST["total"] = str_replace(",", "", $_POST["total"]);
    if ($_login->money < $_POST["total"])
        exit(json_encode(['st' => "error", "msg" => $_lang["validMax"], "data" => $_POST]));
    UpDate("login", "-money", $_POST["total"], "where id=" . $id);
    $sql = SqlIn("payments", $_POST);
    if ($sql) {
        echo json_encode(array('st' => "success", "msg" => $_lang["Paymentsentsuccessfully"], "type_msg" => "large"));
    } else {
        echo json_encode(array('st' => "error", "msg" => $_lang["Paymentsenterror"], "error" => SqlError(), "data" => $_POST));
    }
} else if ($action == "Coupon") {
    $coupon = isv("coupon");
    if (!$coupon)
        exit(json_encode(array('st' => "error", "msg" => $_lang["couponempty"])));
    $sql = Sel("coupons", "where code='" . $coupon . "' and active=1");
    if ($sql) {
        if ($sql->date &&  $sql->date < time()) {
            echo json_encode(array('st' => "error", "msg" => $_lang["couponexpired"]));
        } else
            echo json_encode(array('st' => "success", "msg" => $_lang["couponesuccess"]));
    } else {
        echo json_encode(array('st' => "error", "msg" => $_lang["couponerror"], "error" => SqlError()));
    }
} else if ($action == "orders") {
    $products = isv("products");
    unset($_POST["products"]);
    $sql = SqlIn($action, $_POST);
    $_order = $sql;
    if ($sql) {
        foreach ($products as $key => $value) {
            $value["order_id"] = $sql;
            SqlIn("orders_products", $value);
        }
        Remove("cart", "where user_id=" . $_login->id);
        echo json_encode(array('st' => "success", $_POST, "red" => getSiteUrl("orders"), "msg" => $_lang["Savedsuccessfully"], "type_msg" => "large"));
    } else {
        echo json_encode(array('st' => "error", "msg" => $_lang["savingerror"], "error" => SqlError(), "data" => $_POST));
    }
} else if ($action == "update") {
    $table = isv("table");
    $id = isv("id");
    $add = isv("add");
    $duble = isv("duble");
    if (is_array(isv("update"))) {
        $update = isv("update");
    } else
        $update = json_decode(str_replace("'", '"', isv("update")), true);
    if ($add) {
        $sel = Selaa($table, "where id=" . $id);
        foreach ($update as $key => $value) {
            if ($sel[$key])
                if (!$duble && strpos($sel[$key], $value) !== false)
                    $update[$key] = $sel[$key];
                else
                    $update[$key] = $sel[$key] . $add . $value;
        }
    }
    $sql = upDate($table, $update, "", "where id=" . $id);
    if ($sql) {
        echo json_encode(array('st' => "success", "data" => $update, "msg" => $_lang["Savedsuccessfully"]));
    } else
        echo json_encode(array('st' => "error", "data" => $_POST, "msg" => $_lang["savingerror"], "error" => SqlError()));
} else if ($action == "remove") {
    $table = isv("table");
    $id = isv("id");
    $where = isv("where");
    $type = isv("type");
    $template = isv("template");
    $str = "";
    $sel = null;
    if ($table == "payments") {
        $sel = Sel("payments", "where id=" . $id);
    }
    if (count(explode(",", $id)) > 1) {
        foreach (explode(",", $id) as $key => $value) {
            $str = " id=" . $value;
            $sql = Remove($table, "where " . $str);
        }
    } else {
        if ($id)
            $str = " id=" . $id;
        if ($where) {
            $where = json_decode(str_replace("'", '"', $where), true);
            foreach ($where as $k => $v) {
                $str .= ($str ? "and" : "") . " " . $k . "='" . $v . "'";
            }
        }
        $sql = Remove($table, ($str ? "where " . $str : ""));
    }
    if ($sql) {
        if ($template) {
            ob_start();
            include 'inc/template/' . $template . '.php';
            $template = ob_get_contents();
            ob_end_clean();
        }
        if ($table == "payments" && $sel && $sel->status == 0) {
            UpDate("login", "+money", $sel->total, "where id=" . $sel->user_id);
        }
        echo json_encode(array('st' => "success", "msg" => $_lang["Removedsuccessfully"], "template" => $template));
    } else
        echo json_encode(array('st' => "error", "msg" => $_lang["removingerror"], "error" => SqlError()));
} else {
    $old_password = isv("old_password");
    $template = isv("template");
    $message = isv("message");
    $data_id = isv("data_id");
    if (!$data_id)
        $data_id = isv("id");
    $type = isv("data_type");
    $remove_avatar = isv("remove_avatar");
    $action = str_replace("_table", "", $action);
    unset($_POST["old_password"]);
    unset($_POST["template"]);
    unset($_POST["action"]);
    unset($_POST["data_id"]);
    unset($_POST["cpassword"]);
    unset($_POST["data_type"]);
    unset($_POST["fileUploader"]);
    unset($_POST["insta_post"]);
    unset($_POST["remove_avatar"]);
    foreach ($_POST as $k => $v) {
        if (is_array($_POST[$k])) {
            // convert_img($_POST[$k]);
            $_POST[$k] = convert_img($_POST[$k]);
            // $_POST[$k] = rawurlencode(json_encode($_POST[$k]));
        } else
        if (strpos($k, "typeahead") !== false)
            unset($_POST[$k]);
        else if (strpos($v, "base64")  !== false) {
            list($type, $data) = explode(';', $v);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $type = explode("/", $type);
            $type = end($type);
            $file_name = "file" . time() . "." . $type;
            file_put_contents('uploads/' . $file_name, $data);
            $_POST[$k] = $file_name;
        }
        if ($k == "price" || $k == "total" || $k == "money")
            $_POST[$k] = str_replace(",", "", $_POST[$k]);
    }
    if (isset($_POST["password"]) && trim($_POST["password"]) == "")
        unset($_POST["password"]);
    if ($remove_avatar)
        $_POST["avatar"] = "blank.png";
    foreach ($_FILES as $key => $value) {
        $file_tmp = $_FILES[$key]["tmp_name"];
        if (!$file_tmp)
            continue;
        $file_type = pathinfo($_FILES[$key]["name"], PATHINFO_EXTENSION);
        $file_name = "file" . time() . "." . $file_type;
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        $_POST[$key] = $file_name;
    }
    if (1 == 2)
        if (isset($_FILES["avatar"]) && $_FILES["avatar"]["tmp_name"]) {
            $file_tmp = $_FILES["avatar"]["tmp_name"];
            $file_type = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
            $file_name = "avatar" . time() . "." . $file_type;
            move_uploaded_file($file_tmp, "uploads/" . $file_name);
            $_POST["avatar"] = $file_name;
        }
    if (array_key_exists("message", $_POST) && !trim(strip_tags($message))) {
        exit(json_encode(array('st' => "error", "msg" => $_lang["entermessage"], "data" => $_POST)));
    } else if (array_key_exists("message", $_POST)) {
        $support_id = isv("support_id");
        UpDate("support", "status", $_POST["status"], "where id=" . $support_id);
        unset($_POST["status"]);
    }
    if (isset($_FILES["attach"]) && $_FILES["attach"]["tmp_name"]) {
        $file_tmp = $_FILES["attach"]["tmp_name"];
        $file_type = pathinfo($_FILES["attach"]["name"], PATHINFO_EXTENSION);
        $file_name = $_FILES["attach"]["name"] . time() . "." . $file_type;
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        $_POST["attach"] = $file_name;
    }
    if ($data_id) {
        if ($old_password) {
            $sql = Sel($action, "where id=" . $data_id);
            if ($sql->password != md5($old_password)) {
                echo json_encode(array('st' => "error", "msg" => $_lang["currentpasswordincorrect"]));
                die();
            }
        }
        $sql = UpDate($action, $_POST, null, "where id=" . $data_id);
    } else {
        $sql = SqlIn($action, $_POST);
        $data_id = $sql;
    }
    if ($sql) {
        if ($template) {
            ob_start();
            include 'inc/template/' . $template . '.php';
            $template = ob_get_contents();
            ob_end_clean();
        }
        echo json_encode(array('st' => "success", "data" => $_POST, "msg" => $_lang["Savedsuccessfully"], "template" => $template, "id" => $data_id));
    } else
        echo json_encode(array('st' => "error", "msg" => $_lang["savingerror"], "error" => SqlError()));
}
function addNof($data)
{
    $data += ["icon" => "", "type" => "success", "active" => 1, "date" => time()];
    if ($data["icon"] && strpos($data["icon"], "<i")  === false) {
        $data["icon"] = "<i data-feather='" . $data["icon"] . "'></i>";
    }
    SqlIn("notifications", $data);
    _sendPush($data);
}
if ($action == "notifications") {
    _sendPush($_POST);
}
function _sendPush($data)
{
    global $St;
    $data += ["user_id" => 0, "admin" => 0];
    $user_id = $data["user_id"];
    $ids = [];
    $content = [
        "msg" => ["en" => $data["description"], "ar" => $data["description_arabic"]],
        "title" => ["en" => $data["title"], "ar" => $data["title_arabic"]],
        "link" => $data["link"]
    ];

    $interface = $St->lang;
    if ($user_id) {
        $sel = Sel("login", "where id=" . $user_id);
        if ($sel->push_id) {
            $ids = array_filter(explode(",", $sel->push_id));
        }
        if ($sel->lang)
            $interface = $sel->interface;
    } else {
        $variable = getUser("login", "where push_id !='' and active=1 " . ($data["admin"] ? " and role=1" : ""));
        foreach ($variable as $key => $value) {
            $ids += array_filter(explode(",", $value["push_id"]));
        }
    }

    if ($interface == "_arabic") {
        $content["msg"]["en"] = $content["msg"]["ar"];
        $content["title"]["en"] = $content["title"]["ar"];
    } else {
        unset($content["msg"]["ar"]);
        unset($content["title"]["ar"]);
    }
    if ($user_id && $ids || !$user_id) {
        $res = sendPushMessage($ids, $content);
        //echo "<pre>";
        //  print_r($res);
    }
}
$ar = ["support_messages", "payments", "comments", "orders", "products", "cancel-order"];
if (in_array($action, $ar)) {
    $order_id = isv("order_id");
    $user_id = isv("user_id");
    $status = isv("status");
    $support_id = isv("support_id");
    $active = isv("active");
    $id = (isset($data_id) ? $data_id : isv("id"));
    $id = (isset($_order) ? $_order : $id);
    $data = [
        "icon" => "message-square",
        "title" => "New comment",
        "description" => "A new comment has been added to order #" . $order_id,
        "title_arabic" => "تعليق جديد",
        "description_arabic" => "تم اضافة تعليق جديد على طلب #" . $order_id,
        "admin" => ($_login->role == 1 ? 0 : 1)
    ];
    switch ($action) {
        case  "orders":
            if ($_login->role == 1) {
                $sel = Sel("orders", "where id=" . $id);
                $s = orderStatus($status);
                $data["icon"] = "shopping-cart";
                $data["title"] = "Orders";
                $data["description"] = "Your order has been " . $s["etitle"] . " #" . $id;
                $data["title_arabic"] = "الطلبات";
                $data["description_arabic"] = "الطلب الخاص بك  " . $s["atitle"] . " #" . $id;
                $data["user_id"] = $user_id;
                $data["type"] = $s["class"];
                $data["link"] = getSiteUrl("order-preview", $id);
                if ($status == 3) {
                    $commission = $sel->commission;
                    $pr = getUser("orders_products", "where order_id=" . $id);
                    if ($pr) {
                        $pr2 = 0;
                        $prices = 0;
                        foreach ($pr as $v2) {
                            $pr2 = selaa("products", "where id=" . $v2["product_id"]);
                            if ($pr2 && $pr2["user_id"]) {
                                $pr2["price"] -=  (($St->commission * $pr2["price"]) / 100) * $v2["amount"];
                                UpDate("login", "+money", $pr2["price"], "where id=" . $pr2["user_id"]);
                            }
                            if ($pr2) {
                                if ($pr2["product_specification"]) {
                                    $data3 = json_decode(rawurldecode($pr2["product_specification"]), true);
                                    $data3[$v2["product_color"]]["sizes"][$v2["product_size"]]["stock"] -= $v2["amount"];
                                    $Stock = $data3[$v2["product_color"]]["sizes"][$v2["product_size"]]["stock"];
                                    $data3 = rawurlencode(json_encode($data3));
                                    UpDate("products", "product_specification",  $data3, "where id=" . $v2["product_id"]);
                                } else {
                                    $Stock =  $pr2["stock"] - $v2["amount"];
                                    UpDate("products", "-stock", $v2["amount"], "where id=" . $v2["product_id"]);
                                }
                                if (!$Stock) {
                                    $d = [
                                        "icon" => "box",
                                        "title" => "Products",
                                        "description" => "Please note, product is out of stock #" . $v2["product_id"],
                                        "title_arabic" => "المنتجات",
                                        "description_arabic" => "برجاء الانتباه ، نفذ المنتج من المخزن #" . $v2["product_id"],
                                        "admin" => 1,
                                    ];
                                    $d["link"] = getSiteUrl("site-products", "1/" . $v2["product_id"]);
                                    addNof($d);
                                    if ($pr2["user_id"]) {
                                        $d["admin"] = 0;
                                        $d["user_id"] = $pr2["user_id"];
                                        addNof($d);
                                    }
                                }
                            }
                        }
                    }
                    UpDate("login", "+money", $commission, "where id=" . $user_id);
                }
            } else if (isset($_order)) {
                $data["icon"] = "shopping-cart";
                $data["title"] = "Orders";
                $data["title_arabic"] = "الطلبات";
                $data["description"] = "A new order has been added #" . $id;
                $data["description_arabic"] = "تم اضافة طلب  جديد  #" . $id;
                $data["type"] = "success";
                $data["admin"] = 1;
                $data["link"] = getSiteUrl("order-preview", $id);
            }
            break;
        case  "cancel-order":
            $data["icon"] = "shopping-cart";
            $data["title"] = "Orders";
            $data["title_arabic"] = "الطلبات";
            $data["description"] = "Order #$id has been cancelled ";
            $data["description_arabic"] = "تم الغاء الطلب رقم  $id ";
            $data["type"] = "success";
            $data["admin"] = 1;
            $data["link"] = getSiteUrl("order-preview", $id);
            break;
        case  "support_messages":
            $data["icon"] = "twitch";
            $data["title"] = "Support";
            $data["description"] = "Support ticket has been answered #" . $support_id;
            $data["title_arabic"] = "الدعم";
            $data["description_arabic"] = "تم الرد على تذكرة الدعم  #" . $support_id;
            $data["user_id"] = Sel("support", "where id=" . $support_id)->user_id;
            $data["link"] = getSiteUrl("support");
            break;
        case  "payments":
            if ($_login->role == 1) {
                $s = payStatus($status);
                $data["icon"] = "credit-card";
                $data["title"] = "Payment Request";
                $data["description"] = "Your payment request has been " . $s["etitle"] . " #" . $id;
                $data["title_arabic"] = "طلب الدفع";
                $data["description_arabic"] = "طلب الدفع الخاص بك  " . $s["atitle"] . " #" . $id;
                $data["user_id"] = $user_id;
                $data["type"] = $s["class"];
            }
            break;
        case  "products":
            $s = [
                "etitle" => ($active ? $_allLang["english"]["Activated"] : $_allLang["english"]["inactive"]),
                "atitle" => ($active ? $_allLang["_arabic"]["Activated"] : $_allLang["_arabic"]["inactive"]),
                "class" => ($active ? "success" : "danger")
            ];
            $data["icon"] = "box";
            $data["title"] = "Products";
            $data["description"] = "Your product has been " . $s["etitle"] . " #" . $id;
            $data["title_arabic"] = "المنتجات";
            $data["description_arabic"] = "المنتج الخاص بك  " . $s["atitle"] . " #" . $id;
            $data["user_id"] = Sel("products", "where id=" . $id)->user_id;
            $data["type"] = $s["class"];
            $data["link"] = getSiteUrl("site-products");
            break;
        default:
            $data["link"] = getSiteUrl("order-preview", $order_id);
            $data["user_id"] = Sel("orders", "where id=" . $order_id)->user_id;
            break;
    }
    if ($id || $order_id || $support_id || isset($_POST["status"]) && $id)
        addNof($data);
}
if ($msg)
    echo json_encode($msg);
