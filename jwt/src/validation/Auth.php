<?php
namespace JWTRenan\JWT\Validation;

use JWTRenan\JWT\Helpers\Encoder;

class Auth {

    public function check_auth(String $api_token)
	{
		$http_header = apache_request_headers();

		if (isset($http_header['Authorization']) && $http_header['Authorization'] != null && !empty($api_token)) {
			$bearer = explode (' ', $http_header['Authorization']);

			$token   = explode('.', $bearer[1]);
			$header  = $token[0];
			$payload = $token[1];
			$sign    = $token[2];

			$valid = hash_hmac('sha256', $header . "." . $payload, $api_token, true);
			$valid = Encoder::base64UrlEncode($valid);

			if ($sign === $valid) {
				return true;
			}
		}

		header("HTTP/1.0 401");
		Encoder::returnJson( array('success' => false, "mensagem"=> "Not authorized."));
	}   

}