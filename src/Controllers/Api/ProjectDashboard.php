<?php

namespace Controllers\Api;

class ProjectDashboard extends \Controllers\BaseSecureController
{
    public function index() {
    	// if user does not provide a project, render project list
    	return $this->listView();
    }

    public function listView() {
    	// get all projects
    	// filter out to only projects user has permission
    	// render ui
    }
}
