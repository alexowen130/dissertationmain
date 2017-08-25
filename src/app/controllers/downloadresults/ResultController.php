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

        for ($i =1; $i < sizeof($download); $i++) {

            $filelocation = $download[$i]['filelocation'];
            $fileid = $download[$i]['id'];

            $codeCheck = $this->container->submission->codeLint($filelocation);


            $results = Download::find($fileid)->update(
                array(

                'lintresult' => $filelocation.'.json',
                )
            );

        }


        //Displays message confirming Sucess
            $this->container->flash->addMessage('info', 'Your files have been sucessfully checked, please download the files to see the results');
        
            
        return $this->container->view->render(
            $response, 'Results/Results.html', array(
            'download' => $download,
            )
        );

    }
    
}



