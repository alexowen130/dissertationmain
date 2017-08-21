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


    // //For User to attempt to log in
    // public function attempt($username, $password)
    // {

    //     $user = User::where('username', $username)->first();

    //     if (!$user) {

    //         return false;
    //     }

    //     if (password_verify($password, $user->password)) {

    //         $_SESSION['user'] = $user->id;
    //         return true;
    //     }

    //     return false;

    // }

    // //Logs Out
    // public function logout()
    // {
    //     unset($_SESSION['user']);

}