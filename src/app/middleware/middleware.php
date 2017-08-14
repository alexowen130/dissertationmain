<?php

namespace App\middleware;


class middleware
{
	//Creates Container Instance
    protected $container;

    //Returns Container when called in Dependancies
    public function __construct($container)
    {
        $this->container = $container;

    }
}
