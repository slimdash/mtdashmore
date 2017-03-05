<?php

namespace Controllers;

use PhpFirebase\Firebase;

class MainDashboard extends BaseSecuredController
{
    public function getDashboard() 
    {
    	// Base endpoint
		$base = 'https://brick-admin.firebaseio.com';

		// Auth token
		$token = $this->tokenData["token"];

    	// get list of projects
        $rsp = $this->doGetJson($base . '/projects.json', [], ["auth" => $token]); 
		$projs = $rsp["body"];
        $filtered = [];

    	// filter out projects user does not have permission to
        foreach ($projs as $project => $value) {
            if (isset($value["members"][$this->tokenData["decoded"]->sub])){
                $filtered[$project] = $value;
            }
        } 

    	// return and render to main dashboard
        $this->render('main.html', ["projects" => json_encode($filtered)]);
    }
}
