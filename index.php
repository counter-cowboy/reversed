<?php

function reverseWords($str)
{
    $words=preg_split("([\s,.!?]+)", $str, -1, PREG_SPLIT_DELIM_CAPTURE);
    $reversed='';

    foreach ($words as $word) {
        $reversed.=
    }
}