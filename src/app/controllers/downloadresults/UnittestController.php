<?php

namespace App\Controllers\downloadresults;

use App\controllers\BaseController;
use App\models\download;
use App\Submission\SubmissionDisplay;
use Slim\Http\Request;
use Slim\Http\Response;

class UnittestController extends BaseController
{

    //Renders template that is needed
    public function getTest($request, $response, $args)
    {

     	$file = '/var/www/Reports/'.$args['filename'];
            
        return $this->container->view->render(
            $response, 'UnitTest/unittest.html');

    }
    
}