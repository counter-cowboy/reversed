<?php

function reverseWords($str)
{

    $words = preg_split("/([\s,'-.!?]+)/", $str, -1, PREG_SPLIT_DELIM_CAPTURE);
    $reversed = '';
    print_r($words);

    foreach ($words as $word) {
        $reversed .= preg_replace_callback('/\p{L}+/u', function ($match) {
            return reverseWordWithCasePreservation($match[0]);
        }, $word);
    }

    return $reversed;
}

function reverseWordWithCasePreservation($word)
{
    $length = strlen($word);
    $position = [];

    for ($i = 0; $i < $length; $i++) {
        if (ctype_upper($word[$i])) {
            $position[] = $i;
        }
    }

    $reversed = strtolower(strrev($word));

    foreach ($position as $pos) {
        $reversed[$pos] = strtoupper($reversed[$pos]);
    }

    return $reversed;
}
$input = "heLLo, World!";
$output = reverseWords($input);
echo $output;