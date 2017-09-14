<?php

/**
Controls Authentication of App
**/


namespace App\Submission;

use App\models\download;

//Talks to DB to setup and check user
class SubmissionDisplay
{

    public function download()
    {
        $downloads = Download::all();

        return $downloads;
    }  


    //Copes with JS, PHP, CSS
    public function codeLint($filename)
    {

        $output = shell_exec('../../vendor/bin/phpcs --report=json --report-file=/var/www/Reports/'.$filename.'.json /var/www/downloads/' . $filename);
            return $output;  
    }

    public function phpUnitTest($filename)
    {

        $output = shell_exec('../../vendor/bin/phpunit --coverage-text /var/www/unitTestPHP/AssertUnitTest.php');

            $output1 = substr($output, 53, -56);  
            return $output1;  
    }

    public function jsUnitTest($filename)
    {

        $output = shell_exec('../../vendor/bin/qunit /var/www/downloads/' . $filename);
            return $output;
    }    

}