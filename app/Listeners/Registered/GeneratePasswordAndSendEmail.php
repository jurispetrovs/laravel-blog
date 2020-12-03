<?php

namespace App\Listeners\Registered;

use App\Mail\UserPassword;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GeneratePasswordAndSendEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(Registered $event)
    {
        $user = $event->user;

        $password = Str::random(10);
        $user->password = Hash::make($password);
        $user->save();

        Mail::to($user)->queue(new UserPassword($user, $password));
    }
}
