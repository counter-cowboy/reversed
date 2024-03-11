<?php

function reverseWords($str)
{
    // разбиваем входящую строку на слова, используя разделитель, описанный в RegExp.
    // разделитель также попадает в результирующий массив
    $words = preg_split("/([\s,'-.!?]+)/", $str, -1, PREG_SPLIT_DELIM_CAPTURE);
    $reversed = '';

    //вывдем на экран полученный массив
    print_r($words);

    // перебираем полученный массив поиндексно
    foreach ($words as $word) {

        // на всё суммарное совпадение последовательности алфавитных символов
        // (любого языка) вызываем callback function,  в которой вызываем функцию
        // поиска индексов символов в верхнем регистре и переворачивания слова

        $reversed .= preg_replace_callback('/\p{L}+/u', function ($match) {return reverseWordWithCasePreservation($match[0]);}, $word);
    }

    return $reversed;
}

function reverseWordWithCasePreservation($word)
{
    $length = strlen($word);
    $position = [];
    //перебираем слово посимвольно, выясняем индекс символа в верхнем регистре
    //индексы сохраняем в массив
    for ($i = 0; $i < $length; $i++) {
        if (ctype_upper($word[$i])) {
            $position[] = $i;
        }
    }

    //во избежание путаницы переводим всё слово в нижний регистр
    $reversed = strtolower(strrev($word));

    //перебираем массив с индексами, переводим символ с индексом в верхний регистр
    foreach ($position as $pos) {
        $reversed[$pos] = strtoupper($reversed[$pos]);
    }

    return $reversed;
}

$input = "heLLo-World!";
$output = reverseWords($input);
echo $output;