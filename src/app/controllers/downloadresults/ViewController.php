<?php

namespace App\Controllers\downloadresults;

use App\controllers\BaseController;
use App\models\download;
use App\Submission\SubmissionDisplay;

class ViewController extends BaseController
{

    //Renders template that is needed
    public function getView($request, $response, $args)
    {

    	$file = '/var/www/Reports/'.$args['filename'];

    	$data = file_get_contents($file);

    	$json = json_decode($data, true);

    	foreach ($json as $d) {

    		var_dump($d);


    	}
       
        return $this->container->view->render($response, 'Results/ResultsView.html');

    }
    
}