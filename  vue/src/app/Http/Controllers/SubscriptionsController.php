<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionsController extends Controller
{
    public function subscribe(Request $request,int $userId)
    {
        Subscription::create([
            'subscriber_id' => $request->user->id,
            'user_id' => $userId
        ]);
    }
}
