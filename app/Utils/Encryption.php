<?php

namespace App\Utils;

class Encryption {
    public static function encrypt($data, $secretKey) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
        $encryptedData = openssl_encrypt($data, "aes-256-cbc", $secretKey, 0, $iv);
        return base64_encode($encryptedData . "::" . $iv);
    }

    public static function decrypt($data, $secretKey) {
        list($encryptedData, $iv) = explode("::", base64_decode($data), 2);
        return openssl_decrypt($encryptedData, "aes-256-cbc", $secretKey, 0, $iv);
    }
}