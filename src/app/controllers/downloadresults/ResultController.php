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

	for($i; $i < sizeof($download); $i++){
		
		$filelocation = $download[$i]['filelocation'];

		$codeCheck = $this->container->submission->codeLint($filelocation);
	}


        return $this->container->view->render($response, 'Results/Results.html', array(
        		'download' => $download,
        	));

    }
    
}


