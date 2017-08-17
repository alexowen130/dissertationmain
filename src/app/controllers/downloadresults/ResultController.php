<?php

namespace App\Controllers\downloadresults;

use App\controllers\BaseController;
use App\models\download;
use App\Submission\SubmissionDisplay;

class ResultController extends BaseController
{

    //Renders template that is needed
    public function getResults($request, $response)
    {

	$download = $this->container->submission->download();


        return $this->container->view->render($response, 'Results/Results.html', array(
        		'download' => $download,
        	));

    }
    
}


