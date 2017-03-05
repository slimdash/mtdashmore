<?php

namespace Controllers;

class ProjectDashboard extends BaseSecureController
{
    public function getDashboard() 
    {
    	// if user does not have permission to project, redirect to login
    	// get list of modules
    	// filter out any module that projects does not have permission to
    	// render dashboard with modules
    }

    public function getModule() 
    {
    	// render module
    }
}
