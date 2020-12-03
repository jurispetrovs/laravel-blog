<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CounterListener implements ShouldQueue
{

    use InteractsWithQueue;

    public function handle($event)
    {
        $x = 0;

        while($x < 1000) {
            $x++;
        }
    }
}
