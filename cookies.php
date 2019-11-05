<?php
function set_cookies($cached_page_name) {
    if (!isset($_COOKIE["LRU"])) {
        setcookie("LRU", " ", time() + 60 * 60 * 24 * 5);
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
        setcookie("LRU", " ", time() + 60 * 60 * 24 * 5);
    }
    $LRUCache = json_decode($_COOKIE["LRU"], true);
    echo "<aside class=\"LRU\">";
    echo "<p>Last five previously visited pages</p>";
    $pages = array();
    foreach ($LRUCache as $page_name => $page_cached_time) {
        $pages[$page_cached_time] = $page_name;
    }
    krsort($pages);
    foreach ($pages as $page_cached_time => $page_name) {
        echo "<br><a href=" . $page_name . ".php>" . $page_name . "</a><br>";
    }
    echo "</aside>";
}

function add_product_view_count($product_name) {
    if (!isset($_COOKIE["product_view_count"])) {
        setcookie("product_view_count", " ", time() + 60 * 60 * 24 * 5);
    }
    $products = json_decode($_COOKIE["product_view_count"], true);
    $products[$product_name] += 1;
    $products = json_encode($products);
    setcookie("product_view_count", $products, time() + 60 * 60 * 24 * 5);
}

function get_product_view_count() {
    if (!isset($_COOKIE["product_view_count"])) {
        setcookie("product_view_count", " ", time() + 60 * 60 * 24 * 5);
    }
    $products = json_decode($_COOKIE["product_view_count"], true);
    echo "<aside class=\"product\">";
    echo "<p>Last five most visited pages</p>";
    asort($products);
    $index = 0;
    foreach ($products as $product_name => $product_count) {
        echo "<br><a href=" . $product_name . ".php>" . $product_name . ": " . $product_count . " views</a><br>";
        $index += 1;
        if($index == 5) {
            break;
        }
    }
    echo "</aside>";
}
?>