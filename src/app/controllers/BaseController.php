<?php


namespace App\Controllers;

class BaseController
{

	//Creates Container for App
    protected $container;

    public function __construct($container)
    {

        $this->container = $container;


    }


}