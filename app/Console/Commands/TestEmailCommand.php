<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {email} {--method=log}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email functionality for password reset';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $method = $this->option('method');
        
        // Check if user exists
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }
        
        $this->info("Testing email functionality...");
        $this->info("Email: {$email}");
        $this->info("Method: {$method}");
        $this->info("Current MAIL_MAILER: " . config('mail.default'));
        
        try {
            // Temporarily change mail driver if needed
            if ($method !== config('mail.default')) {
                config(['mail.default' => $method]);
                $this->info("Temporarily switched to {$method} mailer");
            }
            
            // Send password reset
            $status = Password::sendResetLink(['email' => $email]);
            
            if ($status === Password::RESET_LINK_SENT) {
                $this->info("✅ Password reset email sent successfully!");
                
                if ($method === 'log') {
                    $this->info("💡 Check the log file at: storage/logs/laravel.log");
                }
            } else {
                $this->error("❌ Failed to send password reset email.");
                $this->error("Status: {$status}");
            }
            
        } catch (\Exception $e) {
            $this->error("❌ Exception occurred:");
            $this->error($e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
