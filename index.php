<?php
include "inc.php";
if ($Gapp == "get") {
    if (isv("json") && isv("json") != "false")
        header('Content-Type: application/json; charset=utf-8');
} else
    include "inc/header.php";
/*Sion("user_id",false); */
if (isv("activation")) {
    $sql = Sel("login", "where `forgot` ='" . isv("activation") . "'");
    if (!$sql) {
        $_msg = (array('st' => "error", "msg" => $_lang["incorrectactivation"], "type_msg" => "large"));
    } else {
        Sion("login_id", $sql->id);
        UpDate("login", "active", 1, "where `forgot` ='" . isv("activation") . "'");
        $_msg = array('st' => "success", "red" => getSiteUrl("index"), "msg" => $_lang["activationsuccessfully"], "type_msg" => "large");
    }
    // print_r($sql);
    //die();
} else
if (Sion("redirect") && !isv("redirect") && $_page->auth && $Gapp) {
    $redirect = Sion("redirect");
    Sion("redirect", false);
    header("Location: " . getSiteUrl($redirect));
    exit();
} else if (isv("redirect"))
    Sion("redirect", isv("redirect"));

if ($Gapp == "sign-out") {
    Sion("login_id", false);
    Sion("user_id", false);
    header("Location: " . getSiteUrl("index"));
    exit();
}
if (!$Gapp || ($Gapp == "login" &&  $_login)) {

    if ($St->maintenance)
        header("Location: " . getSiteUrl("under-maintenance"));
    else
        header("Location: " . getSiteUrl("index"));
    exit();
}
if (!$_login && $_page->auth) {
    $slug = $_page->slug;
    if ($_id)
        $slug .= "/" . $_id;
    header("Location: " . getSiteUrl("login", "?redirect=" . $slug));
    exit();
}

if ($_login && $_page->role != "" && !in_array($_login->role, explode(",", $_page->role))) {
    header("Location: " . getSiteUrl("index"));
    exit();
}
if ($Gapp && $Gapp != "index") {
    include "inc/" . $Gapp . ".php";
} else {
    include "inc/index.php";
}

?>

<?php if ($Gapp != "get")  include "inc/footer.php";
?>
