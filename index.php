<?php

function reverseWords($str)
{
    // разбиваем входящую строку на слова, используя разделитель, описанный в RegExp.
    // разделитель также попадает в результирующий массив
    $words = preg_split("/([\s,'-.`!?]+)/", $str, -1, PREG_SPLIT_DELIM_CAPTURE);
    $reversed = '';

    //вывдем на экран полученный массив
    echo "<pre>";
    print_r($words);
    echo "</pre><br>";

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
    $position = [];
    //перебираем слово посимвольно, выясняем индекс символа в верхнем регистре
    //индексы сохраняем в массив
    for ($i = 0; $i < strlen($word); $i++) {
        if (ctype_upper($word[$i])) {
            $position[] = $i;
        }
    }

    //во избежание путаницы переводим всё слово в нижний регистр
    $reversed = strtolower(strrev($word));

    //перебираем массив с индексами, переводим символ с индексом в верхний регистр
    foreach ($position as $pos) {
        $reversed[$pos] = mb_strtoupper($reversed[$pos]);
    }

    return $reversed;
}

function testReverseWord()
{
    $input1 = "Cat";
    $expected1 = "Tac";
    $output1 = reverseWords($input1);
    if (assert($output1 === $expected1)) {
        echo "Test 1 OK<br>";
    }

    $input2 = "houSe";
    $expected2 = "esuOh";
    $output2 = reverseWords($input2);
    assert($output2 === $expected2);
    echo "Test 2 OK <br>";

    $input3 = "elEpHant";
    $expected3 = "tnAhPele";
    $output3 = reverseWords($input3);
    assert($output3 === $expected3);
    echo " Test 3 OK <br>";

    $input4 = "cat,";
    $expected4 = "tac,";
    $output4 = reverseWords($input4);
    assert($output4 === $expected4);
    echo "Test 4 OK <br>";

    $input5 = "is 'cold' now";
    $expected5 = "si 'dloc' won";
    $output5 = reverseWords($input5);
    assert($output5 === $expected5);
    echo "Test 5 OK <br>";

    $input6 = "third-part";
    $expected6 = "driht-trap";
    $output6 = reverseWords($input6);
    assert($output6 === $expected6);
    echo "Test 6 OK <br>";

    $input7 = "can`t";
    $expected7 = "nac`t";
    $output7 = reverseWords($input7);
    assert($output7 === $expected7);
    echo "Test 7 OK <br>";

}

// $input = "elEpHant";
// $output = reverseWords($input);
// echo $output;

testReverseWord();
