<?php

function reverseWords($str)
{
    $words = preg_split("/([\s,'-.!?]+)/", $str, -1, PREG_SPLIT_DELIM_CAPTURE);
    $reversed = '';
    print_r($words);

    foreach ($words as $word) {
        $reversed .= preg_replace_callback('/\p{L}+/u', function ($match) {

            print_r($match);
            return strrev($match[0]);
        }, $word);
    }
    return $reversed;
}

$input = "third-part";
$output = reverseWords($input);
echo $output;