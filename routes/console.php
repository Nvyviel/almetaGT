<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule automatic deletion of expired shipments
Schedule::command('shipments:delete-expired')
    ->daily() // Run every day at midnight
    ->appendOutputTo(storage_path('logs/auto-delete-shipments.log'));

// Schedule automatic validation of shipment dates
Schedule::command('shipments:validate-dates --fix')
    ->dailyAt('02:00') // Run every day at 2 AM
    ->appendOutputTo(storage_path('logs/validate-dates.log'));
