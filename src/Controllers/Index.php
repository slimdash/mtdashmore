<?php

namespace Controllers;

class Index extends BaseController
{
    /**
     * health check
     */
    public function index()
    {
        $this->render('login.html');
    }
}
