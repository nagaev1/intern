<?php

$stringArray = ['one', 'two', 'three', 'fourone', 'one', 'ooone'];
$subString = 'one';
$arrayA = [];
$arrayB = [];

foreach ($stringArray as $el) {
    if (str_contains($el, $subString)) {
        array_push($arrayA, $el);
    } else {
        array_push($arrayB, $el);
    }
}

echo print_r($arrayA, true), print_r($arrayB, true);