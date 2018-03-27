<?php
function generateRandomString($id) {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    $randomString_n = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
for ($i = 0; $i < $length; $i++) {
        $randomString_n .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString .$id .$randomString_n;
}

?>