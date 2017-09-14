<?php

namespace App\Controllers\downloadresults;

use App\controllers\BaseController;
use App\models\download;
use App\Submission\SubmissionDisplay;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use App\lib\moveUploadedFile;

class UnittestController extends BaseController
{

    //Renders template that is needed
    public function getTest($request, $response, $args)
    {

        $file = '/var/www/Reports/'.$args['filename'];
            
        return $this->container->view->render(
            $response, 'UnitTest/unittest.html'
        );

    }


    public function postTestDownload($request, $response)
    {

        //Gets the file from template
        $uploadedFile = $request->getUploadedFiles();

        $uploadedFile = $uploadedFile['file'];

        //Checks if any Errors are present
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

            //Gets FileName as stored on Server
            $uploadedFileName = $request->getUploadedFiles()['file']->getClientFilename();

            //Gets the FileType

            $mediaType = $request->getUploadedFiles()['file']->getClientMediaType();


            switch ($mediaType) {
            case 'application/x-javascript':
                    $filename = moveUploadedFile('/var/www/unitTestJS', $uploadedFile);
                    $this->container->flash->addMessage('info', 'You have sucessfully Uploaded a Unit test file for JavaScript');
                return $response->withRedirect($this->container->router->pathFor('unittest.file'));
                    break;

            case 'application/x-php':
                    $filename = moveUploadedFile('/var/www/unitTestPHP', $uploadedFile);
                    $this->container->flash->addMessage('info', 'You have sucessfully Uploaded a Unit test file for PHP');
                return $response->withRedirect($this->container->router->pathFor('unittest.file'));
                    break;
                
            default:
                    $this->container->flash->addMessage('error', 'You have not input the correct file type, please try again and refer to the example files at the bottom of the page.');
                return $response->withRedirect($this->container->router->pathFor('unittest.file'));
                    break;
            }
        }
    }

}

//Function from Slim Documentation that allows the file to be moved into a specificed directory

//Function from Slim Documentation that allows the file to be moved into a specificed directory

function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = 'AssertUnitTest'; // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}