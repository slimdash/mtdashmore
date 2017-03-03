<?php

namespace Controllers;

class Index extends BaseController
{
    /**
     * health check
     */
    public function getHealthCheck()
    {
    	echo 'OK';
    }

    public function index() 
    {
    	$this->f3->reroute('/login');
    }

    public function getLogin()
    {
        $this->render('login.html');
    }

    public function getLogout()
    {
    	// clear session
    	$this->f3->clear('SESSION');
        $this->render('logout.html');
    }

    public function getDashboard()
    {
        $this->render('main/index.html');
    }

    public function getProject()
    {
        $this->render('project.html');
    }

    public function getAuthFirebase()
    {
        $token = $this->queryParam('token');

        // validate token
        $decodedTokenData = $this->decodeToken($token);

        if (is_null($decodedTokenData["token"])) {
            $this->f3->error('403', 'Token error: ' + $decodedTokenData["message"]);
            return;
        }

        // store token into session
        $this->f3->set('SESSION.decodedToken', $decodedTokenData);

        // success login redirect to home
        return $f3->reroute('@home');
    }
}
