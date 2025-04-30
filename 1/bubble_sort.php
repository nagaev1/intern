<?php

function bubble_sort($array)
{
    while ($isSorted == false) {
        $isSorted = true;
        for ($i = 0; $i < count($array) - 1; $i++) {
            if ($array[$i] > $array[$i + 1]) {
                [$array[$i], $array[$i + 1]] = [$array[$i + 1], $array[$i]];
                $isSorted = false;
            }
        }
    }
    echo print_r($array);
}

$arr = [3, 4, 1, 5, 6, 1, 4, 1, 4, 7, 12, 5, 13, 1, 31, 'a', 'f', 'd', 'e', 'b', 'A', 'h', 'B'];
bubble_sort($arr);