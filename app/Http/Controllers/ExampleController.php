<?php

/// app/Http/Controllers/ExampleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class ExampleController extends Controller
{
    public function sendEmail()
    {
        try {
            // Send email
            Mail::to('farahanaabdullah365@gmail.com')->send(new TestEmail());
            
            return "Email sent successfully!";
        } catch (\Exception $e) {
            return "Failed to send email. Error: " . $e->getMessage();
        }
    }
}

