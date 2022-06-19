<?php

function is_prefix(string $haystack, string $str){
    $len_haystack = mb_strlen($haystack);
    $len_str = mb_strlen($str);

    if ($len_haystack < $len_str) return false;

    for ($i = 0; $i < $len_str; $i++)
        if (mb_substr($haystack, $i, 1) !== mb_substr($str, $i, 1)) return false;

    return true;
}

function random_string(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring = $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}