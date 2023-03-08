<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        try {
            Mail::to('channl@ominext.com')->send(new TestMail());
        } catch (Exception $th) {
            dd($th->getMessage());
        }
    }
}
