<?php

namespace Controllers;

use Firebase\JWT\JWT;

class BaseSecuredController extends BaseController
{
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
