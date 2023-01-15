<?php
namespace JWTRenan\JWT\Token;

use JWTRenan\JWT\Helpers\Encoder;

class Login
{

    public function generate_token(Array $payload, String $api_token)
    {

        if(!empty($payload) && !empty($api_token))
        {

            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];
    
            $date = [
                'date' => date('Y:m:d')
            ];
    
            array_push($payload, $date);
    
            $header = json_encode($header);
            $payload = json_encode($payload);
    
            $header = Encoder::base64UrlEncode($header);
            $payload = Encoder::base64UrlEncode($payload);
    
            $sign = hash_hmac('sha256', $header . "." . $payload, $api_token, true);
            $sign = Encoder::base64UrlEncode($sign);
    
            $token = $header . '.' . $payload . '.' . $sign;
    
            header("HTTP/1.0 200");
            return Encoder::returnJson(array('token' => $token));

        }

        header("HTTP/1.0 401");
        return Encoder::returnJson( array('mensagem' => 'Login fail.' ));   

    }

}
