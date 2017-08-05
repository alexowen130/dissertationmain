<?php

namespace App\Controllers\downloadfile;

use App\controllers\BaseController;
use App\models\download;

class SubmitController extends BaseController
{

	public function getDownload($request, $response)
	 {
	 	return $this->container->view->render($response, 'Filedownload/filedownload.html');

	}

	public function postDownload($request, $response)
	{

		$filename = $request->getUploadedFiles()['filename'];

		var_dump($filename->getClientFilename());


		die();

		 // $uploadedFile = $uploadedFiles['example1'];
   //  if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
   //      $filename = moveUploadedFile($directory, $uploadedFile);
   //      $response->write('uploaded ' . $filename . '<br/>');


		$this->container->flash->addMessage('info', 'You have sucessfully Uploaded a File! Are there any more to submit');
		
	}


}