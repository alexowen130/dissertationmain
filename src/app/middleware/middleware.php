<?php

namespace App\middleware;


class middleware
{

	protected $container;


	public function __construct($container)
	{
		$this->container = $container;

	}
}
