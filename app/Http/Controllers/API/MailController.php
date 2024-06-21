<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $subject = $request->input('subject');
        $body = $request->input('body');

        // Validate inputs if needed

        // Send email using SendMail Mailable class
        Mail::to('recipient@example.com')->send(new SendMail($subject, $body));

        return response()->json(['message' => 'Email sent successfully'], 200);
    }
}
