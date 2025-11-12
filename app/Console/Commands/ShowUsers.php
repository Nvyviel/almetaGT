<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all users in the system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = \App\Models\User::select('id', 'name', 'email')->get();
        
        if ($users->count() === 0) {
            $this->info('No users found in the system.');
            return;
        }
        
        $this->info('Users in the system:');
        foreach ($users as $user) {
            $this->line("ID: {$user->id} | Email: {$user->email} | Name: {$user->name}");
        }
    }
}
