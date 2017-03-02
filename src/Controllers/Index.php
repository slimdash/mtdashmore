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

        // redirect to the main dashboard
        return $this->response->withRedirect('/main/dash');
    }
}
