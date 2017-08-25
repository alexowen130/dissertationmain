<?php

namespace App\Controllers\downloadresults;

use App\controllers\BaseController;
use App\models\download;
use App\Submission\SubmissionDisplay;
use Slim\Http\Request;
use Slim\Http\Response;

class DownloadingController extends BaseController
{
    //Renders template that is needed
    public function getDownload($request, $Response, $args)
    {

        $file = '/var/www/Reports/'.$args['filename'];

        // echo $file;

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment;filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);

        }
    }

        //Renders template that is needed
    public function getFile($request, $Response, $args)
    {

        $file = '/var/www/downloads/'.$args['filename'];

        // echo $file;

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment;filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);

        }
    }














    
}
