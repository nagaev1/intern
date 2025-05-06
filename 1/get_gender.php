<?php
function getGender(string $name)
{
    if (strlen($name) < 10 || strlen($name) > 100 || !ctype_alpha($name)) {
        echo 'wrong name';
        return;
    }
    echo $name . ' / length: ' . strlen($name) . "\r\n";
    if (strlen($name) % 2) {
        echo 'Boy!';
    } else {
        echo 'Girl!';
    }
}

$name = "ashfasdkjfhdskjfsdhfksgfshdfgsfjhdgsdjhfgs";
getGender($name);
