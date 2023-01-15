<?php

namespace JWTRenan\JWT\Helpers;

class Encoder
{

    public static function base64UrlEncode($data)
    {

        $b64 = base64_encode($data);
        if ($b64 === false) {
            return false;
        }
        $url = strtr($b64, '+/', '-_');

        return rtrim($url, '=');
    }

    public static function returnJson($array)
    {
        header("Content-Type: application/json");
        echo json_encode($array);
        exit;
    }
}
