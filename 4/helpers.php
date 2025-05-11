<?php

function generate(string $view, array $data = [])
{
    if (!empty($data)) {
        // преобразуем элементы массива в переменные
        extract($data);
    }
    include "./resources/views/$view.php";
}
