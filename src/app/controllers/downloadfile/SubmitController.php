<?php

namespace App\Controllers\downloadfile;

use App\controllers\BaseController;
use App\models\download;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

class SubmitController extends BaseController
{

	public function getDownload($request, $response)
	{
	 	return $this->container->view->render($response, 'Filedownload/filedownload.html');

	}

	public function postDownload($request, $response)
	{


		$uploadedFile = $request->getUploadedFiles()['file'];

   		if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

	
   			$uploadedFileName = $request->getUploadedFiles()['file']->getClientFilename();
   			$mediaType = $request->getUploadedFiles()['file']->getClientMediaType();

   			$filename = moveUploadedFile('/var/www/downloads', $uploadedFile);

   			var_dump($uploadedFileName);

			move_uploaded_file($uploadedFileName, '/var/www/downloads');   			


		$this->container->flash->addMessage('info', 'You have sucessfully Uploaded a File! Are there any more to submit');
		
	}

}
}