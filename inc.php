<?php
@ob_start();
@session_start();
$lang = "_arabic";
$clang = "";
include "inc/config.php";
include "inc/lang.php";
include "inc/function.php";
//require("inc/class.phpmailer.php");
include "src/stichoza/vendor/autoload.php";

use Stichoza\GoogleTranslate\GoogleTranslate;

$GoogleTranslate = new GoogleTranslate();
$GoogleTranslate->setSource('ar');
$GoogleTranslate->setTarget('en');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/phpmailer/vendor/autoload.php';
$St = getSet();
if ($St->icon) {
    if (strpos($St->icon, "svg") === false && 1 == 2) {
        $St->icon2 = $St->icon;
        $St->icon = '<img src="' . getUpUrl($St->icon) . '" width="60"  alt="' . $St->title . '">';
    }
}
$mail = new PHPMailer(true);
$mail->IsSMTP(); // Using SMTP.
//$mail->SMTPDebug = 1;
$mail->SMTPAuth = false; // Enables SMTP authentication.
$mail->Host = "localhost"; // GoDaddy support said to use localhost
$mail->Port = 25;
$mail->CharSet = 'UTF-8';
$mail->SMTPSecure = 'none';
//havent read yet, but this made it work just fine
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$_title = explode("|", explode("-", $St->title)[0])[0];
$_Atitle = explode("-", $St->title)[1];
$mail->SetFrom('contact@mahgooz.com', $_title);

$_msg = "";
$jsonData = [];
$lang = ($St->lang ? $St->lang : "_arabic");
$interface = ($St->interface ? $St->interface : "light");
$Gapp = isv("app");
$script = "";
$Gtype = isv("type");
$_id = isv("id");
$redirect = isv("redirect");
$_site = getSiteUrl();
$_page = getPages();
$_pageAr = jsonOut($_page);
$_St = jsonOut($St);
$_login = json_decode("[]");
$pname = pathinfo(basename($_SERVER["PHP_SELF"]))["filename"];
$user_id = Sion("user_id");
$login_id = Sion("login_id");
if ($_page)
    $_redirect = getSiteUrl($_page->slug, $_id);
if ($login_id) {
    $_login = Sel("login", "where id=" . $login_id);
    if (!$_login || !$_login->active) {
        $_msg = ['st' => "error", $password, "msg" => $_lang[$lang]["accountneedsactivation"], "type_msg" => "large"];
        $_login = json_decode("[]");
        $login_id = null;
    }
    $lang = ($_login && $_login->lang ? $_login->lang : $lang);
    $interface = ($_login && $_login->interface ? $_login->interface : $interface);
}
if (isv("lang", 1)) {
    $lang = Sion("lang", isv("lang"));
    if ($_login) {
        UpDate("login", "lang", $lang, "where id=" . $login_id);
    }
    if (isv("redirect") && $login_id)
        header("Location: " . getSiteUrl(isv("redirect")));
    exit();
}
if ($lang !=  "english")
    $clang = "_arabic";
$_allLang = $_lang;
$_lang =  $_lang[$lang];
/* $json = json_decode(trim(file_get_contents("manychat.txt")),true);
foreach ($json["areas"] as $key => $value) {
    $value ["name_arabic"] = $value["Name"];
    $value ["city"] = $_id;
    //$value ["name"] = $GoogleTranslate->translate($value["Name"]);
    $value ["name"] = $value["Name"];
    unset($value["Name"]);
    SqlIn("delivery_areas",$value);
}
print_r($json["areas"]);
die(); */
//die();