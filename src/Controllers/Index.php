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
        $token = $this->f3->get('GET.token');

        // store token into session
        $this->f3->set('SESSION.token', "Bearer " . $token);

        // success login redirect to home
        return $this->f3->reroute('@home');
    }
}
