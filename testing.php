<?php
    // Error Control (@)
    // When this precedes a command, errors generated are ignored (allows custom messages)
    // require, include, require_once, include_once
    $my_array = array(1, 2, 3, 4, 5);
    $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
    $pieces = explode(" ", $pizza);
    
    $my_text_array = array("first"=>1, "second"=>2, "third"=>3, 3=>"third");
    print_r($my_text_array[3]); // third
    
    // multi array and print_r
    $multiD = array 
    (
        "fruits"  => array("myfavorite" => "orange", "yuck" => "banana", "yum" => "apple"),
        "numbers" => array(1, 2, 3, 4, 5, 6),
        "holes"   => array("first", 5 => "second", "third")
    );
    
    print_r($multiD); 
    // Array ( [fruits] => Array 
    // ( [myfavorite] => orange [yuck] => banana [yum] => apple ) 
    //   [numbers] => Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 ) 
    //   [holes] => Array ( [0] => first [5] => second [6] => third ) )

    print("<br>");
    
    // Array functions
    // array_flip() swaps keys for values
    // array_count_values() returns an associative array of all values in an array, and their frequency
    // array_rand() pulls a random element
    // array_unique() removes duppies
    // array_walk() applies a user defined function to each element of an array (so you can dice all of a dataset)
    // count() returns the number of elements in an array
    // array_search() returns the key for the first match in an array

    // Read file and print it
    $items = file("./testing.txt");
    foreach ($items as $line)
    {
        $line = str_replace("\n", "", $line);
        $line = explode("\t", $line);
        print_r($line);
        print("<br>");
    }

    // Useful string functions
    // str_replace()
    // trim(), ltrim(), rtrim()
    // implode(), explode()
    // addslashes(), stripslashes()
    // htmlentities(), html_entity_decode(), htmlspecialchars()
    // striptags()

    define("Constant", 5);
    print(Constant); // 5
    
    $arr[0] = "first";
    $arr[] = "second";
    print_r($arr); // Array ( [first] => 1 [second] => 2 [third] => 3 )
    
    // print array 
    $arr["first"] = 1;
    $arr["second"] = 2;
    $arr["third"] = 3;
    print_r($arr);
    for (reset($arr); $element = key($arr); next($arr)) {
        print("<br>" . $arr[$element]); // 1
    }
    foreach ($arr as $key => $value) {
        print("<br> key: " . $key . " value: " . $value); // key: first value: 1
    }
    
    // strcmp 
    print("<br> " . strcmp("aa", "ab")); // -1
    print("<br> " . strcmp("bb", "ab")); // 1
    
    if( preg_match("(Kun)", "Kun Su", $matches)) {
        print("<br> Found Kun, matches:  <br>");
        print_r($matches); // Array ( [0] => Kun )
    }
    
    // Regular Expressions 
    
    if( preg_match("([a-zA-Z]*)", "Kun Su", $matches)) {
        print("<br> Found Kun, matches:  <br>");
        print_r($matches);
    }
    // ^ matches the beginning of the String
    // $ matches the end of the String
    // [a-zA-Z]* matches a-Z with 0 to *
    // [[:<;]]
    // [[:>;]]
    // eregi <= case insensitive
    // Quantifier 
    // {n} exactly n times
    // {n, m} n to m inclusive
    // {n, } n or more
    // ? 0 or 1
    
    // Set cookie and get cookie
    $VALUE = "Kun Su";
    setcookie("NAME", $VALUE, time() + 60 * 60 * 24 * 5);
    foreach ($_COOKIE as $key => $value) {
        print("<br> key: " . $key . " value: " . $value);
    }
    
    
    $phone = "(669)225-5140\n";
    $regx = "(^\([0-9]{3}\)[0-9]{3}-[0-9]{4}$)";
    if (preg_match($regx, $phone)) {
        print("<br> Valid phone<br>"); // Valid phone
    }
    
    chop($phone); // remove the new line at the end of the line
    
    // $ and $$
    $a = 'hello';
    $$a = 'world';
    echo "$a ${$a}"; // hello world
    echo "$a $hello"; // hello world
    
    // == and ===
    var_dump(0 == "a"); // 0 == 0 -> true
    var_dump("1" == "01"); // 1 == 1 -> true
    var_dump("10" == "1e1"); // 10 == 10 -> true
    var_dump(100 == "1e2"); // 100 == 100 -> true
    
    switch ("a") {
        case 0:
            echo "0";
            break;
        case "a": // never reached because "a" is already matched with 0
            echo "a";
            break;
    }

    $a = "a";
    echo "<br>";
    print($a / 1);
    $v1 = "2%";
    $v2 = "8%";
    echo "<br>";
    print($v1);
    echo "<br>";
    print($v2);
    echo "<br>";
    print($v2 + $v1);
    echo "<br>";
    $Exam = 10 + $v2 + $v1;
    print("<br> Exam: " . $Exam);
    switch($a) {
        case 0:
            print("<br> 0000");
            break;
        case "a":
            print("<br> aaaa"); 
            break;
    }
?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<body>
<canvas id=“canvas” width=“150” height=“150”>
</canvas>


</body>
</html> -->