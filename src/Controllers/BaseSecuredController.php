<?php

namespace Controllers;

use Firebase\JWT\JWT;

class BaseSecuredController extends BaseController
{
    /**
     * Decode and validate the token
     *
     * @param  string         $$token
     * @return object|boolean The JWT's payload as a PHP object or false in case of error
     */
    public function decodeToken($token)
    {
        $rst = [
            "token" => false,
            "message" => ""
        ];
        try {
            JWT::$leeway = 8;
            $content     = file_get_contents("https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com");
            $kids        = json_decode($content, true);
            $jwt         = JWT::decode($token, $kids, array('RS256'));
            $fbpid       = $this->getOrDefault('firebase.projectid', 'dummy');
            $issuer      = 'https://securetoken.google.com/' . $fbpid;
            $rst["token"] = $token;

            if ($jwt->aud != $fbpid) {
                $rst["message"] = 'invalid audience';
                $rst["token"] = null;
            } elseif ($jwt->iss != $issuer) {
                $rst["message"] = 'invalid issuer';
                $rst["token"] = null;
            } elseif (empty($jwt->sub)) {
                $rst["message"] = 'invalid user';
                $rst["token"] = null;
            };

        } catch (\Firebase\JWT\ExpiredException $ee) {
            $rst["message"] = 'token has expired';
            $rst["token"] = null;
        } catch (\Exception $e) {
            $rst["message"] = $e->getMessage();
            $rst["token"] = null;
        }

        return $rst;
    }

    /**
     * Authenticate
     */
    public function beforeRoute()
    {
        $headers = $this->getAuthorizationHeader();

        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/i', $headers, $matches)) {
                $token = $matches[1];

                $decodedTokenData = $this->decodeToken($token);
                if (is_null($decodedTokenData["token"])) {
                    $this->f3->error('403', 'Token error: ' + $decodedTokenData["message"]);
                    return;
                }
                
                $this->tokenData = $decodedTokenData;
                return;
            }

            $this->f3->error('403', 'Authorization Bearer is required');
        }

        $this->f3->error('403', 'Authorization header is required');
        return;
    }
}
