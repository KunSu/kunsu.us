<?php
function set_cookies($cached_page_name) {
    if (!isset($_COOKIE["LRU"])) {
        $temp = array();
        setcookie("LRU", json_encode($temp), time() + 60 * 60 * 24 * 5);
    }
    $LRUCache = json_decode($_COOKIE["LRU"], true);
    if (array_key_exists($cached_page_name, $LRUCache)) {
        unset($LRUCache[$cached_page_name]);
    }
    if (count($LRUCache) == 5) {
        array_shift($LRUCache);
    } 
    $LRUCache[$cached_page_name] = time();
    $LRUCache = json_encode($LRUCache);
    setcookie("LRU", $LRUCache, time() + 60 * 60 * 24 * 5);
}

function get_cookies() {
    if (!isset($_COOKIE["LRU"])) {
        $temp = array();
        setcookie("LRU", json_encode($temp), time() + 60 * 60 * 24 * 5);
    }
    $LRUCache = json_decode($_COOKIE["LRU"], true);
    echo '<aside class="LRU">';
    echo "<p>Last five previously visited pages</p>";
    $pages = array();
    foreach ($LRUCache as $page_name => $page_cached_time) {
        $pages[$page_cached_time] = $page_name;
    }
    krsort($pages);
    foreach ($pages as $page_cached_time => $page_name) {
        $url = str_replace(' ', '%20', $page_name);
        echo "<br><a href=" . $url . ".php>" . $page_name . "</a><br>";
    }
    echo "</aside>";
}

function add_product_view_count($product_name) {
    if (!isset($_COOKIE["product_view_count"])) {
        $temp = array();
        setcookie("product_view_count", json_encode($temp), time() + 60 * 60 * 24 * 5);
    }
    $products = json_decode($_COOKIE["product_view_count"], true);
    $products[$product_name] += 1;
    $products = json_encode($products);
    setcookie("product_view_count", $products, time() + 60 * 60 * 24 * 5);
}

function get_product_view_count() {
    if (!isset($_COOKIE["product_view_count"])) {
        $temp = array();
        setcookie("product_view_count", json_encode($temp), time() + 60 * 60 * 24 * 5);
    }
    $products = json_decode($_COOKIE["product_view_count"], true);
    echo '<aside class="product">';
    echo "<p>Last five most visited pages</p>";
    asort($products);
    $index = 0;
    foreach ($products as $product_name => $product_count) {
        $url = str_replace(' ', '%20', $product_name);
        echo "<br><a href=" . $url . ".php>" . $product_name . ": " . $product_count . " views</a><br>";
        $index += 1;
        if($index == 5) {
            break;
        }
    }
    echo "</aside>";
}
?>