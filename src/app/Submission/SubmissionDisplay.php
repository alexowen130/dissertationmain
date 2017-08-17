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
    // Download::table('downloads')->get();

    // $size = sizeof($downloads);

    // $fileId;
    // $download = array();

    // for ($i = 0; $i < $size; $i++) {

    //     array_push($download, $downloads[$i]);

    // }

    return $downloads;


    // foreach ($downloads as $download) {
    //     return sizeof($downloads);
    // }
    

    // public function signedIn()
    // {

    //     return isset($_SESSION['user']);
    // }

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

}}