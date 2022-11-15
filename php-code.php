<?php
require_once '../site/wp-load.php';
require_once '../common/gtgmember/index.php';

$geolocation = get_geolocation_information();
$current_date = new DateTime("now", new DateTimeZone('America/New_York'));

if (($current_date->format('Y-m-d H:i:s') < '2021-05-20 00:00:00' || $current_date->format('Y-m-d H:i:s') > '2021-05-23 03:00:00') && !isset($_GET['soldout'])) {
    header("Location: https://www.howtogettheguy.com/texting/");
    exit();
}

$cart_link = 'https://members.howtogettheguy.com/checkout/?rid=pi8x4I';
$token = filter_input(INPUT_GET, 'token');

if ($token) {
    $cart_link = add_query_arg(['token' => $token, 'confirmpurchase' => 1, 'recommended' => 1], $cart_link);
}

$contact_id = filter_input(INPUT_GET, 'id');

if (isset($contact_id)) {
    $contact_information = get_contact_information($contact_id);
}

if (!empty($contact_information)) {
    $cart_link .= '&id=' . $contact_id;
}
?>
