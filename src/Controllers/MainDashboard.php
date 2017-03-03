<?php

namespace Controllers;

class MainDashboard extends BaseController
{
    public function getDashboard() 
    {
    	// get list of projects
    	// filter out projects user does not have permission to
    	// return and render to main dashboard
    	// render main dashboard
        $this->render('main.html');
    }
}
