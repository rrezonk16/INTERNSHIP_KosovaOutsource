<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotificationEmail;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendNotification()
    {
        $details = [
            'email' => 'rrezonkrasniqi32@gmail.com',
            'title' => 'Testing Jobs and Queues',
            'body'  => 'This is a Testing Jobs and Queues notification email.'
        ];

        SendNotificationEmail::dispatch($details);

        return response()->json(['message' => 'Notification email queued successfully']);
    }
}
