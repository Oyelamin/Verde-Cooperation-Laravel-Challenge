<?php

/**
 * @param $array
 * @return array
 */
function flattenArray($array)
{
    $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
    $result = [];
    foreach ($it as $v) {
        array_push($result, $v);
    }
    return $result;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
