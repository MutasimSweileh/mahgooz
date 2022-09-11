<?php
include "inc.php";

$action = isv("action");
if ($action == "feedback") {
    echo json_encode($_POST);
}
