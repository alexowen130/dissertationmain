<?php

namespace App\Controllers\downloadfile;

use App\controllers\BaseController;
use App\models\download;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use App\lib\moveUploadedFile;

class SubmitController extends BaseController
{

    //Renders template that is needed
    public function getDownload($request, $response)
    {
        return $this->container->view->render($response, 'Filedownload/filedownload.html');

    }

    public function postDownload($request, $response)
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

            //Moves file to directory
            $filename = moveUploadedFile('/var/www/downloads', $uploadedFile);


            //Adds File to DB
            $downloads = Download::create(
                [

                'filename' => $uploadedFileName,
                'filetype' => $mediaType,
                'filelocation' => $filename

                ]
            );

            //Displays message confirming Sucess
            $this->container->flash->addMessage('info', 'You have sucessfully Uploaded a File! Are there any more to submit');

            //Returns to Submission Page
            return $response->withRedirect($this->container->router->pathFor('submit.download'));
        }

        //Displays Errors
        $this->container->flash->addMessage('error', 'We are unable to upload your file please try again!');

        //Returns to Submission Page
        return $response->withRedirect($this->container->router->pathFor('submit.download'));

    }

}

//Function from Slim Documentation that allows the file to be moved into a specificed directory

function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}