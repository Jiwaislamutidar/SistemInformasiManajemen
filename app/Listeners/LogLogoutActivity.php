<?php

namespace App\Listeners;

use App\Services\ActivityLogger;
use Illuminate\Auth\Events\Logout;

class LogLogoutActivity
{
    public function handle(Logout $event): void
    {
        ActivityLogger::log('Logout dari sistem', $event->user);
    }
}
